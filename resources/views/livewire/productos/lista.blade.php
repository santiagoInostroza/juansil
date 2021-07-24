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
    <div x-data="main">
        <h2 class="mt-2 py-2  font-bold text-gray-600 text-xl">Lista de productos</h2>
        <ul class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 border-l border-t border-gray-200">
            @foreach ($productos as $producto)
                <li class="border-b border-r  p-4 flex flex-col justify-between">
                    <div class="w-full">
                        @if ($producto->image)
                            <img class="object-contain h-48 w-full" src="{{ Storage::url($producto->image->url) }}" alt="">
                        @endif
                        
                        <div class="text-gray-600 w-max-content m-auto max-w-full">
                           
                           <div class="max-w-full">
                               {{$producto->name}}
                            </div> 
                            <div class="font-bold">
                                {{$producto->brand->name}}
                            </div>
        
                           
                          
                        </div>
                        
                    
                    </div>
                  

                    <div class="text-gray-600 w-max-content m-auto text-center mt-4 h-full flex flex-col justify-center max-w-full">
                    
                        @if (isset($producto->salePrices))
                            @foreach ($producto->salePrices as $price)
                                @if ( count($producto->salePrices)==1)
                                    <div class="text-xl h-full flex items-center"> ${{ number_format($price->total_price, 0, ',', '.') }}</div>
                                @else
                                    @if ($price->quantity == 1)
                                    <div class="text-sm grid grid-cols-2">
                                        <div class="text-right">{{ $price->quantity }} x </div>
                                        <div class="text-left  px-1 mx-1"> ${{ number_format($price->total_price, 0, ',', '.') }}</div>
                                    </div>
                                        
                                    @else
                                        <div class="text-xs font-thin grid grid-cols-2 items-center max-w-full mt-2 text-right">
                                            <div class="w-max-content">
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
                    
                
                    @if ($producto->stock>0)
                        <div class="text-center mt-4">
                            <x-jet-secondary-button> <i class="fas fa-cart-plus mr-1"></i> Agregar</x-jet-secondary-button>
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

    <script>
        function main(){
            return{

            }
        }
    </script>


</div>
