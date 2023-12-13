<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_path',
        'announce_id'
    ];

    protected $table = 'files';

    public function announce()
    {
        return $this->belongsTo(Announce::class);
    }
}
