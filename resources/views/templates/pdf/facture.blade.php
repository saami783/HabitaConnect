<!DOCTYPE html>
<html lang="FR">
<head>
    <style>
        .invoice-header {
            padding: 20px;
            text-align: center;
        }
        .invoice-header h1 {
            border: 2px solid #dee2e6;
            display: inline-block;
            padding: 10px;
        }
        .contact-info {
            width: 100%;
            display: table;
            padding: 20px;
        }
        .contact-info div {
            display: table-cell;
        }
        .order-summary {
            padding: 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .invoice-table th,
        .invoice-table td {
            border: 1px solid #dee2e6;
            padding: 10px;
        }
        .invoice-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }
    </style>

    <title>
        Facture #{{ $facture->id }}
    </title>
</head>

<body>
<header class="invoice-header">
    <h1>
       Facture #{{ $facture->id }}
    </h1>
</header>

<div class="contact-info">
    <div>
        <strong>HabitaConnect</strong><br>
        56 Boulevard de l’Imaginaire<br>
        75008 PARIS<br>
        <a href="https://habitaconnect.sami-bahij.com">https://habitaconnect.sami-bahij.com</a>
    </div>
    <div style="text-align: right;">
        <strong>{{ $user->name }}</strong><br>
        {{ $user->email }}<br>
        tél: {{ $user->number_phone }}
    </div>
</div>

<div class="order-summary">
    <h2>Récapitulatif de la location</h2>
    <table class="invoice-table">
        <tr>
            <td>Période</td>
            <td>du {{ date('d-m-Y', strtotime($reservation->begin_at)) }} au {{ date('d-m-Y', strtotime($reservation->end_at)) }} pour un total de {{ $reservation->total_days }} jours</td>
        </tr>

        <tr>
            <td>Prix par jour</td><td>{{ $announce->price_per_night }} €</td>
        </tr>
        <tr>
            <td>Total de la reservation</td>
            <td>{{ $facture->amount }} €</td>
        </tr>
    </table>
    <h3>Assurances</h3>

    <h3>Montant Total : {{ $facture->amount }} €</h3>
</div>

<footer class="invoice-footer">
    &copy; HabitaConnect Society
</footer>
</body>
</html>
