<?php

namespace App\Mail;

// Tambahkan baris ini untuk memberitahu PHP di mana letak Model Objection
use App\Models\Objection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ObjectionDiresponMail2 extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public Objection $obj;
    public string $reason;

    // Sekarang, PHP tahu bahwa 'Objection' di sini merujuk ke 'App\Models\Objection'
    public function __construct(Objection $obj, string $reason)
    {
        $this->obj = $obj;
        $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Respon Permohonan Keberatan',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.objection2',
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
