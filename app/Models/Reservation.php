<?php

namespace App\Models;

use App\Enum\ReservationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'begin_at',
        'end_at',
        'user_id',
        'announce_id',
        'status' => ReservationStatus::class,
        'price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function annonce()
    {
        return $this->belongsTo(Announce::class);
    }
}
