<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Event;

class Eventcontroller extends Controller
{
    public function index() {

        $events = Event::all();
        return view('welcome',['events' => $events]);
    }

    public function cadastrar() {
        return view('perfil.forms');
    }

    public function store(Request $request) {

        $event = new Event;

        $event->title = $request->title;
        $event->description = $request->description;
        $event->local = $request->local;
        $event->obrigatorio = $request->obrigatorio;

        $event->save();

        return redirect('/');

    }
}
