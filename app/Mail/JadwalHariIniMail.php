<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JadwalHariIniMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $jadwal;

    public function __construct($user, $jadwal)
    {
        $this->user = $user;
        $this->jadwal = $jadwal;
    }

    public function build()
    {
        return $this->subject('Jadwal Kuliah Hari Ini')
                    ->view('emails.jadwal-hari-ini');
    }
}

