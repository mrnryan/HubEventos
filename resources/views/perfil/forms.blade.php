@extends('layouts.master')

@section('body')

<h3 class="text-gray-700 text-3xl font-medium">CADASTRAR EVENTO</h3>

<section class="bg-gray-100 mt-6">
  <div class="rounded-lg bg-white p-8 shadow-lg lg:col-span-3 lg:p-12">
    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="space-y-4">
    @csrf

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
            <img id="preview" class="h-full w-full object-cover hidden" />
          </div>
        </div>
      </div> 
      <!-- Nome e Data -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
      <div>
          <!-- Nome do Evento -->
      <label class="block text-sm font-medium text-gray-700" for="title">Título:</label>
      <input  class="w-full rounded-lg border-gray-200 p-3 text-sm" 
      placeholder="Digite o nome do evento" type="text" id="title" name="title" required>

      </div>
      <div class="mb-4">
            <!-- Data do evento -->
        <label class="block text-sm font-medium text-gray-700" for="date">Data do evento</label>
        <input  class="w-full rounded-lg border-gray-200 p-3 text-sm" 
        type="date" id="date" name="date" required>
      </div>
    </div>

    <!-- Descrição do Evento -->
    <label class="block text-sm font-medium text-gray-700" for="description">Descrição:</label>
    <textarea class="w-full rounded-lg border-gray-200 p-3 text-sm"
          placeholder="Digite uma descrição detalhada do evento"
          rows="5" id="description" name="description" placeholder="Descrição"></textarea>

    <!-- Local e permanencia -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
      <div>
        <label class="block text-sm font-medium text-gray-700"  for="local">Local:</label>
        <input  class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder="Digite o local do evento" type="text" id="local" name="local"  required>

      </div>
      <div class="mb-4">
        <label for="obrigatorio" class="block text-sm font-medium text-gray-700 mb-2">O evento é permanente?</label>
        <select name="obrigatorio" id="obrigatorio" 
            class="block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="0">Não</option>
            <option value="1">Sim</option>
        </select>
      </div>
    </div>

    <div class="mb-4">
        <label for="categoria" class="block text-sm font-medium text-gray-700 mb-2">Categoria:</label>
        <select name="categoria" id="categoria" 
            class="block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="0">Acadêmico </option>
            <option value="1">Corporativo</option>
            <option value="2">Cultural</option>
            <option value="3">Social</option>
            <option value="4">Tecnologia</option>
            <option value="5">Esportivo </option>
        </select>
    </div>

    <div>
    <label for="link" class="block text-sm font-medium text-gray-700">Link para inscrição no Evento (Opcional)</label>
    <input type="url" name="link" id="link" class="mt-1 p-2 w-full border rounded-md" value="{{ old('link', $event->link ?? '') }}">
  </div>

    <!-- Botão de Cadastro -->
    <div class="mt-4">
        <button
          type="submit"
          class="inline-block w-full rounded-lg bg-green-700 px-5 py-3 font-medium text-white sm:w-auto hover:shadow-lg hover:bg-green-800 transition-shadow duration-300"
        >
          CADASTRAR
        </button>
      </div>
    </form>






  </div>
</section>

<script>
  function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById("preview");

    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        preview.src = e.target.result;
        preview.classList.remove("hidden");
      };
      reader.readAsDataURL(file);
    } else {
      preview.classList.add("hidden");
      preview.src = "";
    }
  }
</script>
@endsection