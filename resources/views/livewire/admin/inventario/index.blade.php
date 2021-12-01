<div class="bg-gray-300 rouned">
    
    {{-- TITULO --}}
    <h1 class="text-2xl p-4 text-center font-bold bg-gray-600 text-white rounded-t">INVENTARIO</h1>

    <div class="border p-4 rounded grid grid-cols-1 md:grid-cols-2 gap-4 ">
        {{-- BUSCADOR --}}
        <div class="flex gap-4 relative">
            <x-jet-input wire:model.debounce="search" class="w-full" placeholder="Buscar por producto"></x-jet-input>
            <div class="absolute right-4">
                <x-spinner.spinner :size="10" wire:loading.delay wire:target="search"></x-spinner.spinner>
            </div>
        </div>

        {{-- FILTROS --}}
        <div class="flex gap-4 my-4">
            Ordenar por...
            <div class="relative">
                <select name="" id="" class="border rounded" wire:model="order_by">
                    <option value="name">Nombre</option>
                    <option value="id">Id</option>
                    <option value="stock">Stock</option>
                    <option value="status">Estado</option>
                </select>
                <div class="absolute top-0 left-8">
                    <x-spinner.spinner :size="6" wire:loading.delay wire:target="order_by"></x-spinner.spinner>
                </div>
            </div>
            <div class="relative">
                <select name="" id="" class="border rounded" wire:model="asc">
                    <option value="asc">Asc...</option>
                    <option value="desc">Desc</option>
                </select>
                <div class="absolute top-0 left-4">
                    <x-spinner.spinner :size="6" wire:loading.delay wire:target="asc"></x-spinner.spinner>
                </div>
            </div>
        

        </div>
    
    </div>

    {{-- LISTA PRODUCTOS --}}
    <div class="flex flex-col p-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" width="10" class="hidden sm:block px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Id</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Producto</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">stock disponible</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">stock reservado</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">stock now</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">stock por precios</th>
                                
                               
                                <th scope="col" width="10" class="relative px-6 py-3">
                                
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($products as $product)
                                <tr>
                                    <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap">
                                        <div>{{$product->id}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-1">
                                            @if ($product->image)
                                                <figure>
                                                    @if ( Storage::exists('products_thumb/' .  $product->image->url))
                                                    <img class="object-contain w-12 h-12" src="{{Storage::url('products_thumb/' . $product->image->url)}}" alt="">
                                                    @else
                                                        <img class="object-contain w-12 h-12" src="{{Storage::url($product->image->url)}}" alt="">
                                                    @endif
                                                </figure>
                                            
                                               
                                            @endif
                                        
                                            <div class="ml-2">
                                                <div class="text-sm font-medium text-gray-900"> {{$product->name}} </div>
                                            </div>
                                        </div>
                                    </td>
                                   
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 w-max-content flex items-center gap-4">
                                            <div class="font-bold tracking-wide"> {{ $product->stock}} un.</div>
                                            <div class="p-2 shadow rounded cursor-pointer"><i class="fas fa-pen"></i></div>
                                        </div>                       
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 w-max-content flex items-center gap-4">
                                            <div class="font-bold tracking-wide"> 
                                              
                                               @php
                                                    $stockReservado=0;
                                                    foreach ($sales as $sale) {
                                                        // echo $sale->saleItems;
                                                        if($sale->saleItems->has('product_id',$product->id)){
                                                            $stock += $sale->cantidad_total;
                                                        }
                                                    }
                                               @endphp
                                               {{$stockReservado}}
                                            
                                            </div>
                                           
                                        </div>                             
                                    </td>
                                   
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col gap-2 hidden" x-data="{quantity:''}">
                                            
                                            <div class="">
                                                @if ($product->stockInventory->count())
                                                    @foreach ($product->stockInventory as $item)
                                                        @if ($loop->last)
                                                            <div class="flex flex-col">
                                                                <div class="flex gap-4 items-center justify-between">
                                                                    <div>{{ $item->quantity }} un.  </div>
                                                                    <div class="text-xs">{{ Helper::fecha($item->date)->diffForHumans() }}</div> 
                                                                </div>
                                                                @if ($product->stock != $item->quantity )
                                                                    <x-jet-button class="bg-yellow-500 text-white hover:bg-yellow-600" wire:click="ajustarStock({{ $product->id }}, {{ $item->quantity }})"> Ajustar stock</x-jet-button>
                                                                <textarea x-ref="comment" x-on:blur="$wire.commentAjuste=$refs.comment.value" class="border p-2" placeholder="Ingresa un comentario"></textarea>
                            
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="bg-red-600 text-white py-1">
                                                        No hay revision de stock
                                                    </div>
                                              @endif
                                             
                                            </div>

                                            <x-jet-input x-model="quantity"></x-jet-input>
                                            <x-jet-button x-on:click="$wire.actualizateStock('{{ $product->id }}', quantity);quantity=''">Actualizar Stock</x-jet-button>
                                            
                                        </div>
                                        
                                    </td>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($product->purchasePrices->count())
                                            <div class="text-sm text-gray-500 max-h-96 overflow-auto rounded w-max-content"> 
                                                @foreach ($product->purchasePrices as $precio)
                                                    @if (!$mostrarTodosLosProductos && $precio->stock <=0)
                                                        @continue
                                                    @endif
                                                    <div class="grid grid-cols-5 hover:bg-gray-100 p-1 w-max-content text-center">
                                                        <div class="col-span-2">
                                                            {{$precio->stock}}/<span class="font-bold">{{$precio->cantidad}}</span> un.
                                                        </div>
                                                        <div class="" style="min-width: 45px">
                                                            ${{number_format($precio->precio,0,',','.')}}
                                                        </div>
                                                        <div class="col-span-2">
                                                            @if ($precio->fecha)
                                                                {{$this->fecha($precio->fecha)->format('d-m-Y')}}
                                                            @endif
                                                        </div>
                                                       
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>                              
                                    <td class="px-6 py-2 text-sm font-medium text-right whitespace-nowrap">
                                        <div class="flex flex-col items-center justify-between gap-1 w-max-content">                                            
                                            <x-jet-secondary-button wire:click="showPurchase({{ $product }})"> <i class="fas fa-eye"></i></x-jet-secondary-button>
                                            <x-jet-secondary-button  > <i class="fas fa-pen"></i> </x-jet-secondary-button>
                                            {{-- <x-jet-secondary-button wire:click="deleteProduct({{ $product }})"><i class="far fa-trash-alt"></i></x-jet-secondary-button> --}}
                                            {{-- <a href="{{ route('admin.purchases.show', $purchase) }}" title="Ver datos del cliente" class="mr-2 btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.purchases.edit', $purchase) }}" class="mr-2 btn btn-secondary btn-sm"><i class="fas fa-pen"></i></a>
                                            <form action="{{ route('admin.purchases.destroy', $purchase) }}" method='POST' class="mr-2 alerta_eliminar">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                            </form> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
