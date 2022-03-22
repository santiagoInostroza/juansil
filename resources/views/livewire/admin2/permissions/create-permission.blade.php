<div x-data="{permissions:@entangle('permissions').defer}" >
    <div class="shadow p-4 w-full bg-white rounded mb-4 grid gap-4">
        <div>
            <h2 class="">Nombre</h2>
            <x-jet-input placeholder="Ingresa un nombre para este permiso" class="w-full" wire:model.defer="name"></x-jet-input>
            
            @error('name')
                <span class="text-red-500 text-sm">{{$message}}</span>
            @enderror
        </div>
        <div>
            <h2 class="">Description</h2>
            <x-jet-input placeholder="Ingresa una breve descripcion" class="w-full" wire:model.defer="description"></x-jet-input>
            
            @error('description')
                <span class="text-red-500 text-sm">{{$message}}</span>
            @enderror
        </div>
        
        <div>
            <x-jet-button wire:click="createPermission()">Crear Permiso</x-jet-button>
        </div>
        
    </div>
</div>