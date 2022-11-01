<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function store(Request $request) {
        $offer = $request->all();
        $offer['vigencia'] = date('Y-m-d', strtotime("+1 week"));
        $offer['user_id'] = $request->user()->id;
        Offer::create($offer);

        $ad = Ad::find($offer['ad_id']);
       return redirect()
                ->route('ads.show', $ad->id)
                ->with('offers', $ad->offers()->paginate(config('pagination.offers', 10)));
    }

    public function refuse(Request $request) {
        //enviar email

        //eliminar oferta

        //redirect a l'anunci
        dd($request->post('ad_id'));
        $ad = Ad::find($offer['ad_id']);
        return redirect()
        ->route('ads.show', $ad->id)
        ->with('offers', $ad->offers()->paginate(config('pagination.offers', 10)));
    }
}
