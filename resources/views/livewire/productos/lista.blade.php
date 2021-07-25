<div class="container max-w-7xl py-8" >

    {{-- @if (count($productos)>0)
        @isset($name)
            <h2 class="font-bold text-gray-600 pt-8 pb-4 text-xl">Busquedas relacionadas con "{{$name}}"</h2>
        @endisset

        <div class="grid grid-cols-2  md:grid-cols-3 lg:grid-cols-4 lg:max-w-5xl xl:max-w-7xl mx-auto" style="height: max-content">
            @foreach ($productos as $producto)
                <livewire:producto :producto='$producto' :key="$producto->id" />
            @endforeach
        </div>

        <div class="mt-4">
            {{ $productos->links() }}
        </div>

    @else
        @isset($name)
        <h2 class="font-bold text-gray-600 pt-8 pb-4 text-xl">No se encontraron productos relacionados con la busqueda '{{$name}}'</h2>
        <p class="font-bold text-gray-600 pt-8 pb-4" >Si quieres revisa nuestros otros productos</p>
        @endisset
    @endif

    <hr>
    <h2 class="font-bold text-gray-600 pt-8 pb-4 text-xl">Destacados</h2>
    <div class="grid grid-cols-2  md:grid-cols-3 lg:grid-cols-4  lg:max-w-5xl xl:max-w-7xl mx-auto" style="height: max-content">
        @foreach ($destacados as $key => $producto)
            <livewire:producto :producto='$producto' :key="$producto->id" />
        @endforeach
       
    </div>
    <div class="flex justify-end">
        <div class="cursor-pointer btn ">
            Ver más destacados...
        </div>
    </div>
    <hr> --}}
    
    {{-- PRODUCTOS MAS VENDIDOS --}}
    <div x-data="productosMain()" x-init="">
        @if ($search != "")
            <h2 class="mt-2 py-2  font-bold text-gray-600 text-xl">Busqueda : {{$search}}</h2>
        @else
            <h2 class="mt-2 py-2  font-bold text-gray-600 text-xl">Lista de productos</h2>
        @endif
        <ul class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 border-l border-t border-gray-200">
            @foreach ($productos as $product)
                <li class="border-b border-r  p-4 flex flex-col justify-between" wire:key="{{ $product->id }}">
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
                                <i class="fas fa-shopping-cart mx-2 text-green-500"></i>
                                <label for="cantidad_product_{{$product->id}}">
                                    <input type="number" min="1" class="p-1 w-9 text-center text-gray-500 cantidad_producto_{{$product->id}}" value="{{ (isset(session('carrito')[$product->id])) ? session('carrito')[$product->id]['cantidad']:'1' }}"
                                        wire:ignore 
                                        onchange="return listaSetCantidad({{ $product->id }}, {{ $product->stock }})"  
                                        id='cantidad_product_{{ $product->id }}'  
                                        data-pid="{{ $product->id }}"
                                    > 
                                    
                                </label>
                                <div class="w-max-content">

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
        @if ($search != "")
            @if (count($tags)>0)
                <h2 class="mt-2 py-2  font-bold text-gray-600 text-xl">Etiquetas : {{$search}}</h2>
                @foreach ($tags as $tag)
                    <a href="" class="p-4 ">
                        {{$tag->name}}
                    </a>
                @endforeach
               
            @endif
            @if (count($brands)>0)
                <h2 class="mt-2 py-2  font-bold text-gray-600 text-xl">Marcas : {{$search}}</h2>
                @foreach ($brands as $brand)
                    <a href="" class="p-4 ">
                        {{$brand->name}}
                    </a>
                @endforeach
               
            @endif
        @endif
    </div>

    @push('js')
    <script>
        function productosMain(){
            return{
                listaAumentaCantidad: function(pid){
                    var cantidad =  ++document.getElementById('cantidad_product_' + pid).value;
                    document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                        element.value=cantidad;
                    });
                    this.$wire.setCantidad( pid,cantidad)
                },
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
                Livewire.emitTo('productos.lista','setCantidad', pid,cantidad);
            }           
        }


        function listaDisminuyeCantidad(pid){
            if(document.getElementById('cantidad_product_' + pid).value <= 1){
                removeFromCart(pid);
            }else{
                let cantidad =  --document.getElementById('cantidad_product_' + pid).value;
                document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                    element.value=cantidad;
                });
                Livewire.emitTo('productos.lista','setCantidad', pid,cantidad);
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
                Livewire.emitTo('productos.lista','setCantidad', pid,cantidad);            
        }


        function addToCart(pid){
           
            Livewire.emitTo('productos.lista','addToCart', pid);
        }

        function removeFromCart(pid){
            Livewire.emitTo('productos.lista','removeFromCart', pid);
        }
    </script>
@endpush


</div>
