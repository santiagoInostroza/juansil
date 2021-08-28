<div>
    <div class="mt-10"></div>
    <div class="p-4">
        <h1 class="text-2xl font-bold text-gray-600 uppercase">{{$category->name}}</h1>
    </div>

    <ul class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 border-l border-t border-gray-200">
        @foreach ($products as $product)
            <li class="border-b border-r  p-4 flex flex-col justify-between" wire:key="{{ $product->id }}">
                <a href="{{route('products.show',$product)}}">
                    <div class="w-full">
                        @if ($product->image)
                            <figure>
                                @if ( Storage::exists('products_thumb/' .$product->image->url))
                                    <img class="object-contain h-48 w-full" src="{{ Storage::url('products_thumb/' . $product->image->url) }}">
                                @else
                                    <img class="object-contain h-48 w-full" src="{{ Storage::url($product->image->url) }}" alt="">
                                @endif
                            </figure>                            
                        @endif
                        
                        <div class="text-gray-600 w-max-content m-auto max-w-full">
                            <div class="font-bold">
                                {{$product->brand->name}}
                            </div>
        
                        <div class="max-w-full">
                            {{$product->name}}
                            </div>                           
                        </div>
                    </div>
                </a>
                <div class="text-gray-600 w-max-content m-auto text-center mt-4 h-full flex flex-col justify-center max-w-full">
                
                    @if (isset($product->salePrices))
                        @foreach ($product->salePrices as $price)
                            @if ( count($product->salePrices)==1)
                                <div class="text-xl h-full flex items-center"> ${{ number_format($price->total_price, 0, ',', '.') }}</div>
                            @else
                                @if ($price->quantity == 1)
                                <div class="text-sm grid grid-cols-2">
                                    <div class="text-right">{{ $price->quantity }} x </div>
                                    <div class="text-left  px-1 mx-1"> ${{ number_format($price->total_price, 0, ',', '.') }}</div>
                                </div>
                                    
                                @else
                                    <div class="text-xs font-thin grid grid-cols-2 items-center max-w-full mt-2 text-right">
                                        <div class="">
                                            {{ $price->quantity }} x  ${{ number_format($price->total_price, 0,',','.') }}
                                        </div>
                                        <span class="text-left bg-red-600 text-sm  sm:text-lg  px-1 mx-1  rounded text-white w-max-content" style="padding-top: 1px">
                                            ${{ number_format($price->price, 0,',','.') }} c/u
                                        </span>
                                    </div>
                                    
                                @endif
                                
                            @endif
                        @endforeach
                    @endif
            
                </div>
                
            
                @if ($product->stock>0)
                    <div class="text-center mt-4 relative" >
                        @if (!session()->has('carrito.'.$product->id))
                            {{-- <div wire:loading wire:target="{{$product->id}}" class="font-bold text-yellow-300 p-2 font-xl">Agregando al carrito ...</div> --}}
                            <x-jet-secondary-button onclick="return addToCart({{$product->id}});"> 
                                <i class="fas fa-cart-plus mr-1 mb-1" ></i> 
                                Agregar
                            </x-jet-secondary-button>
                        @else
                            <div class="w-max-content m-auto">
                                <i class="fas fa-shopping-cart text-green-500"></i>
                                <label for="cantidad_product_{{$product->id}}">
                                    <input type="number" min="1" class="p-1 w-9 text-center text-gray-500 cantidad_producto_{{$product->id}}" value="{{ (isset(session('carrito')[$product->id])) ? session('carrito')[$product->id]['cantidad']:'1' }}"
                                        wire:ignore 
                                        onchange="return listaSetCantidad({{ $product->id }}, {{ $product->stock }})"  
                                        id='cantidad_product_{{ $product->id }}'  
                                        data-pid="{{ $product->id }}"
                                    > 
                                </label>
                                <x-jet-secondary-button onclick="return listaDisminuyeCantidad2({{ $product->id }})" data-pid="{{$product->id}}">-</x-jet-secondary-button>
                                
                                <x-jet-secondary-button onclick="return listaAumentaCantidad({{ $product->id }}, {{ $product->stock }})" data-pid="{{$product->id}}">+</x-jet-secondary-button>
                            </div>
                        
                        @endif
                    </div>
                @else
                    <div class="text-center mt-4">
                        <div class="cursor-default inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm  focus:outline-none    transition ease-in-out duration-150" disabled> Agotado</div>
                    </div>
                @endif                    
            </li>            
        @endforeach
    </ul>

    <div class="p-4">
        <h2 class="text-2xl font-bold text-gray-600 uppercase">
           MIRA OTRAS CATEGORIAS
        </h2>
    </div>

   

    
    @foreach ($categories as $category2)
        @if (count($category2->products)==0)
            @continue
        @endif
        <h3 class="text-2xl font-bold text-gray-600 uppercase p-4">{{$category2->name}}</h3>
        <ul class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 border-l border-t border-gray-200">
            @foreach ($category2->products as $product)
                <li class="border-b border-r  p-4 flex flex-col justify-between" wire:key="{{ $product->id }}">
                    <a href="{{route('products.show',$product)}}">
                        <div class="w-full">
                            @if ($product->image)
                                <img class="object-contain h-48 w-full" src="{{ Storage::url($product->image->url) }}" alt="">
                            @endif
                            
                            <div class="text-gray-600 w-max-content m-auto max-w-full">
                                <div class="font-bold">
                                    {{$product->brand->name}}
                                </div>
            
                            <div class="max-w-full">
                                {{$product->name}}
                                </div>                           
                            </div>
                        </div>
                    </a>
                    <div class="text-gray-600 w-max-content m-auto text-center mt-4 h-full flex flex-col justify-center max-w-full">
                    
                        @if (isset($product->salePrices))
                            @foreach ($product->salePrices as $price)
                                @if ( count($product->salePrices)==1)
                                    <div class="text-xl h-full flex items-center"> ${{ number_format($price->total_price, 0, ',', '.') }}</div>
                                @else
                                    @if ($price->quantity == 1)
                                    <div class="text-sm grid grid-cols-2">
                                        <div class="text-right">{{ $price->quantity }} x </div>
                                        <div class="text-left  px-1 mx-1"> ${{ number_format($price->total_price, 0, ',', '.') }}</div>
                                    </div>
                                        
                                    @else
                                        <div class="text-xs font-thin grid grid-cols-2 items-center max-w-full mt-2 text-right">
                                            <div class="">
                                                {{ $price->quantity }} x  ${{ number_format($price->total_price, 0,',','.') }}
                                            </div>
                                            <span class="text-left bg-red-600 text-sm  sm:text-lg  px-1 mx-1  rounded text-white w-max-content" style="padding-top: 1px">
                                                ${{ number_format($price->price, 0,',','.') }} c/u
                                            </span>
                                        </div>
                                        
                                    @endif
                                    
                                @endif
                            @endforeach
                        @endif
                
                    </div>
                    
                
                    @if ($product->stock>0)
                        <div class="text-center mt-4 relative" >
                            @if (!session()->has('carrito.'.$product->id))
                                {{-- <div wire:loading wire:target="{{$product->id}}" class="font-bold text-yellow-300 p-2 font-xl">Agregando al carrito ...</div> --}}
                                <x-jet-secondary-button onclick="return addToCart({{$product->id}});"> 
                                    <i class="fas fa-cart-plus mr-1 mb-1" ></i> 
                                    Agregar
                                </x-jet-secondary-button>
                            @else
                                <div class="w-max-content m-auto">
                                    <i class="fas fa-shopping-cart text-green-500"></i>
                                    <label for="cantidad_product_{{$product->id}}">
                                        <input type="number" min="1" class="p-1 w-9 text-center text-gray-500 cantidad_producto_{{$product->id}}" value="{{ (isset(session('carrito')[$product->id])) ? session('carrito')[$product->id]['cantidad']:'1' }}"
                                            wire:ignore 
                                            onchange="return listaSetCantidad({{ $product->id }}, {{ $product->stock }})"  
                                            id='cantidad_product_{{ $product->id }}'  
                                            data-pid="{{ $product->id }}"
                                        > 
                                    </label>
                                    <x-jet-secondary-button onclick="return listaDisminuyeCantidad2({{ $product->id }})" data-pid="{{$product->id}}">-</x-jet-secondary-button>
                                    
                                    <x-jet-secondary-button onclick="return listaAumentaCantidad({{ $product->id }}, {{ $product->stock }})" data-pid="{{$product->id}}">+</x-jet-secondary-button>
                                </div>
                            
                            @endif
                        </div>
                    @else
                        <div class="text-center mt-4">
                            <div class="cursor-default inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm  focus:outline-none    transition ease-in-out duration-150" disabled> Agotado</div>
                        </div>
                    @endif                    
                </li>            
            @endforeach
        </ul>
        
    @endforeach
  
    <div>
        @push('js')
            <script>
                function listaAumentaCantidad(pid, stock){
                    if(document.getElementById('cantidad_product_' + pid).value >= stock){
                        alerta_timer({icon:'warning',title:'No hay suficiente stock para agregar más unidades!!', timer: 2000});
                    }else{
                        var cantidad =  ++document.getElementById('cantidad_product_' + pid).value;
                        document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                            element.value=cantidad;
                        });
                        Livewire.emitTo('productos.category-livewire','setCantidad', pid,cantidad);
                    }           
                }
    
    
                function listaDisminuyeCantidad2(pid){
                    if(document.getElementById('cantidad_product_' + pid).value <= 1){
                        removeFromCart2(pid);
                    }else{
                        let cantidad =  --document.getElementById('cantidad_product_' + pid).value;
                        document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                            element.value=cantidad;
                        });
                        Livewire.emitTo('productos.category-livewire','setCantidad', pid,cantidad);
                    }
                }
    
    
                function listaSetCantidad(pid, stock){
                    let cantidad =1;
                    if(document.getElementById('cantidad_product_' + pid).value>= stock){
                        alerta_timer({icon:'warning',title:'No hay suficiente stock para agregar más unidades!!', timer: 2000});
                        cantidad = stock;
                    }else{
                        if(document.getElementById('cantidad_product_' + pid).value<=1){
                            document.getElementById('cantidad_product_' + pid).value = cantidad;
                        }else{
                            cantidad =  document.getElementById('cantidad_product_' + pid).value;
                        }
                    }
                    document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                        element.value=cantidad;
                    });
                    Livewire.emitTo('productos.category-livewire','setCantidad', pid,cantidad);            
                }
    
    
                function addToCart(pid){
                    Livewire.emitTo('productos.category-livewire','addToCart', pid);
                }
    
                function removeFromCart2(pid){
                    Livewire.emitTo('productos.category-livewire','removeFromCart2', pid);
                }
            </script>        
        @endpush
    </div>
</div>
