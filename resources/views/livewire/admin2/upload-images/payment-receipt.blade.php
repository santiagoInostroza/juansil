<div id="payment_receipt_{{$sale->id}}" x-data="{isOpenAddPaymentReceipt:false}">

    <div wire:loading wire:target="payment_receipt">
        <div class="fixed inset-0 bg-gray-800 opacity-50"></div>
        <div class="fixed inset-0 flex justify-center items-center">
            <i class="fas fa-spinner animate-spin"></i>
        </div>
    </div>

    @if ($payment_receipt  )
        <x-modal.alert2>
            <div>
                <x-slot name="header">Deseas guardar esta imagen?</x-slot>
                <x-slot name="body">                                      
                       
                  

                    <img class="max-w-sm max-h-72 object-cover m-auto" src=" {{$payment_receipt->temporaryUrl()}}" alt="Imagen temporal del recibo">
                </x-slot>
                <x-slot name="footer">
                    <div class="flex items-center gap-4 justify-between">
                        <x-jet-secondary-button wire:click="$set('payment_receipt','')">Cancelar</x-jet-secondary-button>
                        <x-jet-button wire:click="savePaymentReceipt()">Guardar</x-jet-button>
                    </div>
                </x-slot>
                
            </div>
        </x-modal>
    @endif

    @if ($sale->payment_receipt_url == null)
        <label class="inline-flex items-center    rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 p-0">
            <i class="fas fa-camera {{$size}}"></i>
            <input class="hidden" type="file" wire:model="payment_receipt">
        </label>
        <x-jet-input-error for="payment_receipt">Debes seleccionar una imagen</x-jet-input-error>
    @else
        <div x-on:click="isOpenAddPaymentReceipt = true">
            <div class="flex items-center gap-1 shadow rounded p-1 cursor-pointer">
                <i class="fas fa-camera {{$size}}"></i>
                1
            </div>
        </div>
    @endif

    <div x-cloak x-show="isOpenAddPaymentReceipt" x.on:click.away="isOpenAddPaymentReceipt=false">
        <x-modal.alert2>
            <div>
                <x-slot name="header">Cambiar recibo de pago</x-slot>
                <x-slot name="body"> 
                  
                    <img class="max-w-sm max-h-72 object-cover m-auto transform hover:scale-300 transition-all duration-2000" src="{{ Storage::url($sale->payment_receipt_url) }}"  alt="Imagen del recibo">
                   


                </x-slot>
                <x-slot name="footer">
                    <div class="flex items-center gap-4">
                        <x-jet-secondary-button x-on:click="isOpenAddPaymentReceipt=false">cerrar</x-jet-secondary-button>
                        <label x-on:click="isOpenAddPaymentReceipt=false" class="inline-flex items-center px-4 py-2 gap-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 p-0">
                            <i class="fas fa-camera text-lg"></i> Cambiar imagen
                            <input  class="hidden" type="file" wire:model="payment_receipt">
                        </label>
                    </div>
                   
                </x-slot>
                
            </div>
        </x-modal>

    </div>

    

   
    
   
   
    
</div>

