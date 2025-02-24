@extends('layouts.master')

@section('body')
    <h3 class="text-gray-700 text-3xl font-medium">Eventos Favoritados</h3>

    <div class="container mx-auto p-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-4">
    <div class="max-w-2xl mx-auto p-4">

    @foreach ($favoriteEvents as $event)
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
        </div>
    @endforeach

    @if($favoriteEvents->isEmpty())
        <p class="text-gray-500">Você ainda não favoritou nenhum evento.</p>
    @endif
</div>
    </div>
</div>

@endsection
