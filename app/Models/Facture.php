<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'amount',
        'user_id',
        'announce_id',
        'reservation_id'
    ];
    protected $table = 'factures';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function announce()
    {
        return $this->belongsTo(Announce::class, 'announce_id');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
}
