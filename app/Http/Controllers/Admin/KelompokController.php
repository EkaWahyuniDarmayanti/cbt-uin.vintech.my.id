<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKelompokMahasiswaRequest;
use App\Http\Requests\StoreKelompokRequest;
use App\Models\Angkatan;
use App\Models\Kelompok;
use App\Models\KelompokMahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class KelompokController extends Controller
{
    public function create(Angkatan $angkatan)
    {
        return view('admin.kelompok.create', compact('angkatan'));
    }

    public function store(StoreKelompokRequest $request)
    {
        try {
            Kelompok::create($request->validated());
        } catch (\Exception $e) {
            return redirect(route('angkatan.show', $request->angkatan_id))->with('error', 'Gagal Tambah Data ' . $e->getMessage());
        }
        return redirect(route('angkatan.show', $request->angkatan_id))->with('success', 'Berhasil Tambah Data');
    }

    public function destroy(Kelompok $kelompok, Angkatan $angkatan)
    {
        $kelompok->delete();
        return redirect()->route('angkatan.show', $angkatan->id)->with('success', 'Data berhasil dihapus.');
    }

    public function show(Kelompok $kelompok)
    {
        $data = KelompokMahasiswa::where('kelompok_id', $kelompok->id)->get();
        return view('admin.kelompok.show', compact('kelompok', 'data'));
    }

    public function createKelompokMahasiswa(Kelompok $kelompok)
    {
        $mahasiswa = User::where('role', 'Mahasiswa')->get();
        return view('admin.kelompok.create_kelompok_mahasiswa', compact('kelompok', 'mahasiswa'));
    }

    public function storeKelompokMahasiswa(StoreKelompokMahasiswaRequest $request)
    {
        try {
            KelompokMahasiswa::create($request->validated());
        } catch (\Exception $e) {
            return redirect(route('kelompok.show', $request->kelompok_id))->with('error', 'Gagal Tambah Data ' . $e->getMessage());
        }
        return redirect(route('kelompok.show', $request->kelompok_id))->with('success', 'Berhasil Tambah Data');
    }

    public function destroyKelompokMahasiswa(KelompokMahasiswa $kelompokMahasiswa, Kelompok $kelompok)
    {
        $kelompokMahasiswa->delete();
        return redirect()->route('kelompok.show', $kelompok->id)->with('success', 'Data berhasil dihapus.');
    }
}
