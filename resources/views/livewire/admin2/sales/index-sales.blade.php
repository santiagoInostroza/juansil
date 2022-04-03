<div class="text-xs">

    {{-- LOADING --}}
    <div wire:loading.flex>
        <div class="fixed inset-0 bg-gray-500 opacity-50 z-40"></div>
        <div class="fixed inset-0 flex items-center justify-center  z-40">
            <i class="fas fa-spinner animate-spin text-4xl"></i>
        </div>
    </div>

    {{-- {{ session('saleColumns')}} --}}

    {{-- TABLE --}}
    <x-table.table>

      
        <x-slot name="subtitle">
            <div class="flex justify-between gap-x-12 gap-y-2 items-center flex-wrap-reverse my-4">
                <div class=" flex-1 flex gap-2 items-center">
                    <x-jet-input class="w-full" wire:model.debounce.1s="search" placeholder="Ingresa palabra o frase para buscar..." type="search"></x-jet-input>
                </div>
                
                <div class="flex items-center gap-2">
                    <span> {{ $sales->total()}} resultados</span>
                    
                    <div id="change_date" x-data="{isOpenChangeDate:false}">
                        <div x-on:click="isOpenChangeDate=true" class="p-2.5 bg-white border rounded cursor-pointer select-none">
                            <i class="fas fa-filter text-gray-500"></i> filtros <i class="fas fa-chevron-down ml-2"></i>
                        </div>
                        <div  x-cloak x-show="isOpenChangeDate"x-transition x-on:click.away="isOpenChangeDate=false" x-on:click="isOpenChangeDate=false">
                            <ul   class="bg-white rounded shadow absolute z-10 overflow-auto py-2 w-max-content transform -translate-x-1/3 select-none border mt-2">
                            
                                <li class="p-2  cursor-pointer hover:bg-gray-100 {{ ($filterDate == 'todaysRoute') ? 'hover:bg-gray-600 text-white bg-gray-500':''}}">
                                    <div wire:click="$set('filterDate','todaysRoute')" class="mr-2" >
                                        Ruta de hoy
                                    </div>
                                </li>
                                <li class="p-2  cursor-pointer hover:bg-gray-100 {{ ($filterDate == 'yesterdayRoute') ? 'hover:bg-gray-600 text-white bg-gray-500':''}}">
                                    <div wire:click="$set('filterDate','yesterdayRoute')" class="mr-2" >
                                        Ruta de ayer
                                    </div>
                                </li>
                            
                                <li class="p-2  cursor-pointer hover:bg-gray-100 {{ ($filterDate == 'sheduledToday') ? 'hover:bg-gray-600 text-white bg-gray-500':''}}">
                                    <div wire:click="$set('filterDate','sheduledToday')" class="mr-2" >
                                        Agendados hoy
                                    </div>
                                </li>
                                <li class="p-2  cursor-pointer hover:bg-gray-100 {{ ($filterDate == 'threeDaysAgo') ? 'hover:bg-gray-600 text-white bg-gray-500':''}}">
                                    <div wire:click="$set('filterDate','threeDaysAgo')" class="mr-2" >
                                        Hace 3 dias
                                    </div>
                                </li>
                                <li class="p-2  cursor-pointer hover:bg-gray-100 {{ ($filterDate == 'tenDaysAgo') ? 'hover:bg-gray-600 text-white bg-gray-500':''}}">
                                    <div wire:click="$set('filterDate','tenDaysAgo')" class="mr-2" >
                                        Hace 10 dias
                                    </div>
                                </li>
                                <li class="p-2  cursor-pointer hover:bg-gray-100 {{ ($filterDate == 'month') ? 'hover:bg-gray-600 text-white bg-gray-500':''}}">
                                    <div wire:click="$set('filterDate','month')" class="mr-2" >
                                        Todo el mes
                                    </div>
                                </li>
                                <li class="p-2  cursor-pointer hover:bg-gray-100 {{ ($filterDate == 'pendingTicketsOfMonth') ? 'hover:bg-gray-600 text-white bg-gray-500':''}}">
                                    <div wire:click="$set('filterDate','pendingTicketsOfMonth')" class="mr-2" >
                                        Boletas pendientes del mes
                                    </div>
                                </li>
                                <li class="p-2  cursor-pointer hover:bg-gray-100 {{ ($filterDate == 'all') ? 'hover:bg-gray-600 text-white bg-gray-500':''}}">
                                    <div wire:click="$set('filterDate','all')" class="mr-2" >
                                        Todas
                                    </div>
                                </li>
                                <li class="border-b my-2"></li>
                            </ul>
                        </div>
                    </div>
                    <div id="change_columns" x-data="{isOpenChangeColumns:false}">
                        <div x-on:click="isOpenChangeColumns=true" class="p-2.5 bg-white border rounded cursor-pointer select-none">
                            Columnas <i class="fas fa-chevron-down ml-2"></i>
                        </div>
                        <div  x-cloak  x-show="isOpenChangeColumns"x-transition x-on:click.away="isOpenChangeColumns=false">
                            <ul  class="bg-white rounded shadow absolute z-10 h-96 overflow-auto py-2 w-max-content transform -translate-x-1/2 select-none border mt-2">
                            
                                <li class="p-2  cursor-pointer hover:bg-gray-100" x-on:click="isOpenChangeColumns=false">
                                    <div wire:click="setColumns('mobile')" class="mr-2" >
                                        seleccionar para Mobil
                                    </div>
                                </li>
                                <li class="p-2  cursor-pointer hover:bg-gray-100" x-on:click="isOpenChangeColumns=false">
                                    <div wire:click="setColumns('basic')" class="mr-2" >
                                        seleccionar basicos
                                    </div>
                                </li>
                                <li class="p-2  cursor-pointer hover:bg-gray-100" x-on:click="isOpenChangeColumns=false">
                                    <div wire:click="setColumns('boleta')" class="mr-2" >
                                        emitir boletas
                                    </div>
                                </li>
                            
                                <li class="p-2  cursor-pointer hover:bg-gray-100" x-on:click="isOpenChangeColumns=false">
                                    <div wire:click="setColumns('all')" class="mr-2" >
                                        seleccionar todos
                                    </div>
                                </li>
                               
                                <li class="border-b my-2"></li>
                                @foreach ($columns as $nameColumn => $valueColumn)
                                    <label>
                                        <li class="p-2  cursor-pointer ">
                                            <input wire:click="setColumns('{{ $nameColumn }}')" class="mr-2" type="checkbox" value="" name="" id="" {{ ($valueColumn) ?'checked' : ''  }}>
                                            {{$nameColumn}}
                                        </li>
                                    </label>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div id="change_rows" x-data="{isOpenChangeFiles:false}">
                        <div x-on:click="isOpenChangeFiles=true" class="p-2.5 bg-white border rounded cursor-pointer select-none">
                            Filas <i class="fas fa-chevron-down ml-2"></i>
                        </div>
                        <div  x-cloak  x-show="isOpenChangeFiles"x-transition x-on:click.away="isOpenChangeFiles=false">
                            <ul  class="bg-white rounded shadow absolute z-10  overflow-auto py-2 select-none border mt-2">
                                <label >
                                    <li class="p-2  cursor-pointer hover:bg-gray-50 {{ ($rows==10)?'bg-gray-500 text-white hover:bg-gray-600':''}}">
                                        <div wire:click="$set('rows',10)" x-on:click="isOpenChangeFiles=false">
                                        10
                                        </div>
                                    </li>
                                </label>
                                <label>
                                    <li class="p-2  cursor-pointer hover:bg-gray-50 {{ ($rows==25)?'bg-gray-500 text-white hover:bg-gray-600':''}} ">
                                        <div wire:click="$set('rows',25)" x-on:click="isOpenChangeFiles=false">
                                            25
                                        </div>
                                    </li>
                                </label>
                                <label>
                                    <li class="p-2  cursor-pointer hover:bg-gray-50 {{ ($rows==100)?'bg-gray-500 text-white hover:bg-gray-600':''}} ">
                                        <div wire:click="$set('rows',100)" x-on:click="isOpenChangeFiles=false">
                                            100
                                        </div>
                                    </li>
                                </label>
                            </ul>
                        </div>
                    </div> 
                </div>
            </div>
            {{-- FILTROS ESOECIFICOS  NO LE GUSTARON A LA PATY--}}
            {{-- <div class="text-indigo-500 flex flex-wrap gap-2 py-2">
                @if($sale_id != "")
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gapx-2 px-1 rounded-3xl bg-indigo-100">
                            
                            <div class="p-1">
                                id:  {{$sale_id}}
                            </div>
                            <div class="p-1 cursor-pointer" wire:click="$set('sale_id','')">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    </div>
               @endif
                <div>
                    @if($name != "")
                        <div class="flex items-center gapx-2 px-1 rounded-3xl bg-indigo-100">
                            <div class="p-1">
                                nombre:  {{$name}}
                            </div>
                            <div class="p-1 cursor-pointer" wire:click="$set('name','')">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div>
                    @if($address != "")
                        <div class="flex items-center gapx-2 px-1 rounded-3xl bg-indigo-100">
                            <div class="p-1">
                                direccion:  {{$address}}
                            </div>
                            <div class="p-1 cursor-pointer" wire:click="$set('name','')">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    @if($dateStart != "" && $dateEnd != "")
                        <div class="flex items-center gapx-2 px-1 rounded-3xl bg-indigo-100">
                            <div class="p-1">
                                fecha inicio:  {{$dateStart}}
                                fecha fin:  {{$dateEnd}}
                            </div>
                            <div class="p-1 cursor-pointer" wire:click="$set('name','')">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    @if($dateStart != "" && $dateEnd == "")
                        <div class="flex items-center gapx-2 px-1 rounded-3xl bg-indigo-100">
                            <div class="p-1">
                                fecha :  {{$dateStart}}
                               
                            </div>
                            <div class="p-1 cursor-pointer" wire:click="$set('name','')">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    @if($dateStart == "" && $dateEnd != "")
                        <div class="flex items-center gapx-2 px-1 rounded-3xl bg-indigo-100">
                            <div class="p-1">
                                fecha :  {{$dateEnd}}
                               
                            </div>
                            <div class="p-1 cursor-pointer" wire:click="$set('name','')">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    @endif
                </div>

            </div> --}}
        </x-slot>
       


        <x-slot name='thead'>
            <x-table.tr>
                @foreach ($columns as $nameColumn => $valueColumn)
                    @if ($valueColumn) 
                        <x-table.th> <div class="{{ ($nameColumn == 'accion') ? 'flex justify-end mr-8': '' }}">{{$nameColumn}}</div></x-table.th>
                    @endif
                @endforeach
            </x-table.tr>
            {{-- FILTROS ESOECIFICOS  NO LE GUSTARON A LA PATY--}}
            {{-- <x-table.tr>
                @foreach ($columns as $nameColumn => $valueColumn)
                    @if ($nameColumn == 'id' && $columns['id']) 
                        <x-table.th> <div><x-jet-input class="w-14 text-xs" placeholder="id" wire:model.debounce.1s="sale_id"></x-jet-input></div></x-table.th>
                    @elseif ($nameColumn == 'nombre' && $columns['nombre']) 
                        <x-table.th> <div><x-jet-input class="w-max text-xs" placeholder="nombre" wire:model.debounce.1s="name"></x-jet-input></div></x-table.th>
                    @elseif ($nameColumn == 'direccion' && $columns['direccion'])
                        <x-table.th> <div><x-jet-input class="w-max text-xs" placeholder="direccion" wire:model.debounce.1s="address"></x-jet-input></div></x-table.th>
                    @elseif ($nameColumn == 'fecha' && $columns['fecha'])
                        <x-table.th> 
                            <div><x-jet-input class="text-xs w-max" type="date" wire:model.debounce.1s="dateStart"></x-jet-input></div>
                            <div><x-jet-input class="text-xs w-max" type="date" wire:model.debounce.1s="dateEnd"></x-jet-input></div>
                        </x-table.th>
                    @else
                        <x-table.th> <div></div></x-table.th>
                    @endif
                @endforeach
            </x-table.tr> --}}
        </x-slot>
        <x-slot name='tbody'>
            @if ($sales->count())
                @foreach ($sales as $sale)
                    <x-table.tr>
                        <div>
                            @foreach ($columns as $nameColumn => $valueColumn)
                                @if ( $nameColumn == 'id' && $columns['id']) 
                                    <x-table.td>
                                        {{$sale->id}}
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'delivery' && $columns['delivery']) 
                                    <x-table.td>
                                        @if ($sale->delivery)
                                            <i class="fas fa-truck"></i>
                                        @endif
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'nombre' && $columns['nombre'])
                                    <x-table.td>

                                        <div id='tooltip_name_{{$sale->id}}' x-data='{tooltip:false}' x-on:mouseleave='tooltip=false'>
                                            <div x-on:mouseover='tooltip=true'>
                                                {{$sale->name}}
                                            </div>
                                            <div x-cloak x-show='tooltip' x-transition >
                                                <div class='bg-white rounded shadow p-4 absolute z-10'>
                                                    <div>  {{$sale->address}}  </div>
                                                    <div> Total ${{number_format($sale->total,0,',','.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'direccion' && $columns['direccion'])
                                    <x-table.td>{{$sale->address}}</x-table.td>
                                @endif

                                @if ( $nameColumn == 'fecha' && $columns['fecha'])
                                    <x-table.td>
                                        {{ ($sale->created_at) ? Helper::date($sale->created_at)->dayName : ''}} {{ ($sale->created_at) ? Helper::date($sale->created_at)->format('d-m-y H:i') .' hrs.' : '' }} 
                                    </x-table.td>
                                @endif

                                @if ( isset($columns['total']) &&  $nameColumn == 'total' && $columns['total']) 
                                    <x-table.td>${{number_format($sale->total,0,',','.')}}</x-table.td>
                                @endif
                                
                                @if (isset($columns['costo']) &&  $nameColumn == 'costo' &&  $columns['costo']) 
                                    <x-table.td> ${{ number_format($sale->total_cost,0,',','.')}}</x-table.td>
                                @endif

                                @if (isset($columns['diferencia']) &&  $nameColumn == 'diferencia' &&  $columns['diferencia']) 
                                    <x-table.td> 
                                        <div>
                                            @if ($sale->difference != null)
                                                ${{ number_format($sale->difference,0,',','.')}}
                                            @else
                                                ${{  number_format($sale->total -$sale->total_cost,0,',','.') }}
                                            @endif
                                        </div>
                                    
                                    </x-table.td>
                                @endif

                                @if (isset($columns['porcentaje']) &&  $nameColumn == 'porcentaje' &&  $columns['porcentaje']) 
                                    <x-table.td>
                                        <div>
                                            @if ($sale->percentage != null)
                                                {{ number_format($sale->percentage,2,',','.')}}%
                                            @else
                                                @if ($sale->difference != null)
                                                    {{  number_format( $sale->difference / $sale->total * 100 ,2,',','.') }}%
                                                @else
                                                    {{  number_format( ($sale->total -$sale->total_cost ) / $sale->total  * 100 ,2,',','.') }}%
                                                @endif
                                            @endif
                                        </div>
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'monto pagado' && $columns['monto pagado']) 
                                    <x-table.td>${{number_format($sale->payment_amount,0,',','.')}}</x-table.td>
                                @endif

                                @if ( $nameColumn == 'estado de pago' && $columns['estado de pago']) 
                                    <x-table.td>
                                        <div>
                                            @if ($sale->payment_status==1)
                                                <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-yellow-500 text-white rounded-full">
                                                    Pendiente
                                                </span>
                                                
                                            @elseif($sale->payment_status==2)
                                                <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-yellow-500 text-white rounded-full">
                                                    Abonado
                                                </span>
                                            
                                            @elseif($sale->payment_status==3)
                                                <div id="payment_status_{{$sale->id}}" x-data="{isOpenPaymentStatus:false}" x-on:mouseout="isOpenPaymentStatus=false">
                                                    <span x-on:mouseover="isOpenPaymentStatus=true" class="select-none text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-500 text-white rounded-full">
                                                        Pagado  
                                                    </span>
                                                    @if ($sale->payment_date)
                                                        <div x-cloak x-show="isOpenPaymentStatus">
                                                            <div class="bg-white shadow p-4 absolute rounded">
                                                                el   {{ ($sale->payment_date) ? Helper::date($sale->payment_date)->dayName : ''}} {{ ($sale->payment_date) ? Helper::date($sale->payment_date)->format('d-m-Y H:i') : '' }}
                                                                <div>
                                                                    @if ($sale->payment_account == 1)
                                                                        Efectivo
                                                                    @elseif($sale->payment_account == 2)
                                                                        Cuenta rut Paty
                                                                    @elseif($sale->payment_account == 3)
                                                                        Cuenta rut Santiago
                                                                    @elseif($sale->payment_account == 4)
                                                                        Cuenta rut Silvia
                                                                    @elseif($sale->payment_account == 5)
                                                                        Cuenta corriente Santander Santiago
                                                                    @elseif($sale->payment_account == 6)
                                                                        Cuenta vista (chequera electronica) Juansil
                                                                    @elseif($sale->payment_account == 7)
                                                                        Otra                                    
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    
                                                </div>
                                            
                                            @endif
                                        </div>
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'monto pendiente' && $columns['monto pendiente']) 
                                    <x-table.td> ${{ number_format($sale->pending_amount,0,',','.')}}</x-table.td>
                                @endif

                                @if ( $nameColumn == 'fecha de pago' && $columns['fecha de pago']) 
                                    <x-table.td>
                                        {{ ($sale->payment_date) ? Helper::date($sale->payment_date)->dayName : ''}} {{ ($sale->payment_date) ? Helper::date($sale->payment_date)->format('d-m-Y H:i') : '' }}
                                    
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'fecha de entrega' && $columns['fecha de entrega']) 
                                    <x-table.td>
                                        {{ ($sale->delivery_date) ? Helper::date($sale->delivery_date,false)->dayName : ''}} {{ ($sale->delivery_date) ? Helper::date($sale->delivery_date,false)->format('d-m-Y') : '' }}
                                    
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'fecha entregado' && $columns['fecha entregado']) 
                                    <x-table.td>
                                        {{ ($sale->date_delivered) ? Helper::date($sale->date_delivered)->dayName : ''}} {{ ($sale->date_delivered) ? Helper::date($sale->date_delivered)->format('d-m-Y H:i') : '' }}
                                    
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'estado de entrega' && $columns['estado de entrega']) 
                                    <x-table.td>
                                        <div class="flex gap-2 items-center">
                                            {{-- @if ($sale->delivery)
                                                <i class="fas fa-truck"></i>
                                            @endif --}}

                                            @if ( $sale->delivery && ($sale->delivery_stage ==0 || $sale->delivery_stage ==null) )

                                                <div id="delivery_stage_{{$sale->id}}" x-data="{isOpenDeliveryStage:false}" x-on:mouseout="isOpenDeliveryStage=false">
                                                    <span  x-on:mouseover="isOpenDeliveryStage=true" class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-yellow-500 text-white rounded-full">
                                                        Pendiente
                                                    </span>
                                                    @if ($sale->delivery_date)
                                                        <div x-cloak x-show="isOpenDeliveryStage">
                                                            <div class="bg-white shadow p-4 absolute rounded">
                                                            
                                                            entregar el {{ ($sale->delivery_date) ? Helper::date($sale->delivery_date)->dayName : ''}} {{ ($sale->delivery_date) ? Helper::date($sale->delivery_date)->format('d-m-Y') : '' }}
                                                            
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                        
                                            @elseif($sale->delivery_stage==1)
                                                <div id="delivery_stage_{{$sale->id}}" x-data="{isOpenDeliveryStage:false}" x-on:mouseout="isOpenDeliveryStage=false">
                                                    <span x-on:mouseover="isOpenDeliveryStage=true" class="select-none text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-500 text-white rounded-full">
                                                        Entregado  
                                                    </span>
                                                    @if ($sale->date_delivered)
                                                        <div x-cloak x-show="isOpenDeliveryStage">
                                                            <div class="bg-white shadow p-4 absolute rounded">
                                                            
                                                            el    {{ ($sale->date_delivered) ? Helper::date($sale->date_delivered)->dayName : ''}} {{ ($sale->date_delivered) ? Helper::date($sale->date_delivered)->format('d-m-Y H:i') : '' }}
                                                            por  {{ ($sale->deliveredBy()) ?  $sale->deliveredBy()->name : ''}}
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            
                                            @endif
                                        </div>
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'comentarios preventa' && $columns['comentarios preventa']) 
                                    <x-table.td>
                                        <div class="">
                                            @if ($sale->comments)
                                                <div id="comment_{{$sale->id}}" x-data="{isOpenComment:false}" x-on:mouseleave="isOpenComment=false">
                                                    <div class="p-4 cursor-pointer" x-on:mouseover="isOpenComment=true">
                                                        {!! Str::limit($sale->comments , 26, '...')!!}
                                                    </div>
                                                    <div x-cloak x-show="isOpenComment" >
                                                        <div class="shadow rounded p-4 bg-white absolute  ">
                                                            {!! $sale->comments !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </x-table.td>
                                @endif

                                @if (isset($columns['vendedor']) &&  $nameColumn == 'vendedor' &&  $columns['vendedor']) 
                                    <x-table.td>  {{ ($sale->createdBy() ) ? $sale->createdBy()->name : '' }}</x-table.td>
                                @endif

                                @if ( isset($columns['entregado por']) && $nameColumn == 'entregado por' && $columns['entregado por']) 
                                    <x-table.td>{{ ($sale->deliveredBy()) ?  $sale->deliveredBy()->name : ''}}</x-table.td>
                                @endif

                                @if (  isset($columns['valor despacho']) && $nameColumn == 'valor despacho' && $columns['valor despacho']) 
                                    <x-table.td> ${{ number_format($sale->delivery_value,0,',','.') }}</x-table.td>
                                @endif

                                @if ( isset($columns['subtotal']) && $nameColumn == 'subtotal' && $columns['subtotal']) 
                                    <x-table.td> ${{ number_format($sale->subtotal,0,',','.') }}</x-table.td>
                                @endif

                                @if ( $nameColumn == 'tipo venta' && $columns['tipo venta']) 
                                    <x-table.td>
                                        @if ($sale->sale_type == 1)
                                            <div id="tooltip_sale_type_{{$sale->id}}" x-data="{tooltip:false}" x-on:mouseleave="tooltip=false">
                                                <div x-on:mouseover="tooltip=true">
                                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                        <button
                                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                            <img class="h-8 w-8 rounded-full object-cover"
                                                                src="{{ $sale->createdBy()->profile_photo_url }}" alt="{{ $sale->createdBy()->name }}" />
                                                        </button>
                                                    @else
                                                        <button
                                                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                            <div>{{ $sale->createdBy()->name }}</div>
                                
                                                            <div class="ml-1">
                                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </div>
                                                        </button>
                                                    @endif
                                                </div>
                                                <div x-cloak x-show="tooltip" x-transition >
                                                    <div class="bg-white rounded shadow p-4 absolute z-10">
                                                        venta realizada por un ejecutivo 
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($sale->sale_type == 2)
                                            

                                            <div id="tooltip_sale_type_{{$sale->id}}"  x-data="{tooltip:false}" x-on:mouseleave="tooltip=false">
                                                <div x-on:mouseover="tooltip=true">
                                                    <i class="fas fa-cart-arrow-down"></i>
                                                </div>
                                                <div x-cloak x-show="tooltip" x-transition >
                                                    <div class="bg-white rounded shadow p-4 absolute z-10">
                                                        venta realizada a travez de la página
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($sale->sale_type == 3)
                                            <div id="tooltip_sale_type_{{$sale->id}}"  x-data='{tooltip:false}' x-on:mouseleave='tooltip=false'>
                                                <div x-on:mouseover='tooltip=true'>
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div x-cloak x-show='tooltip' x-transition >
                                                    <div class='bg-white rounded shadow p-4 absolute z-10'>
                                                        venta especial 
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'tipo de pago' && $columns['tipo de pago']) 
                                    <x-table.td> 
                                        <div>
                                            @if ($sale->payment_account == 1)
                                                Efectivo
                                            @elseif($sale->payment_account == 2)
                                                Cuenta rut Paty
                                            @elseif($sale->payment_account == 3)
                                                Cuenta rut Santiago
                                            @elseif($sale->payment_account == 4)
                                                Cuenta rut Silvia
                                            @elseif($sale->payment_account == 5)
                                                Cuenta corriente Santander Santiago
                                            @elseif($sale->payment_account == 6)
                                                Cuenta vista (chequera electronica) Juansil
                                            @elseif($sale->payment_account == 7)
                                                Otra                                    
                                            @endif
                                        </div>
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'comentario conductor' && $columns['comentario conductor']) 
                                    <x-table.td>
                                        <div class="">
                                            @if ($sale->driver_comment)
                                                <div id="comment_driver_{{$sale->id}}" x-data="{isOpenCommentDriver:false}" x-on:mouseleave="isOpenCommentDriver=false">
                                                    <div class="p-4 cursor-pointer" x-on:mouseover="isOpenCommentDriver=true">
                                                        {!! Str::limit($sale->driver_comment , 26, '...')!!}
                                                    </div>
                                                    <div x-cloak x-show="isOpenCommentDriver" x-transition>
                                                        <div class="shadow rounded p-4 bg-white absolute">
                                                            {!! $sale->driver_comment !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'boleta emitida' && $columns['boleta emitida']) 
                                    <x-table.td>
                                        {{-- {{ $sale->payment_account }} --}}
                                        @if ($sale->boleta)
                                            
                                            <div id='tooltip_fecha_boleta_{{$sale->id}}' x-data='{tooltip:false}' x-on:mouseleave='tooltip=false'>
                                                <span x-on:mouseover="tooltip=true" class="select-none text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-500 text-white rounded-full">
                                                    Boleta emitida
                                                </span>
                                                <div x-cloak x-show='tooltip' x-transition >
                                                    <div class='bg-white rounded shadow p-4 absolute z-10'>
                                                    <div>
                                                            por {{ ($sale->boletaBy())? $sale->boletaBy()->name :''}}
                                                    </div>
                                                    <div>
                                                            el {{($sale->fecha_boleta) ? Helper::date($sale->fecha_boleta)->dayName : ''}} {{($sale->fecha_boleta) ? Helper::date($sale->fecha_boleta)->format('d-m-Y H:i') : ''}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            @if ($sale->payment_status == 3)
                                                <x-jet-secondary-button wire:click="setBoleta({{$sale->id}})">Emitir</x-jet-secondary-button>
                                            @endif

                                        @endif
                                        
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'boleta emitida el' && $columns['boleta emitida el']) 
                                    <x-table.td>
                                        {{($sale->fecha_boleta) ? Helper::date($sale->fecha_boleta)->dayName : ''}} {{($sale->fecha_boleta) ? Helper::date($sale->fecha_boleta)->format('d-m-Y H:i') : ''}}
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'boleta emitida por' && $columns['boleta emitida por']) 
                                    <x-table.td>
                                        {{ ($sale->boletaBy())? $sale->boletaBy()->name :''}}
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'usuario recibe pago' && $columns['usuario recibe pago']) 
                                    <x-table.td>
                                        {{ ($sale->paymentBy()) ? $sale->paymentBy()->name:''}}
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'imagen del recibo' && $columns['imagen del recibo']) 
                                    <x-table.td>
                                        @if ($sale->payment_receipt_url)
                                            <div id='tooltip_payment_receipt_url_{{$sale->id}}' x-data='{tooltip:false,isOpenModalImage:false,rotate:0}' x-on:mouseleave='tooltip=false'>
                                                <div class="flex items-center gap-1">

                                                    <div x-on:mouseover='tooltip=true' x-on:click="isOpenModalImage=true">
                                                        <img class="w-10 object-cover cursor-pointer transform hover:scale-250 duration-2000" src="{{Storage::url($sale->payment_receipt_url)}}" alt="Imagen del recibo {{$sale->id}}">
                                                    </div>
                                                    @if ($sale->verify_payment_receipt == null || $sale->verify_payment_receipt == 0)
                                                        <livewire:admin2.upload-images.payment-receipt size="text-md" :sale="$sale" :key="'sale_'.$sale->id . rand()" />
                                                    @endif
                                                </div>
                                                <div x-cloak x-show='tooltip' x-transition>
                                                    <div class='bg-white rounded shadow p-4 absolute z-10 transform -translate-x-1/3'>
                                                        <div>por {{ ($sale->paymentReceiptBy())? $sale->paymentReceiptBy()->name :''}}</div>
                                                        <div>el {{($sale->payment_receipt_date) ? Helper::date($sale->payment_receipt_date)->dayName : ''}} {{($sale->payment_receipt_date) ? Helper::date($sale->payment_receipt_date)->format('d-m-Y H:i') : ''}} </div>
                                                    </div>
                                                </div>
                                                <div x-cloak x-show="isOpenModalImage" x-transition>
                                                    <x-modals.image-screen>
                                                        <div>
                                                            <img class="w-full object-contain transform  transition hover:scale-250 duration-2000 " :class="(rotate ==1) ? 'rotate-90': rotate ==2? 'rotate-180' : rotate==3 ? 'rotate-270' : '' " src="{{Storage::url($sale->payment_receipt_url)}}" alt="Imagen del recibo {{$sale->id}}">
                                                            <div class="absolute w-full bottom-0 left-0 flex justify-center items-center gap-2">
                                                                <x-jet-secondary-button x-on:click="(rotate==3) ? rotate=0 : rotate++"> Rotar</x-jet-secondary-button>
                                                                <x-jet-danger-button x-on:click="isOpenModalImage=false">Cerrar</x-jet-danger-button>
                                                            </div>
                                                        </div>
                                                    </x-modals.image-screen>
                                                </div>

                                            </div>
                                        @elseif($sale->payment_account > 1 && ($sale->verify_payment_receipt == null || $sale->verify_payment_receipt == 0) )
                                    
                                            <div class="flex gap-1 items-center text-xs py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-yellow-500 text-white rounded-full">
                                                Pendiente <livewire:admin2.upload-images.payment-receipt size="text-md" :sale="$sale" :key="'sale_'.$sale->id" />
                                            </div>
                                        @endif

                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'recibo subido el' && $columns['recibo subido el']) 
                                    <x-table.td>
                                        {{($sale->payment_receipt_date) ? Helper::date($sale->payment_receipt_date)->dayName : ''}} {{($sale->payment_receipt_date) ? Helper::date($sale->payment_receipt_date)->format('d-m-Y H:i') : ''}}
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'recibo subido por' && $columns['recibo subido por']) 
                                    <x-table.td>
                                        {{ ($sale->paymentReceiptBy())? $sale->paymentReceiptBy()->name :''}}
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'verificacion recibo' && $columns['verificacion recibo']) 
                                    <x-table.td>
                                        @if ( $sale->verify_payment_receipt )
                                            <div id='tooltip_verify_payment_receipt_{{$sale->id}}' x-data='{tooltip:false}' x-on:mouseleave='tooltip=false'>
                                                <span x-on:mouseover="tooltip=true" class="select-none text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-500 text-white rounded-full">
                                                    Pago Verificado
                                                </span>
                                                <div x-cloak x-show='tooltip' x-transition >
                                                    <div class='bg-white rounded shadow p-4 absolute z-10'>
                                                        <div>
                                                            por {{ ($sale->verifyPaymentReceiptBy() ) ? $sale->verifyPaymentReceiptBy()->name :''}}
                                                        </div>
                                                        <div>
                                                            el {{($sale->verify_payment_receipt_date) ? Helper::date($sale->verify_payment_receipt_date)->dayName : ''}} {{($sale->verify_payment_receipt_date) ? Helper::date($sale->verify_payment_receipt_date)->format('d-m-Y H:i') : ''}}
                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            @if ($sale->payment_receipt_url)
                                                    <div x-data="{isOpenVerify:false}">
                                                        <span x-on:click="isOpenVerify=true" class="cursor-pointer text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-yellow-500 text-white rounded-full">
                                                            Pendiente validar
                                                        </span>
                                                        <div x-cloak x-show="isOpenVerify" xtransition>
                                                            <x-modal.alert2>
                                                                <x-slot name="header">Confirmar pago</x-slot>
                                                                <x-slot name="body">
                                                                    <div class="max-h-96 max-w">
                                                                        <img class="max-h-80 w-full object-contain transform hover:scale-250 duration-2000" src="{{Storage::url($sale->payment_receipt_url)}}" alt="Imagen del recibo {{$sale->id}}">
                                                                    </div>
                                                                    <div>
                                                                        <div>
                                                                            {{$sale->customer->name}} 
                                                                        </div>
                                                                        <div>
                                                                            Total ${{number_format($sale->total,0,',','.')}}
                                                                        </div>
                                                                        <div>
                                                                            El pago ha sido revisado y lo he verificado.
                                                                        </div>
                                                                    </div>
                                                                </x-slot>
                                                                <x-slot name="footer">
                                                                    <div class="flex gap-4 justify-center">
                                                                        <x-jet-secondary-button x-on:click="isOpenVerify=false">no</x-jet-secondary-button>
                                                                        <x-jet-button wire:click="verifyReceipt({{ $sale->id }})">Si</x-jet-button>
                                                                    </div>
                                                                </x-slot>
                                                            </x-modal.alert2>
                                                            
                                                        </div>
            
                                                    </div>
                                                
                                            @endif
                                                
                                        @endif

                                        
                                        
                                        
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'recibo verificado por' && $columns['recibo verificado por']) 
                                    <x-table.td>
                                        {{ ($sale->verifyPaymentReceiptBy() ) ? $sale->verifyPaymentReceiptBy()->name :''}}
                                    </x-table.td>
                                @endif
                                @if ( $nameColumn == 'recibo verificado el' && $columns['recibo verificado el']) 
                                    <x-table.td>
                                        {{($sale->verify_payment_receipt_date) ? Helper::date($sale->verify_payment_receipt_date)->dayName : ''}} {{($sale->verify_payment_receipt_date) ? Helper::date($sale->verify_payment_receipt_date)->format('d-m-Y H:i') : ''}}
                                    </x-table.td>
                                @endif

                                @if ( $nameColumn == 'accion' && $columns['accion']) 
                                    <x-table.td> 
                                        <div  class="flex gap-2 justify-end">
                                            @can('admin.sales.edit')
                                                <x-jet-secondary-button><i class="fas fa-pen"></i></x-jet-secondary-button>
                                            @endcan
                                            @can('admin.sales.delete')
                                                <x-jet-danger-button><i class="fas fa-trash"></i></x-jet-danger-button>
                                            @endcan
                                        </div>
                                    </x-table.td>
                                @endif

                            @endforeach
                        </div>
                    </x-table.tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">
                        <div class="p-4 bg-white text-2xl text-red-500">
                            @if ($filterDate == 'todaysRoute')
                                No hay pedidos para la ruta de hoy
                            @elseif($filterDate == 'sheduledToday')
                                No hay pedidos que se hayan agendado hoy
                            @elseif($filterDate == 'threeDaysAgo')
                                No hay pedidos que se hayan agendado desde hace 3 días
                            @elseif($filterDate == 'tenDaysAgo')
                                No hay pedidos que se hayan agendado desde hace 10 días
                            @elseif($filterDate == 'all')
                                No hay pedidos que se hayan agendado desde hace 3 días
                            
                            @endif
                        </div>
                    </td>
                </tr>
            @endif
        </x-slot>
    </x-table.table>


    {{-- PAGINATOR --}}
    <div >
        <div class="h-16 w-full"></div>
        <div class="fixed bottom-0 right-0 w-full bg-white">
            {{ $sales->links() }}
           
        </div>
    </div>
</div>




