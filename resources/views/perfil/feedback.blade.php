@extends('layouts.master')

@section('body')
    <h3 class="text-gray-700 text-3xl font-medium">EVENTOS AVALIADOS</h3>

                    
    <div class="container mx-auto p-6">
        <div class="grid grid-cols-2 gap-6">
            @foreach ($events as $event)
                <div class="event-container bg-white p-6 rounded-lg shadow-lg mb-6 transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                    <!-- Nome e Imagem do Evento -->
                    <h2 class="text-2xl font-bold">{{ $event->name }}</h2>
                    <img src="{{ asset('img/events/' . ($event->image ?: 'placeholder.jpg')) }}" 
                        alt="{{ $event->title }}" 
                        class="w-full h-48 object-cover rounded-lg">
                    <div class="font-bold text-xl mb-2">{{ $event->title }}</div>

                    <!-- Avaliações -->
                    <h3 class="text-xl font-semibold mt-6">Avaliações:</h3>
                    <button id="toggle-btn-{{ $event->id }}" class="text-blue-500" onclick="toggleFeedback({{ $event->id }})">Mostrar avaliações</button>

                    <div id="feedback-{{ $event->id }}" class="feedback-container hidden mt-4">
                        @foreach ($event->feedbacks as $feedback)
                            <div class="feedback-item bg-gray-100 p-4 mt-4 rounded-lg shadow-md">
                                <p class="font-semibold text-blue-600">{{ $feedback->name }}</p>
                                <!-- Estrelas da Avaliação -->
                                <div class="stars text-yellow-500">
                                    @for ($i = 0; $i < $feedback->rating; $i++)
                                        <span>★</span>
                                    @endfor
                                </div>
                                <p class="text-gray-700 mt-2">{{ $feedback->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>


<script>
    function toggleFeedback(eventId) {
        const feedbackContainer = document.getElementById(`feedback-${eventId}`);
        const button = document.getElementById(`toggle-btn-${eventId}`);

        // Alterna a visibilidade das avaliações
        feedbackContainer.classList.toggle('hidden');
        
        // Altera o texto do botão
        if (feedbackContainer.classList.contains('hidden')) {
            button.textContent = 'Mostrar avaliações';
        } else {
            button.textContent = 'Ocultar avaliações';
        }
    }
</script>
@endsection
