<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ThongBaoPhieuHen extends Mailable
{
     use Queueable, SerializesModels;

    public $tenkh;
    public $ngaygio;
    public $trangthai;
    public $dichvu;
    public $loaitc;
    public function __construct($tenkh, $ngaygio, $trangthai, $dichvu, $loaitc)
    {
        $this->tenkh = $tenkh;
        $this->ngaygio = $ngaygio;
        $this->trangthai = $trangthai;
        $this->dichvu = $dichvu;
        $this->loaitc = $loaitc;
    }

    public function build()
    {
        return $this->subject('🐾 WiWi - Thông báo phiếu hẹn khám')
                    ->view('email.thongbaophieuhen');
    }
}