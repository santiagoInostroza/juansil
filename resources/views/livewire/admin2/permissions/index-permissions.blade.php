<div>
    <x-table.table>
        <x-slot name="title">
       
                <x-jet-input class="w-full" placeholder="Buscar permiso..." wire:model.debounce="search"></x-jet-input>
         
        </x-slot>
        <x-slot name="thead">
            <x-table.tr>
                <x-table.th>Nombre</x-table.th>
                <x-table.th>Descripcion</x-table.th>
                <x-table.th></x-table.th>
            </x-table.tr>
        </x-slot>

        <x-slot name="tbody">
            @foreach ($permissions as $permission)
            <x-table.tr>
                <x-table.td>{{$permission->name}}</x-table.td>
                <x-table.td>
                    <ul class="flex flex-wrap gap-2 my-1">
                       {{$permission->description}}
                    </ul>
                </x-table.td>
                <x-table.td>
                    <div class="flex items-center gap-1 justify-end">

                        @can('admin.permissions.edit')
                            <a href="{{ route('admin2.permissions.edit', $permission)}}">
                                <x-jet-secondary-button>
                                    <i class="fas fa-pen"></i>
                                </x-jet-secondary-button>
                            </a>
                        @endcan
                        @can('admin.permissions.delete')
                            <div x-data="{isOpenDeletePermission:false}">                          
                                <x-jet-danger-button x-on:click="isOpenDeletePermission=true"> <i class="fas fa-trash"></i></x-jet-danger-button>
                                <div x-cloak x-show="isOpenDeletePermission">
                                    <x-modal.alert2>
                                        <x-slot name="header">Eliminar Permiso </x-slot>
                                        <x-slot name="body">Seguro deseas eliminar este permiso {{$permission->id}} '{{$permission->name}}'?</x-slot>
                                        <x-slot name="footer">
                                            <div class="flex justify-between">
                                                <x-jet-secondary-button x-on:click="isOpenDeletePermission=false"> Cancelar</x-jet-secondary-button>
                                                <x-jet-danger-button wire:click="deletePermission('{{ $permission->id }}')"> Eliminar</x-jet-danger-button>
                                            </div>
                                        </x-slot>
                                    </x-modal.alert2>
                                </div>
                            </div>
                        @endcan
                        
                    </div>
                </x-table.td>
            </x-table.tr>
            @endforeach
        </x-slot>
     
    </x-table.table>
</div>
