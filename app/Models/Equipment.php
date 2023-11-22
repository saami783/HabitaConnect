<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];
    protected $table = 'equipments';

    public function announces()
    {
        return $this->belongsToMany(Announce::class, 'announce_equipment');
    }
}
