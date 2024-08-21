<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKelompokMentorRequest;
use App\Models\Kelompok;
use App\Models\KelompokMahasiswa;
use App\Models\KelompokMentor;
use App\Models\User;
use Illuminate\Http\Request;

class KelompokMentorController extends Controller
{
    public function index()
    {
        return view('admin.kelompok_mentor.index', [
            'data' => User::where('role', 'Mentor')->get()
        ]);
    }

    public function show(User $kelompokMentor)
    {
        $data = KelompokMentor::where('user_id', $kelompokMentor->id)->get();
        return view('admin.kelompok_mentor.show', compact('kelompokMentor', 'data'));
    }

    public function create(User $kelompokMentor)
    {
        $data = Kelompok::all();
        return view('admin.kelompok_mentor.create', compact('kelompokMentor', 'data'));
    }

    public function store(StoreKelompokMentorRequest $request)
    {
        try {
            KelompokMentor::create($request->validated());
        } catch (\Exception $e) {
            return redirect(route('kelompok-mentor.show', $request->user_id))->with('error', 'Gagal Tambah Data ' . $e->getMessage());
        }
        return redirect(route('kelompok-mentor.show', $request->user_id))->with('success', 'Berhasil Tambah Data');
    }

    public function destroy(KelompokMentor $kelompokMentor, User $kelompok)
    {
        $kelompokMentor->delete();
        return redirect()->route('kelompok-mentor.show', $kelompok->id)->with('success', 'Data berhasil dihapus.');
    }

    public function lihatKelompok()
    {
        return view('mentor.kelompok.index', [
            'data' => KelompokMentor::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function lihatMahasiswa(Kelompok $kelompok)
    {
        return view('mentor.kelompok.mahasiswa', [
            'data' => KelompokMahasiswa::where('kelompok_id', $kelompok->id)->get(),
            'kelompok' => $kelompok
        ]);
    }
}
