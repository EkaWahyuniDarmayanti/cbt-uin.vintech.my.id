<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJadwalMentorRequest;
use App\Mail\ScheduleNotificationEmail;
use App\Models\Jadwal;
use App\Models\JadwalMentor;
use App\Models\KelompokMentor;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Spatie\CalendarLinks\Link;

class JadwalMentorController extends Controller
{
    public function index()
    {
        return view('mentor.jadwal.index', [
            'data' => JadwalMentor::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function create()
    {
        $jadwal = Jadwal::all();
        return view('mentor.jadwal.create', compact('jadwal'));
    }

    public function store(StoreJadwalMentorRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;

            $kelompok = KelompokMentor::join('kelompok_mahasiswa', 'kelompok_mentor.kelompok_id', 'kelompok_mahasiswa.kelompok_id')
                ->join('users', 'kelompok_mahasiswa.user_id', 'users.id')
                ->select('users.email')
                ->where('kelompok_mentor.user_id', auth()->user()->id)->get();

            $jadwal = Jadwal::where('id', $request->jadwal_id)->first();

            $linkGCalender = Link::create(
                $jadwal->topik,
                DateTime::createFromFormat('Y-m-d H:i', $jadwal->tanggal . ' 09:00'),
                DateTime::createFromFormat('Y-m-d H:i', $jadwal->tanggal . ' 18:00')
            )->google();

            foreach ($kelompok as $value) {
                Mail::to($value->email)->send(new ScheduleNotificationEmail($jadwal, $linkGCalender));
            }

            JadwalMentor::create($data);
        } catch (\Exception $e) {
            return redirect(route('lihat-jadwal'))->with('error', 'Gagal ' . $e->getMessage());
        }
        return redirect(route('lihat-jadwal'))->with('success', 'Berhasil Tambah Jadwal');
    }

    public function keterangan(JadwalMentor $jadwalMentor)
    {
        return view('mentor.jadwal.keterangan', compact('jadwalMentor'));
    }

    public function storeKeterangan(Request $request, JadwalMentor $jadwalMentor)
    {
        $jadwalMentor->keterangan = $request->keterangan;
        $jadwalMentor->save();
        return redirect(route('lihat-jadwal'))->with('success', 'Berhasil Simpan Keterangan');
    }

    public function destroy(JadwalMentor $jadwalMentor)
    {
        $jadwalMentor->delete();
        return redirect(route('lihat-jadwal'))->with('success', 'Berhasil Hapus Jadwal');
    }
}
