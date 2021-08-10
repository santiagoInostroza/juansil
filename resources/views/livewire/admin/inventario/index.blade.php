<div>
    
    
    <h1 class="text-2xl p-4 text-center font-bold bg-gray-50">INVENTARIO</h1>
    <div class="my-4 flex gap-4 relative">
        <x-jet-input wire:model="search" class="w-full" placeholder="Buscar por producto"></x-jet-input>
        <div class="absolute right-4">
            <x-spinner.spinner :size="10" wire:loading.delay></x-spinner.spinner>
        </div>
    </div>
    <div class="flex gap-4 my-4">
        Ordenar por...
        <select name="" id="" class="border rounded" wire:model="order_by">
            <option value="name">Nombre</option>
            <option value="id">Id</option>
            <option value="stock">Stock</option>
            <option value="status">Estado</option>
        </select>
        <select name="" id="" class="border rounded" wire:model="asc">
            <option value="asc">Asc...</option>
            <option value="desc">Desc</option>
        </select>

    </div>
  
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Id</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Producto</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Stock</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Stock min</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">stock por precios</th>
                                
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Estado</th>
                                <th scope="col" class="relative px-6 py-3">
                                
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($products as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="">
                                            <div>{{$product->id}}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-4">
                                            @if ($product->image)
                                                <figure>
                                                    <img class="h-12 w-12 object-cover" src="{{Storage::url($product->image->url)}}" alt="">
                                                </figure>
                                            @endif
                                           
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{$product->name}}
                                                </div>
                                                <div class="flex gap-4">
                                                    <div class="text-sm text-gray-500">
                                                        {{$product->brand->name}}
                                                    </div>
                                                    <div class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                        {{$product->category->name}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                   
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <div class="font-bold tracking-wide">
                                                {{ $product->stock}} 
                                            </div>
                                        </div>
                                        {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500"> {{ $product->stock_min}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($product->purchasePrices->count())
                                            <div class="text-sm text-gray-500 max-h-96 overflow-auto border rounded"> 
                                                @foreach ($product->purchasePrices as $precio)
                                                    @if (!$mostrarTodosLosProductos && $precio->stock <=0)
                                                        @continue
                                                    @endif
                                                    <div class="grid grid-cols-2 hover:bg-gray-100 p-1">
                                                        <div>
                                                            {{$precio->stock}} un.
                                                        </div>
                                                        <div>
                                                            ${{number_format($precio->precio,0,',','.')}}
                                                        </div>
                                                       
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                       
                                        @if ($product->status)
                                            Activo
                                        @else
                                            Desactivado
                                        @endif
                                    </td>
                                   
                              
                                    <td class="px-6 py-2 text-sm font-medium text-right whitespace-nowrap">
                                        <div class="flex flex-col items-center justify-between gap-1 w-max-content">                                            
                                            <x-jet-secondary-button wire:click="showPurchase({{$product}})"> <i class="fas fa-eye"></i></x-jet-secondary-button>
                                            <x-jet-secondary-button  > <i class="fas fa-pen"></i> </x-jet-secondary-button>
                                            <x-jet-secondary-button wire:click="deletePurchase({{$product}})"><i class="far fa-trash-alt"></i></x-jet-secondary-button>
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
