<?php

namespace App\Mail;

use App\Models\Announce;
use App\Models\Facture;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ConfirmationReservation extends Mailable
{

    use Queueable, SerializesModels;

    private Reservation $reservation;
    private Announce $announce;
    private Facture $facture;

    public function __construct(Reservation $reservation)
    {
        $announce = Announce::find($reservation->announce_id);
        $this->facture = $reservation->facture;
        $this->reservation = $reservation;
        $this->announce = $announce;
    }

    public function build()
    {
        return $this->view('templates.mails.confirmation_reservation')
            ->with([
                'reservation' => $this->reservation,
                'announce' => $this->announce,
                'user' => Auth::getUser(),
                'date' => new \DateTime(),
                'facture' => $this->facture
            ]);
    }

}
