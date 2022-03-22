<div x-data="{permissions:@entangle('permissions')}" >
    <div class="shadow p-4 w-full bg-white rounded mb-4">
        <h2 class="">Nombre</h2>
        <x-jet-input placeholder="Ingresa un nombre para este rol" class="w-full" wire:model.defer="role.name"></x-jet-input>
       
        @error('role.name')
            <span class="text-red-500 text-sm">{{$message}}</span>
        @enderror
    </div>

    <div class="shadow p-4 w-full bg-white rounded my-4">
        <h2 class="">Permisos</h2>
        <ul  class="grid grid-cols-4 gap-1">
            @foreach ($allPermissions as $key => $permission)
                <li class="rounded shadow p-2 " >
                   
                    <label class="flex gap-2 items-center cursor-pointer ">
                        <input type="checkbox"  value="{{$permission->id}}"  x-model="permissions" class="cursor-pointer">
                        <div>
                            <div class="font-bold">
                                {{$permission->name}}
                            </div>
                            <div class="text-sm">
                                {{$permission->description}}
                            </div>
                        </div>
                    </label>
                </li>
            @endforeach
        </ul>
        @error('permissions')
            <span class="text-red-500 text-sm">{{$message}}</span>
        @enderror

        <div>
            <x-jet-button wire:click="editRol()">Actualizar Rol</x-jet-button>
        </div>
        
    </div>
</div>
