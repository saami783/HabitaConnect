<header>
    @extends('welcome')
</header>

<h2> Hello </h2>

<p> Titre : {{ $announce->title }} </p>

<p> Description : {{ $announce->description }} </p>
<p> Adresse : {{ $announce->address }} </p>
<p> Prix par nuit : {{ $announce->price_per_night }} </p>
<p> Type de logement : {{ $announce->type }} </p>
<p> Utilisateur : {{ $announce->user->name }} </p>
