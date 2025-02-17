@extends('layout')

@section('content')
<div>
  <main class="flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-4 flex items-center justify-center">

      <!-- Container para o card de evento e o chat, centralizados -->
      <div class="flex flex-col md:flex-row gap-12 items-center justify-center">

        <!-- Card de Evento (um pouco menor) -->
        <div class="w-full md:w-2/3 lg:w-2/3 bg-white rounded-lg border p-6 shadow-lg transform transition-all duration-300 hover:scale-105 hover:shadow-2xl flex flex-col" id="eventCard">
          <img src="{{ asset('img/events/' . ($event->image ?: 'placeholder.jpg')) }}" 
          alt="Evento Image" class="w-full rounded-md object-contain mb-4">
          <div class="px-1 py-4 flex-grow">
            <!-- Título do evento -->
            <div class="font-bold text-2xl mb-4">{{ $event->title }}</div>

            <!-- Descrição -->
            <label for="description" class="text-sm font-semibold text-gray-700">Descrição:</label>
            <div class="mb-4">
              <input id="description" type="text" value="{{ $event->description ?: 'Evento sem descrição' }}" class="w-full bg-gray-100 text-gray-700 border border-gray-300 p-3 rounded-md cursor-not-allowed" disabled>
            </div>

            <!-- Local -->
            <label for="local" class="text-sm font-semibold text-gray-700">Local:</label>
            <div>
              <input id="local" type="text" value="{{ $event->local }}" class="w-full bg-gray-100 text-gray-700 border border-gray-300 p-3 rounded-md cursor-not-allowed" disabled>
            </div>
          </div>
          <div class="px-1 py-4">
            <a href="#" class="text-blue-500 hover:underline">Read More</a>
            <a href="/formFeedback">sssssssssssssss</a>
          </div>
        </div>

        <!-- Componente de Chat (tamanho independente na vertical) -->
        <div class="w-full md:w-1/3 lg:w-1/2 flex flex-col bg-white shadow-xl rounded-lg border border-gray-300 overflow-hidden" id="chatContainer">
          <div class="flex flex-col flex-grow h-[400px] p-4 overflow-auto"> <!-- Altura reduzida para o chat -->
            <!-- Exemplo de mensagem -->
            <div class="flex w-full mt-2 space-x-3 max-w-xs">
              <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300"></div>
              <div>
                <div class="bg-gray-300 p-3 rounded-r-lg rounded-bl-lg">
                  <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <span class="text-xs text-gray-500 leading-none">2 min ago</span>
              </div>
            </div>
            <!-- Adicione mais mensagens aqui se necessário -->
          </div>

          <div class="bg-gray-300 p-4">
            <input class="flex items-center h-10 w-full rounded px-3 text-sm" type="text" placeholder="Type your message…">
          </div>
        </div>

      </div>

    </div>
  </main>
</div>

<script>
  window.addEventListener('DOMContentLoaded', function() {
    var cardHeight = document.getElementById('eventCard').offsetHeight;
    document.getElementById('chatContainer').style.height = cardHeight - 100 + 'px'; // Diminuir a altura do chat um pouco
  });
</script>

@endsection
