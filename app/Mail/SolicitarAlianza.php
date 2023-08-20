<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;

class SolicitarAlianza extends Mailable
{
    use Queueable, SerializesModels;

    protected $clienteSA;
    protected $descripcion;

    public function __construct($clienteSA, $descripcion)
    {
        $this->clienteSA = $clienteSA;
        $this->descripcion = $descripcion;
    }

    public function build()
    {
        /* dd($this->clienteSA, $this->descripcion); */
        return $this->view('emails.solicitarAlianza', [
            'clienteSA' => $this->clienteSA,
            'descripcion' => $this->descripcion,
        ])
        ->subject('Solicitar Alianza');
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Solicitar Alianza',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
