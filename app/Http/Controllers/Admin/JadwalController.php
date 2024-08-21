<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJadwalRequest;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        return view('admin.jadwal.index', [
            'data' => Jadwal::all()
        ]);
    }

    public function create()
    {
        return view('admin.jadwal.create');
    }

    public function store(StoreJadwalRequest $request)
    {
        try {
            Jadwal::create($request->validated());
        } catch (\Exception $e) {
            return redirect(route('jadwal.index'))->with('error', 'Gagal Tambah Data ' . $e->getMessage());
        }
        return redirect(route('jadwal.index'))->with('success', 'Berhasil Tambah Data');
    }

    public function edit(Jadwal $jadwal)
    {
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    public function update(StoreJadwalRequest $request, Jadwal $jadwal)
    {
        try {
            $jadwal->update($request->validated());
        } catch (\Exception $e) {
            return redirect(route('jadwal.index'))->with('error', 'Gagal Update Data');
        }
        return redirect(route('jadwal.index'))->with('success', 'Berhasil Update Data');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Akun berhasil dihapus.');
    }
}
