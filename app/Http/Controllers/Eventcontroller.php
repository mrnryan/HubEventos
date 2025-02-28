<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Event;
use App\models\Message;


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
        $event->link = $request->link ?? null;


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
        // Ordenar mensagens pela data de criação (campo `created_at`) em ordem crescente (do mais antigo para o mais recente)
        $messages = Message::where('event_id', $id)->orderBy('created_at', 'asc')->get(); 

        return view('/exibir_evento/evento', ['event' => $event, 'messages' => $messages]);
    }

    public function storeMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        Message::create([
            'event_id' => $id,
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return redirect()->route('event.storeMessage', $id); // Redireciona para a mesma página do evento
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
        $event->link = $request->link ?? null;
    
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

    public function filtrocategoria(Request $request)
    {
        // Captura o valor da categoria do filtro
        $categoria = $request->input('categoria');
        
        // Se a categoria for 0 (todos), não aplica filtro
        if ($categoria == 0) {
            $events = Event::all();  // Exibe todos os eventos
        } else {
            $events = Event::where('categoria', $categoria)->get();  // Filtra os eventos pela categoria
        }

        // Verifica se não há eventos para a categoria
        $message = $events->isEmpty() ? 'Não há eventos cadastrados para essa categoria.' : null;

        // Retorna a view com os eventos ou a mensagem
        return view('EventCategoria', compact('events', 'message'));
    }




}
