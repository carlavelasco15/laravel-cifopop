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
        $ads = $request->user()->ads()->paginate(10);
        $deletedAds = $request->user()->ads()->onlyTrashed()->get();
        $myOffers = $request->user()->offers()->paginate(10);

        return view('home', [
            'ads' => $ads,
            'deletedAds' => $deletedAds,
            'myOffers' => $myOffers,
        ]);
    }
}
