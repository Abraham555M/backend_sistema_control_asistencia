<?php

namespace App\Mail;

use App\Models\Empleado;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitacionCrearCuenta extends Mailable
{
    use Queueable, SerializesModels;

    public $empleado;
    public $link;

    /**
     * Create a new message instance.
     */
    public function __construct(Empleado $empleado, $link)
    {
        $this->empleado = $empleado;
        $this->link = $link;
    }

    public function build()
    {
        return $this->subject('Invitación para crear tu cuenta')
                    ->markdown('emails.invitacion_cuenta');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitacion Crear Cuenta',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.invitacion_cuenta',
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
