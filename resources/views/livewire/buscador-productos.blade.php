<div class="w-full sm:relative">
    <div x-data="buscador()" x-init="document.getElementById('buscar').focus()">

        <div @click="openSearch" class="flex items-center w-full relative">
            <input  class="w-full h-8 px-3 rounded" type="text" placeholder="Que estás buscando?">
            <div class=" text-black absolute px-2 right-0" >     
                <svg class="w-6 h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
        <div class="hidden" :class="{'hidden': !searchIsOpen}">
            <div class="fixed inset-0 bg-gray-900 opacity-75"></div>
            <div class="absolute top-0 left-0 right-0 bg-white border z-10">
                <div class="flex px-3 justify-between items-center">
                    <h2 class="text-lg font-bold my-2 text-center">Que estás buscando?</h2>
                    <div class="p-3 cursor-pointer hover:bg-red-600" @click="searchIsOpen = false"><i class="fas fa-times"></i></div>
                </div>

                <div class="px-3 mb-3">
                    <input wire:ignore type="text" class="border w-full h-8 pl-2 rounded" placeholder="Ingresa nombre del producto" wire:model='search' id='buscar'
                        @keyup="escribir"
                    >
                </div>

                <div class="flex p-3 gap-2">
                    <div @click="type_selected=1" class="p-2 cursor-pointer @if($type_selected == 1) border-b-2  border-orange-400 @endif">Todo</div>
                    <div @click="type_selected=2" class="p-2 cursor-pointer @if($type_selected == 2) border-b-2  border-orange-400 @endif">Productos</div>
                    <div @click="type_selected=3" class="p-2 cursor-pointer @if($type_selected == 3) border-b-2  border-orange-400 @endif">Categorias</div>
                </div>

                <hr>
               
           
                <div class="mt-2 p-3 shadow-xl overflow-auto" style="max-height: calc(100vh - 170px)">
                  
                    @if ($type_selected != 3 && count($products)>0)
                        <h2 class="text-lg p-3">Productos</h2>
                        @foreach ($products as $product)
                        <a href="{{ route('products.show', $product) }}">
                            <div class="p-2 flex">
                                <div class="pr-2 w-12">
                                    @if ($product->image)
                                       <img src="{{Storage::url($product->image->url)}}" alt=""> 
                                    @endif
                                </div>
                                <div>
                                    {{$product->name}}
                                </div>

                            </div> 
                        </a>
                            
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
    <script>
        function buscador() {
            return {
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
                }
               
            }
        }
    </script>

</div>
