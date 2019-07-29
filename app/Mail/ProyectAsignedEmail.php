<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProyectAsignedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $proyecto;
    public $name_user;

    public function __construct($proyecto, $name_user)
    {
        $this->proyecto = $proyecto;
        $this->name_user = $name_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('mail.proyectasigned', compact('proyecto', 'name_user'));
        return $this->view('mail.proyectasigned')
                    ->with([
                        'proyecto' => $this->proyecto,
                        'name_user' => $this->name_user,
                    ]);
    }
}
