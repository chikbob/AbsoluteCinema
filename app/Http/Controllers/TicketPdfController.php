<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketPdfController extends Controller
{
    public function download(Ticket $ticket): \Illuminate\Http\Response
    {
        $ticket->load(['seats' => fn($q) => $q->withPivot('price'), 'session.hall']);

        $pdf = Pdf::loadView('pdf.ticket', [
            'ticket' => $ticket
        ]);

        return $pdf->download("ticket-{$ticket->id}.pdf");
    }
}
