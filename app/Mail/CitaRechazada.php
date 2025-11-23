<?php

namespace App\Mail;

use App\Models\Cita;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CitaRechazada extends Mailable
{
    use Queueable, SerializesModels;

    public Cita $cita;
    public string $razon;

    /**
     * Create a new message instance.
     */
    public function __construct(Cita $cita, string $razon = '')
    {
        $this->cita = $cita;
        $this->razon = $razon;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '❌ Tu cita con Percy Mamani ha sido rechazada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.cita-rechazada',
            with: [
                'cita' => $this->cita,
                'razon' => $this->razon,
            ]
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
