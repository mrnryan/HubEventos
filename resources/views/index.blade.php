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

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $event->obrigatorio ? 'Sim' : 'Não' }}</span>
                            </td>

                           
 <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{ $event->categoria == 0 ? 'Tecnologia' : ($event->categoria == 1 ? 'Arquitetura' : ($event->categoria == 2 ? 'Mecânica' : ($event->categoria == 3 ? 'Eventos' : ''))) }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                    @if(count($events) == 0)
                        <p>Não há eventos disponiveís no momento.</p>
                    @endif
                  
                </table>
            </div>
        </div>
    </div>
@endsection
