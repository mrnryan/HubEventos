<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="bg-gradient-to-tr from-green-700 to-black">
  <section id="login" class="p-4 flex flex-col justify-center min-h-screen max-w-md mx-auto">
    <div class="p-6 bg-sky-100 rounded">
      <div class="flex items-center justify-center font-black m-3 mb-12">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-3 text-red-600 animate-pulse" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
        </svg>
      <h1 class="tracking-wide text-2xl text-gray-900">Deixe seu feedback</h1>
      </div>
        @if(auth()->check())
          <form action="{{ route('feedback.store', $event->id) }}" method="POST">
          @csrf

          <div class="mt-4">
                <label class="block font-semibold">Nome de usuário:</label>
                <input type="text" name="name" placeholder="Digite seu nome de usuário" class="w-full border rounded p-2" required>
            </div>

            <div class="mt-4">
                <label class="block font-semibold">Comentário:</label>
                <textarea name="comment" placeholder="Escreva um comentario" class="w-full border rounded p-2" required></textarea>
            </div>

            <div class="mt-4">
                <label class="block font-semibold">Nota (1 a 5):</label>
                <select name="rating" class="w-full border rounded p-2" required>
                    <option value="1">1 - Péssimo</option>
                    <option value="2">2 - Ruim</option>
                    <option value="3">3 - Regular</option>
                    <option value="4">4 - Bom</option>
                    <option value="5">5 - Excelente</option>
                </select>
            </div>

            <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Enviar</button>
          </form>
      @endif
    </div>
  </section>

  <script>
    document.getElementById("login_form").onsubmit = function() {
      event.preventDefault()
      // animation
      document.getElementById("login_process_state").classList.remove("hidden")
      document.getElementById("login_process_state").classList.add("animate-pulse")

      document.getElementById("login_default_state").classList.add("hidden")
    }

    let current_count = parseInt(document.getElementById("item_count").value)
    let subtotal = parseInt(5)

    function plus() {
      document.getElementById("item_count").value = ++current_count
      document.getElementById("subtotal").innerHTML =` $${subtotal * document.getElementById("item_count").value}`

    }

    function minus() {
      if(current_count < 2) {
        current_count = 1
        document.getElementById("item_count").value = 1
        document.getElementById("subtotal").innerHTML =` $${subtotal * document.getElementById("item_count").value}`
      } else {
        document.getElementById("item_count").value = --current_count
        document.getElementById("subtotal").innerHTML =` $${subtotal * document.getElementById("item_count").value}`
      }
    }

  </script>
</div>
</body>
</html>