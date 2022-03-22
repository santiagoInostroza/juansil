<div>
    <form wire:submit.prevent="createSupplier()">
    <div class="bg-white shadow p-4 rounded grid gap-4">
            <div>

                <x-jet-label>Nombre</x-jet-label>
                <x-jet-input class="w-full" placeholder="Ingresa nombre del proveedor" wire:model="name"></x-jet-input>
                @error('name')
                    <span class="text-sm text-red-600"> {{$message}}</span>
                @enderror
            </div>
            <div>
                
                <x-jet-button>Crear Proveedor</x-jet-button>
            </div>
        </div>
    </form>
</div>
