@extends('layout')

@section('content')
<div>
  <main class="flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-4 flex items-center justify-center">

    <div class="flex flex-col md:flex-row gap-12 items-center justify-center">

<!-- Card de Evento (em destaque) -->
<div class="w-full md:w-2/3 lg:w-2/3 bg-white rounded-lg border p-6 shadow-xl transform transition-all duration-300 hover:scale-105 hover:shadow-2xl flex flex-col" id="eventCard">
    <img src="{{ asset('img/events/' . ($event->image ?: 'placeholder.jpg')) }}" 
        alt="Evento Image" class="w-full rounded-md object-cover h-60 mb-4">
    <div class="px-1 py-4 flex-grow">
        <!-- Data do Evento -->
        <div class="text-gray-600 text-sm mb-3 font-semibold">{{ date('d/m/Y', strtotime($event->date)) }}</div>
        <!-- Título do evento -->
        <div class="font-bold text-2xl mb-4 text-gray-800">{{ $event->title }}</div>

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

    <!-- Link de inscrição -->
    <label for="local" class="text-sm font-semibold text-gray-700">Inscreva-se no link abaixo:</label>
    <div>
        @if($event->link)
            <p class="mt-2">
                <a href="{{ $event->link }}" target="_blank" class="text-blue-500 underline hover:text-blue-700">
                    Clique aqui para se inscrever
                </a>
            </p>
        @else
            <div class="mt-2 p-3 bg-gray-100 border border-gray-300 rounded-md text-gray-600">
                <p>⚠ Este evento não possui um link para inscrição.</p>
            </div>
        @endif
    </div>

    <div class="px-1 py-4 flex justify-end">
        <a href="{{ route('feedback.ver', $event->id) }}" 
            class="inline-block text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 text-center transition-all duration-300 ease-in-out transform hover:scale-105">
            Deixe seu feedback
        </a>
    </div>
</div>

<!-- Chat -->
<div class="w-full md:w-1/3 lg:w-1/2 bg-white rounded-lg border p-4 shadow-md flex flex-col gap-4" id="chatContainer">
    <h1 class="text-xl font-semibold text-gray-800">Chat Interativo:</h1>
    
    <div class="bg-gray-100 p-4 rounded-lg space-y-4 flex-grow overflow-y-auto" id="messagesContainer">
    <!-- Exibindo as mensagens -->
    @foreach($messages as $message)
        <div class="flex items-start space-x-2 mb-2
                    @if($message->user_id == auth()->id()) justify-end @else justify-start @endif">
            <!-- Mensagens do usuário logado à direita -->
            @if($message->user_id == auth()->id())
            
                <!-- Quebra de linha automática para as mensagens -->
                <p class="text-sm text-gray-700 break-all max-w-xs">{{ $message->message }}</p>
                <span class="font-semibold text-sm text-blue-600">{{ $message->user->name }}</span>
            @else
                <!-- Mensagens de outros usuários à esquerda -->
                <span class="font-semibold text-sm text-blue-600">{{ $message->user->name }}:</span>
                <!-- Quebra de linha automática para as mensagens -->
                <p class="text-sm text-gray-700 break-all max-w-xs">{{ $message->message }}</p>
            @endif
        </div>
    @endforeach
</div>


    @auth
        <form action="{{ route('event.storeMessage', $event->id) }}" method="POST" class="flex mt-4 space-x-2">
            @csrf
            <!-- Usando textarea para permitir a quebra de linha -->
            <textarea name="message" class="flex-grow p-2 border border-gray-300 rounded-lg text-sm resize-y" placeholder="Digite sua mensagem..." required></textarea>
            <button type="submit" class="p-2 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                </svg>
            </button>
        </form>
    @else
        <p class="mt-4 text-red-500 text-sm">Você precisa estar logado para enviar mensagens.</p>
    @endauth
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

<script>
    // Rola automaticamente até a última mensagem
    window.addEventListener('load', function() {
        const messagesContainer = document.getElementById('messagesContainer');
        messagesContainer.scrollTop = messagesContainer.scrollHeight; // Isso rola até o final
    });
</script>

@endsection

<!-- <div class="bg-gray-100 p-4 rounded-lg space-y-4 flex-grow overflow-y-auto" id="messagesContainer">

        @foreach($messages as $message)
            <div class="flex items-start space-x-2 mb-2">
                <span class="font-semibold text-sm text-blue-600">{{ $message->user->name }}:</span>

                <p class="text-sm text-gray-700 break-all max-w-xs">{{ $message->message }}</p>
            </div>
        @endforeach
    </div> -->
