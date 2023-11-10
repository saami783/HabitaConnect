<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Announce;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{

    public function generatePdf(Reservation $reservation)
    {

        $announce = Announce::find($reservation->announce_id);
        $facture = $reservation->facture;

        $html = view('templates.pdf.facture',[
            'facture' => $facture,
            'reservation' => $reservation,
            'announce' => $announce,
            'user' => Auth::getUser()
        ])->render();

        $pdf = PDF::loadHTML($html);

        return $pdf->stream('facture.pdf');
    }

}
