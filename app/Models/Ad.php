<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Ad extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['titulo', 'precio', 'imagen', 'descripcion', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offers() {
        return $this->hasMany(Offer::class);
    }

    public function openOffers() {
        $query = DB::table('offers')
                    ->where('ad_id', $this->id)
                    ->whereNull('rejected_at')
                    ->whereNull('accepted_at');
        return $this->hydrate($query->get()->toArray());
    }
}
