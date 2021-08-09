<div  x-data="purchaseMain()">

    <div class="" @keyup.shift.c.window="openNewPurchase=true">
    
        <h1 class="uppercase text-2xl text-gray-600 font-bold text-center mb-10">LISTA DE COMPRAS</h1>
 

        <div class="">
            <div class="flex items-center justify-between gap-2 mb-6">
                <x-jet-input wire:model='search' type="text" class="w-full"  placeholder="Ingrese nombre del proveedor"></x-jet-input>
                <div>
                    <x-jet-button wire:click="newPurchase" class="w-max-content">Crear nueva compra</x-jet-button>
                </div>
            </div>
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
                                                <div class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                    @if ($purchase->created_by())
                                                        {{$purchase->created_by()->name}}   <br>
                                                        {{$purchase->created_at->timezone('America/Santiago')->format('d-m-Y H:i:s')}}   
                                                      
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-2 text-sm font-medium text-right whitespace-nowrap">
                                                <div class="flex items-center justify-between gap-1 w-max-content">                                            
                                                    <x-jet-secondary-button wire:click="showPurchase({{$purchase}})"> <i class="fas fa-eye"></i></x-jet-secondary-button>
                                                    <x-jet-secondary-button  > <i class="fas fa-pen"></i> </x-jet-secondary-button>
                                                    <x-jet-secondary-button wire:click="deletePurchase({{$purchase}})"><i class="far fa-trash-alt"></i></x-jet-secondary-button>
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
        <div class="">
            {{ $purchases->links() }}
        </div>
        <div class="p-2 text-center bg-white fixed-bottom">
            Total compras ${{number_format($purchases->sum('total'),0,',','.')}}
        </div>
    </div>

 


    {{-- CREAR NUEVA COMPRA --}}
    <div  class="hidden" :class=" {'hidden' :  !openNewPurchase  }" class="card" @keyup.shift.a.window="openItemIf()">
        <x-modal.modal2>
            <x-slot name="titulo">
                <div class="flex items-end justify-between uppercase">
                    <div></div>
                    <h2 class="text-xl font-semibold text-gray-500 uppercase"> Crear compra</h2>
                    
                    <x-jet-button  wire:click="$set('openNewPurchase',false)" class="block">
                        <i class="fas fa-times"></i>
                    </x-jet-button>
                </div>
            </x-slot>

            {{-- BODY --}}
            <div>
                <div class="relative">

                    {{-- PROVEEDOR Y FECHA --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2 mb-4">
                        <div class="flex flex-col gap-2">
                            <x-jet-label>Selecciona Proveedor</x-jet-label>
                            <x-dropdowns.dropdown  wire:model.lazy="supplier_id" :items="$suppliers" placeholder="Ingresa nombre del proveedor" id="searchSupliers"></x-dropdowns.dropdown>
                            <x-jet-input-error for="supplier_id" class="" />
                           
                           
                        </div>
                        <div class="flex flex-col gap-2">
                            <x-jet-label>Selecciona fecha</x-jet-label>
                            <x-jet-input wire:model.lazy="fecha_compra" class="w-full" type="date"></x-jet-input>
                            <x-jet-input-error for="fecha_compra" class="" />
                        </div>
                    </div>
                
                    {{-- ITEMS AGREGADOS --}}
                    <div class="">
                        @if (session()->has('compra.items') && count(session('compra.items')) > 0)
                            <div class="my-5">
                                <x-table>
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="  py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                    <div class="flex items-center justify-center">
                                                        Imagen  
                                                    </div>
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                    PRODUCTO   
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                    CANTIDAD total   
                                                </th>
                                                
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                    Precio total
                                                </th>
                                                
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                    <span class="sr-only">Accion</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach (session('compra.items') as $key => $item)
                                                <tr>
                                                    <td class="py-4 whitespace-nowrap">
                                                        <div class="flex items-center justify-center">
                                                            
                                                                <img  class="object-contain h-24 w-24" src="{{Storage::url($item['image'])}}" alt="{{ $item['product_id'] }}" title='Id producto {{ $item['product_id'] }}'>
                                                            
                                                        </div>
                                                        
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div>
                                                            {{ $item['cantidad'] }}  {{ $item['product_name'] }} x {{ $item['cantidad_por_caja'] }} un.
                                                        </div>
                                                        <div class="text-sm font-semibold text-gray-400">
                                                            ${{ number_format($item['precio'],0,',','.') }} x unidad   ${{ number_format($item['precio_por_caja'],0,',','.') }} x caja
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $item['cantidad_total'] }}  un.
                                                    </td>
                                                    
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        ${{ number_format($item['precio_total'],0,',','.') }}  
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <x-jet-button wire:click="open_mod_item({{ $key }})"><i class="fas fa-edit"></i></x-jet-button>
                                                        <x-jet-danger-button wire:click="deleteItem({{ $key }})"><i class="far fa-trash-alt"></i></x-jet-danger-button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </x-table>       
                            </div>
                        @endif
                    </div>

                    {{-- AGREGAR ITEMS  Y TOTAL --}}
                    <div class="flex justify-between items-center my-10">
                        <div>
                            <x-jet-button wire:click="$set('openAddItem',true)" >Agregar Item</x-jet-button>
                            
                                <div x-show="openAddItem">
                                    <x-modal.modal2 class="relative">
                                        <x-slot name="titulo"> 
                                            <div class="flex justify-center items-center h-full bg-gray-200">
                                                <h2 class="text-xl">Agregar Item</h2>
                                            </div>

                                        </x-slot>

                                        <div class="flex flex-col gap-2 mb-4 "  >
                                            <x-jet-label>Selecciona Producto</x-jet-label>
                                            <x-dropdowns.dropdown  wire:model.defer="product_id" :items="$products" placeholder="Ingresa nombre del producto" id="searchProducts" :value="$product_id" />
                                            <x-jet-input-error for="product_id" class="" />
                                        </div>
                                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                                <div  class="flex flex-col gap-2 mb-4">
                                                    <x-jet-label>Cantidad</x-jet-label>
                                                    <x-jet-input wire:model.defer="cantidad" x-ref="cantidad" type="number" @keyup="calcularCantidadTotal"></x-jet-input>
                                                    <x-jet-input-error for="cantidad" class="" />
                                                
                                                </div>
                                                <div class="flex flex-col gap-2 mb-4">
                                                    <x-jet-label>Cantidad por caja</x-jet-label>
                                                    <x-jet-input wire:model.defer="cantidad_por_caja" x-ref="cantidad_por_caja"  type="number" @keyup="calcularCantidadTotal"></x-jet-input>
                                                    <x-jet-input-error for="cantidad_por_caja" class="" />
                                                </div>
                                        
                                        
                                            <div class="flex flex-col gap-2 mb-4">
                                                <x-jet-label>Cantidad total</x-jet-label>
                                                <x-jet-input wire:model.defer="cantidad_total" @keyup="calcularCantidad" x-ref="cantidad_total"  type="number"></x-jet-input>
                                                <x-jet-input-error for="cantidad_total" class="" />
                                            </div>
                                            <div class="flex flex-col gap-2 mb-4">
                                                <x-jet-label>precio</x-jet-label>
                                                <x-jet-input  wire:model.defer="precio" x-ref="precio"  @keyup="calcularCantidadTotal" type="number"></x-jet-input>
                                                <x-jet-input-error for="precio" class="" />
                                            </div>
                                            <div class="flex flex-col gap-2 mb-4">
                                                <x-jet-label>precio por caja</x-jet-label>
                                                <x-jet-input  wire:model.defer="precio_por_caja" id="precio_por_caja" x-model="precio_por_caja" x-ref="precio_por_caja" @keyup="calcularPrecio" type="number"></x-jet-input>
                                                <x-jet-input-error for="precio_por_caja" class="" />
                                            </div>
                                            <div class="flex flex-col gap-2 mb-4">
                                                <x-jet-label>precio total</x-jet-label>
                                                <x-jet-input wire:model.defer="precio_total" @keyup="calcularPrecio2" x-ref="precio_total" type="number"></x-jet-input>
                                                <x-jet-input-error for="precio_total" class="" />
                                            </div>
                                        </div>


                                        <x-slot name="footer"> 
                                            <div class="flex justify-end items-center h-full mr-5 gap-5">
                                                <x-jet-secondary-button wire:click="addItem">AGREGAR ITEM</x-jet-secondary-button>
                                                <x-jet-button wire:click="$set('openAddItem',false)"> Cerrar </x-jet-button>
                                            </div>
                                        </x-slot>
                                    </x-modal.modal2> 
                                </div>                  
                            
                        </div>

                        <div class="flex gap-4">
                            <div class="">
                                Total
                            </div>
                            <div>
                                ${{ number_format( session('compra.total'),0,',','.') }}
                            </div>
                        </div>
                    </div>

                    {{-- COMENTARIO --}}
                    <div class="mb-4">
                        <x-jet-label>Comentario</x-jet-label>
                        <textarea class="w-full rounded border" name="" id="" wire:model.lazy="comments"></textarea>
                    </div>

                    {{-- BOTON COMPRAR --}}
                    <div class="my-10">
                        <div class="text-right" wire:click="save">
                            <x-jet-button>Crear Compra</x-jet-button>
                        </div>
                    </div>
                    

                </div>
            </div>

            <x-slot name="footer">
                <div class="flex justify-end">

                    {{-- <x-jet-button wire:click="$set('openShowDetails',false)">Cerrar</x-jet-button> --}}
                    <div class="grid grid-cols-2 gap-4 text-xl font-semibold uppercase w-50">
                        <div class="font-bold text-gray-500">
                            Total
                        </div>
                        <div class="text-right">
                            ${{ number_format( session('compra.total'),0,',','.') }}
                        </div>
                    </div>

                </div>
            </x-slot>

        </x-modal.modal2>
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
                    <h2 class="mt-2 text-2xl font-bold text-gray-500 uppercase">{{$purchase_selected->supplier->name}}</h2> 
                    <h2 class="text-xl font-semibold text-gray-500">
                        {{$this->fecha($purchase_selected->fecha)->dayName}} 
                        {{$this->fecha($purchase_selected->fecha)->format('d-m-Y')}}
                    
                    </h2>
                </div>
                @if ($purchase_selected->comments)
                    <h2 class="text-xl font-semibold text-gray-500">Comentario</h2>
                    <div class="w-full p-5 mx-auto mb-2 border rounded-xl">
                        {{$purchase_selected->comments}}
                    </div>
                @endif

                <h2 class="text-xl font-semibold text-gray-500">Detalle</h2>
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
 
    @push('js')
        <script>
           
            function purchaseMain(){
                return {
                    product_id: @entangle('product_id'),
                    cantidad: @entangle('cantidad'),
                    cantidad_por_caja:@entangle('cantidad_por_caja'),
                    cantidad_total:@entangle('cantidad_total'),
                    precio:@entangle('precio'),
                    precio_por_caja:"",
                    precio_total:@entangle('precio_total'),


                    openNewPurchase: @entangle('openNewPurchase'),
                    openShowDetails: @entangle('openShowDetails'),
                    openAddItem: @entangle('openAddItem'),
                    prueba: function(){ 
                        alert(this.$refs.searchField.dataset.value)
                    },
                    calcularCantidadTotal(){
                        if(this.$refs.cantidad.value == 0 && this.$refs.cantidad_total.value >0){
                            this.$refs.cantidad.value = this.$refs.cantidad_total.value / this.$refs.cantidad_por_caja.value;
                            this.$refs.cantidad.dispatchEvent(new Event('input'));
                        }else{
                            this.$refs.cantidad_total.value = this.$refs.cantidad.value * this.$refs.cantidad_por_caja.value;
                            this.$refs.cantidad_total.dispatchEvent(new Event('input'));
                        }
                        this.$refs.precio_total.value = this.$refs.precio.value * this.$refs.cantidad_total.value;
                        this.$refs.precio_total.dispatchEvent(new Event('input'));
                        this.$refs.precio_por_caja.value = this.$refs.precio.value * this.$refs.cantidad_por_caja.value;
                        this.$refs.precio_por_caja.dispatchEvent(new Event('input'));
                    },
                    calcularCantidad(){
                        this.$refs.cantidad.value = this.$refs.cantidad_total.value / this.$refs.cantidad_por_caja.value;
                        this.$refs.cantidad.dispatchEvent(new Event('input'));

                        this.$refs.precio_total.value = this.$refs.precio.value * this.$refs.cantidad_total.value;
                        this.$refs.precio_total.dispatchEvent(new Event('input'));

                        this.$refs.precio_por_caja.value = this.$refs.precio.value * this.$refs.cantidad_por_caja.value;
                        this.$refs.precio_por_caja.dispatchEvent(new Event('input'));
                    },
                    calcularPrecio(){
                        this.$refs.precio.value = this.$refs.precio_por_caja.value / this.$refs.cantidad_por_caja.value;
                        this.$refs.precio.dispatchEvent(new Event('input'));

                        this.$refs.precio_total.value = this.$refs.precio.value * this.$refs.cantidad_total.value;
                        this.$refs.precio_total.dispatchEvent(new Event('input'));
                    },
                    calcularPrecio2(){
                        this.$refs.precio.value = this.$refs.precio_total.value / this.$refs.cantidad_total.value;
                        this.$refs.precio.dispatchEvent(new Event('input'));

                        this.$refs.precio_por_caja.value = this.$refs.precio.value * this.$refs.cantidad_por_caja.value;
                        this.$refs.precio_por_caja.dispatchEvent(new Event('input'));
                    },
                    openItemIf(){

                        if(this.openNewPurchase){
                            this.openAddItem = true;
                            setTimeout(() => {
                                document.getElementById('searchField_searchProducts').focus();
                              
                            }, 200);
                        }
                    },
                    


              

                    
                   

                }
            }
        </script>
     
    @endpush

    

</div>

