<div>
    {{-- LISTA --}}
    <div wire:poll.60s>
        {{-- TITULO --}}
        <h1 class="p-4 text-center uppercase text-3xl text-gray-600 font-bold my-4">Lista de visitas</h1>
        {{-- SEARCH --}}
        <div class="flex items-center justify-between gap-4">
            <div class="relative flex-1">
                <x-jet-input wire:model.debounce.500ms="search" type="search" class="w-full" placeholder="Buscar..."></x-jet-input>
                <div  wire:loading.flex wire:target="search" >
                    <x-spinner.spinner2 size="6"></x-spinner.spinner2>
                </div>
            </div>
            {{-- <x-jet-button wire:click="$set('openAddNew',true)"  class="flex items-center gap-2"><div><i class="fas fa-plus"></i> </div><div>Agregar nuevo</div></x-jet-button> --}}
        </div>
        {{-- FILTROS --}}
        <div class="p-4 border rounded my-4 flex items-center gap-4">
            <div class="flex items-center gap-2">
                <x-jet-label>Orden</x-jet-label>
                <select class="border p-2 rounded" name="orderBy" id="" wire:model="orderBy">
                    <option value="id">Id</option>
                    <option value="ip">Ip</option>
                </select>
            </div>
            <div class="flex items-center gap-2">
                <x-jet-label>Direccion</x-jet-label>
                <select class="border p-2 rounded" name="direction" id="" wire:model="direction">
                    <option value="asc">asc</option>
                    <option value="desc">desc</option>
                </select>
            </div>
        </div>

        <div class="p-4 border rounded my-4 flex items-center gap-4">
            <h4>Cantidad total de visitas {{ $userCounts->count() }}</h4>
            <h4>Cantidad total de usuarios que han visitado {{ $userCountsTotalDistinct }}</h4>
            <h4>Cantidad total de usuarios chilenos que han visitado {{ $userCountsChile }}</h4>
        </div>

        {{-- TABLA --}}
        <div>
            <x-table>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Id </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> IP </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Agente </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Fecha creado </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Fecha modificado </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Ultima visita </th>
                        <th scope="col" class="relative px-6 py-3" width="10"><span class=""></span> </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($userCounts as $user)
                                <tr wire:click="editRowTrue({{ $user->id }})" wire:key="row_{{$user->id}}" class="">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 p-2">
                                                {{ $user->id }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 ">
                                                    @if ($user->ip == '190.114.35.111')
                                                        Santi
                                                    @elseif($user->ip == '45.232.92.56')
                                                        Romi Celu
                                                    @elseif($user->ip == '201.219.236.243')
                                                        Santy Celu 1
                                                    @else
                                                        {{ $user->ip }}
                                                    @endif
                                                    {{ $user->nameNavigator }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $user->page }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $user->countryName }}   {{ $user->visitas }} visitas
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </td>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 p-2">
                                                    {{ $user->agent }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                               
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 p-2">
                                                    {{   Helper::fecha($user->dateCreate)->dayName }} {{  Helper::fecha($user->dateCreate)->format('d-m-y H:i:s') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                               
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 p-2">
                                                    {{ ($user->dateModificate != null) ?  Helper::fecha($user->dateModificate)->dayName .' ' . Helper::fecha($user->dateModificate)->format('d-m-y H:i:s') : '' }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                               
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 p-2">
                                                    {{ ($user->date != null) ?  Helper::fecha($user->date)->diffForHumans() :'' }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                               
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                
                                  
                


                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        {{-- <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a> --}}
                                    </td>
                                </tr>                            
                                @if ($showInfoTrue)
                                    <tr class="bg-gray-50">
                                        <td colspan="4">
                                            <div class="p-4">
                                            Info adicional
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                        @endforeach
                    </tbody>
                </table>
                    
                    
                        
                
            
            </x-table>
            

    
    


        </div>
    </div>

    {{-- MODALES --}}
    <div>
        {{-- <div wire:loading wire:target="addRol">
            <x-spinner.spinner_screen></x-spinner.spinner_screen>
        </div> --}}
        @if ($openAddNew)
        <div>
            <x-modal.modal2> 
                <div class="p-4 px-2">
                    <div class="flex justify-between items-center gap-4 mb-4">
                        <h2 class="font-bold text-xl text-gray-600">Modal abierto</h2>
                        <div wire:click="$set('openAddNew',false)" class="p-2 px-3 border shadow rounded-full hover:bg-red-500 hover:text-white cursor-pointer"><i class="fas fa-times transform hover:scale-125"></i></div>
                    </div>
                    <div>
                        {{-- DATOS DEL MODAL .... --}}
                        <div>
                            <x-jet-label >Nombre</x-jet-label>
                            {{-- <x-jet-input wire:model.defer="namePermission"></x-jet-input> --}}
                        </div>
                      
                        <div>
                            <x-jet-label >Descripcion</x-jet-label>
                            {{-- <x-jet-input wire:model.defer="descriptionPermission"></x-jet-input> --}}
                        </div>
                    </div>
                    <div class="p-4 px-2">
                        {{-- <x-jet-button wire:click="addRol">Crear Permiso</x-jet-button> --}}
                    </div>
                    
                </div>
            </x-modal.modal2>
        </div>
            
        @endif

    </div>

    


</div>


