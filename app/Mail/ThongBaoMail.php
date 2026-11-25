<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThongBaoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tenNguoiNhan;

    public function __construct($tenNguoiNhan)
    {
        $this->tenNguoiNhan = $tenNguoiNhan;
    }

    public function build()
    {
        return $this->subject('🐾 WiWi gửi lời chào!')
                    ->view('email.thongbao');
    }
}