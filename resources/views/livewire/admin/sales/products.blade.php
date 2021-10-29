<div class="">
    
    
    <div class="relative">
        <div wire:loading.flex wire:target="search" >
            <x-spinner.spinner2></x-spinner.spinner2>
        </div>
        <x-jet-input class="w-full" wire:model.debounce.500ms="search"></x-jet-input>
    </div>
    <table class="table-fixed w-full">
        <thead>
            <tr>
                <th class="w-5/12">Nombre</th>
                <th class="w-1/12 text-right">Cantidad</th>
                <th class="w-2/12 text-right">Unidad</th>
                <th class="w-2/12 text-right">Total</th>
                <th class="w-2/12 text-right"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td>
                        <div class="p-2 flex items-center gap-2" >
                            <div>
                                <img width="30" src="{{ Storage::url('products_thumb/' . $product->image->url)}}" alt="L">
                            </div>
                            <div>
                                <div>
                                    {{ $product->name}}
                                </div>
                                <div class="">
                                    Stock {{$product->stock}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>
                            @foreach ($product->salePrices as $price)
                                <div class="text-right"> {{ $price->quantity }} </div>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div>
                            @foreach ($product->salePrices as $price)    
                                <div class="col-span-2 text-right"> ${{ number_format($price->price,0,',','.') }} </div>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div>
                            @foreach ($product->salePrices as $price)
                                <div class="col-span-3 text-right">${{ number_format($price->total_price,0,',','.') }} </div>
                            @endforeach
                        </div>
                    </td>
                    <td width="10">
                        <div class="text-right pr-5">
                            <x-jet-button wire:loading.attr="disabled" wire:click="addToSale({{ $product->id }})">Agregar</x-jet-button>
                        </div>
                    </td>
                </tr>
            @endforeach
           
           
        </tbody>
    </table>
</div>
