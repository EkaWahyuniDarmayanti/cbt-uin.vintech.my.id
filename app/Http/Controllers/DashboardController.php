<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Angkatan;
use App\Models\JadwalMentor;
use App\Models\KelompokMahasiswa;
use App\Models\Mentoring;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $angkatan = Angkatan::all();
        $total = [];
        foreach ($angkatan as $value) {
            $temp = Absensi::select('mahasiswa_id')->where('angkatan_id', $value->id)->distinct()->get();
            $total[$value->id] = count($temp);
        }
        if (auth()->user()->role == 'Mentor') {
            $jadwal = JadwalMentor::where('user_id', auth()->user()->id)->get();
        } else {
            $jadwal = KelompokMahasiswa::join('kelompok_mentor', 'kelompok_mahasiswa.kelompok_id', 'kelompok_mentor.kelompok_id')
                ->join('jadwal_mentor', 'kelompok_mentor.user_id', 'jadwal_mentor.user_id')
                ->join('jadwal', 'jadwal_mentor.jadwal_id', 'jadwal.id')
                ->join('users', 'jadwal_mentor.user_id', 'users.id')
                ->select('jadwal_mentor.*', 'jadwal.tanggal', 'jadwal.topik')
                ->where('kelompok_mahasiswa.user_id', auth()->user()->id)->get();
        }
        return view('dashboard', compact('angkatan', 'total', 'jadwal'));
    }
}
