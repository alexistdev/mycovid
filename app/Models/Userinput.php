<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userinput extends Model
{
    use HasFactory;

    public function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }
}
