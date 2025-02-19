<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announce extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'description',
        'address',
        'price_per_night',
        'type',
        'is_disponible'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function equipments()
    {
        return $this->belongsToMany(Equipment::class, 'announce_equipment');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class, 'announce_id');
    }
}
