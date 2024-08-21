<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\JadwalMentor;
use App\Models\User;

class JadwalMahasiswaController extends Controller
{
    public function index(Jadwal $jadwal, User $user, JadwalMentor $jadwalMentor)
    {
        $data = [
            'tgl' => $jadwal->tanggal,
            'topik' => $jadwal->topik,
            'nama' => $user->name,
            'nip' => $user->nip_nim,
            'keterangan' => $jadwalMentor->keterangan
        ];
        return view('mahasiswa.jadwal.index', compact('data'));
    }
}
