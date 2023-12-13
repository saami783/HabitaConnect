<link href="{{ asset('css/detailOffre_CSS.css')}}" rel="stylesheet" type="text/css"/>

<section class="section-right">
    <div class="div-à-reserver">
        <h3><strong>Réservation</strong></h3>
        <hr style="color: #4a5568" />

        <form method="POST" action="{{ route('reservations.store') }}">
            @csrf
            <div class="div-date-debut">
                <label for="begin_at">Date de début</label>
                <input type="date" class="form-control" id="begin_at" name="begin_at" required>
            </div>

            <div class="div-date-fin">
                <label for="end_at">Date de fin</label>
                <input type="date" class="form-control" id="end_at" name="end_at" required>
            </div>

            <input type="hidden" name="announce_id" id="announce_id" value="{{ $announce->id }}"
                   autocomplete="off">

            <p class="prix-par-nuit">Prix par nuit : {{ number_format($announce->price_per_night, 2) }} €</p>

            @if($announce->is_disponible)
                <div class="div-btn-reserver">
                    <button type="submit" class="btn btn-reserver">Réserver</button>
                </div>
            @else
                <div class="div-imossible-de-reserver">
                    <p class="p-impossible_de_reserver"><b>Impossible de passer une réservation pour cette annonce car elle est insponible.</b> </p>
                </div>
            @endif
        </form>
    </div>
</section>
