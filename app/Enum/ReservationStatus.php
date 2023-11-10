<?php

namespace App\Enum;

enum ReservationStatus: string
{
    case EnCours = 'En cours';
    case PaiementAccepte = 'Paiement accepté';
    case Annule = 'Annulé';
    case EnAttenteReponseProprietaire = 'En attente d\'une réponse du propriétaire';
}
