<div>
    <div class="card" x-data="purchaseMain()">

        <div class="card-header">
            <div class="flex items-center justify-between gap-2">
                    <x-jet-input wire:model='search' type="text" class="w-full"  placeholder="Ingrese nombre o direccion a buscar"></x-jet-input>
                    <div>
                        <x-jet-button wire:click="newPurchase" class="w-max-content">Crear nueva compra</x-jet-button>
                    </div>
                </div>
            
        </div>

        <div class="card-body">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Id
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Proveedor
                                    </th>
                                    
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Fecha
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Comentarios
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Ingresado por
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                    
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($purchases as $purchase)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>{{$purchase->id}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                            
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{$purchase->supplier->name}}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        ${{number_format($purchase->total,0,',','.')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                            
                                                <div class="font-bold tracking-wide">
                                                    {{ $this->fecha($purchase->fecha)->dayName}} 
                                                </div>
                                                {{ $this->fecha($purchase->fecha)->format('d-m-Y')}}
                                            </div>
                                            {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{$purchase->comments}}
                                        
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                @if ($purchase->created_by())
                                                    {{$purchase->created_by()->name}}   
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-6 py-2 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex items-center justify-between gap-1 w-max-content">                                            
                                                <x-jet-secondary-button wire:click="showDetails({{$purchase->id}})"> <i class="fas fa-eye"></i></x-jet-secondary-button>
                                                <x-jet-secondary-button  > <i class="fas fa-pen"></i> </x-jet-secondary-button>
                                                <x-jet-secondary-button><i class="far fa-trash-alt"></i></x-jet-secondary-button>
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
        <div class="card-footer">
            {{ $purchases->links() }}
        </div>
        <div class="p-2 text-center bg-white shadow fixed-bottom">
            Total compras ${{number_format($purchases->sum('total'),0,',','.')}}
        </div>
       
    </div>

    @if ($openShowDetails)
        <x-modal.modal_screen>
            <x-slot name="titulo">
                <div class="flex items-end justify-between p-4 px-8 uppercase">
                    <div></div>
                    <h2 class="text-xl font-semibold text-gray-500"> DETALLE DE COMPRA {{$purchase_selected->id}}</h2>
                    
                    <x-jet-button  wire:click="$set('openShowDetails',false)" class="block">
                        <i class="fas fa-times"></i>
                    </x-jet-button>
                </div>
            </x-slot>

            <div class="p-2 m-auto my-2 rounded w-max-content"> 
                <div class="flex items-center justify-between mb-4 uppercase">
                        <h2 class="mt-2 text-2xl font-bold text-gray-500 uppercase">{{$purchase->supplier->name}}</h2> 
                        <h2 class="text-xl font-semibold text-gray-500">
                            {{$this->fecha($purchase_selected->fecha)->dayName}} 
                            {{$this->fecha($purchase_selected->fecha)->format('d-m-Y')}}
                        
                        </h2>
                    </div>
                    @if ($purchase_selected->comments)
                        <div class="w-full p-5 mx-auto mb-2 border rounded-xl">
                            {{$purchase_selected->comments}}
                        </div>
                    @endif

                <div class="p-5 mx-auto border rounded-xl w-max-content">
                    <table class="mx-auto table-fixed">
                        <thead>
                            <tr>
                                <th class="w-1/6">Imagen</th>
                                <th class="w-2/6">Producto</th>
                                <th class="w-1/6">Precio</th>
                                <th class="w-1/6">Precio por caja</th>
                                <th class="w-1/6">Precio total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase_selected->purchase_items as $item)
                                <tr>
                                    <td class="">
                                        <div class="flex justify-center">
                                            <img class="object-contain w-20 h-20 text-center" src="{{Storage::url($item->product->image->url)}}" alt="">
                                        </div>
                                    </td>
                                    <td class="text-left">  {{$item->cantidad}}  {{$item->product->name}} x  {{$item->cantidad_por_caja}} un. </td>
                                    <td class="text-center">${{number_format($item->precio,0,',','.')}}</td>
                                    <td class="text-center">${{number_format($item->precio_por_caja,0,',','.')}}</td>
                                    <td class="text-center">${{number_format($item->precio_total,0,',','.')}}</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex justify-between p-4 px-8">

                    <x-jet-button wire:click="$set('openShowDetails',false)">Cerrar</x-jet-button>
                    <div class="grid grid-cols-2 gap-4 text-xl font-semibold uppercase w-50">
                        <div class="font-bold text-gray-500">
                            Total
                        </div>
                        <div class="text-right">
                            ${{number_format($purchase_selected->total,0,',','.')}}
                        </div>
                    </div>

                </div>
            </x-slot>
        </x-modal.modal_screen>
    @endif

    @if ($openNewPurchase)
        <x-modal.modal_screen>
            <x-slot name="titulo">
                <div class="flex items-end justify-between p-4 px-8 uppercase">
                    <div></div>
                    <h2 class="text-xl font-semibold text-gray-500 uppercase"> Crear compra</h2>
                    
                    <x-jet-button  wire:click="$set('openNewPurchase',false)" class="block">
                        <i class="fas fa-times"></i>
                    </x-jet-button>
                </div>
            </x-slot>

            
            <div class="card">
                <div class="card-body">
                    <div class="flex flex-col gap-2 mb-4">
                        <x-jet-label>Selecciona fecha</x-jet-label>
                        <x-jet-input class="w-full" type="date" value="{{$fecha_compra}}"></x-jet-input>
                    </div>
                    <div class="flex flex-col gap-2 mb-4">
                        <x-jet-label>Selecciona Proveedor</x-jet-label>
                        <x-dropdowns.dropdown :items="$suppliers" placeholder="Ingresa nombre del proveedor" id="searchSupliers"></x-dropdowns.dropdown>
                    </div>
                    <div>
                        <x-jet-button wire:click="$set('openAddItem',true)" >Agregar Item</x-jet-button>
                        @if ($openAddItem)
                            <x-modal.modal_screen>
                                <x-slot name="titulo"> 
                                    <div class="flex justify-center items-center h-full bg-gray-200">
                                        <h2 class="text-xl">Agregar Item</h2>
                                    </div>
                                </x-slot>

                                <div class="flex flex-col gap-2 mb-4">
                                    <x-jet-label>Selecciona Producto</x-jet-label>
                                    <x-dropdowns.dropdown :items="$products" placeholder="Ingresa nombre del producto" id="searchProducts"></x-dropdowns.dropdown>
                                </div>


                                <x-slot name="footer"> 
                                    <div class="flex justify-end items-center h-full mr-5">
                                        <x-jet-button wire:click="$set('openAddItem',false)"> Cerrar </x-jet-button>
                                    </div>
                                </x-slot>
                            </x-modal.modal_screen>                   
                        @endif
                    </div>
                    

                </div>
                
            </div>
            

            <x-slot name="footer">
                <div class="flex justify-between p-4 px-8">

                    <x-jet-button wire:click="$set('openShowDetails',false)">Cerrar</x-jet-button>
                    <div class="grid grid-cols-2 gap-4 text-xl font-semibold uppercase w-50">
                        <div class="font-bold text-gray-500">
                            Total
                        </div>
                        <div class="text-right">
                            
                        </div>
                    </div>

                </div>
            </x-slot>
        </x-modal.modal_screen>
    @endif

   

    @push('js')
        <script>
           
            function purchaseMain(){
                return {
                    openShowDetails: @entangle('openShowDetails'),
                    openAddItem: @entangle('openAddItem'),
                    prueba: function(){
                        alert(this.refs.searchField.dataset.value)
                    },
                   

                }
            }
        </script>
     
    @endpush

    

</div>

