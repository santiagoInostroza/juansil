<div>


    <div  x-data='main()'>
        @if ($editSale)
            <x-jet-button>
                <i class="fas fa-pen"></i>
            </x-jet-button>
        @else
            <x-jet-button @click="open_create" >
                Crear Nueva Venta
            </x-jet-button>
        @endif



        <div  class="hidden" :class="{'hidden': !open}" >
            <div class="bg-gray-500 w-full h-full fixed top-0 right-0 left-0 bottom-0 opacity-50 z-10 "></div>     
            <div class="absolute bg-white rounded-lg shadow-xl top-0 right-0 left-0 z-10 mt-4 mx-auto max-w-4xl">
                <div class="px-6 pt-4">
                    <div class="grid grid-cols-2">
                        <div class="text-lg">
                            <h2 class="py-4">Crear Venta</h2>
                        </div>
                        <div class="mb-4">
                            <x-jet-label value='Fecha '></x-jet-label>
                            <x-jet-input type='date' class="w-full" wire:model.lazy="fecha">Fecha</x-jet-input>
                            
                        </div> 
                    </div>
                    <div class="mb-4">
                        @livewire('admin.customer.search-customer')
                    </div>
                </div> 


                @if ($customerId>0)
                    {{-- DELIVERY --}}
                    <div class="px-6">
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
                        <div x-show="delivery" class="w-full border rounded p-4 my-3 ">
                            <h2 class="font-bold text-lg my-2">Comuna de despacho {{($selectedCustomer)?$selectedCustomer->comuna:""}}</h2>

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-jet-label value="Valor despacho"></x-jet-label>
                                    <x-jet-input class="w-full" wire:model="valor_despacho"></x-jet-input>
                                </div>
                                <div>
                                    <x-jet-label value="Fecha de entrega"></x-jet-label>
                                    <x-jet-input type="date" class="w-full" wire:model="fecha_entrega"></x-jet-input>
                                </div>
                            </div>
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
                            
                        </div>



                    </div>



                    {{-- ITEMS --}}
                    <div class="px-6 pt-4 ">
                        @if (session()->has('venta.items') && count(session('venta.items')) > 0)
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
                                            @foreach (session('venta.items') as $key => $item)
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
                    
                    


                    {{-- BOTON AGREGAR ITEM --}}
                    <div class="px-6 py-4 flex justify-between">                
                        <x-jet-button wire:click="open_add_item()">Agregar item</x-jet-button> 
                        {{-- <x-jet-danger-button wire:click='eliminarTodo()'>
                            Borrar items
                        </x-jet-danger-button> --}}
                    </div>

                    {{-- TOTAL --}}
                    <div class="flex justify-end p-4">
                        @if ($delivery)
                            <div class="grid grid-cols-2 max-w-xs gap-3">
                                <div>Sub Total</div>
                                <div>${{ number_format(session('venta.total'),0,',','.') }}</div>
                                <div>Delivery</div>
                                <div>@if($valor_despacho>0)
                                        ${{ number_format($valor_despacho,0,',','.') }}
                                    @else
                                        $0
                                    @endif
                                </div>
                                <div>Total</div>
                                <div>
                                    @if($valor_despacho>0)
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
                    <div class="px-6">
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
                    <div class="px-6 my-6">
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
                        <div x-show="openComentario" class="w-full border rounded p-4 my-3 ">
                            <h2 class="font-bold text-lg my-2">Ingresa un comentario</h2>
                            <textarea wire:model="comentario" name="" id="" cols="10" rows="2" class="w-full"></textarea>
                            
                        </div>
                    </div>


                @endif
            
                {{-- FOOTER --}}
                @if (session()->has('venta.items') && count(session('venta.items')) > 0)
                    <div class="px-6 py-6 bg-gray-100 rounded-lg flex items-center justify-between">
                        <x-jet-secondary-button wire:click="save()">Crear venta</x-jet-button>
                        <x-jet-button @click="open=false">Cerrar</x-jet-button>
                    </div>
                @else
                    <div class="px-6 py-6 bg-gray-100 rounded-lg text-right">
                        <x-jet-button @click="open=false">Cerrar</x-jet-button>
                    </div>
                @endif
               
                   
           
               
           
       

               {{--AGREGAR MODIFICAR  ITEMS --}}
               @if ($open_add_item)
                       <div  class="z-10" x-show="open_add_item" >
                           <div class="fixed top-0 left-0 right-0 bottom-0 bg-gray-900 opacity-75 z-10"></div>
                           <div class="fixed top-px left-0 right-0 my-5 mx-auto  shadow rounded-xl max-w-2xl bg-white z-10">
                               <div class="pt-4 px-4">
                                   <h2 class="py-2 px-1 text-xl font-bold text-gray-600">
                                       @if ($modItem)
                                           Modificar Item
                                       @else
                                           Agregar Item
                                       @endif
                                   </h2>
                                   <div class="w-full"
                                       @click.away="open_list=false" 
                                   >
                                       <x-jet-input class="w-full" placeholder='Buscar producto...' 
                                           wire:model='search' 
                                           {{-- wire:click="$set('open_list',true)" --}}
                                           @click="open_list=true"
                                       />
                                       
                                        <div x-show='open_list' class="absolute bg-white shadow-2xl rounded-lg mr-4 border ">
                                           {{-- ETIQUETAS --}}
                                            <div class="p-4">
                                                <div class="flex items-center justify-between">
                                                    <div x-show="!showTags"   x-transition:enter="transition duration-200 transform ease-out" x-transition:enter-start="scale-75" class="cursor-pointer text-sm font-bold flex items-center gap-2" @click="toggleShowTags">
                                                        <div>Abrir Etiquetas </div>
                                                        <i class="fas fa-chevron-circle-right"></i>
                                                    </div>
                                                    <div x-show="showTags" x-transition:enter="transition duration-200 transform ease-out" x-transition:enter-start="scale-75">
                                                        <div class="inline-block p-2 m-1 font-semibold rounded-xl hover:bg-blue-500 cursor-pointer  @if($tagId == "") bg-blue-900 text-white @else text-blue-800 bg-blue-200  @endif" wire:click="selectTag('')">
                                                            Todos
                                                        </div>
                                                        @foreach ($tags as $tag)
                                                            <div class="inline-block p-2 m-1  font-semibold rounded-xl hover:bg-blue-500 cursor-pointer @if($tagId == $tag->id)  text-white bg-blue-900 @else bg-blue-200 text-blue-800 @endif" wire:click="selectTag({{ $tag->id }})">
                                                                {{$tag->name}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                   
                                                    <div x-show="showTags"  
                                                        x-transition:enter="transition duration-200 transform ease-out"
                                                        x-transition:enter-start="scale-75"
                                                        x-transition:leave="transition duration-100 transform ease-in"
                                                        x-transition:leave-end="opacity-0 scale-90"
                                                        class="cursor-pointer text-sm font-bold flex items-center gap-2" @click="toggleShowTags">
                                                      <i class="fas fa-chevron-circle-left"></i>  
                                                      <div>Cerrar Etiquetas </div>
                                                    </div>
                                                </div>
                                              
                                           </div>
                                       
                                           {{-- LISTA PRODUCTOS --}}
                                           <div class=" overflow-auto" style="max-height: 60vh">
                                               @if (count($products))
                                                   @foreach ($products as $product)
                                                       <div class="flex justify-between items-center hover:shadow-lg pt-2 pb-2 pl-2 pr-6 hover:transform hover:scale-50 cursor-pointer" 
                                                           data-product_id='{{$product->id}}'
                                                           wire:click="seleccionar({{$product->id}})"
                                                           wire:keydown.enter="seleccionar({{$product->id}})"
                                                       
                                                           {{-- @click="seleccionarProducto" --}}
                                                       >
                                                           <div class="flex items-center">
                                                               @if ($product->image)
                                                                    <img class="object-contain h-24 w-24" src="{{ Storage::url($product->image->url) }}" alt="">
                                                               @endif
                                                               <div>
                                                                   <div class="text-center font-semibold text-gray-600">{{$product->name}} </div>
                                                                   <div class="text-gray-400 font-bold text-sm">{{$product->brand->name}}</div>
                                                               </div>
                                                           </div>
                                                           <div class="flex items-center">
                                                               <div class="mr-6">
                                                                   @foreach ($product->salePrices as $price)
                                                                   <div class="text-sm">
                                                                       {{$price->quantity}} x  ${{number_format($price->total_price,0,',','.')}}
                                                                       @if ($price->quantity>1)
                                                                           (${{  number_format($price->price,0,',','.') }})
                                                                       @endif
                                                                   </div>   
                                                                   
                                                                   @endforeach
                                                               </div>

                                                               <div class="text-gray-400 text-center">
                                                                   <div class="text-xl">
                                                                       {{$product->stock}}
                                                                   </div>
                                                                   <div class="text-sm">
                                                                       Stock 
                                                                   </div>
                                                               </div>
                                                           </div>
                                                           
                                                       </div>
                                                   @endforeach
                                               @else
                                                   <div class="hover:shadow-lg p-2 hover:transform hover:scale-50 text-lg " >
                                                       @if ($tagId =="")
                                                           <div class="text-center font-semibold text-gray-600"> No hay productos con nombre "{{$search}}" </div> 
                                                       @else
                                                           @if ($search == "")
                                                               <div class="text-center font-semibold text-gray-600"> No hay "{{$tagName}}"</div>    
                                                           @else
                                                               <div class="text-center font-semibold text-gray-600"> No hay "{{$tagName}}" con nombre "{{$search}}" </div> 
                                                           @endif
                                                       @endif
                                                   </div>
                                               @endif
                                           </div>
                                       </div> 
                                   </div>
                                   
                               </div>
                                                   
                               @if ($selected_product)

                                   <div class="px-4 m-4 mb-0 sm:mb-4 flex items-center justify-between">
                                       <div class="flex items-center">
                                            @if ($selected_product->image)
                                                <img class="object-contain h-24 w-24 mr-4" src="{{Storage::url($selected_product->image->url)}}" alt=""> 
                                            @endif
                                           <div class="">
                                               <h2 class="text-xl font-bold text-gray-800">{{$selected_product->name}}</h2>
                                               <div class="flex items-start text-sm font-semibold text-gray-400">
                                                   <div class="mr-4">
                                                       @foreach ($selected_product->salePrices as $price)
                                                           <div>desde {{$price->quantity}} un.  ${{number_format($price->price,0,',','.')}}</div>  
                                                       @endforeach
                                                   </div>
                                                   <div>
                                                       {{$selected_product->formato}} un. x caja
                                                   </div>
                                               </div>
                                               
                                           </div>
                                       </div>
                                       <div class="text-center">
                                           <div class="text-xl font-bold text-gray-800">{{$selected_product->stock}}</div>
                                           <div class="text-sm font-semibold">Stock</div>
                                       
                                       </div>
                                   </div>
                                   
                                   <div class="colspan-2 grid grid-cols-3 gap-x-6 p-4 pt-0 sm:pt-4">

                                       <div>
                                           <x-jet-label value="Cantidad"/> 
                                           <x-jet-input  wire:ignore  class="w-full" id='cantidad'  @keyup='calculo' value="{{$cantidad}}" />
                                           @error('cantidad') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                       </div>
                                       <div>
                                           <x-jet-label value="CantidadXcaja"/> 
                                           <x-jet-input wire:ignore  id='cantidad_por_caja'  class="w-full"  @keyup='calculo' value='{{$cantidad_por_caja}}'/>
                                           @error('cantidad_por_caja') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                       </div>

                                       <div>
                                           <x-jet-label value="CantidadTotal"/> 
                                           <x-jet-input wire:ignore   id='cantidad_total'  class="w-full"  readonly value="{{$cantidad_total}}" />
                                           @error('cantidad_total') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                       </div>

                                       {{-- PRECIO --}}
                                       <div>
                                           <x-jet-label value="PrecioXUnidad"/> 
                                           <div @click.away="open_precio=false">
                                               <x-jet-input wire:ignore  id='precio'  class="w-full"  @keyup='calculo_por_unitario'  @click="open_precio=true"  value="{{$precio}}" />
                                           
                                               <div x-show="open_precio" class="absolute bg-white shadow-xl">
                                                   @foreach ($selected_product->salePrices as $price)
                                                   <div class="hover:bg-gray-300 cursor-pointer p-2 w-full" @click="set_precio" data-precio="{{$price->price}}">
                                                       desde {{$price->quantity}} un.  ${{number_format($price->price,0,',','.')}}
                                                   </div>  
                                                   @endforeach
                                               </div>
                                               @error('precio') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                           </div>
                                       </div>
                                       {{-- PRECIO POR CAJA --}}
                                       <div>
                                           <x-jet-label value="PrecioXCaja"/> 
                                           <div @click.away="open_precio_por_caja=false">
                                               <x-jet-input wire:ignore  id='precio_por_caja'  class="w-full"  @keyup='calculo_por_caja' @click="open_precio_por_caja=true"  value="{{$precio_por_caja}}" />
                                               <div x-show="open_precio_por_caja" class="absolute bg-white shadow-xl">
                                                   @foreach ($selected_product->salePrices as $price)
                                                   <div class="hover:bg-gray-300 cursor-pointer p-2 w-full" @click="set_precio_por_caja" data-precio_por_caja="{{$price->total_price}}">
                                                       desde {{$price->quantity}} un.  ${{number_format($price->total_price,0,',','.')}}
                                                   </div>  
                                                   @endforeach
                                               </div>
                                               @error('precio_por_caja') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                           </div>
                                       </div>

                                       {{-- PRECIO TOTAL --}}
                                       <div>
                                           <x-jet-label value="PrecioTotal"/> 
                                           <x-jet-input wire:ignore  id='precio_total' class="w-full"  @keyup='calculo' readonly value="{{$precio_total}}" />
                                           @error('precio_total') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                       </div>
                                   </div>
                               @endif
                               <div class="flex justify-between m-8">
                                   <div>  
                                       @if ($modItem)
                                           <x-jet-button wire:click="modItem()">Modificar item</x-jet-button>  
                                       @elseif($selected_product)
                                           <x-jet-button wire:click="addItem()">Agregar item</x-jet-button>                                
                                       @endif  
                                   </div>
                                   <div>
                                       <x-jet-button @click="open_add_item=false">Cerrar</x-jet-button>
                                   </div>
                               </div>
                           </div>
                       </div>
               
               @endif
           

           </div>


       
        </div>

    </div>
   
 
    @push('js')
            <script>
                function main(){
                    return {
                            showTags:@entangle('showTags'),
                            toggleShowTags(){
                                this.showTags = !this.showTags
                            },
                        
                            search:@entangle('search'),

                            open: @entangle('open'),
                            open_add_item: @entangle('open_add_item'),
                            open_mod_item: @entangle('open_mod_item'),
                            open_list: @entangle('open_list'),

                            product_id:@entangle('product_id'),
                            image:@entangle('image'),
                            name:@entangle('name'),
                            cantidad:@entangle('cantidad'),
                            cantidad_por_caja:@entangle('cantidad_por_caja'),
                            cantidad_total:@entangle('cantidad_total'),
                            precio:@entangle('precio'),
                            precio_por_caja:@entangle('precio_por_caja'),
                            precio_total:@entangle('precio_total'),

                            delivery: @entangle('delivery'),
                            
                            openComentario: @entangle('openComentario'),


                            open_precio:false,
                            open_precio_por_caja:false,

                            open_create:function(){
                                this.open=true;
                                setTimeout(() => {
                                    document.getElementById('search').focus();
                                }, 400);
                            },
                        

                            
                            modificar_item:function(pid){
                                console.log(pid);
                                Livewire.emit('seleccionar',pid);  
                                this.open_add_item=true;
                            },



                            set_precio:function(){
                                this.precio = event.target.dataset['precio'];
                                this.open_precio=false;
                                document.getElementById('precio').value = Math.round(this.precio); 
                                this.calculo_por_unitario();

                            },
                            set_precio_por_caja:function(){
                                this.precio_por_caja = event.target.dataset['precio_por_caja'];
                                this.open_precio_por_caja=false;
                                document.getElementById('precio_por_caja').value = Math.round(this.precio_por_caja) ; 
                                this.calculo_por_caja();
                            },

                        
                        
                            calculo:function(){
                                this.cantidad = document.getElementById('cantidad').value;
                                this.cantidad_por_caja = document.getElementById('cantidad_por_caja').value;
                                this.cantidad_total =this.cantidad * this.cantidad_por_caja;
                                document.getElementById('cantidad_total').value = this.cantidad_total; 

                                this.precio = document.getElementById('precio').value;
                                this.precio_por_caja = this.precio * this.cantidad_por_caja;
                                this.precio_total = this.cantidad * this.precio_por_caja;
                                document.getElementById('precio_por_caja').value = this.precio_por_caja; 
                                document.getElementById('precio_total').value = this.precio_total; 
                            },
                            calculo_por_unitario:function(){
                                this.precio = document.getElementById('precio').value;
                                this.precio_por_caja = this.precio * this.cantidad_por_caja;
                                this.precio_total = this.cantidad * this.precio_por_caja;
                                document.getElementById('precio_por_caja').value = this.precio_por_caja; 
                                document.getElementById('precio_total').value = this.precio_total; 
                            },
                            calculo_por_caja:function(){
                                this.precio_por_caja = document.getElementById('precio_por_caja').value;
                                this.precio = this.precio_por_caja / this.cantidad_por_caja 
                                this.precio_total = this.cantidad * this.precio_por_caja;
                                document.getElementById('precio').value = this.precio; 
                                document.getElementById('precio_total').value = this.precio_total; 
                            }
                        

                    }
                }
            </script>
    @endpush
</div>
