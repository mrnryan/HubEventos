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

    public function index1() {

        $events = Event::all();
        return view('tables',['events' => $events]);
    }

    public function index2() {

        $events = Event::all();
        return view('index',['events' => $events]);
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

        // upload de imagem
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path("img/events"), $imageName);

            $event->image = $imageName;


        }

        $event->save();

        return redirect('/');

    }
}
