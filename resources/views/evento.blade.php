@extends('layout')

@section('content')
<main>
  <div class="flex items-center justify-center">
    <div class="container mx-auto p-4">
      <!-- Card único centralizado -->
      <div class="bg-white rounded-lg border p-6 w-full max-w-lg shadow-lg mx-auto transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
        <img src="https://placehold.co/300x200/d1d4ff/352cb5.png" alt="Placeholder Image" class="w-full h-64 rounded-md object-cover">
        <div class="px-1 py-4">
          <div class="font-bold text-2xl mb-2">Blog Title</div>
          <p class="text-gray-700 text-base">
            This is a simple blog card example using Tailwind CSS. You can replace this text with your own blog content.
          </p>
        </div>
        <div class="px-1 py-4">
          <a href="#" class="text-blue-500 hover:underline">Read More</a>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection