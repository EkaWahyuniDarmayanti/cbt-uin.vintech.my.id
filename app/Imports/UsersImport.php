<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (isset($row['nim'])) {
            if (!User::where('nip_nim', $row['nim'])->exists()) {
                DB::beginTransaction();
                try {
                    User::create([
                        'name' => 'NONAME',
                        'email' => trim($row['nim']) . '@gmail.com',
                        'nip_nim' => trim($row['nim']),
                        'name' => trim($row['nama']),
                        'password' => $row['nim'],
                        'role' => 'Mahasiswa'
                    ]);

                    Log::info('Data dengan nim ' . $row['nim'] . ' berhasil di import!');
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    Log::info(json_encode($e->getMessage()));
                }
            }
        }
    }
}
