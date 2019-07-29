<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class mensajesPendientes extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $mensaje;

    public function __construct($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('mail.newimbox', compact('mensaje'));
        return $this->view('mail.newimbox')
                    ->with([
                        'mensaje' => $this->mensaje,
                    ]);
    }
}
