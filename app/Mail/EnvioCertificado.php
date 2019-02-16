<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnvioCertificado extends Mailable
{
    use Queueable, SerializesModels;

    private $rutaCertificado;
    private $remitente;
    private $asunto;

    public $cuerpo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($remitente, $asunto, $cuerpo, $rutaCertificado)
    {
        $this->remitente = $remitente;
        $this->asunto = $asunto;
        $this->cuerpo = $cuerpo;
        $this->rutaCertificado = $rutaCertificado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->remitente)
            ->subject($this->asunto)
            ->attach($this->rutaCertificado)
            ->view('emails.enviar-certificado');
    }
}
