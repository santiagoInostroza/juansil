<div>
    <div x-data="sectorsMain()"  class="card pt-20">
        <div class="card-header">Sectores</div>

        <div class="card-body">
            <div>
                <img src="{{url('images/comunas.png')}}" alt="">
            </div>
            <div class="w-screen overflow-auto pr-10">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Valor despacho
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Días Rebajados
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Sector
                                </th>
                               
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tiene reparto 
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cantidad pedidos
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($comunas as $comuna)
                                    <tr class=" @if($comuna->tiene_reparto)   @else disabled bg-gray-200 text-gray-100 @endif " id="comuna_{{$comuna->id}}"
                                        data-nombre="{{$comuna->name}}"
                                        data-valor_despacho="{{$comuna->valor_despacho}}"
                                        data-sector="{{$comuna->sector}}"
                                        data-dias_rebajados="{{$comuna->dias_rebajados}}"
                                        data-valor_rebajado="{{$comuna->valor_rebajado}}"
                                        data-tiene_reparto="{{$comuna->tiene_reparto}}"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium  text-gray-900">
                                                {{$comuna->name}}
                                            </div>
                                        </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">${{number_format($comuna->valor_despacho,0,',','.')}}</div>
                                            {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                                        </td>
                                   
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @php
                                              $dias =  explode(',',$comuna->dias_rebajados)
                                            @endphp
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    @foreach ($dias as $dia)
                                                        <div>
                                                            @switch($dia)
                                                                @case(1)
                                                                    Lunes
                                                                    @break
                                                                @case(2)
                                                                    Martes
                                                                    @break
                                                                @case(3)
                                                                    Miercoles
                                                                    @break
                                                                @case(4)
                                                                    Jueves
                                                                    @break
                                                                @case(5)
                                                                    Viernes
                                                                    @break
                                                                @case(6)
                                                                    Sabado
                                                                    @break
                                                                @default

                                                                    
                                                            @endswitch
                                                        </div>
                                                    @endforeach 
                                                </div>
                                                <div class="text-xl">
                                                    {{($comuna->valor_rebajado!=0)?"$" . number_format($comuna->valor_rebajado,0,',','.'): ""}}
                                                </div>
                                            </div>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{$comuna->sector}}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                           @if ( $comuna->tiene_reparto)
                                               Si
                                           @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{$comuna->cantidad_pedidos}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a class="text-indigo-600 hover:text-indigo-900 cursor-pointer" wire:click="openModal({{$comuna->id}})">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
            
            
            </div>
        </div>

        {{-- MODAL --}}
        @isset($comuna_seleccionada)
            <x-modal.modal>
                <x-slot name="titulo">
                    <h1 class="text-xl font-bold text-gray-800">{{$comuna_seleccionada->name}}</h1>
                </x-slot>
                <div class="py-2">
                    <x-jet-label>
                        Tiene reparto
                        <label class="switch">
                            <input type="checkbox" wire:model="tiene_reparto" >
                            <span class="slider round"></span>
                        </label>
                    </x-jet-label>
                 
                        
                </div>
                <div class="@if(!$tiene_reparto) hidden @endif">                
                    <div >
                        <x-jet-label>
                            Valor despacho
                        </x-jet-label>
                        <x-jet-input class="w-full" wire:model="valor_despacho" />
                    </div>
                    <div>
                        <x-jet-label>
                            Sector
                        </x-jet-label>
                        <x-jet-input class="w-full" wire:model="sector" />
                    </div>
                    <div>
                        <x-jet-label>
                           Valor rebajado
                        </x-jet-label>
                        <x-jet-input class="w-full" wire:model="valor_rebajado" />
                    </div>
                    <div>
                        <x-jet-label>
                            Días rebajados
                        </x-jet-label>
                        <select name="" id="" class="w-full h-36" wire:model="dias_rebajados" multiple>
                            <option value="1">Lunes</option>
                            <option value="2">Martes</option>
                            <option value="3">Miercoles</option>
                            <option value="4">Jueves</option>
                            <option value="5">Viernes</option>
                            <option value="6">Sabado</option>
                        </select>
                     
                    </div>
                   
                </div>
               
                <x-slot name="footer"> 
                    <x-jet-button wire:click="save">Guardar</x-jet-button>
                    <x-jet-button x-on:click="cerrarModal">Cerrar</x-jet-button>
            </x-slot>
            </x-modal.modal>
        @endisset
      
    </div>

    @push('js')
        <script>
            function sectorsMain(){
                return{
                    modal:@entangle('modal'),
                    titulo:"Titulo",

                    cerrarModal: function(){
                        this.modal=false;
                    },
                }
            }
        </script>
    @endpush

</div>
