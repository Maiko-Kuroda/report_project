<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class InquiryMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.inquiry')
        ->subject('メッセージを受け付けました')
        //ここに問合せのパラメーターを渡す必要あり※未設定
        ->from("管理者ようのメールアドレスにする","表示名にかえる")
        ->with('data', $this->data);
        // $this->dataにデータがはいるとinquiry.blade.phpの内容が反映
        //
    }
}