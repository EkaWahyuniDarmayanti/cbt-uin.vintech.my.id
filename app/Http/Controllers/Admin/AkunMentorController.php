<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMentorRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateMentorRequest;
use App\Imports\MentorImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class AkunMentorController extends Controller
{
    public function index()
    {
        return view('admin.akun_mentor.index', [
            'data' => User::where('role', 'Mentor')->get()
        ]);
    }

    public function create()
    {
        return view('admin.akun_mentor.create');
    }

    public function store(StoreMentorRequest $request)
    {
        try {
            $model = $request->validated();
            $model['email'] = $request->nip_nim . '@gmail.com';
            $model['role'] = 'Mentor';
            User::create($model);
        } catch (\Exception $e) {
            return redirect(route('akun-mentor.index'))->with('error', 'Gagal Tambah Data ' . $e->getMessage());
        }
        return redirect(route('akun-mentor.index'))->with('success', 'Berhasil Tambah Data');
    }

    public function edit(User $akun_mentor)
    {
        return view('admin.akun_mentor.edit', compact('akun_mentor'));
    }

    public function update(UpdateMentorRequest $request, User $akun_mentor)
    {
        try {
            $data = $request->validated();
            if ($request->password != null) {
                $data['password'] = $request->password;
            }

            $akun_mentor->update($data);
        } catch (\Exception $e) {
            return redirect(route('akun-mentor.index'))->with('error', 'Gagal Update Data ' . $e->getMessage());
        }
        return redirect(route('akun-mentor.index'))->with('success', 'Berhasil Update Data');
    }

    public function destroy(User $akun_mentor)
    {
        $akun_mentor->delete();
        return redirect()->route('akun-mentor.index')->with('success', 'Akun berhasil dihapus.');
    }

    public function formatImport()
    {
        $file = public_path() . "/download/format-import-mentor.xlsx";

        $headers = array(
            'Content-Type: application/vnd.ms-excel',
        );

        return Response::download($file, 'format-import-mentor.xlsx', $headers);
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        set_time_limit(0);
        try {
            Excel::import(new MentorImport, $request->file('file'));
            return redirect()->route('akun-mentor.index')->with('success', 'Akun berhasil diimport.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
