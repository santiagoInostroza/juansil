<div class="w-full lg:relative">
    <div x-data="buscador()" x-init="document.getElementById('buscar').focus()">

        

        <div @click="openSearch" class="flex items-center w-full relative">
            <input  class="w-full h-8 px-3 rounded" type="text" placeholder="¿Qué estás buscando?">
            <div class=" text-black absolute px-2 right-0" >     
                <svg class="w-6 h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
        <div class="hidden" :class="{'hidden': !searchIsOpen}">
            <div class="fixed inset-0 bg-gray-900 opacity-75"></div>
            <div class="absolute top-0 left-0 right-0 bg-white border z-10 lg:-mt-4">
                <div class="flex px-3 justify-between items-center">
                    <h2 class="text-lg font-bold my-2 text-center">¿Qué estás buscando?</h2>
                    <div class="p-3 cursor-pointer hover:bg-red-600" @click="searchIsOpen = false"><i class="fas fa-times"></i></div>
                </div>

                <div class="px-3 mb-1">
                    <input wire:ignore type="text" class="border w-full h-8 pl-2 rounded" placeholder="Ingresa nombre del producto" wire:model='search' id='buscar'
                        @keyup="escribir"
                    >
                </div>
               
                    <div class="flex p-3 pt-1 gap-2">
                        <div @click="type_selected=1" class="p-2 cursor-pointer @if($type_selected == 1) border-b-2  border-orange-400 @endif">Todo</div>
                        <div @click="type_selected=2" class="p-2 cursor-pointer @if($type_selected == 2) border-b-2  border-orange-400 @endif">Productos</div>
                        <div @click="type_selected=3" class="p-2 cursor-pointer @if($type_selected == 3) border-b-2  border-orange-400 @endif">Categorias</div>
                    </div>
                

                <hr>
               
           
                <div class="mt-2 p-3 shadow-xl overflow-auto" style="max-height: calc(100vh - 170px)">
                  
                    @if ($type_selected != 3 && count($products)>0)
                        <h2 class="text-lg p-3">Productos</h2>
                        @foreach ($products as $product)
                        
                            <div class="flex justify-between items-center my-3">
                                <a href="{{ route('products.show', $product) }}">
                                    <div class="p-2 flex">
                                        <div class="pr-2 w-16">
                                            @if ($product->image)
                                            <img class="object-cover w-full" src="{{Storage::url($product->image->url)}}" alt=""> 
                                            @endif
                                        </div>
                                        <div class="text-xs md:text-sm">
                                            <div class="font-bold text-gray-800">

                                                {{$product->name}}
                                            </div>
                                            <div class="text-xs">
                                                @foreach ($product->salePrices as $price)
                                                    <div class="grid grid-cols-3 gap-2">
                                                        <div class="">
                                                            x {{$price->quantity}} un.
                                                        </div>
                                                       
                                                        <div class="">
                                                             ${{number_format($price->total_price,0,',','.')}}  
                                                        </div>
                                                       
                                                        @if($price->quantity>1) 
                                                            <div class="font-bold text-red-700">
                                                                (${{number_format($price->price,0,',','.')}}) 
                                                            </div>
                                                        @endif
                                                       
                                                    </div>
                                                @endforeach
                                              
                                            </div>
                                        </div>
                                    </div> 
                                </a>
                                <div>
                                    <div class=" flex flex-col text-xs">
                                        @if (isset(session('carrito')[$product->id]))
                                            <div class="flex mb-1">
                                                <div @click="disminuyeCantidad" class="p-1 px-2 border cursor-pointer rounded" data-pid="{{$product->id}}">-</div>
                                                <input type="number" class="p-1 w-7" id='cantidad_producto_{{$product->id}}' value="{{ session('carrito')[$product->id]['cantidad'] }}"> 
                                                <div @click="aumentaCantidad" class="p-1 px-2 border cursor-pointer rounded" data-pid="{{$product->id}}">+</div>
                                            </div>
                                            <button class="shadow cursor-pointer bg-blue-600 text-white p-1 rounded">
                                                Agregado
                                            </button>

                                        @else
                                            <button class="shadow cursor-pointer bg-green-600 text-white p-1 rounded">
                                                <i class="fas fa-cart-plus"></i> Agregar
                                            </button>
                                        @endif
                                       
                                       
                                      
                                       
                                    </div>
                                </div>
                            </div>
                            <hr>
                        
                            
                        @endforeach
                                     
                    @endif
                    
                    @if ($type_selected != 2 && count($tags)>0)
                        <h2 class="text-lg p-3">Categorias</h2>
                        @foreach ($tags as $tag)
                            <a href="{{ route('products.tag', $tag) }}">
                                <div class="p-2  pl-5 flex">
                                    {{$tag->name}}
                                </div>
                            </a>
                        @endforeach
                    @endif

                    @if (count($products)==0 && count($tags)==0)
                        <h2 class="font-bold">No se encontraron resultados...</h2>
                    @endif
                   
                </div>
            </div>
        </div>
        
    </div>
    @push('js')
        <script>
            function buscador() {
                return {
                    cantidad : @entangle('cantidad'),
                    search: @entangle('search'),
                    searchIsOpen: @entangle('searchIsOpen'),
                    type_selected: @entangle('type_selected'),

                
                    search: null,

                    escribir: function(e){
                    //    console.log(e.target.value);
                        console.log(this.search);
                    //    this.search= e.target.value;
                    },
                    openSearch: function(){
                        this.searchIsOpen=true;
                        this.search = document.getElementById('buscar');
                        setTimeout(() => {
                            this.search.focus();
                        }, 300);
                    },
                    aumentaCantidad: function(e){
                        let pid = e.target.dataset.pid;
                        let cantidad =  ++document.getElementById('cantidad_producto_' + pid).value;
                        
                       
                        this.$wire.aumentar( pid,cantidad );
                    },
                    disminuyeCantidad: function(){
                        this.cantidad--;
                    },
                
                }
            }
        </script>
     @endpush

</div>
