<?php

namespace App\Mail;

use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccesoPlataforma extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario, $contraseña;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct($usuario, $contraseña)
    {
        $this->usuario = $usuario;
        $this->contraseña = $contraseña;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.accesoplataforma');
    }
}
