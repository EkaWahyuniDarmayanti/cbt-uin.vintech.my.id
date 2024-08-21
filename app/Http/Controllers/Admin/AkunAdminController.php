<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AkunAdminController extends Controller
{
    public function index()
    {
        return view('admin.akun_admin.index', [
            'data' => User::where('role', 'Admin')->get()
        ]);
    }

    public function create()
    {
        return view('admin.akun_admin.create');
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $model = $request->validated();
            $model['email'] = $request->nip_nim . '@gmail.com';
            $model['role'] = 'Admin';
            User::create($model);
        } catch (\Exception $e) {
            return redirect(route('akun-admin.index'))->with('error', 'Gagal Tambah Data ' . $e->getMessage());
        }
        return redirect(route('akun-admin.index'))->with('success', 'Berhasil Tambah Data');
    }

    public function edit(User $akun_admin)
    {
        return view('admin.akun_admin.edit', compact('akun_admin'));
    }

    public function update(UpdateUserRequest $request, User $akun_admin)
    {
        try {
            $data = $request->validated();
            if ($request->password != null) {
                $data['password'] = $request->password;
            }

            $akun_admin->update($data);
        } catch (\Exception $e) {
            return redirect(route('akun-admin.index'))->with('error', 'Gagal Update Data');
        }
        return redirect(route('akun-admin.index'))->with('success', 'Berhasil Update Data');
    }

    public function destroy(User $akun_admin)
    {
        $akun_admin->delete();
        return redirect()->route('akun-admin.index')->with('success', 'Akun berhasil dihapus.');
    }
}
