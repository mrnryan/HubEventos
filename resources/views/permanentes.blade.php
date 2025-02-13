@extends('layout')

@section('content')

    <div class="container mx-auto p-4">
    <h3 class="text-gray-700 text-3xl font-medium">Eventos permanentes</h3>
    <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-4">
        @foreach($mandatoryEvents as $event)
            <!-- Card do Evento -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 ease-in-out p-4 overflow-hidden">
                <!-- Imagem do Evento -->
                <img src="{{ asset('img/events/' . ($event->image ?: 'placeholder.jpg')) }}" 
                    alt="Evento Image" class="w-full h-48 rounded-md object-cover mb-4">
                
                <div class="px-1 py-2">
                    <div class="font-bold text-xl mb-2">{{ $event->title }}</div>
                    <p class="text-gray-700 text-base mb-4 truncate">
                        {{ $event->description ?: 'Evento sem descrição' }}
                    </p>
                </div>
                
                <div class="px-1 py-2">
                    <p class="text-sm text-gray-600">Local: {{ $event->local }}</p>
                </div>
            </div>
        @endforeach
        @if($mandatoryEvents->isEmpty())
        <p class="text-gray-500">Nenhum evento permanente no momento.</p>
        @endif
    </div>
</div>

@endsection
