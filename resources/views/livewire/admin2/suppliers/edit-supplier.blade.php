<div>
    <form wire:submit.prevent="updateSupplier()">
    <div class="bg-white shadow p-4 rounded grid gap-4">
            <div>

                <x-jet-label>Nombre</x-jet-label>
                <x-jet-input class="w-full" placeholder="Ingresa nombre del proveedor" wire:model="supplier.name"></x-jet-input>
                @error('supplier.name')
                    <span class="text-sm text-red-600"> {{$message}}</span>
                @enderror
            </div>
            <div>
                
                <x-jet-button>Actualizar Proveedor</x-jet-button>
            </div>
        </div>
    </form>
</div>
