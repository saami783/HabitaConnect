<?php

namespace App\Enum;

enum ReservationStatus: string
{
    case NonFinalise = 'Réservation non finalisée';
    case PaiementAccepte = 'Paiement accepté';
    case Annule = 'Annulé';
    case EnAttenteReponseProprietaire = 'En attente d\'une réponse du propriétaire';
}
