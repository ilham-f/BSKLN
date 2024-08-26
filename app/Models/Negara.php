<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kawasans(){
        return $this->belongsTo(Kawasan::class, 'kawasan_id', 'id');
    }

    public function direktorats()
    {
        return $this->belongsTo(Direktorat::class, 'direktorat_id', 'id');
    }
}
