<div class="grid grid-cols-1 md:grid-cols-2 gap-4 h-full"  x-data="{showDetail:false}">

    {{-- LISTA DE PRODUCTOS --}}  
    <div class="rounded bg-white p-2 overflow-hidden h-full "   :class="{'hidden' : showDetail}">
        <div class=" flex justify-between gap-8 items-center mb-2 pr-2">
            <div class="relative flex-1">
                <div wire:loading.flex wire:target="search" >
                    <x-spinner.spinner2></x-spinner.spinner2>
                </div>
                <x-jet-input class="w-full" wire:model.debounce.500ms="search" placeholder="Buscar producto..."></x-jet-input>
                
            </div>

            <div class="flex md:hidden" x-on:click="">
                <i class="fas fa-shopping-cart"></i>
            </div>
            
    
        </div>
        <div class=" overflow-auto h-full ">
            <div class="grid grid-cols-1  lg:grid-cols-2 xl:grid-cols-3 gap-2 relative mb-12">
                @foreach ($products as $product)
                    <div class="flex flex-col justify-between border rounded p-2 cursor-default relative @if($product->stock <= 0) bg-gray-100 text-gray-600   @elseif($product->stock <= $product->stock_min) bg-yellow-100 @else bg-green-200 text-green-800 @endif ">
                       
                        <div class="relative ">
                            <figure>
                                @if ($product->image)
                                    <img class="object-contain w-16 h-16"  src="{{ Storage::url('products_thumb/' . $product->image->url)}}" alt="{{$product->name}}">
                                @else
                                    <img class="object-contain w-16 h-16"  src="{{ Storage::url('products_thumb/' . $product->name)}}" alt="{{$product->name}}">
                                @endif
                                
                                <figcaption class="text-gray-800 mt-2">{{$product->name}}</figcaption>
                            </figure>
                            <div class="absolute top-0 right-0 mr-4 mt-4 p-1 rounded font-bold ">
                                <div>Stock</div>
                                <div class="text-center">
                                    {{$product->stock}}
                                </div>
                            </div>
                        
                        </div>
    
                        <div class="flex items-center gap-2 overflow-x-auto overflow-y-hidden w-full relative">
                            @if($product->stock <= 0)

                            @elseif (isset(session('venta.items')[$product->id]))
                             
                                @php
                                    $item = session('venta.items')[$product->id];
                                    $key = $product->id;
                                @endphp

                                <div x-data="{quantityBox:{{ $item['cantidad_por_caja'] }}, quantity:{{ $item['cantidad']}}, loading:false}" x-init="quantityBox={{ $item['cantidad_por_caja'] }}; quantity={{ $item['cantidad']}} " id="lista_order2_{{$item['product_id']}}" class="flex items-center justify-between gap-2 h-24 w-full">
                                   
                                    <div class="flex items-center justify-center gap-2">
                                        <x-jet-input x-model="quantity" x-on:keyup.debounce.800ms="loading=true;$wire.setQuantity({{$key}}, quantity ).then((response)=>{loading=false; if(response>0){quantity=response}})"  type="number" min=1 class="w-12"> </x-jet-input>
                                        <span class="">x</span> 
                                        <x-jet-input x-model="quantityBox" x-on:keyup.debounce.800ms="loading=true;$wire.setQuantityBox({{$key}}, quantityBox ).then((response)=>{loading=false; if(response>0){quantityBox=response}})"  type="number" min=1 class="w-12" > </x-jet-input>
                                        <div> {{session('venta.items')[$product->id]['cantidad_total']  }}  un.</div>
                                    </div>
                                    <div class="hidden" :class="{'hidden' : !loading}">
                                        <x-spinner.spinner2></x-spinner.spinner>
                                    </div>   
                                    <x-jet-danger-button class="p-2 cursor-pointer" wire:click="removeFromTemporalOrder({{ $key }})"><i class="fas fa-times"></i></x-jet-danger-button>
                                                                         
                                </div>



                            @else
                                @foreach ($product->salePrices as $price)
                                <div class=" h-24">
                                    <div id="quantity_{{$price->id}}" x-data="{loading:false}" class="relative text-xs cursor-pointer bg-white hover:bg-gray-200 text-gray-800 font-semibold py-2 px-2 border border-gray-200 rounded shadow" 
                                        @if($price->quantity <= $product->stock) 
                                            x-on:click="loading=true;$wire.addToTemporalOrder({{ $product->id }},{{$price->quantity}},{{ $price->price }}).then(()=>loading=false);toast('Agregado','success')" 
                                        @else 
                                            x-on:click="loading=true;$wire.alertStock({{$price->quantity}}).then(()=>loading=false)" 
                                        @endif >
                                        <div x-show="loading">
                                            <x-spinner.spinner2></x-spinner.spinner2>
                                        </div>
                                        <div class="select-none">x {{$price->quantity}}</div>
                                        <div class="select-none">${{ number_format($price->total_price,0,',','.') }}</div>
                                        <div class="text-red-600 select-none">(${{ number_format($price->price,0,',','.') }})</div>
                                    </div>
                                </div>
                                   
                                @endforeach 
                               
                            @endif
                           
                        </div>

                        @if($product->stock <= 0)
                            <div class="absolute inset-0 bg-gray-600 opacity-25"></div>
                        @endif
                    </div>
                @endforeach
    
            </div>
        </div>
        
    </div>
    {{-- PEDIDO NUEVO --}}
    <div class=" rounded bg-white  overflow-auto overflow-x-hidden h-full" >
        <div class="flex justify-between shadow p-2 px-4 md:hidden" x-on:click="showDetail = !showDetail">
            <span></span>
            <span class="font-bold">Detalle</span>

            <div class="hidden" :class="{'hidden' : showDetail}">
                <i class="fas fa-chevron-up"  ></i>
            </div>
            <div class="hidden" :class="{'hidden' : !showDetail}">
                <i class="fas fa-minus"  ></i>
            </div>
        </div>
        <div class="max-w-4xl m-auto  hidden md:block p-4" :class="{'hidden' : !showDetail}">
            <div class="mb-4">
        
                @livewire('admin.customer.search-customer')
                @error('customerId')
                    <span class="text-xs text-red-600">Selecciona cliente</span>
                @enderror
            </div>
        
             {{-- DELIVERY --}}
             <div  class="w-full border rounded p-2">
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
                        <div  class="flex items-center  w-max-content">
                            <label class="switch">
                                <input type="checkbox" wire:model="delivered" id='delivered'>
                                <span class="slider round"></span>
                            </label>
                            <label for="delivered" class="flex items-center" >
                                {{-- <i class="fas fa-truck pl-3 cursor-pointer"> </i> --}}
                                <div class="ml-3 font-bold cursor-pointer">Entregado</div>
                            </label>
                        </div>
                    @endif
        
                </div>
            
            
        
                @if ($delivery)
        
                    <div  class="w-full ">
        
                        <div class="grid grid-cols-2 gap-2">
                            <div id="dias" x-data="{loading:false}" class="relative">
                                <div class="hidden" :class="{'hidden':!loading}">
                                    <x-spinner.spinner2></x-spinner.spinner2>
                                </div>
                                <div class="flex items-center gap-4">
                                    <x-jet-label value="Fecha de entrega"></x-jet-label>
                                   
                                </div>
                               
                                <x-jet-input type="date" class="w-full" wire:model="fecha_entrega"></x-jet-input>
                                <x-jet-input-error for="fecha_entrega" class="mt-2" />
                                @if ($fecha_entrega!="") 
                                    <div class="text-green-500 font-bold">{{ Helper::fecha($fecha_entrega)->dayName }} <i class="fas fa-check"></i> </div>
                                @endif
                                <div class="flex gap-4 my-2 ">
                                    @if ($lu == $fecha_entrega)
                                        <x-jet-button class="" x-on:click="loading=true;$wire.$set('fecha_entrega', '{{$lu}}').then( ()=> loading=false)">LU</x-jet-button> 
                                    @else
                                        <x-jet-secondary-button class="" x-on:click="loading=true;$wire.$set('fecha_entrega', '{{$lu}}').then( ()=> loading=false)">LU</x-jet-secondary-button> 
                                    @endif

                                    @if ($ma == $fecha_entrega)
                                        <x-jet-button class="" x-on:click="loading=true;$wire.$set('fecha_entrega', '{{$ma}}').then( ()=> loading=false)">MA</x-jet-button> 
                                    @else
                                        <x-jet-secondary-button class="" x-on:click="loading=true;$wire.$set('fecha_entrega', '{{$ma}}').then( ()=> loading=false)">MA</x-jet-secondary-button> 
                                    @endif

                                    @if ($mi == $fecha_entrega)
                                        <x-jet-button class="" x-on:click="loading=true;$wire.$set('fecha_entrega', '{{$mi}}').then( ()=> loading=false)">MI</x-jet-button> 
                                    @else
                                        <x-jet-secondary-button class="" x-on:click="loading=true;$wire.$set('fecha_entrega', '{{$mi}}').then( ()=> loading=false)">MI</x-jet-secondary-button> 
                                    @endif

                                    @if ($ju == $fecha_entrega)
                                        <x-jet-button class="" x-on:click="loading=true;$wire.$set('fecha_entrega', '{{$ju}}').then( ()=> loading=false)">JU</x-jet-button> 
                                    @else
                                        <x-jet-secondary-button class="" x-on:click="loading=true;$wire.$set('fecha_entrega', '{{$ju}}').then( ()=> loading=false)">JU</x-jet-secondary-button> 
                                    @endif
                                    @if ($vi == $fecha_entrega)
                                        <x-jet-button class="" x-on:click="loading=true;$wire.$set('fecha_entrega', '{{$vi}}').then( ()=> loading=false)">VI</x-jet-button> 
                                    @else
                                        <x-jet-secondary-button class="" x-on:click="loading=true;$wire.$set('fecha_entrega', '{{$vi}}').then( ()=> loading=false)">VI</x-jet-secondary-button> 
                                    @endif
                                    
                                 
                                </div>
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
            <br>
            {{-- ITEMS --}}
            <div class="w-full border rounded p-2">
                <h2 class="font-bold">Lista de productos</h2>
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
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                
                                        </th>
                                        
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach (session('venta.items') as $key => $item)
                                        <tr class="relative">
                                            <td class="py-2 whitespace-nowrap">
                                               
                                                <div x-init="console.log('onot')" x-data="{quantityBox:{{ $item['cantidad_por_caja']}}, quantity:{{ $item['cantidad']}}, loading:false}" x-init="quantityBox={{ $item['cantidad_por_caja'] }}; quantity={{ $item['cantidad']}} " id="lista_order_{{$item['product_id']}}" class="flex items-center justify-center">
                                                    
                                                    <figure class="w-12">
                                                        <img  class="object-contain h-8 w-8" src="{{Storage::url('products_thumb/' . $item['image'])}}" alt="{{'products_thumb/' . $item['product_id'] }}" title='Id producto {{ $item['product_id'] }}'>
                                                    </figure>
                                                    <div class="flex flex-col md:flex-row">
                                                        <x-jet-input x-model="quantity" x-on:keyup.debounce.800ms="loading=true;$wire.setQuantity({{$key}}, quantity ).then((response)=>{loading=false; if(response>0){quantity=response}})"  type="number" min=1 class="w-12"> </x-jet-input>
                                                        <span class="mx-2">x</span> 
                                                        <x-jet-input x-model="quantityBox" x-on:keyup.debounce.800ms="loading=true;$wire.setQuantityBox({{$key}}, quantityBox ).then((response)=>{loading=false; if(response>0){quantityBox=response}})"  type="number" min=1 class="w-12" > </x-jet-input>
                                                        
                                                    </div>
                                                   <div class="hidden" :class="{'hidden' : !loading}">
                                                        <x-spinner.spinner2></x-spinner.spinner>
                                                    </div>                                                
                                                </div>
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap">
                                                <div class="">
                                                    <div>
                                                        {{ $item['product_name'] }}
                                                    </div>
        
                                                    <div class="text-sm font-semibold text-gray-400">
                                                        
                                                        <span class="mr-4">${{ number_format($item['precio'],0,',','.') }} c/u  </span>
                                                        @if ($item['cantidad_por_caja'] != 1)
                                                            ${{ number_format($item['precio_por_caja'],0,',','.') }} x {{$item['cantidad_por_caja']}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div  class="mr-4 text-right">
                                                    <div>
                                                        {{$item['cantidad_total']}} un.
                                                    </div>
                                                    <div >
                                                        <div> ${{ number_format($item['precio_total'],0,',','.') }} </div>
                                                    </div>
                                                </div> 
                                            </td>
                                            <td>
                                                <div class="p-2 cursor-pointer" wire:click="removeFromTemporalOrder({{ $key }})">
                                                    <i class="fas fa-times"></i>
                                                </div>
                                            </td>
                                            
                                    
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </x-table>       
                    </div>
                @endif
                @error('items')
                    <span class="text-xs text-red-600">No has seleccionado productos</span>
                @enderror
            </div> 
          
        
            {{-- TOTAL --}}
            <div class="flex justify-end p-4">
                @if ($valor_despacho > 0 && $delivery)
                    <div class="grid grid-cols-2 max-w-xs gap-3">
                        <div>Sub Total</div>
                        <div>${{ number_format(session('venta.total'),0,',','.') }}</div>
                        <div>Delivery</div>
                        <div> ${{ number_format($valor_despacho,0,',','.') }}</div>
                        <div>Total</div>
                        <div> ${{ number_format($valor_despacho + session('venta.total'),0,',','.') }} </div>
                    </div>
                @else
                    <div class="grid grid-cols-2 max-w-xs ">
                        <div>Total</div>
                        <div>${{ number_format(session('venta.total'),0,',','.') }}</div>
                    </div>
                @endif
            
            </div>
        
           
        
            {{-- ESTADO DEL PAGO --}}
               
            <div class="w-full border rounded p-2 ">
                <div class="flex justify-between items-center">
                    <h2 class="font-bold">Estado del pago</h2>
                    <div class="flex justify-around">
                        <div wire:click="$set('estado_pago', 1 )" class="p-1 font-boldw-max-content cursor-pointer hover:text-gray-600 rounded @if ($estado_pago==1)bg-gray-900 text-white @endif">Pendiente</div>
                        <div wire:click="$set('estado_pago', 2 )" class="mx-2 p-1 font-boldw-max-content cursor-pointer hover:text-gray-600 rounded @if ($estado_pago==2)bg-gray-900 text-white @endif">Abono</div>
                        <div wire:click="$set('estado_pago', 3 )" class="p-1 font-boldw-max-content cursor-pointer hover:text-gray-600 rounded @if ($estado_pago==3)bg-gray-900 text-white @endif">Pagado</div>
                    </div>
                </div>
                @if ($estado_pago==2)
                    <div class="my-2">
                        <x-jet-input class="w-full" placeholder="Ingresa monto" wire:model="abono"></x-jet-input>
                    </div>
                @endif
            </div>
            <br>
            
            {{-- COMENTARIOS --}}
            <div class=" w-full border rounded p-2 ">
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
                    <textarea wire:model="comentario" cols="10" rows="2" class="w-full mt-2" placeholder="Ingresa un comentario"></textarea>
                @endif
            
            </div>
            
        
            <div x-data="{loading:false}" class="my-4">
                <div class="hidden" :class="{'hidden':!loading}">
                    <x-spinner.spinner2></x-spinner.spinner2>
                </div>
                <x-jet-button class="w-full" x-on:click="loading=true;$wire.createOrder().then((response)=>{ if(response){toast('Pedido Creado!!');} ;loading=false})">Crear Pedido</x-jet-button>
            </div>
                
        
        </div>
    </div>
</div>



