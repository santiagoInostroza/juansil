<div>
 
    @if ($collection->count())
        
   
        <div>
            {{-- TITULO --}}
            <h1 class="p-4 text-center uppercase text-3xl text-gray-600 font-bold my-4">Mis compras</h1>
            {{-- SEARCH --}}
            {{-- <div class="flex items-center justify-between gap-4">
                <div class="relative flex-1">
                    <x-jet-input wire:model.debounce.500ms="search" type="search" class="w-full" placeholder="Buscar..."></x-jet-input>
                    <div  wire:loading.flex wire:target="search" >
                        <x-spinner.spinner2 size="6"></x-spinner.spinner2>
                    </div>
                </div>
                <x-jet-button wire:click="$set('openAddNew',true)"  class="flex items-center gap-2"><div><i class="fas fa-plus"></i> </div><div>Agregar nuevo</div></x-jet-button>
            </div> --}}
            {{-- FILTROS --}}
            <div class="p-4 border rounded my-4 flex items-center gap-4">
                {{-- <div class="flex items-center gap-2">
                    <x-jet-label>Orden</x-jet-label>
                    <select class="border p-2 rounded" name="orderBy" id="" wire:model="orderBy">
                        <option value="id">Fecha</option>
                        <option value="name">Nombre</option>
                    </select>
                </div> --}}
                <div class="flex items-center gap-2">
                    <x-jet-label>Ordenar</x-jet-label>
                    <select class="border p-2 rounded" name="direction" id="" wire:model="direction">
                        <option value="asc">Más antigua</option>
                        <option value="desc">Más reciente</option>
                    </select>
                </div>
            </div>

            {{-- TABLA --}}
            <div>
                <x-table>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="hidden sm:block  px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Id </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Total </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Fecha </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Estado Pago </th>
                            <th scope="col" class="relative px-6 py-3" width="10"> <span class=""></span> </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($collection as $sale)
                                    <tr class="text-gray-900
                                        @if ($sale->payment_status == 3)
                                            bg-green-200
                                        @elseif ($sale->payment_status == 2)
                                            bg-green-100
                                        @elseif ($sale->payment_status == 1)
                                            bg-yellow-100
                                        @endif
                                    ">
                                        <td class="hidden sm:flex px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center ">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $sale->id }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm  text-gray-600">
                                                    ${{ number_format($sale->total,0,',','.')}}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm  text-gray-600">
                                                    {{ Helper::fecha($sale->date)->dayName }}
                                                    {{-- {{ Helper::fecha($sale->date)->diffForHumans() }} --}}
                                                    {{ Helper::fecha($sale->date)->format('d') }}
                                                    {{ Helper::fecha($sale->date)->monthName }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm  text-gray-600">
                                                    @if ($sale->payment_status == 3)
                                                        Pagado
                                                    @elseif ($sale->payment_status == 2)
                                                        Abonado
                                                    @elseif ($sale->payment_status == 1)
                                                    Pendiente
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center gap-2">
                                                <div  wire:click="isShowInfo({{$sale->id}})" wire:key="row_info_{{$sale->id}}"  class="p-2 px-3 flex " title="Ver más info">
                                                
                                                    @if ($showInfo == $sale->id) 
                                                        <a href="#" class=" hover:text-gray-500 flex w-max-content justify-between items-center gap-1"><span class="hidden sm:block ">Ocultar detalle</span> <i class="fas fa-arrow-up"></i></a>  
                                                    @else
                                                        <a href="#" class=" hover:text-gray-500 flex w-max-content justify-between items-center gap-1"><span class="hidden sm:block ">Ver detalle</span><i class="fas fa-arrow-down"></i></a>
                                                    @endif
                                                </div>
                                                {{-- <div title="Eliminar" wire:click="deleteItem({{$item->id}})" class="p-2 flex cursor-pointer rounded-full hover:bg-red-500 hover:text-white transform hover:scale-125"><i class="fas fa-trash-alt "></i></div> --}}
                                            </div>
                                        
                                        </td>
                                    </tr>
                                    @if ($showInfo == $sale->id)
                                        <tr class="bg-gray-50">
                                            <td colspan="5">
                                                <x-modal.modal_screen>
                                                    <div class="flex justify-between items-center gap-4 my-4">
                                                        <h2> 
                                                            {{ Helper::fecha($sale->date)->dayName }}
                                                            {{ Helper::fecha($sale->date)->format('d') }}
                                                            {{ Helper::fecha($sale->date)->monthName }}
                                                        </h2>
                                                        <div wire:click="isShowInfo({{$sale->id}})" class="p-1 px-3 border rounded-full cursor-pointer">
                                                            <i class="fas fa-times"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-sm sm:text-base border p-4" >
                                                        @foreach ($sale->saleItems as $item)
                                                            <div class="grid grid-cols-6 gap-1 mt-4 items-center justify-between">               
                                                                <figure>
                                                                    <img class=" rounded h-24 w-24 object-contain transform hover:scale-150 transition-all duration-500 ease-in-out delay-75" src="{{ Storage::url('products_thumb/' . $item->product->image->url) }}" alt="{{ $item->product->image->url }}">
                                                                </figure>
                                                                <div class="col-span-4">
                                                                    <div class="text-sm sm:text-base">
                                                                        @if ($item->cantidad_por_caja == 1)
                                                                        {{ $item->cantidad  }} 
                                                                        {{ $item->product->name }} 
                                                                        @else
                                                                            {{ $item->cantidad  }} x {{ $item->cantidad_por_caja }}
                                                                            {{ $item->product->name }} 
                                                                        @endif                                                                
                                                                    </div>   
                                                                    <div>
                                                                        ${{ number_format($item->precio,0,',','.')}}
                                                                    </div>
                                                                    <div>
                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                                <div>
                                                                    ${{ number_format($item->precio_total,0,',','.')}}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="border-t w-full flex justify-between items-center gap-4 my-4 bg-white">
                                                        <div class="my-4">
                                                            @if ($sale->subtotal != $sale->total && $sale->subtotal > 0 )
                                                            <div class="grid grid-cols-2 gap-2">
                                                                    <div> Sub Total </div>
                                                                    <div> ${{ number_format($sale->subtotal,0,',','.') }}</div>
                                                                
                                                                    <div> Reparto </div>
                                                                    <div> ${{ number_format($sale->delivery_value,0,',','.') }}</div>
                                                                
                                                                    <div> Total </div>
                                                                    <div> ${{ number_format($sale->total,0,',','.') }}</div>
                                                                                                                        
                                                            </div>
                                                            @else
                                                                Total  ${{ number_format($sale->total,0,',','.') }}
                                                            @endif
                                                        </div>                                                   
                                                    </div>

                                                </x-modal.modal_screen>
                                            </td>
                                        </tr>
                                    @endif
                            
                            @endforeach
                        </tbody>
                    </table>
                        
                        
                            
                    
                
                </x-table>
                

        
        


            </div>
        </div>

    @else
        <h1 class="p-4 text-center uppercase text-3xl text-gray-600 font-bold my-4">Mis compras</h1>
        <div class="flex flex-col justify-around">
            <div class="flex items-center justify-center text-xl text-gray-600 font-bold">
                No has realizado compras aún...
            </div>
            <div class="flex items-center justify-center mt-12 text-xl text-gray-600 font-bold">
               Comienza a agregar productos al carrito y luego dentro del carrito haz click en continuar para poder realizar tu pedido
            </div>
        </div>
       
        
    @endif

    {{-- MODALES --}}
    <div>
        {{-- <div wire:loading wire:target="addRol">
            <x-spinner.spinner_screen></x-spinner.spinner_screen>
        </div> --}}
        @if ($openAddNew)
        <div>
            <x-modal.modal2> 
                <div class="p-4 px-2">
                    <div class="flex justify-between items-center gap-4 mb-4">
                        <h2 class="font-bold text-xl text-gray-600">Modal abierto</h2>
                        <div wire:click="$set('openAddNew',false)" class="p-2 px-3 border shadow rounded-full hover:bg-red-500 hover:text-white cursor-pointer"><i class="fas fa-times transform hover:scale-125"></i></div>
                    </div>
                    <div>
                        {{-- DATOS DEL MODAL .... --}}
                        <div>
                            <x-jet-label >Nombre</x-jet-label>
                            {{-- <x-jet-input wire:model.defer="namePermission"></x-jet-input> --}}
                        </div>
                      
                        <div>
                            <x-jet-label >Descripcion</x-jet-label>
                            {{-- <x-jet-input wire:model.defer="descriptionPermission"></x-jet-input> --}}
                        </div>
                    </div>
                    <div class="p-4 px-2">
                        {{-- <x-jet-button wire:click="addRol">Crear Permiso</x-jet-button> --}}
                    </div>
                    
                </div>
            </x-modal.modal2>
        </div>
            
        @endif

    </div>
</div>