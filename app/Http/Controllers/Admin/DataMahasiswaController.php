<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class DataMahasiswaController extends Controller
{
    public function index()
    {
        return view('admin.data_mahasiswa.index', [
            'data' => User::where('role', 'Mahasiswa')->get()
        ]);
    }

    public function create()
    {
        return view('admin.data_mahasiswa.create');
    }

    public function store(StoreMahasiswaRequest $request)
    {
        try {
            $model = $request->validated();
            $model['email'] = $request->nip_nim . '@gmail.com';
            $model['role'] = 'Mahasiswa';
            User::create($model);
        } catch (\Exception $e) {
            return redirect(route('data-mahasiswa.index'))->with('error', 'Gagal Tambah Data ' . $e->getMessage());
        }
        return redirect(route('data-mahasiswa.index'))->with('success', 'Berhasil Tambah Data');
    }

    public function edit(User $data_mahasiswa)
    {
        return view('admin.data_mahasiswa.edit', compact('data_mahasiswa'));
    }

    public function update(UpdateMahasiswaRequest $request, User $data_mahasiswa)
    {
        try {
            $data = $request->validated();
            if ($request->password != null) {
                $data['password'] = $request->password;
            }

            $data_mahasiswa->update($data);
        } catch (\Exception $e) {
            return redirect(route('data-mahasiswa.index'))->with('error', 'Gagal Update Data ' . $e->getMessage());
        }
        return redirect(route('data-mahasiswa.index'))->with('success', 'Berhasil Update Data');
    }

    public function destroy(User $data_mahasiswa)
    {
        $data_mahasiswa->delete();
        return redirect()->route('data-mahasiswa.index')->with('success', 'Akun berhasil dihapus.');
    }

    public function formatImport()
    {
        $file = public_path() . "/download/format-import-mahasiswa.xlsx";

        $headers = array(
            'Content-Type: application/vnd.ms-excel',
        );

        return Response::download($file, 'format-import-mahasiswa.xlsx', $headers);
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        set_time_limit(0);
        try {
            Excel::import(new UsersImport, $request->file('file'));
            return redirect()->route('data-mahasiswa.index')->with('success', 'Akun berhasil diimport.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
