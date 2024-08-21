<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data, $linkGCalender;
    public function __construct($data, $linkGCalender)
    {
        $this->data = $data;
        $this->linkGCalender = $linkGCalender;
    }

    public function build()
    {
        return $this->subject('JADWAL CBT')->view('emails.schedule');
    }
}
