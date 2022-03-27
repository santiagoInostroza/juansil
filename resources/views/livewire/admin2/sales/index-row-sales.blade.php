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
            <x-table.td>{{$sale->name}}</x-table.td>
        @endif

        @if ( $nameColumn == 'direccion' && $columns['direccion'])
            <x-table.td>{{$sale->address}}</x-table.td>
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
            
                {{ ($sale->delivery_date) ? Helper::date($sale->delivery_date)->dayName : ''}} {{ ($sale->delivery_date) ? Helper::date($sale->delivery_date)->format('d-m-Y') : '' }}
            
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
                        <div x-show="tooltip" x-cloak x-transition >
                            <div class="bg-white rounded shadow p-4 absolute">
                                venta realizada por un ejecutivo 
                            </div>
                        </div>
                    </div>
                @elseif($sale->sale_type == 2)
                    

                    <div id="tooltip_sale_type_{{$sale->id}}"  x-data="{tooltip:false}" x-on:mouseleave="tooltip=false">
                        <div x-on:mouseover="tooltip=true">
                            <i class="fas fa-cart-arrow-down"></i>
                        </div>
                        <div x-show="tooltip" x-cloak x-transition >
                            <div class="bg-white rounded shadow p-4 absolute">
                                venta realizada a travez de la página
                            </div>
                        </div>
                    </div>
                @elseif($sale->sale_type == 3)
                    <div id="tooltip_sale_type_{{$sale->id}}"  x-data='{tooltip:false}' x-on:mouseleave='tooltip=false'>
                        <div x-on:mouseover='tooltip=true'>
                            <i class="fas fa-user"></i>
                        </div>
                        <div x-show='tooltip' x-cloak x-transition >
                            <div class='bg-white rounded shadow p-4 absolute'>
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
                        <div x-show='tooltip' x-cloak x-transition >
                            <div class='bg-white rounded shadow p-4 absolute'>
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
                    <x-jet-secondary-button wire:click="setBoleta()">Emitir</x-jet-secondary-button>

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
                    <div id='tooltip_payment_receipt_url_{{$sale->id}}' x-data='{tooltip:false,isOpenModalImage:false}' x-on:mouseleave='tooltip=false'>
                        <div x-on:mouseover='tooltip=true' x-on:click="isOpenModalImage=true">
                            <img class="w-10 object-cover cursor-pointer" src="{{Storage::url($sale->payment_receipt_url)}}" alt="Imagen del recibo {{$sale->id}}">
                        </div>
                        <div x-show='tooltip' x-cloak x-transition >
                            <div class='bg-white rounded shadow p-4 absolute'>
                                <div>por {{ ($sale->paymentReceiptBy())? $sale->paymentReceiptBy()->name :''}}</div>
                                <div>el {{($sale->payment_receipt_date) ? Helper::date($sale->payment_receipt_date)->dayName : ''}} {{($sale->payment_receipt_date) ? Helper::date($sale->payment_receipt_date)->format('d-m-Y H:i') : ''}} </div>
                            </div>
                        </div>
                        <div x-cloak x-show="isOpenModalImage" x-transition>
                            <x-modals.image-screen>
                                <div>
                                    <img class="w-full object-contain transform shadow rounded transition ease-in-out delay-100 hover:-translate-y-1 scale-75 hover:scale-125 duration-1000" src="{{Storage::url($sale->payment_receipt_url)}}" alt="Imagen del recibo {{$sale->id}}">
                                    <div class="fixed bottom-12 right-12 ">
                                        <x-jet-danger-button x-on:click="isOpenModalImage=false">Cerrar</x-jet-danger-button>
                                    </div>
                                </div>
                            </x-modals.image-screen>
                        </div>
                    </div>
                @elseif($sale->payment_account > 1 && ($sale->verify_payment_receipt == null || $sale->verify_payment_receipt == 0) )
                    <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-yellow-500 text-white rounded-full">
                        Pendiente
                    </span>
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
                        <div x-show='tooltip' x-cloak x-transition >
                            <div class='bg-white rounded shadow p-4 absolute'>
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
