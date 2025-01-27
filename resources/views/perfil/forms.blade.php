@extends('layouts.master')

@section('body')

<h3 class="text-gray-700 text-3xl font-medium">CADASTRAR EVENTO</h3>

<section class="bg-gray-100 mt-6">
  <div class="rounded-lg bg-white p-8 shadow-lg lg:col-span-3 lg:p-12">
    <form action="#" class="space-y-4">
      
      <!-- Upload de Imagem -->
      <div>
        <label class="block text-sm font-medium text-gray-700" for="event-image">Imagem do Evento</label>
        <div class="flex items-center gap-4">
          <input
            type="file"
            id="event-image"
            class="w-full rounded-lg border-gray-200 p-3 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-700 file:text-white hover:file:bg-green-800"
            accept="image/*"
            onchange="previewImage(event)"
          />
          
    <!-- Contêiner para a pré-visualização da imagem -->
          <div id="image-preview" class="h-30 w-30 overflow-hidden rounded-lg border border-gray-200 bg-gray-50">
            <img id="preview" class="h-full w-full object-cover hidden" />
          </div>
        </div>
      </div>

      <!-- Nome do Evento -->
      <div>
        <label class="block text-sm font-medium text-gray-700" for="event-name">Nome do Evento</label>
        <input
          class="w-full rounded-lg border-gray-200 p-3 text-sm"
          placeholder="Digite o nome do evento"
          type="text"
          id="event-name"
        />
      </div>

      <!-- Data e Local -->
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div>
          <label class="block text-sm font-medium text-gray-700" for="event-date">Data do Evento</label>
          <input
            class="w-full rounded-lg border-gray-200 p-3 text-sm"
            placeholder="Selecione a data"
            type="date"
            id="event-date"
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700" for="event-location">Local do Evento</label>
          <input
            class="w-full rounded-lg border-gray-200 p-3 text-sm"
            placeholder="Digite o local"
            type="text"
            id="event-location"
          />
        </div>
      </div>

      <!-- Categoria do Evento -->
      <div class="grid grid-cols-1 gap-4 text-center sm:grid-cols-3">
        <div>
          <label
            for="option-conference"
            class="block w-full cursor-pointer rounded-lg border border-gray-200 p-3 text-gray-600 hover:border-black has-[:checked]:border-black has-[:checked]:bg-black has-[:checked]:text-white"
            tabindex="0"
          >
            <input class="sr-only" id="option-conference" type="radio" name="event-category" />
            <span class="text-sm"> Conferência </span>
          </label>
        </div>
        <div>
          <label
            for="option-workshop"
            class="block w-full cursor-pointer rounded-lg border border-gray-200 p-3 text-gray-600 hover:border-black has-[:checked]:border-black has-[:checked]:bg-black has-[:checked]:text-white"
            tabindex="0"
          >
            <input class="sr-only" id="option-workshop" type="radio" name="event-category" />
            <span class="text-sm"> Workshop </span>
          </label>
        </div>
        <div>
          <label
            for="option-meetup"
            class="block w-full cursor-pointer rounded-lg border border-gray-200 p-3 text-gray-600 hover:border-black has-[:checked]:border-black has-[:checked]:bg-black has-[:checked]:text-white"
            tabindex="0"
          >
            <input class="sr-only" id="option-meetup" type="radio" name="event-category" />
            <span class="text-sm"> Meetup </span>
          </label>
        </div>
      </div>

      <!-- Descrição do Evento -->
      <div>
        <label class="block text-sm font-medium text-gray-700" for="event-description">Descrição do Evento</label>
        <textarea
          class="w-full rounded-lg border-gray-200 p-3 text-sm"
          placeholder="Digite uma descrição detalhada do evento"
          rows="5"
          id="event-description"
        ></textarea>
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