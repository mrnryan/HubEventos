@extends('layout')

@section('content')
<h3 class="text-gray-700 text-2xl font-medium m-4">Eventos filtrados por categoria</h3>



{{-- Verifica se a mensagem foi passada e exibe caso não haja eventos --}}
@if ($message)
    <p class="text-red-500 font-semibold">{{ $message }}</p>
    <a class="text-blue-500" href="/">Ver todos</a>
@else
    {{-- Exibe os eventos se houver algum --}}
    <div class="container mx-auto p-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-6">
    @foreach($events as $event)
    <!-- Card do Evento -->
        <div class="block bg-white rounded-lg border border-gray-300 shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 ease-in-out p-6 overflow-hidden">
            
            <!-- Link do Evento -->
            <a href="/exibir_evento/{{ $event->id }}" class="block">
                <!-- Imagem do Evento -->
                <img src="{{ asset('img/events/' . ($event->image ?: 'placeholder.jpg')) }}" 
                    alt="Evento Image" class="w-full h-48 rounded-md object-cover mb-6">
                
                <div class="px-2 py-3">
                    <!-- Data do Evento -->
                    <div class="text-gray-600 text-sm mb-3 font-semibold">{{ date('d/m/Y', strtotime($event->date)) }}</div>
                    <!-- Título do Evento -->
                    <div class="font-semibold text-2xl text-gray-800 mb-4">{{ $event->title }}</div>
                    <!-- Local -->
                    <p class="text-sm text-gray-500 mb-2">Local: <span class="font-medium text-gray-700">{{ $event->local }}</span></p>
                    <!-- Descrição -->
                    <p class="text-gray-600 text-sm mb-6">{{ $event->description ?: 'Evento sem descrição' }}</p>
                </div>
            </a>

            <!-- Favoritar -->
            @if (auth()->check()) <!-- Verifica se o usuário está autenticado -->
                <form action="{{ route('event.favorite', $event->id) }}" method="POST">
                    @csrf
                    <button 
    id="favorite-button-{{ $event->id }}" 
    class="favorite-btn text-white p-2 rounded-lg transition-all duration-300 ease-in-out
        {{ auth()->user()->favoriteEvents->contains($event) ? 'bg-green-500 hover:bg-green-600' : 'bg-blue-500 hover:bg-blue-600' }}"
    data-event-id="{{ $event->id }}"
    data-favorited="{{ auth()->user()->favoriteEvents->contains($event) ? 'true' : 'false' }}">

    @if (auth()->user()->favoriteEvents->contains($event))
        <span class="material-icons align-middle"></span> Favoritado
    @else
        <span class="material-icons align-middle"></span> Favoritar
    @endif
</button>

                </form>
            @else
                <a href="{{ route('login') }}" 
                class="inline-block text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all duration-300 ease-in-out transform hover:scale-105">
                Faça login para favoritar
                </a>
            @endif
        </div>
    @endforeach
    </div>
</div>
@endif




@endsection
