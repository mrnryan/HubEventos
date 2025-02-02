@extends('layouts.master')

@section('body')
    <h3 class="text-gray-700 text-3xl font-medium">Tables</h3>

    @foreach($events as $event)

    <div class="container mx-auto mx-auto p-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-4">
          <!-- Replace this with your grid items -->
          <div class="bg-white rounded-lg border p-4">
            <!-- Verificar se a imagem existe, senão usar a imagem placeholder -->
            <img src="{{ asset('img/events/' . ($event->image ?: 'placeholder.jpg')) }}" 
             alt="Evento Image" class="w-full h-48 rounded-md object-cover">
            <div class="px-1 py-4">
              <div class="font-bold text-xl mb-2">{{ $event->title }}</div>
              <p>Descrição...</p>
              <p class="text-gray-700 text-base">
                {{ $event->description ?: 'Evento sem descrição' }}
              </p>
            </div>
            <div class="px-1 py-4">
              <p>Local: {{ $event->local }}</p>
            </div>
          </div>
      </div>

    @endforeach
@endsection
