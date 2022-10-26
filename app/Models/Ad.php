<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'precio', 'imagen', 'descripcion', 'user_id'];

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }
}
