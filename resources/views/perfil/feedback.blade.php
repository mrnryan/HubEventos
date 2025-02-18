@extends('layouts.master')

@section('body')
    <h3 class="text-gray-700 text-3xl font-medium">EVENTOS</h3>

    <div class="flex flex-col mt-8">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nome do evnento</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Comentario</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nota do evento</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                    </thead>
                    


                @foreach ($feedbacks as $feedback)
                    <tbody class="bg-white">
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">

                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900"><strong>{{ $feedback->name }}</strong></div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-normal border-b border-gray-200 max-w-xs">
                                <div class="text-sm leading-5 text-gray-900 break-words">
                                    {{ $feedback->comment }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-normal border-b border-gray-200 max-w-xs">
                                <div class="text-sm leading-5 text-gray-900 break-words">
                                    <strong>Nota: {{ $feedback->rating }}/5</strong>
                                </div>
                            </td>

                            <td class="px-10 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"></span>
                            </td>

                        </tr>
                    </tbody>
                    @endforeach

                    

    

    @if($feedbacks->isEmpty())
        <p class="text-gray-500">Nenhum feedback ainda. Seja o primeiro a comentar!</p>
    @endif
                  
                </table>
            </div>
        </div>
    </div>
@endsection
