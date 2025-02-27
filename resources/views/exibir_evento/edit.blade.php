@extends('layouts.master')

@section('title', 'Editando:' . $event->title)

@section('body')

<h3 class="text-gray-700 text-3xl font-medium">EDITAR EVENTO</h3>

<section class="bg-gray-100 mt-6">
  <div class="rounded-lg bg-white p-8 shadow-lg lg:col-span-3 lg:p-12">
    <form method="POST" action="{{ url('/exibir_evento/update/' . $event->id) }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

    <!-- Upload de Imagem -->
    <div>
    <label class="block text-sm font-medium text-gray-700" for="image">Imagem do Evento</label>
    <div class="flex items-center gap-4">
        <input
            type="file"
            id="image"
            class="w-full rounded-lg border-gray-200 p-3 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-700 file:text-white hover:file:bg-green-800"
            accept="image/*"
            name="image"
            onchange="previewImage(event)"
        />
        
        <!-- Contêiner para a pré-visualização da imagem -->
        <div id="image-preview" class="h-30 w-30 overflow-hidden rounded-lg border border-gray-200 bg-gray-50">
            <img id="preview" src="{{ asset('img/events/' . ($event->image ?: 'placeholder.jpg')) }}" 
                 alt="Evento Image" class="w-full h-full rounded-md object-cover mb-4">
        </div>
    </div>
</div>

<!-- Nome e Data -->
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
      <div>
          <!-- Nome do Evento -->
    <label class="block text-sm font-medium text-gray-700" for="title">Título:</label>
    <input  class="w-full rounded-lg border-gray-200 p-3 text-sm" 
    placeholder="Digite o nome do evento" value="{{ $event->title }}" type="text" id="title" name="title" required>

      </div>
      <div class="mb-4">
           <!-- Data do evento -->
    <label class="block text-sm font-medium text-gray-700" for="date">Data do evento</label>
    <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
    value="{{ old('date', isset($event->date) ? date('Y-m-d', strtotime($event->date)) : '') }}"
    type="date" id="date" name="date" required>
      </div>
    </div>

    <!-- Descrição do Evento -->
    <label class="block text-sm font-medium text-gray-700" for="description">Descrição:</label>
    <textarea class="w-full rounded-lg border-gray-200 p-3 text-sm"
          placeholder="Digite uma descrição detalhada do evento"
          rows="5" id="description" name="description" placeholder="Descrição">{{ $event->description ?: 'Evento sem descrição' }}</textarea>

    <!-- Data e Local -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
      <div>
        <label class="block text-sm font-medium text-gray-700"  for="local">Local:</label>
        <input  class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder="Digite o local do evento" value="{{ $event->local }}" type="text" id="local" name="local"  required>

      </div>
      <div class="mb-4">
        <label for="obrigatorio" class="block text-sm font-medium text-gray-700 mb-2">Obrigatório:</label>
        <select name="obrigatorio" id="obrigatorio" 
            class="block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="0">Não</option>
            <option value="1" {{ $event->obrigatorio == 1 ? "selected='selected'" : "" }} >Sim</option>
        </select>
      </div>
    </div>

    <div class="mb-4">
        <label for="categoria" class="block text-sm font-medium text-gray-700 mb-2">Categoria:</label>
        <select name="categoria" id="categoria" 
            class="block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="0">Acadêmico</option>
            <option value="1" {{ $event->categoria == 1 ? "selected='selected'" : "" }} >Corporativo</option>
            <option value="2" {{ $event->categoria == 2 ? "selected='selected'" : "" }} >Cultural</option>
            <option value="3" {{ $event->categoria == 3 ? "selected='selected'" : "" }} >Social</option>
            <option value="4" {{ $event->categoria == 4 ? "selected='selected'" : "" }} >Tecnologia</option>
            <option value="5" {{ $event->categoria == 5 ? "selected='selected'" : "" }} >Esportivo</option>

        </select>
    </div>

    <div>
    <label for="link" class="block font-medium text-sm text-gray-700">Link para inscrição no Evento (Opcional)</label>
    <input type="url" name="link" id="link" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
        value="{{ old('link', $event->link) }}">
  </div>


    <!-- Botão de Cadastro -->
    <div class="mt-4">
        <button
          type="submit"
          class="inline-block w-full rounded-lg bg-green-700 px-5 py-3 font-medium text-white sm:w-auto hover:shadow-lg hover:bg-green-800 transition-shadow duration-300"
        >
          EDITAR EVENTO
        </button>
      </div>
    </form>






  </div>
</section>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>

@endsection