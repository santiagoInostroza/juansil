@props(['name', 'price'])
<div class="w-full">
@if (auth()->user()->hasDefaultPaymentMethod())

    @if (auth() ->user()->subscribed($name))
        @if (auth()->user()->subscribedToPlan($price,$name))
            @if (auth()->user()->subscription($name)->onGracePeriod())
                <button 
                    wire:click="resuminSubscription('{{ $name }}')"
                    wire:loading.remove
                    wire:target="resuminSubscription('{{$name}}')"
                    class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
                    Reanudar Plan
                </button>

                <button 
                    wire:loading.flex 
                    wire:target="resuminSubscription('{{$name}}')"
                    class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    <x-spinner.spinner size='6' class="mr-2" />
                    Reanudar Plan
                </button>
                    
            @else
            <button 
                wire:click="cancellingSubscription('{{ $name }}')"
                wire:loading.remove
                wire:target="cancellingSubscription('{{$name}}')"
                class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
                Cancelar
            </button>

            <button 
                wire:loading.flex 
                wire:target="cancellingSubscription('{{$name}}')"
                class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                <x-spinner.spinner size='6' class="mr-2" />
                Cancelar
            </button>
                
            @endif
        @else
            <button 
                wire:click="changinPlans('{{$name}}','{{$price}}')"
                wire:loading.remove
                wire:target="changinPlans('{{$name}}','{{$price}}')"
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
                Cambiar plan
            </button>

            <button 
                wire:loading.flex 
                wire:target="changinPlans('{{$name}}','{{$price}}')"
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                <x-spinner.spinner size='6' class="mr-2" />
                Cambiar plan
            </button>
        @endif
    @else
        <button wire:click="newSubscription('{{ $name }}','{{ $price }}')" 
            wire:loading.remove
            wire:target="newSubscription('{{$name}}','{{$price}}')"
            class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
            Suscribirse
        </button>

        <button wire:loading.flex 
            wire:target="newSubscription('{{ $name }}','{{ $price }}')"
            class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
            <x-spinner.spinner size='6' class="mr-2" />
            Suscribirse
        </button>
    @endif
    
@else
    <button 
        
        class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
        Agregar Metodo de pago
    </button>
@endif

</div>
