    <div class="container py-11 lg:max-w-7xl ">
        <div class="mx-6 mb-6" >
            <div class="grid grid-cols md:grid-cols-2 gap-4 mb-6">
                @isset($producto->image->url)
                    <figure> 
                        @if ( Storage::exists('products_thumb/' .$producto->image->url))
                            <img class="object-contain h-52 sm:h-96 w-full object-center hover:bg-gray-500"  src="{{ Storage::url('products/' . $producto->image->url) }}" alt="">
                        @else
                            <img class="object-contain h-52 sm:h-96 w-full object-center"  src="{{ Storage::url($producto->image->url) }}" alt="">
                        @endif
                    </figure>
                @endisset

                <div class="flex flex-col justify-center">
                    <div class="mb-2">
                        @foreach ($producto->tags as $tag)
                            <a href="{{route('products.tag',$tag)}}">
                                <span
                                    class=" text-xs bg-{{ $tag->color }}-400 rounded-full p-1 mr-2 my-6 text-white">{{ $tag->name }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                    <h1 class="text-xl text-gray-600">{{ $producto->name }}</h1>
                    <div class="text-xl font-bold pb-2">
                        {{ $producto->brand->name }}
                    </div>

                    @foreach ($producto->salePrices as $precio)
               
                        <div class="mb-4">
                            <div class="text-lg w-max-content">
                                <div>
                                    Desde {{$precio->quantity}} un. a 
                                    <div class="font-bold text-gray-500 text-3xl">
                                        ${{number_format($precio->price,0,',','.')}} c/u
                                    </div>
                                </div>
                            </div>
                            @if ($precio->quantity>1)
                            <div class="text-base w-max-content bg-red-100 rounded-xl px-2">
                                    Valor al llevar las {{$precio->quantity}} un. 
                                    <span class="text-red-500 text-xl">
                                        ${{number_format($precio->total_price,0,',','.')}}
                                    </span>
                                </div>
                                @endif
                                
                        </div>
                        
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="fixed left-0 bottom-0 py-6  text-center w-full border-t mr-6 bg-gray-200" style="z-index: 1 ">
                @if ($producto->stock>0)
                    <div class=" flex flex-col text-xs">
                        @if (session()->has('carrito.'.$producto->id))
                          
                                <div class="flex justify-center items-center gap-2">
                                    <i class="fas fa-shopping-cart text-green-500 text-xl"></i>
                                    <input type="number" min="1" class="p-1 w-12 text-center text-gray-500 text-xl font-bold cantidad_producto_{{$producto->id}}" value="{{ (isset(session('carrito')[$producto->id])) ? session('carrito')[$producto->id]['cantidad']:'1' }}"
                                        wire:ignore 
                                        onchange="return showSetCantidad({{ $producto->id }}, {{$producto->stock}});"  
                                        id='show_cantidad_producto_{{$producto->id}}'  
                                        data-pid="{{$producto->id}}"
                                    > 
                                
                                    <x-jet-secondary-button onclick="return showDisminuyeCantidad({{ $producto->id }});" data-pid="{{$producto->id}}">-</x-jet-secondary-button>
                                    <x-jet-secondary-button onclick="return showAumentaCantidad({{ $producto->id }}, {{$producto->stock}});"  data-pid="{{$producto->id}}">+</x-jet-secondary-button>
                                </div>
                           
                        @else
                            <div>
                                <x-jet-secondary-button onclick="addToCart({{$producto->id}})" class="" >
                                    <i class="fas fa-cart-plus m-1"></i> Agregar al carrito
                                </x-jet-secondary-button>

                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center text-red-500 text-xl font-bold">
                        Este producto se encuentra sin stock!!
                    </div>
                @endif
                
            </div>

            @isset($producto->description)
                <div class="my-6">
                    <h2 class="text-2xl my-4 py-2 ">Descripcion del producto</h2>
                    <div class="">
                        {!!$producto->description!!}
                    </div>
                </div>
            @endisset
            <hr>
        </div>

       

        <aside class="md:col-span-2 lg:col-span-3 xl:col-span-1 m-6 mb-20">
       
            
            @if (count($mismas_etiquetas)>0)
                @foreach ($mismas_etiquetas as $key => $productos)
                    @if (count($productos))
                        <div class="mt-4 mb-8">
                            <h1 class="text-2xl font-bold text-gray-600 mb-4">Más de {{ $key }}</h1>
                            <ul class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 border-l border-t border-gray-200">
                                @foreach ($productos as $product)
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
                                                        <x-jet-secondary-button onclick="return listaDisminuyeCantidad({{ $product->id }})" data-pid="{{$product->id}}">-</x-jet-secondary-button>
                                                        
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
                        </div>
                        @if (!$loop->last)
                            <hr>
                        @endif
                    @endif
                @endforeach
            @endif

          

            @if (count($misma_marca)>0)
                <div class="mt-4 mb-8">
                    <h1 class="text-2xl font-bold text-gray-600 mb-4">Más de {{ $producto->brand->name }}</h1>
                    <ul class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 border-l border-t border-gray-200">
                        @foreach ($misma_marca as $product)
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
                                                <x-jet-secondary-button onclick="return listaDisminuyeCantidad({{ $product->id }})" data-pid="{{$product->id}}">-</x-jet-secondary-button>
                                                
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
                </div>
                <hr>
            @endif

         
                 
            @if (count($misma_categoria)>0)
                <div class="mt-4 mb-8">
                    <h1 class="text-2xl font-bold text-gray-600 mb-4">Más de {{ $producto->category->name }}</h1>
                    <ul class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 border-l border-t border-gray-200">
                        @foreach ($misma_categoria as $product)
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
                                                <x-jet-secondary-button onclick="return listaDisminuyeCantidad({{ $product->id }})" data-pid="{{$product->id}}">-</x-jet-secondary-button>
                                                
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
                </div>
            @endif
        </aside>
       


        @push('js')
            <script>
                function showDisminuyeCantidad(pid){
                    console.log('ok');
                    if(document.getElementById('show_cantidad_producto_' + pid).value <= 1){
                        Livewire.emitTo('productos.show','removeFromCart', pid);
                    }else{
                        let cantidad =  --document.getElementById('show_cantidad_producto_' + pid).value;
                        document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                            element.value=cantidad;
                        });
                         Livewire.emitTo('productos.show','setCantidad', pid, cantidad);
                    }
                }

                function showAumentaCantidad(pid, stock){
                    if(document.getElementById('show_cantidad_producto_' + pid).value>= stock){
                        alerta_timer({icon:'warning',title:'No hay suficiente stock para agregar más unidades!!', timer: 2000});
                    }else{
                        var cantidad =  ++document.getElementById('show_cantidad_producto_' + pid).value;
                        document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                            element.value=cantidad;
                        });
                        Livewire.emitTo('productos.show','setCantidad', pid,cantidad);
                    }
                }

                function showSetCantidad(pid, stock){
                    let cantidad =1;
                    if(document.getElementById('show_cantidad_producto_' + pid).value>= stock){
                        alerta_timer({icon:'warning',title:'No hay suficiente stock para agregar más unidades!!', timer: 2000});
                        cantidad = stock;
                    }else{
                        
                        if(document.getElementById('show_cantidad_producto_' + pid).value<=1){
                            document.getElementById('show_cantidad_producto_' + pid).value = cantidad;
                        }else{
                            cantidad =  document.getElementById('show_cantidad_producto_' + pid).value;
                        }
                        
                    }
                    document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                        element.value=cantidad;
                    });
                    Livewire.emitTo('productos.show','setCantidad', pid,cantidad);
                }

                
                function addToCart(pid){
                    Livewire.emitTo('productos.show','addToCart', pid);
                }

            </script>
        @endpush



    </div>

