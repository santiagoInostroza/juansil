<div x-on:click.away='dropdownSearchProduct=false'  id='dropdownSearchProduct' x-data="{dropdownSearchProduct:@entangle('dropdownSearchProduct') }">
    {{-- BUSCAR PRODUCTOS --}}
    <div class="flex flex-wrap items-center justify-center gap-2">
        <i class="fas fa-search"></i>
        <div class="flex-1">
            <x-jet-input class="w-full" type="search" placeholder="Buscar producto..." wire:model.debounce.400ms="searchProduct" x-on:click='dropdownSearchProduct=true' x-on:keyup='dropdownSearchProduct=true'></x-jet-input>
        
            <div x-show='dropdownSearchProduct' x-cloak x-transition class="relative">
                @if ($allProducts != null )
                    <div class='bg-white rounded shadow max-h-96 overflow-auto py-4 absolute w-full z-10'>
                        <div wire:loading.flex target="searchProduct" >
                            <div class="absolute inset-0 bg-gray-200 z-10 opacity-50" ></div>
                            <div class="absolute inset-0 flex justify-center items-center z-10">
                                <div class="text-gray-800">
                                    <i class="fas fa-spinner animate-spin text-4xl"></i>
                                </div>
                            </div>
                        </div> 
                        <div>   
                            @if ($allProducts->count() > 0)
                                <x-table.table>
                                    <x-slot name='thead'>
                                        <x-table.tr>
                                            <x-table.th>Id</x-table.th>
                                            <x-table.th>Imagen</x-table.th>
                                            <x-table.th class="text-left">Nombre</x-table.th>
                                            <x-table.th>Stock</x-table.th>
                                            <x-table.th>Precio compra</x-table.th>
                                            <x-table.th>Ultimo prov</x-table.th>
                                            <x-table.th></x-table.th>
                                        </x-table.tr>
                                    </x-slot>
                                    <x-slot name='tbody'>
                                        <div>
                                            
                                            @foreach ($allProducts as $product)
                                                @if (isset($newPurchase[$product->name]))
                                                    <x-table.tr class="select-none bg-green-100 hover:bg-green-100">                                                                        
                                                        <x-table.td>{{$product->id}} 
                                                        
                                                        </x-table.td>
                                                        <x-table.td>
                                                            <div>
                                                                <img class="object-cover w-8 h-8" src="{{ Storage::url('products_thumb/' . $product->image->url)}}" alt="{{$product->name}}" >
                                                            </div>
                                                        
                                                        </x-table.td>
                                                        <x-table.td>{{$product->name}}</x-table.td>
                                                        <x-table.td>{{$product->stock}}</x-table.td>
                                                        <x-table.td>{{$product->stock}}</x-table.td>
                                                        <x-table.td>
                                                            <div>
                                                                {{$product->stock}}
                                                            </div>
                                                            
                                                        </x-table.td>
                                                        <x-table.td>
                                                            <div class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-green-100 bg-green-600 rounded-full">Agregado</div>

                                                        </x-table.td>
                                                    </x-table.tr>
                                                @else
                                                    <x-table.tr class="cursor-pointer select-none" wire:click="addTo({{ $product->id }})">                                                                        
                                                        <x-table.td>{{$product->id}} 
                                                        
                                                        </x-table.td>
                                                        <x-table.td>
                                                            <div>
                                                                <img class="object-cover w-8 h-8" src="{{ Storage::url('products_thumb/' . $product->image->url)}}" alt="{{$product->name}}" >
                                                            </div>
                                                        
                                                        </x-table.td>
                                                        <x-table.td>{{$product->name}}</x-table.td>
                                                        <x-table.td>{{$product->stock}}</x-table.td>
                                                        <x-table.td>{{$product->stock}}</x-table.td>
                                                        <x-table.td>{{$product->stock}}</x-table.td>
                                                        <x-table.td></x-table.td>
                                                        
                                                    </x-table.tr>
                                                @endif
                                                
                                            
                                            @endforeach
                                    
                                        </div>
                                        
                                    </x-slot>
                                </x-table.table>  
                            @else
                                <div class="text-center">
                                    <p class="text-gray-600">No se encontraron resultados</p>
                                </div>
                            @endif
                            
                        </div>
                    </div>
                @endif
                
            </div>   
        </div>
        <x-jet-button>Crear producto</x-jet-button>
    </div>
    {{-- FAVORITOS --}}
    <div class="my-4">
        <ul class="flex gap-2 flex-wrap text-xs">
            @foreach ($favorites as $favorite)
                <li class="bg-indigo-200 rounded-xl px-2 cursor-pointer hover:bg-indigo-300 hover:font-bold {{ ($searchProduct == $favorite) ? 'bg-indigo-400 text-white':''}}" wire:click="setFavorite('{{ $favorite }}')">{{$favorite}}</li>
            @endforeach
        </ul>
    </div>
</div>
