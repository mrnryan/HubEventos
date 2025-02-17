@extends('layouts.master')

@section('body')
    <h3 class="text-gray-700 text-3xl font-medium">EVENTOS</h3>

    <div class="flex flex-col mt-8">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nome e Data</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">O evento é obrigatorio?</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                    </thead>
                    
                    @foreach($events as $event)

                    <tbody class="bg-white">
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ asset('img/events/' . $event->image) }}" alt="" />
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900">{{ $event->title }}</div>
                                        <div class="text-sm leading-5 text-gray-500">Data: {{ date('d/m/Y', strtotime($event->date)) }}</div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-normal border-b border-gray-200 max-w-xs">
                                <div class="text-sm leading-5 text-gray-900 break-words">
                                    {{ $event->description ?: 'Evento sem descrição' }}
                                </div>
                            </td>

                            <td class="px-10 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $event->obrigatorio ? 'Sim' : 'Não' }}</span>
                            </td>

                           
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{ $event->categoria == 0 ? 'Tecnologia' : ($event->categoria == 1 ? 'Arquitetura' : ($event->categoria == 2 ? 'Mecânica' : ($event->categoria == 3 ? 'Eventos' : ''))) }}</td>
                            <td class="py-7 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium flex space-x-3">
                                <a href="/exibir_evento/edit/{{ $event->id }}" class="flex items-center bg-blue-600 text-white hover:bg-blue-700 font-medium px-3 py-2 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                    Editar
                                </a>
                                
                                <form action="/exibir_evento/{{ $event->id }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center bg-red-600 text-white hover:bg-red-700 font-medium px-3 py-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                        Deletar
                                    </button>
                                </form>
                            </td>

                            
                        </tr>
                    </tbody>
                    @endforeach
                    @foreach($evento->feedbacks as $feedback)
                        <div class="mt-4">
                            <p class="font-semibold">{{ $feedback->user->name }} (Nota: {{ $feedback->rating }})</p>
                            <p>{{ $feedback->comment }}</p>
                        </div>
                    @endforeach
                    
                    @if(count($events) == 0)
                        <p>Não há eventos disponiveís no momento.</p>
                    @endif
                  
                </table>
            </div>
        </div>
    </div>
@endsection
