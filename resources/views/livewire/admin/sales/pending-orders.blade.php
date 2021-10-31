<div>
    
    <form action="">
        <div class="mb-4">
            @livewire('admin.customer.search-customer')
        </div>

        <div class="">
            <div class="grid grid-cols-2">
                <div  class="flex items-center  w-max-content">
                    <label class="switch">
                        <input type="checkbox" wire:model="delivery" id='delivery'>
                        <span class="slider round"></span>
                    </label>
                    <label for="delivery" class="flex items-center" >
                        <i class="fas fa-truck pl-3 cursor-pointer"> </i>
                        <div class="ml-3 font-bold cursor-pointer">Delivery</div>
                    </label>
                </div>
                @if ($delivery)
                    <div  class="flex items-center  w-max-content mt-3">
                        <label class="switch">
                            <input type="checkbox" wire:model="delivered" id='delivered'>
                            <span class="slider round"></span>
                        </label>
                        <label for="delivered" class="flex items-center" >
                            <i class="fas fa-truck pl-3 cursor-pointer"> </i>
                            <div class="ml-3 font-bold cursor-pointer">Entregado</div>
                        </label>
                    </div>
                @endif

            </div>
           

            @if ($delivery)

                <div  class="w-full ">

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <x-jet-label value="Fecha de entrega"></x-jet-label>
                            <x-jet-input type="date" class="w-full" wire:model="fecha_entrega"></x-jet-input>
                            <x-jet-input-error for="fecha_entrega" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label value="Valor despacho"></x-jet-label>
                            <x-jet-input class="w-full" wire:model="valor_despacho"></x-jet-input>
                            <x-jet-input-error for="valor_despacho" class="mt-2" />
                        </div>
                    
                    </div>
                    
                </div>
            @endif
        </div>

        {{-- ITEMS --}}
        <div class="">
            @if (session()->has('venta.items') && count(session('venta.items')) > 0)
                <div class="my-5">
                    <x-table>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="  py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                        <div class="flex items-center justify-center">
                                            
                                        </div>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                         
                                    </th>
                                   
                                    
                                   
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach (session('venta.items') as $key => $item)
                                    <tr>
                                        <td class="py-2 whitespace-nowrap">
                                            <div class="flex items-center justify-center">
                                                {{ $item['cantidad'] }}  x {{ $item['cantidad_por_caja'] }}
                                                <figure>
                                                    <img  class="object-contain h-8 w-8" src="{{Storage::url('products_thumb/' . $item['image'])}}" alt="{{'products_thumb/' . $item['product_id'] }}" title='Id producto {{ $item['product_id'] }}'>
                                                </figure>                                                        
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="relative">
                                                <div>
                                                    {{ $item['product_name'] }}
                                                </div>

                                                <div class="text-sm font-semibold text-gray-400">
                                                    ${{ number_format($item['precio'],0,',','.') }} c/u   ${{ number_format($item['precio_por_caja'],0,',','.') }} x caja
                                                    {{ $item['cantidad_total'] }}  un.  ${{ number_format($item['precio_total'],0,',','.') }} 
                                                </div>


                                                <div class="absolute top-0 right-0 p-2 cursor-pointer">
                                                    <i class="fas fa-times"></i>
                                                </div>
                                            </div>
                                        </td>
                                       
                                
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </x-table>       
                </div>
            @endif
        </div> 

        {{-- TOTAL --}}
        <div class="flex justify-end p-4">
            @if (false)
                <div class="grid grid-cols-2 max-w-xs gap-3">
                    <div>Sub Total</div>
                    <div>${{ number_format(session('venta.total'),0,',','.') }}</div>
                    <div>Delivery</div>
                    <div>@if(false)
                            ${{ number_format($valor_despacho,0,',','.') }}
                        @else
                            $0
                        @endif
                    </div>
                    <div>Total</div>
                    <div>
                        @if(false)
                            ${{ number_format($valor_despacho + session('venta.total'),0,',','.') }}
                        @else
                            ${{ number_format(session('venta.total'),0,',','.') }}
                        @endif
                    </div>
                </div>
            @else
                <div class="grid grid-cols-2 max-w-xs ">
                    <div>Total</div>
                    <div>${{ number_format(session('venta.total'),0,',','.') }}</div>
                </div>
            @endif
        
        </div>

         {{-- ESTADO DEL PAGO --}}
        <div class="">
            <h2 class="font-bold text-xl ">Estado del pago</h2>
            <div class="w-full border rounded p-4 my-3 ">
                <div class="flex items-center">
                    <div wire:click="$set('estado_pago', 1 )" class="p-2 font-boldw-max-content cursor-pointer hover:text-gray-600 rounded @if ($estado_pago==1)bg-gray-900 text-white @endif">Pendiente</div>
                    <div wire:click="$set('estado_pago', 2 )" class="mx-2 p-2 font-boldw-max-content cursor-pointer hover:text-gray-600 rounded @if ($estado_pago==2)bg-gray-900 text-white @endif">Abono</div>
                    <div wire:click="$set('estado_pago', 3 )" class="p-2 font-boldw-max-content cursor-pointer hover:text-gray-600 rounded @if ($estado_pago==3)bg-gray-900 text-white @endif">Pagado</div>
                </div>
                @if ($estado_pago==2)
                    <div class="my-2">
                        <x-jet-input class="w-full" placeholder="Ingresa monto" wire:model="abono"></x-jet-input>
                    </div>
                @endif
            </div>
        
        </div>

        {{-- COMENTARIOS --}}
        <div class=" my-6">
            <div  class="flex items-center  w-max-content">
                <label class="switch">
                    <input type="checkbox" wire:model="openComentario" id='comentario'>
                    <span class="slider round"></span>
                </label>
                <label for="comentario" class="flex items-center" >
                    <i class="far fa-comment pl-3 cursor-pointer"> </i>
                    <div class="ml-3 font-bold cursor-pointer">Comentario</div>
                </label>
            </div>
            @if ($openComentario)
                <div class="w-full border rounded p-4 my-3 ">
                    <h2 class="font-bold text-lg my-2">Ingresa un comentario</h2>
                    <textarea wire:model="comentario" name="" id="" cols="10" rows="2" class="w-full"></textarea>
                    
                </div>
            @endif
           
        </div>

        <div class="my-4">
            <x-jet-button class="w-full">Crear Pedido</x-jet-button>
        </div>
        
    </form>
</div>
