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
        return view('/perfil/forms');
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

        return redirect('/')->with('msg', 'Evento criado com sucesso!');

    }

    public function showMandatoryEvents()
    {
        // Buscar eventos obrigatórios onde 'obrigatorio' é igual a 1
        $mandatoryEvents = Event::where('obrigatorio', 1)->get();

        // Retorna a view com os eventos obrigatórios
        return view('permanentes', compact('mandatoryEvents'));
    }

    public function exibir($id) {

            // Buscar o evento pelo ID
        $event = Event::findOrFail($id);

        // Armazenar o evento na sessão
        $viewedEvents = session()->get('viewed_events', []);
        
        // Evita duplicar o evento na sessão
        if (!in_array($id, $viewedEvents)) {
            $viewedEvents[] = $id;
        }

        // Salva a lista de eventos visualizados na sessão
        session()->put('viewed_events', $viewedEvents);

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

    public function favoriteEvent($eventId)
    {
            // Verifica se o usuário está autenticado
        if (!auth()->check()) {
            return redirect()->route('login'); // Ou redirecionar para uma página de login
        }

        $event = Event::findOrFail($eventId);
        $user = auth()->user();

        // Verifica se o evento já foi favoritado, senão favorita
        if ($user->favoriteEvents->contains($event)) {
            $user->favoriteEvents()->detach($event);
        } else {
            $user->favoriteEvents()->attach($event);
        }

        return back(); // Redireciona de volta para a página anterior
    }

    public function showFavoriteEvents()
    {
            // Verifica se o usuário está autenticado
        if (!auth()->check()) {
            return redirect()->route('login'); // Redireciona para login
        }

        $user = auth()->user();
        $favoriteEvents = $user->favoriteEvents; // Busca os eventos favoritados

        return view('/tables', compact('favoriteEvents'));
    }



}
