<div>
    {{-- LISTA --}}
    <div>
        {{-- TITULO --}}
        <h1 class="p-4 text-center uppercase text-3xl text-gray-600 font-bold my-4">Titulo</h1>
        {{-- SEARCH --}}
        <div class="flex items-center justify-between gap-4">
            <div class="relative flex-1">
                <x-jet-input wire:model.debounce.500ms="search" type="search" class="w-full" placeholder="Buscar..."></x-jet-input>
                <div  wire:loading.flex wire:target="search" >
                    <x-spinner.spinner2 size="6"></x-spinner.spinner2>
                </div>
            </div>
            <x-jet-button wire:click="$set('openAddNew',true)"  class="flex items-center gap-2"><div><i class="fas fa-plus"></i> </div><div>Agregar nuevo</div></x-jet-button>
        </div>
        {{-- FILTROS --}}
        <div class="p-4 border rounded my-4 flex items-center gap-4">
            <div class="flex items-center gap-2">
                <x-jet-label>Orden</x-jet-label>
                <select class="border p-2 rounded" name="orderBy" id="" wire:model="orderBy">
                    <option value="id">Id</option>
                    <option value="name">Nombre</option>
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

        {{-- TABLA --}}
        <div>
            <x-table>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Id </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Nombre </th>
                        <th scope="col" class="relative px-6 py-3" width="10"><span class="">Accion</span> </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($collection as $item)
                            @if (!$this->editRow[$item->id])
                                <tr wire:click="editRowTrue({{ $item->id }})" wire:key="row_{{$item->id}}" class="cursor-pointer">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 p-2">
                                                {{ $item->id }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 p-2">
                                                    {{$item->name}}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                comentario
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        {{-- <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a> --}}
                                    </td>
                                </tr>
                                @else
                                <tr class="text-gray-900  bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $item->id }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                {{-- ALPINE --}}
                                                <div x-data="{editButton:false, openEdit:false, item_id:'',name:'',loading:false}" x-init="item_id={{$item->id}}; name='{{$item->name}}'" x-on:mouseenter="editButton=true" x-on:mouseleave="editButton=false" class="relative rounded hover:bg-gray-200">
                                                    <div class="text-sm font-medium text-gray-900 p-2">
                                                        {{$item->name}}
                                                    </div>
                                                    <div x-show="editButton" x-on:click="openEdit = true" class="absolute p-2 px-3 top-0 right-0 transform translate-x-4 bg-gray-200 cursor-pointer"   ><i class="fas fa-pen"></i></div>
                                                    <div x-show="openEdit">
                                                        <x-modal.modal2>
                                                            <div class="p-4 px-2">
                                                                <div class="flex justify-between items-center gap-4 mb-4">
                                                                    <h2 class="font-bold text-xl text-gray-600">Editar</h2>
                                                                    <div x-on:click="openEdit = false" class="p-2 px-3 border shadow rounded-full hover:bg-red-500 hover:text-white cursor-pointer"><i class="fas fa-times transform hover:scale-125"></i></div>
                                                                </div>
                                                            
                                                                <x-jet-label>Nombre</x-jet-label>
                                                                <x-jet-input x-model="name">{{$item->name}}</x-jet-input>
                                                                {{-- <x-dropdowns.dropdown2  :items="$items" id="select_item_{{$item->id}} "></x-dropdowns.dropdown2> --}}
                                                            </div>
                                                            <div class="p-4 px-2">
                                                                <x-jet-button x-on:click="openEdit=false; loading= true; $wire.editName(item_id,name).then( ()=> loading=false )">Editar</x-jet-button>
                                                                {{-- <x-jet-button x-on:click="openEdit=false; loading= true; $wire.editName(item_id,document.getElementById('select_item_{{$item->id}}_value').value).then( ()=> loading=false )">Editar</x-jet-button> --}}
                                                           </div>
                                                        </x-modal.modal2>
                                                    </div>
                                                    <div x-show="loading">
                                                        <x-spinner.spinner2 size="8"></x-spinner.spinner2>
                                                    </div>
                                                </div>
                                                {{-- /ALPINE --}}
                                                <div class="text-sm  text-gray-600 p-2">
                                                Comentario
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            <div  wire:click="$set('showInfoTrue',{{!$this->showInfoTrue}})" wire:key="row_info_{{$item->id}}"  class="p-2 px-3 flex hidden" title="Ver más info">
                                                @if ($showInfoTrue) 
                                                    <a href="#" class=" hover:text-gray-500 "><i class="fas fa-arrow-up"></i></a>  
                                                @else
                                                    <a href="#" class=" hover:text-gray-500 "><i class="fas fa-arrow-down"></i></a>
                                                @endif
                                            </div>
                                            <div title="Eliminar" wire:click="deleteItem({{$item->id}})" class="p-2 flex cursor-pointer rounded-full hover:bg-red-500 hover:text-white transform hover:scale-125"><i class="fas fa-trash-alt "></i></div>
                                        </div>
                                       
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