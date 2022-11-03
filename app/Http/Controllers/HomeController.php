<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $ads = $request->user()->ads()->get();
        $deletedAds = $request->user()->ads()->onlyTrashed()->get();
        $myOffers = $request->user()->offers()->get();
        $someonesOffers = new \App\Models\Offer;
        $someonesOffers = $someonesOffers->hydrate($request->user()->getAllMyProductsOffers()->toArray());

        return view('home', [
            'ads' => $ads,
            'deletedAds' => $deletedAds,
            'myOffers' => $myOffers,
            'someonesOffers' => $someonesOffers
        ]);
    }
}
