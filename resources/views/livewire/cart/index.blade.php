
<div>
    <style>
        .cuerpoCarrito::-webkit-scrollbar {
            display: none;
        }
        .cuerpoCarrito {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>

    <section x-data="carritoMain()" class="relative">
        <div class="relative">
            <button @click="animate = (animate) ? false : true" class="z-50 bg-white p-1 rounded-full text-gray-400 hover:text-gray-800 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                @if (session()->has('carrito') && count(session('carrito')) > 0)
                    <div class="rounded-full bg-red-600 p-1 px-2 text-xs text-white font-bold absolute right-6">
                        {{ (session('totalProductos')) }}
                    </div>
                    <div class="rounded-full p-1 px-2 text-xs text-white font-bold right-0 top-7 absolute bg-black">
                        ${{ number_format(session('totalCarrito'),0,',','.') }}
                    </div>
                @endif
                <span class="sr-only">Ir a carrito de compras</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </button>
        </div>
        <div  x-show="animate"  class="bg-gray-800 opacity-25 fixed inset-0 hidden" :class="{hidden: !animate}"></div>
        <div class="card fixed z-20 top-0 max-w-full w-max-content right-0 h-screen shadow hidden bg-white" :class="{hidden: !animate}"  {{--@click.away="animate = false"--}} 
            x-show="animate" 
            x-transition:enter="transition ease-out duration-1000" 
            x-transition:enter-start="opacity-0 transform scale-90"  
            x-transition:enter-end="opacity-100 transform scale-100"  
            x-transition:leave="transition ease-in duration-1000"  
            x-transition:leave-start="opacity-100 transform scale-100"  
            x-transition:leave-end="opacity-0 transform scale-90"
        >
            {{-- HEADER --}}
            <div class="card-header px-6 py-4 flex justify-between items-center h-2/12">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    {{session('totalProductos')}}
                </div>
                <h1 class="text-gray-700 text-2xl font-bold w-max-content ml-3">Carrito de compra</h1>
               
                <div @click="animate = false" class="cursor-pointer hover:bg-purple-100 rounded-full p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
            </div>

            @if (session()->has('carrito') && count(session('carrito')) > 0)
                {{-- CUERPO --}}
                <div class="card-body overflow-auto h-8/12 cuerpoCarrito">
                        @foreach (session('carrito') as $producto)
                         {{-- @php
                             echo "<pre>";
                            var_dump($producto);
                             echo "</pre>";
                         @endphp --}}

                         @if (Aut::user() && Auth::user()->id == 1)
                             Solo lo puede ver el santy
                         @endif



                            @if (true)
                                
                        
                                {{-- {{var_dump($producto)}} --}}
                                <div class="pb-4  text-cool-gray-600 border-b-2 border-gray-200">
                                    <div class=" h-24 flex items-center justify-between relative ">
                                    
                                        <div class="w-16">                                          
                                            <figure>
                                                @if (Storage::exists('products_thumb/' . $producto['url']))
                                                    <img class="max-h-24 object-contain" src=" {{ Storage::url('products_thumb/' . $producto['url']) }}" alt="">
                                                @else
                                                    <img class="max-h-24 object-contain" src=" {{ Storage::url('products/' . $producto['url']) }}" alt="">
                                                @endif
                                            </figure>
                                        </div>
                                
                                        {{-- NOMBRE --}}
                                        <div class="text-sm sm:text-2xl pl-1 sm:px-2 ml-2 sm:mx-4 w-2/3 sm:w-1/2">
                                            <div class="font-bold">
                                                {{ $producto['name'] }}
                                            </div>
                                            <div class="text-xs">
                                                ${{ number_format($producto['precio'], 0, ',', '.') }}
                                            </div>
                                        </div>
                                
                                        {{-- CANTIDAD --}}
                                        <div class=" text-right w-20">
                                            <label class="text-xs font-bold flex items-baseline justify-end">
                                                <input wire:ignore id="carrito_cantidad_producto_{{ $producto['producto_id'] }}" class="w-10 inline-block text-right p-1 cantidad_producto_{{ $producto['producto_id'] }}" onchange="carritoSetCantidad({{ $producto['producto_id'] }}, {{ $producto['stock'] }});" value="{{$producto['cantidad']}}" type="number" > un.
                                            </label>
                                            <div>
                                                ${{ number_format($producto['total'], 0, ',', '.') }}
                                            </div>
                                        </div>
                                
                                        {{-- BOTONES --}}
                                        <div x-data class="flex items-center justify-center ml-4 ">
                                            <button class="cursor-pointer hover:bg-purple-100 rounded-full" onclick="return carritoDisminuyeCantidad({{ $producto['producto_id'] }})">
                                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </button>

                                            <button class="cursor-pointer hover:bg-purple-100 rounded-full" onclick="return carritoAumentaCantidad({{ $producto['producto_id'] }}, {{ $producto['stock'] }})">
                                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </button>
                                        </div>
                                        <div class="cursor-pointer hover:bg-purple-100 rounded-full p-1 sm:p-3 ml-1 sm:ml-5" onclick="return removeFromCart({{ $producto['producto_id'] }});">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </div>
                                    </div>
                                
                                
                                    @if ($producto['faltan']>0 && $producto['nivel']==1)
                                        <div class="text-xs text-gray-500 bg-yellow-100 p-1 w-max-content rounded-lg sm:ml-20">
                                            Agrega 
                                            <span class="font-bold">{{$producto['faltan']}}</span> 
                                            productos más, para obtener un precio más bajo
                                        </div>
                                    @endif
                                    @if ($producto['nivel']>1 && $producto['nivel'] < $producto['cantidadNiveles'] )
                                        
                                        
                                    <div class="sm:flex justify-start items-center">
                                        <div class=" flex text-xs bg-green-100 p-1 w-max-content rounded-lg sm:ml-20 ">

                                            Precio de oferta aplicado
                                            @for($i = 0; $i < $producto['nivel']-1; $i++)
                                                <svg class="w-6 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            @endfor
                                        </div>
                                        <div class="text-xs text-gray-500 bg-yellow-100 p-1 w-max-content rounded-lg sm:ml-2 ">
                                            Agrega 
                                            <span class="font-bold">{{$producto['faltan']}}</span> 
                                            productos más, si quieres obtener un precio aún más bajo
                                        </div>
                                    </div>
                                    @elseif($producto['nivel']>2 &&  $producto['nivel'] == $producto['cantidadNiveles'] )
                                    <div class=" flex text-xs bg-green-100 p-1 w-max-content rounded-lg sm:ml-20">
                                        Mejor precio de oferta aplicado
                                        @for($i = 0; $i < $producto['nivel']-1; $i++)
                                            <svg class="w-6 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        @endfor
                                    </div>
                                    @elseif ($producto['nivel']>1)
                                        <div class=" flex text-xs bg-green-100 p-1 w-max-content rounded-lg sm:ml-20">
                                            Precio de oferta aplicado
                                            @for($i = 0; $i < $producto['nivel']-1; $i++)
                                                <svg class="w-6 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            @endfor
                                        
                                        </div>
                                    @endif
                                
                                
                                </div>
                            @endif
                        @endforeach
                </div>
    
                {{-- FOOTER --}}
                <div class="absolute w-full bottom-0 text-2xl card-footer flex justify-between items-center p-2 mt-10 h-2/12 text-gray-700 font-extrabold">
                    <div>
                        Total
                    </div>
                    <div>
                        ${{ number_format(session('totalCarrito'), 0, ',', '.') }}
                    </div>
                    <div class="m-2">
                        <a href="{{route('pedido')}}">
                            <x-jet-button>
                                <div class="btn btn-primary block cursor-pointer text-center"> Continuar </div>
                            </x-jet-button>
                        </a>
                    </div>
                </div>
            @else
                <div class="card-body p-16">
                    <h2 class="text-gray-700 text-lg font-bold w-max-content m-14">No hay productos en el carro</h2>
                </div>
            @endif
        </div>
    </section>

    @push('js')
        <script>
            function carritoMain(){
                return{
                    animate: @entangle('openCarrito')
                }
            }


            function carritoAumentaCantidad(pid, stock){
                if(document.getElementById('carrito_cantidad_producto_' + pid).value>= stock){
                    alerta_timer({icon:'warning',title:'No hay suficiente stock para agregar más unidades!!', timer: 2000});
                }else{
                    var cantidad =  ++document.getElementById('carrito_cantidad_producto_' + pid).value;
                    document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                        element.value=cantidad;
                    });
                    Livewire.emitTo('cart.index','setCantidad', pid,cantidad);
                }
            }


            function carritoDisminuyeCantidad(pid){
                if(document.getElementById('carrito_cantidad_producto_' + pid).value <= 1){
                    
                }else{
                    let cantidad =  --document.getElementById('carrito_cantidad_producto_' + pid).value;
                    document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                        element.value=cantidad;
                    });
                    Livewire.emitTo('cart.index','setCantidad', pid,cantidad);
                }
            }

            function removeFromCart(pid){
                Livewire.emitTo('cart.index','removeFromCart', pid);
            }

            function carritoSetCantidad(pid, stock){
                let cantidad =1;
                if(document.getElementById('carrito_cantidad_producto_' + pid).value>= stock){
                    alerta_timer({icon:'warning',title:'No hay suficiente stock para agregar más unidades!!', timer: 2000});
                    cantidad = stock;
                }else{
                    
                    if(document.getElementById('carrito_cantidad_producto_' + pid).value<=1){
                        document.getElementById('carrito_cantidad_producto_' + pid).value = cantidad;
                    }else{
                        cantidad =  document.getElementById('carrito_cantidad_producto_' + pid).value;
                    }
                    
                }
                document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                    element.value=cantidad;
                });
                Livewire.emitTo('cart.index','setCantidad', pid,cantidad);

            }


        </script>
    @endpush
</div>
