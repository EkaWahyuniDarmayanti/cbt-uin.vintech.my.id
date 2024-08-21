<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAbsensiRequest;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\JadwalMentor;
use App\Models\KelompokMahasiswa;
use App\Models\KelompokMentor;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class AbsensiController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Mentor') {
            $data = Absensi::where('user_id', auth()->user()->id)->select('mahasiswa_id')->distinct()->get();
        } elseif (auth()->user()->role == 'Mahasiswa') {
            $data = Absensi::where('mahasiswa_id', auth()->user()->id)->get();
            return view('absensi.index', compact('data'));
        } elseif (auth()->user()->role == 'Admin') {
            $data = Absensi::select('mahasiswa_id')->distinct()->get();
        } else {
            $data = [];
        }

        $totalAbsensi = [];
        foreach ($data as $value) {
            $totalAbsensi[$value->mahasiswa_id] = Absensi::where('mahasiswa_id', $value->mahasiswa_id)->count();
        }
        return view('absensi.list', compact('data', 'totalAbsensi'));
    }

    public function create()
    {
        $jadwal = [];
        $kelompokMahasiswa = KelompokMahasiswa::where('user_id', auth()->user()->id)->first();
        $getMentor = KelompokMentor::where('kelompok_id', $kelompokMahasiswa->kelompok_id)->first();
        $jadwalKelompok = JadwalMentor::where('user_id', $getMentor->user_id)->get();
        foreach ($jadwalKelompok as $value) {
            $jadwal[] = Jadwal::where('id', $value->jadwal_id)->first();
        }
        return view('absensi.create', compact('jadwal'));
    }

    public function store(StoreAbsensiRequest $request)
    {
        try {
            $data = $request->validated();

            $angkatan = KelompokMahasiswa::where('user_id', auth()->user()->id)->first();
            $data['angkatan_id'] = $angkatan->kelompok->angkatan->id;

            // ambil id mentor mhs
            $kelompokMahasiswa = KelompokMahasiswa::where('user_id', auth()->user()->id)->first();
            $getMentor = KelompokMentor::where('kelompok_id', $kelompokMahasiswa->kelompok_id)->first();
            $data['user_id'] = $getMentor->user_id;
            $data['mahasiswa_id'] = auth()->user()->id;

            Absensi::create($data);
        } catch (\Exception $e) {
            return redirect(route('absensi.index'))->with('error', 'Gagal ' . $e->getMessage());
        }
        return redirect(route('absensi.index'))->with('success', 'Berhasil input absensi mentoring');
    }

    public function detail($id)
    {
        $data = Absensi::where('mahasiswa_id', $id)->get();
        return view('absensi.index', compact('data'));
    }

    public function acc(Absensi $absensi)
    {
        $absensi->update([
            'ket' => 1
        ]);
        return redirect()->route('absensi.detail', $absensi->mahasiswa_id)->with('success', 'Berhasil Acc Data Mentoring');
    }

    public function cetakMahasiswa($id)
    {
        $data = Absensi::where('mahasiswa_id', $id)->get();
        $mahasiswa = User::find($id);
        $angkatan = KelompokMahasiswa::join('kelompok', 'kelompok_mahasiswa.kelompok_id', 'kelompok.id')
            ->join('angkatan', 'kelompok.angkatan_id', 'angkatan.id')
            ->select('angkatan.angkatan')
            ->where('user_id', $id)->first();
        return view('cetak.absensi', [
            'data' => $data,
            'mahasiswa' => $mahasiswa,
            'angkatan' => $angkatan
        ]);
        // $pdf = PDF::loadview('cetak.absensi', [
        //     'data' => $data,
        //     'mahasiswa' => $mahasiswa,
        //     'angkatan' => $angkatan
        // ]);
        // return $pdf->download('absensi-mahasiswa.pdf');
    }

    public function cetakAdmin()
    {
        $data = Absensi::select('mahasiswa_id')->distinct()->get();
        $totalAbsensi = [];
        foreach ($data as $value) {
            $totalAbsensi[$value->mahasiswa_id] = Absensi::where('mahasiswa_id', $value->mahasiswa_id)->where('hadir', 1)->count();
        }
        return view('cetak.absensi_mahasiswa', compact('data', 'totalAbsensi'));
        // $pdf = PDF::loadview('cetak.absensi_mahasiswa', compact('data', 'totalAbsensi'));
        // return $pdf->download('Laporan Kehadiran.pdf');
    }
}
