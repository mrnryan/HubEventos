<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Event;

class FeedbackController extends Controller
{
    // Exibir os feedbacks de um evento específico
    public function show($eventId)
    {
        $event = Event::findOrFail($eventId);
        $feedbacks = Feedback::where('event_id', $eventId)->get();

        return view('perfil.feedback', compact('event', 'feedbacks'));
    }

    // Método para exibir o formulário de feedback
    public function ver($eventId)
    {
        // Encontra o evento pelo ID
        $event = Event::findOrFail($eventId);

        // Retorna a view do formulário de feedback com os dados do evento
        return view('/formFeedback', compact('event'));
    }

    // Salvar o feedback
    public function store(Request $request, $eventId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Feedback::create([
            'event_id' => $eventId,
            'name' => $request->name,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->route('event.feedback', $eventId)->with('success', 'Feedback enviado com sucesso!');
    }
}
