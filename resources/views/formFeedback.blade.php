<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="bg-gradient-to-tr from-fuchsia-300 to-sky-500">
  <section id="login" class="p-4 flex flex-col justify-center min-h-screen max-w-md mx-auto">
    <div class="p-6 bg-sky-100 rounded">
      <div class="flex items-center justify-center font-black m-3 mb-12">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-3 text-red-600 animate-pulse" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
        </svg>
      <h1 class="tracking-wide text-3xl text-gray-900">Buy Me a Laptop</h1>
      </div>
        <form id="login_form" action="api_login" method="POST"
        class="flex flex-col justify-center">
        <div class="flex justify-between items-center mb-3">
          <div class="inline-flex items-center self-start">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 bg-gradient-to-r from-pink-600 to-red-600 shadow-lg rounded p-1.5 text-gray-100" viewBox="0 0 20 20" fill="currentColor">
          <path d="M13 7H7v6h6V7z" />
          <path fill-rule="evenodd" d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z" clip-rule="evenodd" />
          </svg>
          <span class="font-bold text-gray-900">$5 / Core</span>
          </div>
          <div class="flex">
             <button type="button" onclick="minus()" class="bg-yellow-600 p-1.5 font-bold rounded">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
              </svg>
            </button>
            
            <input id="item_count" type="number" value="1" class="max-w-[100px] font-bold font-mono py-1.5 px-2 mx-1.5
            block border border-gray-300 rounded-md text-sm shadow-sm  placeholder-gray-400
            focus:outline-none
            focus:border-sky-500
            focus:ring-1
            focus:ring-sky-500
            focus:invalid:border-red-500  focus:invalid:ring-red-500">
           
            <button type="button" onclick="plus()" class="bg-green-600 p-1.5 font-bold rounded">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </div>
          <label class="text-sm font-medium">From</label>
          <input class="mb-3 px-2 py-1.5
          mb-3 mt-1 block w-full px-2 py-1.5 border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400
          focus:outline-none
          focus:border-sky-500
          focus:ring-1
          focus:ring-sky-500
          focus:invalid:border-red-500 focus:invalid:ring-red-500" type="text" name="username" placeholder="wahyusa">
          <label class="text-sm font-medium">Messages (optional)</label>
          <textarea class="
          mb-3 mt-1 block w-full px-2 py-1.5 border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400
          focus:outline-none
          focus:border-sky-500
          focus:ring-1
          focus:ring-sky-500
          focus:invalid:border-red-500 focus:invalid:ring-red-500" name="messages" placeholder="Write something"></textarea>
          <button class="px-4 py-1.5 rounded-md shadow-lg bg-gradient-to-r from-pink-600 to-red-600 font-medium text-gray-100 block transition duration-300" type="submit">
            <span id="login_process_state" class="hidden">Sending :)</span>
            <span id="login_default_state">Donate<span id="subtotal"></span></span>
          </button>
        </form>
        @if(auth()->check())
        <form action="{{ route('formFeedback', ['eventId' => $evento->id]) }}" method="POST" class="mt-6">
        @csrf
        <div>
            <label for="rating" class="block text-gray-700">Avaliação</label>
            <input type="number" name="rating" min="1" max="5" required class="border p-2 rounded w-full">
        </div>

        <div class="mt-4">
            <label for="comment" class="block text-gray-700">Comentário</label>
            <textarea name="comment" rows="4" class="border p-2 rounded w-full"></textarea>
        </div>

        <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">Enviar Feedback</button>
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