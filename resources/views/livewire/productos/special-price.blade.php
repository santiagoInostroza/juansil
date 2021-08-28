<div>
    <div x-data="specialMain()">
        @php
            // echo "<pre>";
            //     echo var_dump(session()->all());
            //     echo "<pre>";
        @endphp
        <div>
            <div class="flex justify-between items-center">
                <h1 class=" text-2xl text-center py-4 uppercase text-gray-500 font-bold tracking-widest">
                    Precios Especiales
                </h1>
                <div class="p-4 rounded-full text-xl relative cursor-pointer" x-on:click="openCart">
                    <i class="fas fa-shopping-cart text-gray-600"></i>
                    @if (session('totalProductosSpecial'))
                        <div class="rounded-full bg-red-600 p-1 px-2 text-white text-xs font-bold absolute right-10 top-4">{{ session('totalProductosSpecial') }}</div>
                    @endif
                    @if (session('totalCarritoSpecial'))
                        <div class="rounded-full bg-gray-700 p-1 px-2 text-white text-xs font-bold absolute right-0 mr-3"> {{ number_format(session('totalCarritoSpecial'),0,',','.') }}</div>
                    @endif
                </div>
            </div>
            <div class="p-4  rounded my-2">
                <label for="">
                    <x-jet-input class="w-full" placeholder="Buscar..." wire:model="search"></x-jet-input>
                </label>
                <label for="onlyStock">
                    Mostrar solo productos con stock
                    <label class="switch">
                        <input id="onlyStock" type="checkbox" wire:model="onlyStock">
                        <span class="slider round"></span>
                    </label>
                </label>
            </div>
            <div>
                <ul class="grid grid-cols-1  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 border-l border-t border-gray-200">
                    @foreach ($products as $product)
                        <li class="border-b border-r  p-4 flex flex-col justify-between" wire:key="{{ $product->id }}">
                        
                                <div class="w-full">
                                    @if ($product->image)
                                        @if ( Storage::exists('products_thumb/' .$product->image->url))
                                            <img class=" object-contain h-48 w-full transform hover:scale-110 transition-all duration-500 ease-in-out delay-75" src="{{ Storage::url('products_thumb/'.$product->image->url) }}" alt="">
                                        @else
                                            <img class="object-contain h-48 w-full" src="{{ Storage::url($product->image->url) }}" alt="">
                                            {{-- <img class=" rounded h-24 w-24 object-cover transform hover:scale-150 transition-all duration-500 ease-in-out delay-75" src="{{ Storage::url($product->image->url) }}" alt=""> --}}
                                        @endif

                                       
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
                        
                            <div class="text-gray-600 w-max-content m-auto text-center mt-4 h-full flex flex-col justify-center max-w-full">
                            
                                @if (isset($product->special_sale_price))
                                    <div class="text-2xl font-bold">
                                        ${{number_format($product->special_sale_price,0,',','.')}} 
                                        <span class="text-base">
                                            c/u
                                        </span> 
                                    </div>
                                @endif
                                @if (isset($product->formato))
                                    <div>
                                    caja de {{$product->formato}} ${{number_format($product->special_sale_price * $product->formato,0,',','.')}}
                                    </div>
                                @endif
                        
                            </div>
                            
                        
                            @if ($product->stock>0)
                                <div class="text-center mt-4 relative" >
                                    @if (!session()->has('carritoSpecial.'.$product->id))
                                        {{-- <div wire:loading wire:target="{{$product->id}}" class="font-bold text-yellow-300 p-2 font-xl">Agregando al carrito ...</div> --}}
                                        <x-jet-secondary-button wire:click="addToCart({{ $product->id }})"> 
                                            <i class="fas fa-cart-plus mr-1 mb-1" ></i> 
                                            Agregar
                                        </x-jet-secondary-button>
                                    @else
                                        <div class="w-max-content m-auto">
                                            <i class="fas fa-shopping-cart text-green-500"></i>
                                            <label for="cantidad_product_{{$product->id}}">
                                                <input type="number" min="1" class="p-1 w-9 text-center text-gray-500 cantidad_producto_{{$product->id}}" value="{{ (isset(session('carritoSpecial')[$product->id])) ? session('carritoSpecial')[$product->id]['cantidad']:'1' }}"
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
                                <div class="text-center mt-4 flex items-center justify-center">
                                    <div class="relative w-max-content">
                                        <div class="cursor-default inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-red-500  uppercase tracking-widest shadow-sm  focus:outline-none    transition ease-in-out duration-150" disabled> AGOTADO</div>
                                        {{-- <div class="absolute font-bold text-red-500 uppercase top-0 mt-2 ml-1 transform "> AGOTADO</div> --}}
                                    </div>
                                </div>
                            @endif                    
                        </li>            
                    @endforeach
                </ul>
            </div>
        </div>

         {{-- CARRITO --}}
        <div x-show="showCart" class="hidden" :class="{'hidden':!showCart}">
            <div class="fixed inset-0 bg-gray-900 opacity-25"></div>
            <div class="fixed top-0 right-0 h-full w-screen sm:w-max-content bg-white py-4 shadow" >
                    <div class="flex justify-between items-center gap-4 border-b p-4">
                        <h2 class="text-xl font-bold text-gray-600">Detalle de compra</h2>
                        <div x-on:click="closeCart" class="cursor-pointer">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="h-full px-4">
                        @if (session('carritoSpecial'))
                            <div class="grid grid-cols-7 items-center justify-between gap-1 mt-4">
                                @foreach (session('carritoSpecial') as $item)
                                    <figure>
                                       
                                        @if ( Storage::exists('products_thumb/' .$product->image->url))
                                            <img class=" rounded h-24 w-24 object-cover transform hover:scale-150 transition-all duration-500 ease-in-out delay-75" src="{{ Storage::url('products_thumb/'.$product->image->url) }}" alt="">
                                        @else
                                            <img class="w-16 h-16 object-cover" src="{{Storage::url($item['url'])}}" alt="">
                                            {{-- <img class=" rounded h-24 w-24 object-cover transform hover:scale-150 transition-all duration-500 ease-in-out delay-75" src="{{ Storage::url($product->image->url) }}" alt=""> --}}
                                        @endif
                                    </figure>
                                    <div class="col-span-2">
                                        <div>
                                            {{$item['name']}} 
                                          
                                        </div>   
                                        <div>
                                            ${{ number_format($item['precio'],0,',','.')}}
                                        </div>
                                        <div>
                                            {{-- @php
                                                echo "<pre>";
                                                    echo var_dump($item);
                                                echo "<pre>";
                                            @endphp --}}
                                        </div>
                                    </div>
                                    <div>  
                                        <input type="number" min="1" class="p-1 w-9 text-center text-gray-500 cantidad_producto_{{ $item['producto_id'] }}" value="{{ $item['cantidad'] }}"
                                            wire:ignore 
                                            onchange="return listaSetCantidad({{ $item['producto_id'] }}, {{$item['stock'] }})"  
                                            id='cantidad_product_{{ $item['producto_id'] }}'  
                                            data-pid="{{ $item['producto_id'] }}"
                                        > 
                                        un.
                                    </div>
                                    <div>
                                        ${{ number_format($item['total'],0,',','.')}}
                                    </div>
                                    <div class="p-2 flex flex-col justify-between items-center">
                                            <x-jet-secondary-button onclick="return listaAumentaCantidad({{  $item['producto_id'] }}, {{ $item['stock'] }})">+</x-jet-secondary-button>                          
                                            <x-jet-secondary-button onclick="return listaDisminuyeCantidad({{ $item['producto_id'] }})">-</x-jet-secondary-button>
                                    </div>
                                    <div  wire:click="removeFromCart({{ $item['producto_id'] }})">
                                        <x-jet-danger-button><i class="far fa-trash-alt"></i></x-jet-danger-button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="flex justify-center items-center h-full">
                                <h3 class="font-bold text-xl text-gray-500 mx-4">No hay productos agregados</h3>
                            </div>

                        @endif
                        
                    </div>
                    <div class="absolute bottom-0 h-20 border-t w-full flex justify-between items-center gap-4 px-4 bg-white">
                        <div class="text-2xl">
                            Total  {{ number_format(session('totalCarritoSpecial'),0,',','.') }}
                        </div>
                      
                        <div>
                        <x-jet-button wire:click="save"> Generar pedido</x-jet-button>
                        </div>
                    </div>
               


            </div>
        </div>

        



        
    </div>
    @push('js')
        <script>
            function specialMain(){
                return {
                    showCart: @entangle('showCart'),
                    openCart(){
                        this.showCart = true;
                    },
                    closeCart(){
                        this.showCart = false;
                    },
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
                Livewire.emitTo('productos.special-price','setCantidad', pid,cantidad);            
            }

            
            
            function listaDisminuyeCantidad(pid){
                if(document.getElementById('cantidad_product_' + pid).value <= 1){
                    removeFromCart(pid);
                }else{
                    let cantidad =  --document.getElementById('cantidad_product_' + pid).value;
                    document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                        element.value=cantidad;
                    });
                    Livewire.emitTo('productos.special-price','setCantidad', pid,cantidad);
                }
            }

            
            function listaAumentaCantidad(pid, stock){
                if(document.getElementById('cantidad_product_' + pid).value >= stock){
                    alerta_timer({icon:'warning',title:'No hay suficiente stock para agregar más unidades!!', timer: 2000});
                }else{
                    var cantidad =  ++document.getElementById('cantidad_product_' + pid).value;
                    document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                        element.value=cantidad;
                    });
                    Livewire.emitTo('productos.special-price','setCantidad', pid,cantidad);
                }           
            }

            function removeFromCart(pid){
                Livewire.emitTo('productos.special-price','removeFromCart', pid);
            }


        </script>        
    @endpush

</div>
