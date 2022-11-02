<?php

namespace App\Http\Controllers;

use App\Events\FirstAdCreated;
use App\Http\Requests\AdDeleteRequest;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Http\Requests\AdRequest;
use App\Http\Requests\AdUpdateRequest;
use App\Mail\OfferAccepted;
use App\Mail\OfferRejected;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function __construct() {
        $this->middleware('verified')->except('index', 'show', 'search');
        $this->middleware('password.confirm')->only('purgue');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::orderBy('id', 'DESC')->paginate(10);
        return view('ads.list', [
            'ads' => $ads,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdRequest $request)
    {
        $datos = $request->only(['titulo', 'precio', 'descripcion']);
        $datos += ['imagen' => NULL];
        if($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store(config('filesystems.adsImageDir'));
            $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
    }
        $datos['user_id'] = $request->user()->id;
        $ad = Ad::create($datos);
        if($request->user() && $request->user()->ads->count() == 1)
            FirstAdCreated::dispatch($ad, $request->user());
        return redirect()
                ->route('ads.show', $ad->id)
                ->with('success', "Anuncio $ad->titulo añadido satisfactoriamente")
                ->cookie('lastInsertID', $ad->id, 0);
    }


     /** Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        $offers = $ad->openOffers();
        return view('ads.show', [
            'ad'=>$ad,
            'offers' => $offers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AdRequest $request, Ad $ad)
    {
        if($this->user()->cant('update',$this->ad))
            abort(401, 'No puedes actualizar un anuncio que no es tuyo.');
        return view('ads.update', [
            'ad' => $ad,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdRequest $request, Ad $ad)
    {
        if($this->user()->cant('update', $this->ad))
            abort(401, 'No puedes actualizar un anuncio que no es tuyo.');
        $datos = $request->only('marca', 'modelo', 'kms', 'precio');
        $datos['matriculada'] = $request->has('matriculada') ? 1 : 0;
        $datos['matricula'] = $request->has('matriculada') ? $request->input('matricula') : NULL;
        $datos['color'] = $request->input('color') ?? NULL;
        if ($request->hasFile('imagen'))
        {
            if ($ad->imagen)
                $aBorrar = config('filesystems.adsImageDir') . '/' . $ad->imagen;
            $imagenNueva = $request->file('imagen')->store(config('filesystems.adsImageDir'));
            $datos['imagen'] = pathinfo($imagenNueva, PATHINFO_BASENAME);
        }
        if ($request->filled('eliminarimagen') && $ad->imagen) {
            $datos['imagen'] = NULL;
            $aBorrar = config('filesystems.adsImageDir') . '/' . $ad->imagen;
        }
        if ($ad->update($datos)) {
            if(isset($aBorrar))
                Storage::delete($aBorrar);
        } else {
            if(isset($imagenNueva))
                Storage::delete($imagenNueva);
        }
        $ad->update($datos);
        return back()->with('success', "Anuncio $ad->titulo actualizado.");
    }

    public function delete(AdDeleteRequest $request, Ad $ad) {
        return view('ads.delete', [
            'ad' => $ad
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdDeleteRequest $request, Ad $ad)
    {

        $offers = Ad::find($request->ad_id)->openOffers()->get();
        //enviar emails
        foreach ($offers as $offer) {
            if ($offer->user_id == $request->user_id) {
                Mail::to($offer->user()->get()[0]->email)->send(new OfferAccepted(Ad::find($request->ad_id)));
                $offer['accepted_at'] = date('Y-m-d');
            } else {
                Mail::to($offer->user()->get()[0]->email)->send(new OfferRejected(Ad::find($request->ad_id)));
                $offer['rejected_at'] = date('Y-m-d');
            }
            $offer->save();
        }

        $ad->delete();
        return redirect('ads')
            ->with('success', "Anuncio $ad->titulo eliminado.");
    }

    public function purgue(Request $request)
    {
        $ad = Ad::withTrashed()->find($request->input('ad_id'));
        if($request->user()->cant('delete', $ad))
            abort(401, 'No puedes borrar un anuncio que no es tuyo.');
        if($ad->forceDelete() && $ad->imagen)
            Storage::delete(config('filesystems.adsImageDir').'/'.$ad->imagen);

        return back()->with(
            'success',
            "Anuncio $ad->titulo eliminado definitivamente."
        );
    }

    public function search(Request $request){
        $request->validate(['titulo' => 'max:16', 'descripcion' => 'max:16']);
        $titulo = $request->input('titulo', '');
        $descripcion = $request->input('descripcion', '');
        $ads = Ad::where('titulo', 'like', "%$titulo%")
                        ->where('descripcion', 'like', "%$descripcion%")
                        ->paginate(config('paginator.ads'))
                        ->appends(['titulo' => $titulo, 'descripcion' => $descripcion]);
        return view('ads.list', ['ads' => $ads, 'titulo' => $titulo, 'descripcion' => $descripcion]);
    }

    public function restore(Request $request, int $id)
    {
        $ad = Ad::withTrashed()->find($id);
        if($request->user()->cant('delete', $ad))
            abort(401, 'No puedes borrar un anuncio que no es tuyo.');
        $ad->restore();
        return back()->with(
            'success',
            "Anuncio $ad->titulo restaurado correctamente."
        );
    }
}
