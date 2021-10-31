<div class="">
    
    <div class="flex justify-between gap-8 items-center pr-4">
        <div class="relative flex-1">
            <div wire:loading.flex wire:target="search" >
                <x-spinner.spinner2></x-spinner.spinner2>
            </div>
            <x-jet-input class="w-full" wire:model.debounce.500ms="search"></x-jet-input>
        </div>
        @if ($view == 1)
            <div class="cursor-pointer" wire:click="$set('view','2')">
                <i class="fas fa-bars cursor"></i>
            </div>
        @elseif( $view == 2)
            <div class="cursor-pointer"  wire:click="$set('view','1')">
                <i class="fas fa-th"></i>
            </div>
        @endif

    </div>
    
    @if ($view == 1)
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
                                <figure>
                                    <img width="30" src="{{ Storage::url('products_thumb/' . $product->image->url)}}" alt="{{$product->name}}">
                                </figure>
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
    @elseif( $view == 2)
        <div class="grid grid-cols-1  lg:grid-cols-2 xl:grid-cols-3 mt-4 gap-2 relative">
            @foreach ($products as $product)
                <div class="flex flex-col justify-between border rounded p-2 cursor-default ">
                    <div class="relative">
                        <figure>
                            <img class="object-contain w-16 h-16"  src="{{ Storage::url('products_thumb/' . $product->image->url)}}" alt="{{$product->name}}">
                            <figcaption class="text-gray-800 mt-2">{{$product->name}}</figcaption>
                        </figure>
                        <div class="absolute top-0 right-0 mr-4 mt-4 p-1 rounded @if($product->stock <= 0) bg-red-200 @elseif($product->stock <= $product->stock_min) bg-yellow-100 @endif">
                            <div>Stock</div>
                            <div>
                                {{$product->stock}}
                            </div>
                        </div>
                    
                    </div>

                    <div class="flex items-center gap-2 overflow-x-auto overflow-y-hidden w-full">
                        @foreach ($product->salePrices as $price)
                            <div class="text-xs cursor-pointer transform hover:scale-105 "  wire:dblclick="addToSale({{ $product->id }},{{$price->quantity}},{{ $price->price }})">
                                <div class="border p-2 rounded flex flex-col" >
                                   <div>x {{$price->quantity}}</div>
                                   <div>${{ number_format($price->total_price,0,',','.') }}</div>
                                   <div class="text-red-600">(${{ number_format($price->price,0,',','.') }})</div>
                                    
                                </div>
                               
                            </div>
                            
                        @endforeach 
                    </div>
                </div>
            @endforeach

        </div>

        
        
        
    @endif
 
</div>
