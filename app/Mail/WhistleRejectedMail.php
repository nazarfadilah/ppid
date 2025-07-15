<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WhistleRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $tindakan;
    public $alasan;

    public function __construct($nama, $tindakan, $alasan)
    {
        $this->nama = $nama;
        $this->tindakan = $tindakan;
        $this->alasan = $alasan;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Laporan Ditolak',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.whistle-rejected',
            with: [
                'nama' => $this->nama,
                'tindakan' => $this->tindakan,
                'alasan' => $this->alasan,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
