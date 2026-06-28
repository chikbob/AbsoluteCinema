<?php

// app/Mail/TicketMail.php
namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function build()
    {
        return $this->subject('Ваш билет в кино')
            ->view('emails.ticket')
            ->with([
                'name' => $this->ticket->customer_name,
                'email' => $this->ticket->customer_email,
                'session' => $this->ticket->session_id,
                'seats' => $this->ticket->seats,
                'total' => $this->ticket->total_price,
            ]);
    }
}
