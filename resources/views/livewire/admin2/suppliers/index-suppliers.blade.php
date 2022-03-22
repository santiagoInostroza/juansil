<div>
    <x-table.table>
        <x-slot name="thead">
            <x-table.tr>
                <x-table.th>Nombre</x-table.th>
                <x-table.th></x-table.th>
            </x-table.tr>
        </x-slot>

        <x-slot name="tbody">
            @foreach ($suppliers as $supplier)
            <x-table.tr>
                <x-table.td>{{$supplier->name}}</x-table.td>
               
                <x-table.td>
                    <div class="flex items-center gap-1 justify-end">
                        @can('admin.suppliers.show')
                        <a href="{{ route('admin2.suppliers.show', $supplier)}}">
                            <x-jet-secondary-button>
                                <i class="fas fa-eye"></i>
                            </x-jet-secondary-button>
                        </a>
                        @endcan
                        @can('admin.suppliers.edit')
                                <a href="{{ route('admin2.suppliers.edit', $supplier)}}">
                                    <x-jet-secondary-button>
                                        <i class="fas fa-pen"></i>
                                    </x-jet-secondary-button>
                                </a>
                           
                        @endcan

                        @can('admin.suppliers.delete')
                          
                                <div x-data="{isOpenDeleteSupplier:false}">                          
                                    <x-jet-danger-button x-on:click="isOpenDeleteSupplier=true"> <i class="fas fa-trash"></i></x-jet-danger-button>
                                    <div x-cloak x-show="isOpenDeleteSupplier">
                                        <x-modal.alert2>
                                            <x-slot name="header">Eliminar Proveedor </x-slot>
                                            <x-slot name="body">Seguro deseas eliminar este Proveedor {{$supplier->id}} '{{$supplier->name}}'?</x-slot>
                                            <x-slot name="footer">
                                                <div class="flex justify-between">
                                                    <x-jet-secondary-button x-on:click="isOpenDeleteSupplier=false"> Cancelar</x-jet-secondary-button>
                                                    <x-jet-danger-button wire:click="deleteSupplier('{{ $supplier->id }}')"> Eliminar</x-jet-danger-button>
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
