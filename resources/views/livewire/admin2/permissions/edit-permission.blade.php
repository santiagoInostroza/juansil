<div x-data="{permissions:@entangle('permissions').defer}" >
    <div class="shadow p-4 w-full bg-white rounded mb-4 grid gap-4">
        <div>
            <h2 class="">Nombre</h2>
            <x-jet-input placeholder="Ingresa un nombre para este permiso" class="w-full" wire:model.defer="permission.name"></x-jet-input>
            
            @error('permission.name')
                <span class="text-red-500 text-sm">{{$message}}</span>
            @enderror
        </div>
        <div>
            <h2 class="">Description</h2>
            <x-jet-input placeholder="Ingresa una breve descripcion" class="w-full" wire:model.defer="permission.description"></x-jet-input>
            
            @error('permission.description')
                <span class="text-red-500 text-sm">{{$message}}</span>
            @enderror
        </div>
        
        <div>
            <x-jet-button wire:click="updatePermission()">Actualizar Permiso</x-jet-button>
        </div>
        
    </div>
</div>