<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
class WhistleConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $alasan;
    public $tindakan;

    public function __construct($nama, $alasan, $tindakan)
    {
        $this->nama = $nama;
        $this->alasan = $alasan;
        $this->tindakan = $tindakan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Laporan Dikonfirmasi',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.whistle-confirmed',
            with: [
                'nama' => $this->nama,
                'tindakan' => $this->tindakan,
                'alasan' => $this->alasan,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
