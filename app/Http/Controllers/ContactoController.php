<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\mail;
use App\Mail\Contact;


class ContactoController extends Controller
{
    public function index() {
        return view('contacto');
    }

    public function send(Request $request) {
        $mensaje = new \stdClass();
        $mensaje->asunto = $request->asunto;
        $mensaje->email = $request->email;
        $mensaje->nombre = $request->nombre;
        $mensaje->mensaje = $request->mensaje;

        $mensaje->fichero = $request->hasFile('fichero') ?
            $request->file('fichero')->getRealPath() :
            NULL;

        Mail::to('contacto@laraads.com')->send(new Contact($mensaje));

        return redirect()
            ->route('portada')
            ->with('success', 'Mensaje enviado correctamente.');
    }
}
