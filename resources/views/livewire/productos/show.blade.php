    <div class="container py-11 lg:max-w-7xl ">
        <div class="mx-6 mb-6" >
            <div class="grid grid-cols md:grid-cols-2 gap-4 mb-6">
                <figure>
                    @isset($producto->image->url)
                            <img class="object-contain h-52 sm:h-96 w-full object-center"
                        src="{{ Storage::url($producto->image->url) }}" alt="">
                    @endisset
                </figure>

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
            <div class="fixed left-0 bottom-0 py-6 bg-white text-center w-full border-t mr-6 z-10 ">
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

       

        <aside class="md:col-span-2 lg:col-span-3 xl:col-span-1 m-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-600 mb-4">Más de {{ $producto->category->name }}</h1>
                <ul class="flex flex-wrap justify-around ">
                    @foreach ($misma_categoria as $producto)

                        <li class="mb-8 shadow-2xl" >
                            {{-- <livewire:producto :producto='$producto'> --}}
                        </li>
                    @endforeach


                </ul>

            </div>
            <hr>
            <div class="mt-4">
                <h1 class="text-2xl font-bold text-gray-600 mb-4">Más de {{ $producto->brand->name }}</h1>
                <ul class="flex flex-wrap justify-around">
                    @foreach ($misma_marca as $producto)
                        <li class="mb-8 shadow-2xl">
                            {{-- <livewire:producto :producto='$producto'> --}}
                        </li>
                    @endforeach


                </ul>
            </div>

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

