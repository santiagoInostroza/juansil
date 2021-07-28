{{-- 
    <div class="relative">

   
        <div wire:loading.flex wire:target='addToCart'
            class="absolute w-full h-full bg-gray-200 bg-opacity-25 z-30 items-center justify-center">
            <x-spinner.spinner size='10' />
        </div>

     
        <div class="text-center font-bold py-2 my-2 h-20 flex items-center justify-center ">
            <div>
                @if ($hasOfert)
                    @foreach ($producto->salePrices as $price)
                        <div>
                            @if ($price->quantity == 1)
                                <span class="text-sm"> {{ $price->quantity }} x
                                    ${{ number_format($price->total_price, 0, ',', '.') }}</span>
                            @else
                                <div class="text-xs font-thin mt-2">
                                    desde {{ $price->quantity }}
                                </div>
                                <span class="bg-red-600  text-lg  px-1 mx-1  rounded text-white" style="padding-top: 1px">
                                    $ {{ number_format($price->price, 0,',','.') }} c/u
                                </span>
                            @endif

                        </div>
                    @endforeach
                @else
                    <span class="text-xl">
                        ${{ number_format($producto->salePrices[0]->price, 0, ',', '.') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="flex justify-center items-center text-xs">
            <div class="h-14 flex-1 text-center">
                <a href="{{ route('products.show', $producto) }}" class=" text-center">{{ $producto->name }}</a>

                <div class="font-bold text-center ">
                    <a href='#' class=""> {{ $producto->brand->name }}</a>
                </div>
            </div>
        </div>

        @if ($stock > 0)
            <div class="text-xs text-center font-bold py-4 pt-2">
                <button class="shadow p-2 px-4" wire:click='decrement'>-</button>

                <input min="0" name="" type="number" id="" class="p-2 w-12 shadow text-center"
                    value="{{ $cantidad }}" wire:model="cantidad" wire:keyup.enter='addToCart'
                    wire:change="calcularTotal" wire:blur="$set('msj','')">

                <button class="shadow p-2 px-4" wire:click='increment' wire:blur="$set('msj','')">+</button>


                <div class="m-2 h-4 font-thin flex items-center justify-center">
                    @if ($total > 0)
                        <span class="mx-1">
                            Total: $ {{ number_format($total, 0, ',','.') }}
                        </span>
                    @endif
                </div>

                <div class="px-10">
                    @if ($isAddedToCart)
                        <div class="select-none bg-gray-600 p-3 text-white rounded flex items-center justify-center ">
                            Agregado
                            <svg class="w-6 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    @else
                        <div wire:key='agregar' wire:click="addToCart" class="select-none btn bg-gray-900 text-white block cursor-pointer text-center "style="padding: 0.75rem"> 
                            Agregar
                        </div>
                   @endif
                </div>
                <div class="h-8 text-red-700 pt-2 text-base">
                    {{ $msj }}
                </div>

            </div>
        @else
            <div class="w-full h-32 flex items-end justify-center select-none text-xs text-center font-bold px-10 pb-3">
                <div class="bg-gray-300 text-gray-500 font-bold rounded p-3 w-full">
                    Sin stock 
                </div>
            </div>
        @endif



    </div> --}}