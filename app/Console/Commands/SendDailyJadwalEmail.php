<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\JadwalHariIniMail;
use App\Models\User;
use App\Models\Jadwal;
use Carbon\Carbon;

class SendDailyJadwalEmail extends Command
{
    protected $signature = 'email:jadwal-harian';
    protected $description = 'Kirim email jadwal kuliah harian ke semua user';

    public function handle(): void
    {
        $users = User::all();
        $today = now()->locale('id')->isoFormat('dddd');

        foreach ($users as $user) {
            $jadwal = Jadwal::where('user_id', $user->id)
                            ->where('hari', $today)
                            ->get();

            Mail::to($user->email)->send(new JadwalHariIniMail($user, $jadwal));
        }

        $this->info('Email jadwal harian dikirim.');
    }
}
