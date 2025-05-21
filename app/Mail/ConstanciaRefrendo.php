<?php

namespace App\Mail;

use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Refrendo;

class ConstanciaRefrendo extends Mailable
{
    use Queueable, SerializesModels;

    public $refrendo;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct(Refrendo $refrendo)
    {
        $this->refrendo = $refrendo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.constanciaRefrendo');
    }
}
