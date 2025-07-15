<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusPermohonanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pesan;
    public $fileLampiran;
    public string $reason;

    public function __construct($pesan, $fileLampiran = null, string $reason)
    {
        $this->pesan = $pesan;
        $this->fileLampiran = $fileLampiran;
        $this->reason = $reason;
    }

    public function build()
    {
        $mail = $this->view('emails.status-permohonan')
                     ->with(['pesan' => $this->pesan]);
                     ->with(['alasan' => $this->reason]);

        if ($this->fileLampiran) {
            $mail->attach($this->fileLampiran, [
                'as' => 'informasi-permohonan.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        return $mail->subject('Status Permohonan Informasi Anda');
    }
}
