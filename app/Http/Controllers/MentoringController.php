<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMentoringRequest;
use App\Models\Jadwal;
use App\Models\JadwalMentor;
use App\Models\KelompokMahasiswa;
use App\Models\KelompokMentor;
use App\Models\Mentoring;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class MentoringController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Mentor') {
            $data = Mentoring::where('user_id', auth()->user()->id)->select('mahasiswa_id')->distinct()->get();
        } elseif (auth()->user()->role == 'Mahasiswa') {
            $data = Mentoring::where('mahasiswa_id', auth()->user()->id)->get();
            return view('mentoring.index', compact('data'));
        } elseif (auth()->user()->role == 'Admin') {
            $data = Mentoring::select('mahasiswa_id')->distinct()->get();
        } else {
            $data = [];
        }

        $totalMentoring = [];
        foreach ($data as $value) {
            $totalMentoring[$value->mahasiswa_id] = Mentoring::where('mahasiswa_id', $value->mahasiswa_id)->where('ket', 1)->count();
        }
        return view('mentoring.list', compact('data', 'totalMentoring'));
    }

    public function create()
    {
        // $mahasiswa = [];
        $jadwal = [];
        // $kelompokMentor = KelompokMentor::where('user_id', auth()->user()->id)->get();
        // foreach ($kelompokMentor as $value) {
        //     $kelompokMahasiswa = KelompokMahasiswa::where('kelompok_id', $value->kelompok_id)->get();
        //     foreach ($kelompokMahasiswa as $item) {
        //         $mahasiswa[] = User::where('id', $item->user_id)->first();
        //     }
        // }
        $kelompokMahasiswa = KelompokMahasiswa::where('user_id', auth()->user()->id)->first();
        $getMentor = KelompokMentor::where('kelompok_id', $kelompokMahasiswa->kelompok_id)->first();
        $jadwalKelompok = JadwalMentor::where('user_id', $getMentor->user_id)->get();
        // dd($jadwalKelompok);
        foreach ($jadwalKelompok as $value) {
            $jadwal[] = Jadwal::where('id', $value->jadwal_id)->first();
        }
        return view('mentoring.create', compact('jadwal'));
    }

    public function store(StoreMentoringRequest $request)
    {
        try {
            $data = $request->validated();

            // $image = $request->input('signature');
            // $decoded = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image)); // Dekode base64 ke gambar biner

            // $upload_path = 'public/signatures';
            // $filename = 'signature_' . uniqid() . '.png';
            // Storage::put($upload_path . '/' . $filename, $decoded);

            $angkatan = KelompokMahasiswa::where('user_id', auth()->user()->id)->first();
            $data['angkatan_id'] = $angkatan->kelompok->angkatan->id;

            // ambil id mentor mhs
            $kelompokMahasiswa = KelompokMahasiswa::where('user_id', auth()->user()->id)->first();
            $getMentor = KelompokMentor::where('kelompok_id', $kelompokMahasiswa->kelompok_id)->first();
            $data['user_id'] = $getMentor->user_id;
            $data['mahasiswa_id'] = auth()->user()->id;

            // $data['signature'] = $upload_path . '/' . $filename;
            Mentoring::create($data);
        } catch (\Exception $e) {
            return redirect(route('mentoring.index'))->with('error', 'Gagal ' . $e->getMessage());
        }
        return redirect(route('mentoring.index'))->with('success', 'Berhasil input hasil mentoring');
    }

    public function edit(Mentoring $mentoring)
    {
        $mahasiswa = [];
        $jadwal = [];
        $kelompokMentor = KelompokMentor::where('user_id', auth()->user()->id)->get();
        foreach ($kelompokMentor as $value) {
            $kelompokMahasiswa = KelompokMahasiswa::where('kelompok_id', $value->kelompok_id)->get();
            foreach ($kelompokMahasiswa as $item) {
                $mahasiswa[] = User::where('id', $item->user_id)->first();
            }
        }
        $jadwalMentor = JadwalMentor::where('user_id', auth()->user()->id)->get();
        foreach ($jadwalMentor as $value) {
            $jadwal[] = Jadwal::where('id', $value->jadwal_id)->first();
        }
        return view('mentoring.edit', compact('mentoring', 'mahasiswa', 'jadwal'));
    }

    public function update(Request $request, Mentoring $mentoring)
    {
        try {
            $request->validate([
                'mahasiswa_id' => 'required',
                'jadwal_id' => 'required',
                'deskripsi' => 'required'
            ]);
            $mentoring->update($request->all());
        } catch (\Exception $e) {
            return redirect(route('mentoring.detail', $mentoring->mahasiswa_id))->with('error', 'Gagal Update Data');
        }
        return redirect(route('mentoring.detail', $mentoring->mahasiswa_id))->with('success', 'Berhasil Update Data');
    }

    public function destroy(Mentoring $mentoring)
    {
        $mentoring->delete();
        return redirect()->route('mentoring.detail', $mentoring->mahasiswa_id)->with('success', 'Data berhasil dihapus.');
    }

    public function detail($id)
    {
        $data = Mentoring::where('mahasiswa_id', $id)->get();
        return view('mentoring.index', compact('data'));
    }

    public function acc(Mentoring $mentoring)
    {
        $mentoring->update([
            'ket' => 1
        ]);
        return redirect()->route('mentoring.detail', $mentoring->mahasiswa_id)->with('success', 'Berhasil Acc Data');
    }

    public function revisi(Mentoring $mentoring)
    {
        return view('mentoring.revisi', compact('mentoring'));
    }

    public function updateRevisi(Request $request, Mentoring $mentoring)
    {
        try {
            $request->validate([
                'ket' => 'required',
            ]);
            $mentoring->update($request->all());
        } catch (\Exception $e) {
            return redirect(route('mentoring.detail', $mentoring->mahasiswa_id))->with('error', 'Gagal');
        }
        return redirect(route('mentoring.detail', $mentoring->mahasiswa_id))->with('success', 'Berhasil Kirim Revisi');
    }

    public function lihatRevisi(Mentoring $mentoring)
    {
        return view('mentoring.lihat_revisi', compact('mentoring'));
    }

    public function cetak()
    {
        $data = Mentoring::where('mahasiswa_id', auth()->user()->id)->where('ket', 1)->get();
        $angkatan = KelompokMahasiswa::join('kelompok', 'kelompok_mahasiswa.kelompok_id', 'kelompok.id')
            ->join('angkatan', 'kelompok.angkatan_id', 'angkatan.id')
            ->select('angkatan.angkatan')
            ->where('user_id', auth()->user()->id)->first();
        return view('cetak.resolusi', [
            'angkatan' => $angkatan,
            'data' => $data

        ]);
        // $pdf = PDF::loadview('cetak.resolusi', [
        //     'angkatan' => $angkatan,
        //     'data' => $data

        // ]);
        // return $pdf->download('resolusi-mahasiswa.pdf');
    }

    public function cetakAdmin()
    {
        $data = Mentoring::select('mahasiswa_id')->distinct()->get();
        $totalMentoring = [];
        foreach ($data as $value) {
            $totalMentoring[$value->mahasiswa_id] = Mentoring::where('mahasiswa_id', $value->mahasiswa_id)->where('ket', 1)->count();
        }
        return view('cetak.resolusi_mahasiswa', compact('data', 'totalMentoring'));
        // $pdf = PDF::loadview('cetak.resolusi_mahasiswa', compact('data', 'totalMentoring'));
        // return $pdf->download('Laporan.pdf');
    }

    public function cetakMahasiswa($id)
    {
        $mahasiswa = User::find($id);
        $data = Mentoring::where('mahasiswa_id', $id)->where('ket', 1)->get();
        $angkatan = KelompokMahasiswa::join('kelompok', 'kelompok_mahasiswa.kelompok_id', 'kelompok.id')
            ->join('angkatan', 'kelompok.angkatan_id', 'angkatan.id')
            ->select('angkatan.angkatan')
            ->where('user_id', $id)->first();
        return view('cetak.resolusi', [
            'angkatan' => $angkatan,
            'data' => $data,
            'mahasiswa' => $mahasiswa
        ]);
        // $pdf = PDF::loadview('cetak.resolusi', [
        //     'angkatan' => $angkatan,
        //     'data' => $data,
        //     'mahasiswa' => $mahasiswa
        // ]);
        // return $pdf->download('resolusi-mahasiswa.pdf');
    }
}
