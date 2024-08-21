<?php

namespace App\Console;

use App\Mail\EmailNotification;
use App\Models\JadwalMentor;
use App\Models\KelompokMahasiswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // send email H-1
            info("running schedule made by vin");
            $data = JadwalMentor::join('jadwal', 'jadwal_mentor.jadwal_id', 'jadwal.id')
                ->join('kelompok_mentor', 'jadwal_mentor.user_id', 'kelompok_mentor.user_id')
                ->get();

            foreach ($data as $value) {
                $carbonTanggal = Carbon::parse($value->tanggal);
                $carbonTanggalVariabel = $carbonTanggal->subDay();
                // Ambil tanggal hari ini
                $tanggalHariIni = Carbon::now();

                // Bandingkan
                if ($carbonTanggalVariabel->isSameDay($tanggalHariIni)) {
                    $emailMentor = User::where('id', $value->user_id)->first();
                    Mail::to($emailMentor->email)->send(new EmailNotification($value));
                    $mahasiswa = KelompokMahasiswa::join('users', 'kelompok_mahasiswa.user_id', 'users.id')->where('kelompok_mahasiswa.kelompok_id', $value->kelompok_id)->get();
                    foreach ($mahasiswa as $item) {
                        info($item);
                        Mail::to($item->email)->send(new EmailNotification($value));
                    }
                }
            }
        })->everySixHours();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
