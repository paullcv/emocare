<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Alertas extends Mailable
{
    use Queueable, SerializesModels;

    public $nombreEstudiante;
    public $tituloCuestionario;
    public $porcentajeNegativas;
    public $mensajeAdicional;

    /**
     * Create a new message instance.
     */
    public function __construct($nombreEstudiante, $tituloCuestionario, $porcentajeNegativas, $mensajeAdicional = '')
    {
        $this->nombreEstudiante = $nombreEstudiante;
        $this->tituloCuestionario = $tituloCuestionario;
        $this->porcentajeNegativas = $porcentajeNegativas;
        $this->mensajeAdicional = $mensajeAdicional;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Alerta: Respuestas Negativas',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return (new Content)
            ->view('alerta.alertas')
            ->with([
                'nombreEstudiante' => $this->nombreEstudiante,
                'tituloCuestionario' => $this->tituloCuestionario,
                'porcentajeNegativas' => $this->porcentajeNegativas,
                'mensajeAdicional' => $this->mensajeAdicional,
            ]);
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
