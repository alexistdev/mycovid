<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftarvaksin extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at'  => 'date:d/m/Y',
    ];

    protected $fillable = [
      'user_id', 'nama_lengkap', 'nik','phone'
    ];

    protected $hidden = [
        'user_id',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
