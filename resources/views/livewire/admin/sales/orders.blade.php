<div  class="text-gray-800"  x-data="{loading:false}">
    <div class="hidden" :class="{'hidden' : !loading}">
        <x-spinner.spinner2></x-spinner.spinner2>
    </div>
    <div wire:loading wire:target="search">
        <x-spinner.spinner2></x-spinner.spinner2>
    </div>
    
    <div>
        <div class="flex justify-between items-center gap-4">    
            <div class="flex items-center gap-2">
                <div x-on:click="loading= true; $wire.$set('filter',1).then(()=>loading=false);" class="p-2 shadow @if($filter==1) bg-gray-600 text-white @else cursor-pointer @endif" >hoy</div>
                <div x-on:click="loading= true; $wire.$set('filter',2).then(()=>loading=false);"  class="p-2 shadow @if($filter==2) bg-gray-600 text-white @else cursor-pointer @endif" >3 días</div>
                <div x-on:click="loading= true; $wire.$set('filter',3).then(()=>loading=false);"  class="p-2 shadow @if($filter==3) bg-gray-600 text-white @else cursor-pointer @endif" >7 días</div>            
                <div x-on:click="loading= true; $wire.$set('filter',4).then(()=>loading=false);"  class="p-2 shadow @if($filter==4) bg-gray-600 text-white @else cursor-pointer @endif" >30 días</div>            
                <div x-on:click="loading= true; $wire.$set('filter',5).then(()=>loading=false);"  class="p-2 shadow @if($filter==5) bg-gray-600 text-white @else cursor-pointer @endif" >este mes</div>            
                
                @if ($filter==5)
                   Ventas totales ${{number_format($sales->sum('total'),0,',','.')}}
                @endif
            </div>
            <div class="pr-4">
            
                @if ($sales->count()== 1)
                {{$sales->count()}}  resultado
                @elseif ($sales->count()> 1)
                {{$sales->count()}} 
                resultados
                @endif
            </div>
        </div>
        <div class="my-2">
            <x-jet-input type="search" placeholder="Ingresa nombre" class="w-full" wire:model.debounce.500ms="search"></x-jet-input>
        </div>
    </div>
    <div class="overflow-auto h-full">
        <x-table>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class=" px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider ">Nombre</th>
                        <th class=" px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider  text-left">EstadoPago</th>
                        <th class=" px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider  text-left">FechaReparto</th>
                        <th class=" px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider  text-left">Comentario</th>
                    
                        <th class=" px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider  text-right">Total</th>
                        <th class=" px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider  text-right"></th>
                    
        
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($sales->count())                   
                        @foreach ($sales as $sale)
                            <tr class="border-b border-gray-200 hover:bg-gray-100" id="sale_{{$sale}}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div>
                                            @if ($sale->sale_type== 1)
                                                @if ($sale->created_by())
                                                    <img class="h-8 w-8 rounded-full" src="{{ $sale->created_by()->profile_photo_url }}" alt="">
                                                @else
                                                    
                                                @endif
                                                
                                            @elseif ($sale->sale_type== 2)  
                                                <i class="fas fa-shopping-cart"></i>
                                            @elseif ($sale->sale_type== 3)  
                                                <i class="fas fa-user"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class=" text-sm text-gray-900">{{$sale->customer->name}}</div>
                                            <div class=" text-sm text-gray-500">{{$sale->customer->direccion}}</div>
                                        </div>
                             
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($sale->payment_status == 1)
                                        <div class="text-yellow-300">
                                            Pendiente
                                        </div>
                                        <x-jet-button class="bg-green-300 hover:bg-green-400">Pagar</x-jet-button>
                                    @elseif  ($sale->payment_status == 2)
                                        <div class=" p-1 text-orange-300">
                                            Abonado
                                        </div>
                                    @else
                                        <div class="font-semibold text-green-300">
                                            Pagado
                                            <i class="fas fa-check ml-2"></i> 
                                        </div>
                                        <div>
                                            {{ Str::substr(Helper::fecha($sale->payment_date)->dayName, 0, 3)  }} {{ Helper::fecha($sale->payment_date)->format('d') }} {{ Str::substr(Helper::fecha($sale->payment_date)->monthName, 0, 3)  }}</td>        
                                        </div>
                                    @endif
                                    
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-left">
                                    <div class="">
                                        <div>
                                            @if ($sale->delivery == 0)
                                                Bodega
                                            @else
                                                @if ($sale->date_delivered != null)
                                                    <div class="text-green-300 font-semibold">
                                                        Entregado
                                                        <i class="fas fa-check ml-2"></i> 
                                                    </div>
                                                @else
                                                    <div class="text-yellow-300">
                                                        Entregar
                                                        {{-- <i class="far fa-clock"></i> --}}
                                                    </div>
                                                    
                                                @endif
                                            @endif
                                        </div>
                                        <div>
                                            @if ($sale->delivery == 1)
                                                <div class="flex items-center gap-2">
                                                    <div>
                                                        {{ Str::substr(Helper::fecha($sale->delivery_date)->dayName, 0, 3)  }} {{ Helper::fecha($sale->delivery_date)->format('d') }} {{ Str::substr(Helper::fecha($sale->delivery_date)->monthName, 0, 3)  }}
                                                    </div>
                                                    @if ($sale->date_delivered == null)
                                                        <div x-data="{showEditDate:false,loading:false}" id="changeDeliveryDate_{{$sale->id}}" class="cursor-pointer text-xs ">
                                                            <div x-on:click="showEditDate=true" class="p-2 text-xs text-gray-400 hover:text-gray-600 cursor-pointer" >
                                                                <i class="fas fa-pen"></i>
                                                            </div>
                                                            <div x-show="showEditDate" class="hidden" :class="{'hidden': !showEditDate}">
                                                                <x-modal.modal2>
                                                                    <div class="p-4 relative">
                                                                        <div class="hidden" :class="{'hidden': !loading}">
                                                                            <x-spinner.spinner2></x-spinner.spinner2>
                                                                        </div>
                                                                        <div class="flex items-center justify-between gap-4">
                                                                            <h2 class="text-xl text-gray-800 text-center font-bold"> Cambiar fecha </h2>
                                                                            <div x-on:click="showEditDate = !showEditDate" class="p-2 px-3 border rounded-full hover:bg-red-600 hover:text-white">
                                                                                <i class="fas fa-times"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="my-4 flex flex-col gap-2">
                                                                            <div>

                                                                                {{$sale->customer->name}}
                                                                            </div>
                                                                            <div>
                                                                                {{$sale->customer->direccion}}
                                                                            </div>

                                                                            <x-jet-input x-ref="delivery_date" type="date" value="{{$sale->delivery_date}}"></x-jet-input>

                                                                        </div>
                                                                        <div class="flex justify-between gap-4 items-center mt-4">
                                                                            <x-jet-button x-on:click="loading=true;$wire.changeDeliveryDate({{$sale->id}},$refs.delivery_date.value).then((fecha)=>{loading=false;showEditDate = !showEditDate;toast('Fecha reparto de {{$sale->customer->name}} cambiada!!','success')})">Cambiar</x-jet-button>
                                                                            <x-jet-danger-button  x-on:click="showEditDate = !showEditDate" >Cancelar</x-jet-danger-button>
                                                                        </div>
                                                                    </div>
                                                                </x-modal.modal2>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td> 
                                <td class="px-6 py-4 whitespace-nowrap text-left">
                                    <div class="flex gap-2">                           
                                        @if (Str::length($sale->comments)>10)
                                            <x-tooltip.tooltip>
                                                <x-slot name="tooltip">
                                                    <div class="p-4">
                                                        {{$sale->comments}}
                                                    </div>
                                                </x-slot>
                                                <div class="cursor-default">
                                                    {{Str::limit($sale->comments,10)}}
                                                </div>
                                            </x-tooltip.tooltip>

                                        @else
                                            {{$sale->comments}}
                                        @endif
                                        <div id="comment_{{$sale->id}}" x-data="{showEditComment:false,loading:false}">
                                            <div x-on:click="showEditComment=true" class="p-2 text-xs text-gray-400 hover:text-gray-600 cursor-pointer">
                                                @if ($sale->comments)
                                                    <i class="fas fa-pen"></i>
                                                @else
                                                    <i class="fas fa-plus"></i>
                                                @endif
                                            </div>                                   
                                            <div x-show="showEditComment" class="hidden" :class="{'hidden':!showEditComment}">
                                                <x-modal.modal2>
                                                    <div class="p-4 relative">
                                                        <div class="hidden" :class="{'hidden': !loading}">
                                                            <x-spinner.spinner2></x-spinner.spinner2>
                                                        </div>
                                                        <div class="flex items-center justify-between gap-4">
                                                            <h2 class="text-xl text-gray-800 text-center font-bold"> Editar comentario </h2>
                                                            <div x-on:click="showEditComment = !showEditComment" class="p-2 px-3 border rounded-full hover:bg-red-600 hover:text-white">
                                                                <i class="fas fa-times"></i>
                                                            </div>
                                                        </div>
                                                        <div class="my-4 flex flex-col gap-2">
                                                            <div>

                                                                {{$sale->customer->name}}
                                                            </div>
                                                            <div>
                                                                {{$sale->customer->direccion}}
                                                            </div>

                                                            <textarea x-ref="comment" class="border rounded p-4">{{$sale->comments}}</textarea>

                                                        </div>
                                                        <div class="flex justify-between gap-4 items-center mt-4">
                                                            <x-jet-button x-on:click="loading=true;$wire.editComment({{$sale->id}},$refs.comment.value).then(()=>{loading=false;showEditComment = !showEditComment;toast('Comentario de {{$sale->customer->name}} cambiado!!','success')})">Cambiar</x-jet-button>
                                                            <x-jet-danger-button  x-on:click="showEditComment = !showEditComment" >Cancelar</x-jet-danger-button>
                                                        </div>
                                                    </div>
                                                </x-modal.modal2>

                                            </div>
                                        </div>
                                        
                                    </div>
                                </td> 
                                <td class="px-6 py-4 whitespace-nowrap"> 
                                    <div>
                                        @if ($sale->delivery_value>0)
                                            <div class="text-right">
                                                ${{ number_format($sale->subtotal,0,',','.') }}
                                            </div> 
                                            <div class="text-right">
                                            <i class="fas fa-truck text-gray-400 text-xs"></i>   <span class=" border-b"> ${{ number_format($sale->delivery_value,0,',','.') }} </span>
                                            </div>
                                        @endif
                                        <div class="text-right">
                                            ${{ number_format($sale->total,0,',','.') }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">


                                
                                    <div class="flex items-center gap-2">

                                        @if ($sale->payment_status == 3  )
                                            @if ($sale->boleta != 1)
                                                <div x-data="{loading:false}" id="generateTicket_{{$sale->id}}" class="relative">                                        
                                                    <x-jet-button x-on:click="loading=true; $wire.generateTicket({{ $sale }}).then(()=>loading=false)" class="bg-yellow-300 hover:bg-yellow-400" title="Generar Boleta">
                                                        <i class="fas fa-file-alt"></i>
                                                    </x-jet-button>
                                                    <div class="hidden" :class="{'hidden':!loading}">
                                                        <x-spinner.spinner2 size="8"></x-spinner.spinner2>
                                                    </div>
                                                </div>
                                            @else
                                                <x-jet-button class="bg-green-300 hover:bg-green-400" title="Boleta generada por {{ $sale->boletaBy()->name}} el {{ Helper::fecha($sale->fecha_boleta)->format('d-m')}} a las {{ Helper::fecha($sale->fecha_boleta)->format('H:i')}} hrs.">
                                                    <i class="fas fa-file-alt"></i>
                                                </x-jet-button>
                                            @endif
                                        @endif

                                        <div x-data="{open:false}" id='showOrder_{{$sale->id}}'>
                                            <x-jet-button x-on:click="open =!open"><i class="far fa-eye"></i></x-jet-button>
                                            
                                            <div class="hidden" :class="{'hidden':!open}">
                                                <x-modal.modal2>
                                                    <div id="imprimible_{{$sale->id}}"  class="px-4 py-2">
                                                        <div class="flex items-center justify-between gap-4 mb-2">
                                                            <h2 class="text-2xl text-gray-500 font-bold">Detalle de venta</h2>
                                                           
                                                       
                                                            <div x-on:click="open=!open" class="p-2 px-3 cursor-pointer">
                                                                <i class="fas fa-times"></i>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class=" text-gray-500 flex items-center justify-between gap-8">
                                                            <div>
                                                                {{$sale->customer->name}}
                                                            </div>
                                                            <div>
                                                                {{$sale->customer->celular}}
                                                            </div>
                                                        </div>
                                                        <div class="text-gray-500 my-2">
                                                            {{$sale->customer->direccion}}
                                                        </div>
                                                        @if ($sale->delivery)
                                                            <div class="text-gray-500 ">
                                                            Despacho para el <span class="font-bold uppercase">{{Helper::fecha($sale->delivery_date)->dayName}}</span> {{Helper::fecha($sale->delivery_date)->format('d')}} {{Helper::fecha($sale->delivery_date)->monthName}}
                                                        </div>
                                                        @endif
                                                        @if ($sale->comments)
                                                            <div class="text-gray-500 ">
                                                                {{$sale->comments}}
                                                            </div>
                                                        @endif
                                                       
                                                        
                                                        
                                                        <div class="my-4">
                                                            <x-table>
                                                                <table class="table">
                                                                    <thead class="text-gray-500 font-bold">
                                                                        <tr>
                                                                            <th>Producto</th>
                                                                            <th>Total</th>
                                                                        
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="text-gray-500 ">
                                                                        @foreach ($sale->sale_items as $item)
                                                                            <tr>
                                                                                <td> {{$item->cantidad}} x {{$item->cantidad_por_caja}} {{$item->product->name}}</td>
                                                                                <td>${{number_format($item->precio_total,0,',','.')}}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </x-table>

                                                            
                                                        </div>
                                                        @if ($sale->delivery)
                                                            <div class="flex justify-between items-center gap-4 mt-2  text-gray-500">
                                                                <div>SubTotal</div>
                                                                <div>${{number_format($sale->subtotal,0,',','.')}}</div>
                                                            </div>
                                                            <div class="flex justify-between items-center gap-4 mt-2  text-gray-500 border-b">
                                                                <div>Valor despacho</div>
                                                                <div>${{number_format($sale->delivery_value,0,',','.')}}</div>
                                                            </div>
                                                        @endif
                                                    
                                                        <div class="flex justify-between items-center gap-4 mt-2 text-gray-500 font-bold">
                                                            <div>Total</div>
                                                            <div class="text-xl">${{number_format($sale->total,0,',','.')}}</div>
                                                        </div>

                                                        @if ($sale->payment_status == 3)
                                                            <div class="text-green-800 text-center bg-green-200 p-1 my-2"> Pagado <i class="fas fa-check"></i></div>
                                                        @endif
                                                        @if ($sale->payment_status < 3)
                                                            <div class="text-yellow-400  text-center bg-yellow-200 p-1 my-2"> Pago Pendiente</div>
                                                        @endif
                                                       
                                                    </div>
                                                </x-modal.modal2>
                                            </div>
                                        </div>

                                        @if ($sale->payment_status != 3  || auth()->user()->id == 1)
                                            <div id="deleteOrder_{{$sale->id}}" x-data="{deleteSale:false,loading:false,editSale:false}" class="flex items-center gap-2">
                                                <div class="hidden" :class="{'hidden':!loading}">
                                                    <x-spinner.spinner2></x-spinner.spinner2>
                                                </div>
                                                <x-jet-button x-on:click="loading=true; editSale=true; $wire.setOrderEdit({{ $sale->id}}).then(()=>loading=false)" class="bg-yellow-200 hover:bg-yellow-400"><i class="fas fa-pen"></i></x-jet-button>
                                                @if ($editSale[$sale->id])
                                                    <span class="hidden" :class="{'hidden': !editSale}">
                                                        <x-modal.modal_screen >
                                                            <div>
                                                                <div class="flex items-center justify-between bg-yellow-300 ">
                                                                    <div></div>
                                                                    <h2 class=" text-gray-800 text-xl font-bold text-center p-2 mb-2">Modificar Pedido</h2>
                                                                    <div x-on:click=" editSale=false;$wire.setOrderEditFalse({{$sale->id}})" class="hover:bg-gray-600 p-4">
                                                                        <i class="fas fa-times"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="" style="height: calc(100vh - 140px)">
                                                                    @livewire('admin.sales.edit-order', ['sale' => $sale], key( $sale->id))
                                                                </div>
                                                            </div>
                                                        </x-modal.modal_screen>
                                                    </span>
                                                @endif
                                                
                                                <x-jet-button x-on:click="deleteSale=true" class="bg-red-500 hover:bg-red-700"><i class="fas fa-trash"></i></x-jet-button>

                                                <div x-show="deleteSale" class="hidden" :class="{'hidden': !deleteSale}">
                                                    <x-modal.modal2>
                                                        <div class="p-4">
                                                            <h2 class="my-4 text-xl font-bold">¿Seguro desea eliminar la venta {{$sale->id}} de {{$sale->customer->name}}?</h2>
                                                            <div class="flex gap-4">
                                                                <x-jet-danger-button x-on:click="$wire.deleteSale({{ $sale }})" >Si, eliminar</x-jet-button>
                                                                    <x-jet-button x-on:click="deleteSale=false">No por favorsito</x-jet-button>
                                                            </div>
                                                        </div>
                                                    </x-modal.modal2>
                                                </div>
                                            </div> 
                                          
                                          
                                        @endif

                                       
                                        
                                       
                                    </div>
                                </td>
                            </tr>
                    
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="">
                                <div class="h-full p-4 text-gray-400 text-xl">
                                    No hay pedidos para mostrar...
                                </div>
                            </td>
                        </tr>
                    @endif
                    
                </tbody>
            </table>
        </x-table>
    </div>


   
   
</div>
