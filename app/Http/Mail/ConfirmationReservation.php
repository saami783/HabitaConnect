<?php

namespace App\Http\Mail;

use App\Models\Announce;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationReservation extends Mailable
{

    use Queueable, SerializesModels;

    private Reservation $reservation;
    private Announce $announce;

    public function __construct(Reservation $reservation)
    {
        $announce = Announce::find($reservation->announce_id);
        $this->reservation = $reservation;
        $this->announce = $announce;
    }

    public function build()
    {
        return $this->view('templates.mails.confirmation_reservation')
            ->with([
                'reservationDetails' => $this->reservation,
                'announceDetails' => $this->announce
            ]);
    }

}
