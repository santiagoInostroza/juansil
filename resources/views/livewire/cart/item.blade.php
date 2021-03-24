<div class="pb-4 h-28 text-cool-gray-600 border-b-2 border-gray-200">
    <div class=" h-24 flex items-center justify-between relative ">
        {{-- SPINNER --}}
        {{-- <div wire:loading class="absolute bg-gray-200 bg-opacity-25 z-50 items-center justify-center right-9">
            <x-spinner.spinner size='6' />
        </div> --}}
        {{-- IMAGEN --}}
        <div class="w-16">
            <img class="max-h-24 object-cover" src=" {{ Storage::url($url) }}" alt="">
        </div>

        {{-- NOMBRE --}}
        <div class="pl-1 sm:px-2 ml-2 sm:mx-4 w-2/3 sm:w-1/2">
            <div class="font-bold">
                {{ $name }}
            </div>
            <div class="text-xs">
                ${{ number_format($precio, 0, ',', '.') }}
            </div>
        </div>

        {{-- CANTIDAD --}}
        <div class=" text-right w-20">
            <label class="text-xs font-bold flex items-baseline justify-end">
                <input wire:model="cantidad" wire:change='updateAll' wire:keyup='updateAll' type="number"
                    class="w-10 inline-block text-right p-1" >
                un.
            </label>
            <div>
                ${{ number_format($total, 0, ',', '.') }}
            </div>
        </div>

        {{-- BOTONES --}}
        <div x-data class="flex items-center justify-center ml-4 flex-row-reverse ">

            <button class="cursor-pointer hover:bg-purple-100 rounded-full " 
            @click="$wire.increment()
                setTimeout(() => { 
                    if($wire.isPermitedUpdated){
                        $wire.isPermitedUpdated=false;
                        $wire.updateAll() 
                    }
                   
                }, 1500);">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </button>


            <button class="cursor-pointer hover:bg-purple-100 rounded-full " 
                @click="$wire.decrement()
                setTimeout(() => { 
                    if($wire.isPermitedUpdated){
                        $wire.isPermitedUpdated=false;
                        $wire.updateAll() 
                    }
                }, 1500);">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </button>
        </div>
        <div class="cursor-pointer hover:bg-purple-100 rounded-full p-1 sm:p-3 ml-1 sm:ml-5"
            wire:click="removeItem">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                </path>
            </svg>
        </div>
    </div>



    @if ($msj != '')
        <div class="text-red-700 text-sm ml-20 -mt-4">
            {{ $msj }}
        </div>
    @elseif ($hasOfert == false)

    @elseif ($tipoPrecio == 1)
        <div class="text-xs text-gray-500 bg-yellow-100 p-1 w-max-content rounded-lg ml-20 -mt-4">
            Agrega <span class="font-bold">{{ $cantFaltante }}</span> productos más, para activar la oferta
        </div>
    @elseif ($tipoPrecio == 2)
        <div class=" flex text-xs bg-green-100 p-1 w-max-content rounded-lg ml-20 -mt-4">
            Precio de oferta aplicado
            <svg class="w-6 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
    @endif


</div>
