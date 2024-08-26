<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kawasan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function negaras(){
        return $this->hasMany(Negara::class);
    }

    public function direktorats(){
        return $this->belongsTo(Direktorat::class, 'direktorat_id', 'id');
    }
}
