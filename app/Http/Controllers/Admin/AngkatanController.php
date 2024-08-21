<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAngkatanRequest;
use App\Models\Angkatan;
use App\Models\Kelompok;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    public function index()
    {
        return view('admin.angkatan.index', [
            'data' => Angkatan::all()
        ]);
    }

    public function create()
    {
        return view('admin.angkatan.create');
    }

    public function store(StoreAngkatanRequest $request)
    {
        try {
            Angkatan::create($request->validated());
        } catch (\Exception $e) {
            return redirect(route('angkatan.index'))->with('error', 'Gagal Tambah Data ' . $e->getMessage());
        }
        return redirect(route('angkatan.index'))->with('success', 'Berhasil Tambah Data');
    }

    public function edit(Angkatan $angkatan)
    {
        return view('admin.angkatan.edit', compact('angkatan'));
    }

    public function update(StoreAngkatanRequest $request, Angkatan $angkatan)
    {
        try {
            $angkatan->update($request->validated());
        } catch (\Exception $e) {
            return redirect(route('angkatan.index'))->with('error', 'Gagal Update Data');
        }
        return redirect(route('angkatan.index'))->with('success', 'Berhasil Update Data');
    }

    public function destroy(Angkatan $angkatan)
    {
        $angkatan->delete();
        return redirect()->route('angkatan.index')->with('success', 'Data berhasil dihapus.');
    }

    public function show(Angkatan $angkatan)
    {
        $data = Kelompok::where('angkatan_id', $angkatan->id)->get();
        return view('admin.angkatan.show', compact('angkatan', 'data'));
    }
}
