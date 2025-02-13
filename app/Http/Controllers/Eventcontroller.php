<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Event;

class Eventcontroller extends Controller
{
    public function index() {

        $search = request('search');

        if($search) {
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();
        }

        else {
            $events = Event::all();
        }

        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function index1() {

        $events = Event::all();
        return view('tables',['events' => $events]);
    }

    public function index2() {

        $search = request('search');

        if($search) {
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();
        }

        else {
            $events = Event::all();
        }

        return view('index', ['events' => $events, 'search' => $search]);
    }

    public function cadastrar() {
        return view('perfil.forms');
    }

    public function store(Request $request) {

        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->description = $request->description;
        $event->local = $request->local;
        $event->obrigatorio = $request->obrigatorio;
        $event->categoria = $request->categoria;

        // upload de imagem
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path("img/events"), $imageName);

            $event->image = $imageName;


        }

        $event->save();

        return redirect('/')->with('success', 'Evento criado com sucesso!');

    }

    public function exibir($id) {

        $event = Event::findOrFail($id);

        return view('/exibir_evento/evento', ['event' => $event]);
    }

    public function destroy($id) {

        $event = Event::findOrFail($id)->delete();

        return redirect('/')->with('msg', "Evento deletado com sucesso");
    }

    public function edit($id) {

        $event = Event::findOrFail($id);

        return view('/exibir_evento.edit', ['event' => $event]);
    }

    public function update(Request $request, $id) {
        // Encontrar o evento pelo ID
        $event = Event::findOrFail($id);
    
        // Atualizar os outros campos do evento
        $event->title = $request->title;
        $event->date = $request->date;
        $event->description = $request->description;
        $event->local = $request->local;
        $event->obrigatorio = $request->obrigatorio;
        $event->categoria = $request->categoria;
    
        // Verifica se há um novo upload de imagem
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->file('image');
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
            // Move a nova imagem para a pasta correta
            $requestImage->move(public_path("img/events"), $imageName);
    
            // Atualiza o nome da imagem no evento
            $event->image = $imageName;
        }
    
        // Salva as alterações no banco de dados
        $event->save();

        return redirect('/')->with('msg', "Evento editado com sucesso");    
    }
}
