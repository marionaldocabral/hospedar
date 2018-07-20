<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PedidoDeReserva extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $msg;
    private $reserva;

    public function __construct($msg, $reserva)
    {
        $this->msg = $msg;
        $this->reserva = $reserva;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $msg = $this->msg;
        $reserva = $this->reserva;
        return $this->view('mail.confirm', compact('msg', 'reserva'));
    }
}
