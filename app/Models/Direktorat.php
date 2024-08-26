<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direktorat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kawasans(){
        return $this->hasMany(Kawasan::class);
    }

    public function negaras(){
        return $this->hasMany(Negara::class);
    }
}
