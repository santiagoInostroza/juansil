<div>
    <x-table.table>
        <x-slot name="thead">
            <x-table.tr>
                <x-table.th>Nombre</x-table.th>
                <x-table.th>Permisos</x-table.th>
                <x-table.th></x-table.th>
            </x-table.tr>
        </x-slot>

        <x-slot name="tbody">
            @foreach ($roles as $role)
            <x-table.tr>
                <x-table.td>{{$role->name}}</x-table.td>
                <x-table.td>
                    <ul class="flex flex-wrap gap-2 my-1">
                       
                        @if ($role->name == 'SuperAdmin')
                            <li>
                                Todos los permisos  ({{$role->permissions->count()}})
                            </li>
                        @else
                            <li>
                                {{$role->permissions->count()}}
                            </li>
                        @endif
                       
                    </ul>
                </x-table.td>
                <x-table.td>
                    <div class="flex items-center gap-1">
                        @can('admin.roles.show')
                        <a href="{{ route('admin2.roles.show', $role)}}">
                            <x-jet-secondary-button>
                                <i class="fas fa-eye"></i>
                            </x-jet-secondary-button>
                        </a>
                        @endcan
                        @can('admin.roles.edit')
                            @if ($role->name != 'SuperAdmin')
                                <a href="{{ route('admin2.roles.edit', $role)}}">
                                    <x-jet-secondary-button>
                                        <i class="fas fa-pen"></i>
                                    </x-jet-secondary-button>
                                </a>
                            @endif
                        @endcan

                        @can('admin.roles.delete')
                            @if ($role->name != 'SuperAdmin')
                                <div x-data="{isOpenDeleteRole:false}">                          
                                    <x-jet-danger-button x-on:click="isOpenDeleteRole=true"> <i class="fas fa-trash"></i></x-jet-danger-button>
                                    <div x-cloak x-show="isOpenDeleteRole">
                                        <x-modal.alert2>
                                            <x-slot name="header">Eliminar Rol </x-slot>
                                            <x-slot name="body">Seguro deseas eliminar este Rol {{$role->id}} '{{$role->name}}'?</x-slot>
                                            <x-slot name="footer">
                                                <div class="flex justify-between">
                                                    <x-jet-secondary-button x-on:click="isOpenDeleteRole=false"> Cancelar</x-jet-secondary-button>
                                                    <x-jet-danger-button wire:click="deleteRole('{{ $role->id }}')"> Eliminar</x-jet-danger-button>
                                                </div>
                                            </x-slot>
                                        </x-modal.alert2>
                                    </div>
                                </div>
                                
                            @endif
                        @endcan
                    </div>
                </x-table.td>
            </x-table.tr>
            @endforeach
        </x-slot>
    </x-table.table>
</div>
