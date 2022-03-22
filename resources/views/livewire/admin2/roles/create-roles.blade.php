<div x-data="{permissions:@entangle('permissions').defer}" >
    <div class="shadow p-4 w-full bg-white rounded mb-4">
        <h2 class="">Nombre</h2>
        <x-jet-input placeholder="Ingresa un nombre para este rol" class="w-full" wire:model.defer="name"></x-jet-input>
        {{$name}}
        @error('name')
            <span class="text-red-500 text-sm">{{$message}}</span>
        @enderror
    </div>

    <div class="shadow p-4 w-full bg-white rounded my-4">
        <h2 class="">Permisos</h2>
        <ul  class="grid grid-cols-4">
            @foreach ($allPermissions as $permission)
                <li>
                    <label class="flex gap-2 items-center cursor-pointer p-2 rounded">
                        <input type="checkbox"  value="{{$permission->id}}"  x-model="permissions" class="cursor-pointer">
                        <div>
                            {{$permission->description}}
                        </div>
                    </label>
                </li>
            @endforeach
        </ul>
        @error('permissions')
            <span class="text-red-500 text-sm">{{$message}}</span>
        @enderror

        <div>
            <x-jet-button wire:click="saveRol()">Crear Rol</x-jet-button>
        </div>
        
    </div>
</div>
