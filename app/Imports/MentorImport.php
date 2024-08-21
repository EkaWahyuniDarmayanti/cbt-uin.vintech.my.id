<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MentorImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (isset($row['nip'])) {
            if (!User::where('nip_nim', $row['nip'])->exists()) {
                DB::beginTransaction();
                try {
                    User::create([
                        'name' => 'NONAME',
                        'email' => trim($row['nip']) . '@gmail.com',
                        'nip_nim' => trim($row['nip']),
                        'name' => trim($row['nama']),
                        'password' => $row['nip'],
                        'role' => 'Mentor'
                    ]);

                    Log::info('Data dengan nim ' . $row['nip'] . ' berhasil di import!');
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    Log::info(json_encode($e->getMessage()));
                }
            }
        }
    }
}
