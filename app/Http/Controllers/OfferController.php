<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferDeleteRequest;
use App\Http\Requests\OfferRequest;
use App\Mail\OfferRejected;
use App\Mail\OfferAccepted;
use App\Models\Ad;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OfferController extends Controller
{

    public function __construct() {
        $this->middleware('verified')->except('store', 'refuse', 'accept');
        /* $this->middleware('password.confirm')->only('purgue'); */
    }
    //POLICY si el propietario no es dueño de la oferta y el usuario esta VERIFICADO(en el constructior)
    public function store(OfferRequest $request) {
        if($request->user()->hasOfferOnAd(Ad::find($request->ad_id)))
            abort(401, 'No puedes crear más de una oferta para el mismo anuncio.');
        $offer = $request->all();
        $offer['vigencia'] = date('Y-m-d', strtotime("+1 week"));
        $offer['user_id'] = $request->user()->id;
        Offer::create($offer);


        $ad = Ad::find($offer['ad_id']);
        $offers = $ad->openOffers()->get();
       return redirect()
                ->route('ads.show', $ad->id)
                ->with('offers', $offers);
    }

    //POLICY si el propietario es el dueño de la oferta o si es admin
    public function refuse(OfferDeleteRequest $request) {
        //enviar email
        $offer = Offer::find($request->offer_id);
        $user = $offer->user()->get()[0];
        Mail::to($user->email)->send(new OfferRejected(Ad::find($request->ad_id)));
        //eliminar oferta
        $offer['rejected_at'] = date('Y-m-d');
        $offer->save();
        //redirect a l'anunci
        $ad = Ad::find($offer['ad_id']);
        $offers = $ad->openOffers()->all();
        return redirect()
            ->route('ads.show', $ad->id)
            ->with('offers', $offers);
    }


    public function accept(OfferDeleteRequest $request) {
        //get de las ofertas 'abiertas'
        $offers = Ad::find($request->ad_id)->openOffers();
        //enviar emails
        foreach ($offers as $offer) {
            if ($offer->user_id == $request->user_id) {
                Mail::to($offer->user()->get()[0]->email)->send(new OfferAccepted(Ad::find($request->ad_id)));
                $offer->accepted_at = date('Y-m-d');
            } else {
                Mail::to($offer->user()->get()[0]->email)->send(new OfferRejected(Ad::find($request->ad_id)));
                $offer->rejected_at = date('Y-m-d');
            }
            $offer->save();
        }
        //tancar anunci
        //Ad::destroy($request->ad_is);

        return redirect()
            ->route('ads.index');
    }
}
