<div x-data="ventas()">
    <x-slot name='titulo'>Lista de Ventas</x-slot>
    
    <div class="py-4 flex items-center">
        <x-jet-input wire:model='search' class="flex-1 mr-4" type="" placeholder='Buscar palabra...'  />
        @livewire('admin.sales.create-sale', ['user' => ''])
    </div>
    
    <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    {{-- ID --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer @if ($sort == 'sales.id' ) font-bold text-gray-700 @endif" style="" wire:click="order('sales.id')">
                        <div class="flex justify-center items-center ">
                            <div>
                                Id 
                            </div>
                            <div class="pl-2">  
                                @if ($sort == 'sales.id' )
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort"></i> 
                                @endif
                            </div>
                                
                        </div>
                    </th>
                    {{-- CLIENTE --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer  @if ($sort == 'customers.name' ) font-bold text-gray-700 @endif" wire:click="order('customers.name')">
                        <div class="flex justify-center items-center ">
                            <div>
                                Cliente 
                            </div>
                            <div class="pl-2"> 
                                @if ($sort == 'customers.name' )
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort"></i> 
                                @endif
                            </div>
                        </div>
                    </th>
                    {{-- DIRECCION --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer  @if ($sort == 'customers.direccion' ) font-bold text-gray-700 @endif " wire:click="order('customers.direccion')">
                        <div class="flex justify-center items-center ">
                            <div>
                                Direccion
                            </div>
                            <div class="pl-2"> 
                                @if ($sort == 'customers.direccion' )
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort"></i> 
                                @endif
                            </div>
                        </div>
                    </th>
                    {{-- TOTAL --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer  @if ($sort == 'sales.total' ) font-bold text-gray-700 @endif " wire:click="order('sales.total')">
                        
                        <div class="flex justify-center items-center ">
                            <div>
                                Total
                            </div>
                            <div class="pl-2"> 
                                @if ($sort == 'sales.total' )
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort"></i> 
                                @endif
                            </div>
                        </div>
                    </th>
                    {{-- ESTADO PAGO --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer @if ($sort == 'sales.payment_status' ) font-bold text-gray-700 @endif " wire:click="order('sales.payment_status')">
                        
                        <div class="flex justify-center items-center ">
                            <div>
                                Estado Pago
                            </div>
                            <div class="pl-2"> 
                                @if ($sort == 'sales.payment_status' )
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort"></i> 
                                @endif
                            </div>
                        </div>
                    </th>
                    {{-- ESTADO DELIVERY --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer @if ($sort == 'sales.delivery_stage' ) font-bold text-gray-700 @endif " wire:click="order('sales.delivery_stage')">
                        
                        <div class="flex justify-center items-center ">
                            <div>
                                Estado Delivery
                            </div>
                            <div class="pl-2"> 
                                @if ($sort == 'sales.delivery_stage' )
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort"></i> 
                                @endif
                            </div>
                        </div>
                    </th>
                    {{-- FECHA VENTA --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer @if ($sort == 'sales.date' ) font-bold text-gray-700 @endif " wire:click="order('sales.date')">
                        <div class="flex justify-center items-center ">
                            <div>
                                Fecha Venta 
                            </div>
                            <div class="pl-2"> 
                                @if ($sort == 'sales.date' )
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort"></i> 
                                @endif
                            </div>
                        </div>
                    </th>
                    {{-- FECHA DE PAGO --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer @if ($sort == 'sales.payment_date' ) font-bold text-gray-700 @endif " wire:click="order('sales.payment_date')">
                        <div class="flex justify-center items-center ">
                            <div>
                                Fecha Pago 
                            </div>
                            <div class="pl-2"> 
                                @if ($sort == 'sales.payment_date' )
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort"></i> 
                                @endif
                            </div>
                        </div>
                    </th>
                    {{-- VENTA POR --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer @if ($sort == 'sales.user_created' ) font-bold text-gray-700  @endif " wire:click="order('sales.user_created')">
                        <div class="flex justify-center items-center ">
                            <div>
                                VentaPor
                            </div>
                            <div class="pl-2"> 
                                @if ($sort == 'sales.user_created' )
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort"></i> 
                                @endif
                            </div>
                        </div>
                    </th>
                    {{-- COMENTARIOS --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        <div>Comentarios</div>
                    </th>
                    {{-- ACCION --}}
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer ">
                        Accion
                        {{-- <span class="sr-only">Accion</span> --}}
                    </th>
                </tr>
            </thead>
            
            <tbody class="bg-white divide-y divide-gray-200">
               @foreach ($sales as $sale)
                <tr>
                    {{-- ID --}}
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            {{$sale->id}}
                        </div>
                    </td>
                   {{-- NOMBRE Y DIRECCION --}}
                    <td class="px-6 py-4 " colspan="2">
                        <div class="" style="max-width: 200px;" >
                            <div class="text-sm text-gray-900">{{$sale->customer->name}}</div>
                            <div class="text-sm text-gray-500">
                                    {{$sale->customer->direccion}} 
                                    @isset($sale->customer->block) Torre {{$sale->customer->block}} @endisset 
                                    @isset($sale->customer->depto) depto {{$sale->customer->depto}} @endisset    
                            </div>
                        </div>
                    </td>
                    {{-- TOTAL --}}
                    <td class="px-6 py-4 whitespace-nowrap text-xl text-gray-500">
                        ${{number_format($sale->total,0,',','.')}}
                    </td>
                     {{-- ESTADO DE PAGO --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if ($sale->payment_status == 1)
                            <div> 
                                <span class="text-yellow-400">Pendiente</span> 
                                ${{number_format($sale->pending_amount,0,',','.')}} 
                            </div> 
                        @elseif ($sale->payment_status == 2)
                            <div class=""> 
                                <span class="text-green-500">Abonado</span> 
                                ${{number_format($sale->payment_amount,0,',','.')}} 
                            </div> 
                            <div> 
                                <span class="text-yellow-400">Pendiente</span> 
                                ${{number_format($sale->pending_amount,0,',','.')}} 
                            </div> 
                            
                        @elseif ($sale->payment_status == 3)
                            <i class="fas fa-check text-green-500 d-block"></i> Pagado
                        @endif
                    </td>
                     {{-- ESTADO DE DELIVERY --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if ($sale->delivery == 1)
                            @if ($sale->delivery_stage == 1)
                            <div>

                                 {{date("d-m-Y",strtotime($sale->delivery_date))}}
                            </div>
                            <div>
                                <i class="fas fa-check text-green-500"></i> Entregado
                            </div>
                                {{-- {{date("d-m-Y",strtotime($venta->date_delivered))}} --}}
                            @else
                               <div>
                                   {{date("d-m-Y",strtotime($sale->delivery_date))}}
                                  
                                </div>
                                <div>
                                    <i class="fas fa-truck text-yellow-400"></i> Pendiente
                                </div>
                            @endif
                        @else
                            <div>
                                <div>
                                    {{date("d-m-Y",strtotime($sale->date))}}
                                </div>
                                <div>
                                    Venta Bodega 
                                </div>
                            </div>
                        @endif
                    </td>
                     {{--  FECHA VENTA  --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{date("d-m-Y",strtotime($sale->date))}}
                    </td>
                     {{--  FECHA PAGO --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if ($sale->payment_date!="" && $sale->payment_status == 3)
                            {{date("d-m-Y",strtotime($sale->payment_date))}}
                        @endif
                        @if ($sale->payment_date!="" && $sale->payment_status == 2)
                           <div>
                                Abonado   
                            </div>
                            {{date("d-m-Y",strtotime($sale->payment_date))}}
                        @endif
                        
                      

                       
                       
                    </td>
                     {{--  VENTA POR  --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div> {{ ($sale->created_by()) ? $sale->created_by()->name:"" }}</div>
                    </td>
                     {{--  COMENTARIOS  --}}
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <div class="w-24 text-sm"> {{ $sale->comments }}</div>
                    </td>
                    {{-- ACCION --}}
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium ">
                        <div class="flex lg:flex-col items-center gap-2">
                          
                            
                            <x-jet-button wire:click="open_show({{$sale}})" class="mr-2"><i class="far fa-eye"></i></x-jet-button>
                            <a href="{{ route('admin.sales.edit', $sale) }}" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('admin.sales.destroy', $sale) }}" method='POST' class="alerta_eliminar  mr-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach             
            </tbody>
        </table>
    </x-table>
  

    @if ($open_show)
        <div x-show="open_show">
            <div class="fixed inset-0 w-full h-full bg-gray-900 opacity-25 z-10"></div>
            <div class="fixed inset-1 rounded-xl  shadow-2xl bg-white z-10 overflow-auto h-screen w-screen" style="">
                
                <div class="flex justify-between uppercase items-end">
                    <h2 class="text-xl font-semibold text-gray-500 ml-10">Detalle de venta</h2>
                    <i @click="open_show=false" class="fas fa-times block w-max-content cursor-pointer shadow p-5 hover:bg-gray-200 hover:shadow-2xl rounded-lg" ></i>
                </div>
                    @if ($selected_sale)
                        <div class="px-10 py-2">
                            <div class="flex justify-between uppercase items-center">
                                <h2 class="text-2xl font-bold text-gray-500 uppercase mt-2"> {{$selected_sale->customer->name}} </h2>
                                <h2 class="text-xl font-semibold text-gray-500"> {{date("d-m-Y",strtotime($selected_sale->date))}}</h2>
                            </div>
                        </div>
                    
                        <div class="px-10 mb-6">     
                            <div class="p-2 border rounded-xl my-1">
                                <h2 class="text-lg font-bold text-gray-500 my-2">Detalles</h2>                      
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 ">
                                    <div class="grid grid-cols-2">
                                        <div>Estado de pago</div>
                                        <div>
                                            @if ($selected_sale->payment_status ==1)
                                                Pendiente
                                            @elseif ($selected_sale->payment_status ==2)
                                                Abonado
                                            @elseif ($selected_sale->payment_status ==3)
                                                Pagado
                                            @endif
                                        </div>
                                    </div>
                                    @if ($selected_sale->payment_status !=1)
                                        <div class="grid grid-cols-2">
                                            @if ($selected_sale->payment_status ==3)
                                                <div>Monto pagado</div>
                                            @elseif ($selected_sale->payment_status ==2)
                                                <div>Monto abonado</div>
                                            @endif
                                            
                                            <div>${{number_format($selected_sale->payment_amount,0,',','.')}}</div>
                                        </div>
                                    @endif
                                    @if ($selected_sale->payment_status !=3 ) 
                                        <div class="grid grid-cols-2">
                                            <div>Monto pendiente</div>
                                            <div>${{number_format($selected_sale->pending_amount,0,',','.')}}</div>
                                        </div>
                                    @endif
                                    @if ($selected_sale->payment_date)
                                        <div class="grid grid-cols-2">
                                            @if ($selected_sale->payment_status ==3)
                                                <div>Fecha de pago </div>
                                            @elseif ($selected_sale->payment_status ==2)
                                                <div>Fecha de abono </div>
                                            @endif
                                            
                                            <div>{{date("d-m-Y",strtotime($selected_sale->payment_date))}}</div>
                                        </div>
                                    @endif
                                    @if ($selected_sale->created_by())
                                        <div class="grid grid-cols-2">
                                            <div>Venta por</div>
                                            <div>{{ ($selected_sale->created_by())?$selected_sale->created_by()->name:"" }}</div>
                                        </div>
                                    @endif
                                    
                                    @if ($selected_sale->modified_by())
                                        <div class="grid grid-cols-2">
                                            <div>Modificado por</div>
                                            <div>{{ ($selected_sale->modified_by())?$selected_sale->modified_by()->name:"" }}</div>
                                        </div>
                                    @endif
                                
                                </div>
                            </div>
                            @if ($selected_sale->delivery)
                                <div class="p-2 border rounded-xl my-2">
                                    <h2 class="text-lg font-bold text-gray-500 my-1">Detalles de delivery</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 ">
                                        <div class="grid grid-cols-2">
                                            <div>Etapa de entrega</div>
                                            <div>
                                                @if ($selected_sale->delivery_stage)
                                                    Entregado
                                                @else
                                                    Por entregar
                                                @endif
                                            </div>
                                        </div>
                                        @if ($selected_sale->delivery_stage)
                                            <div class="grid grid-cols-2">
                                                <div>Fecha de entregado</div>
                                                <div>{{date("d-m-Y",strtotime($selected_sale->date_delivered))}}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div>Entregado por</div>
                                                <div>{{ ($selected_sale->delivered_by()) ? $selected_sale->delivered_by()->name : "" }}</div>
                                            </div>
                                        @else
                                            <div class="grid grid-cols-2">
                                                <div>Fecha de entrega</div>
                                                <div>{{date("d-m-Y",strtotime($selected_sale->delivery_date))}}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="border p-2 my-2">
                                <table class="table-fixed w-full mx-auto">
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
                                        @foreach ($selected_sale->sale_items as $item)
                                            <tr>
                                                <td class="text-center">
                                                    @if ($item->product->image)
                                                    <div class="flex justify-center">
                                                        <img class="object-contain w-20 h-20" src="{{Storage::url($item->product->image->url)}}" alt=""> 
                                                    </div>
                                                    @endif
                                                </td>
                                                <td class="text-left">
                                                    <div class="flex justify-start items-center">
                                                        <div>{{$item->cantidad}} {{$item->product->name}} x {{$item->cantidad_por_caja}} un.</div>
                                                    </div>
                                                </td>
                                                <td class="text-center">${{ number_format($item->precio,0,',','.') }}</td>
                                                <td class="text-center">${{ number_format($item->precio_por_caja,0,',','.') }}</td>
                                                <td class="text-center">${{ number_format($item->precio_total,0,',','.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex justify-end my-6">
                                <div class="grid grid-cols-2 w-60 gap-4 text-xl uppercase font-semibold">
                                    @if ($selected_sale->delivery_value>0)
                                        <div class="font-bold text-gray-500">Sub total </div>
                                        <div class="text-right"> ${{number_format($selected_sale->total -$selected_sale->delivery_value,0,',','.')}}</div>
                                        <div class="font-bold text-gray-500">Despacho </div>
                                        <div class="text-right"> ${{number_format($selected_sale->delivery_value,0,',','.')}}</div>
                                        <div class="font-bold text-gray-500">Total </div>
                                        <div class="text-right"> ${{number_format($selected_sale->total,0,',','.')}}</div>
                                    @else
                                        <div class="font-bold text-gray-500">Total </div>
                                        <div class="text-right"> ${{number_format($selected_sale->total,0,',','.')}}</div>
                                    @endif
                                    
                                </div>

                            </div>

                            @if ($selected_sale->comments != "")
                                <div class="p-2 border rounded-xl my-1">
                                    <h2 class="text-lg font-bold text-gray-500 my-2">Comentario</h2>                      
                                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2"> {{$selected_sale->comments}}</div>
                                </div>
                            @endif
                        </div> 
                       
                    @else
                        <div class="p-10">
                            <h2 class="text-lg font-bold text-gray-400">No hay venta seleccionada </h2>
                        </div>
                    @endif
                    <div class="px-10 py-5 bg-gray-100 rounded-lg flex items-center justify-between">
                        <x-jet-button @click="open_show=false">Cerrar</x-jet-button>
                    </div>
               
               
            </div>
        </div>
    @endif

    @push('js')
        <script>
            function ventas(){
                return{
                    open_show: @entangle('open_show'),

                }
            }
        </script>
    @endpush
</div>
