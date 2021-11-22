<div class="card mt-5" x-data="{open:false}">
    @if ($entregas_pendientes == 0)
        <div class="card-header">
            <h2>No hay pendientes</h2>
        </div>
    @else
        <div class="card-header">
            <h2 class="" x-on:click="open=!open" style="cursor: pointer">Pendientes ({{ $entregas_pendientes }} ) Total pendiente ${{ number_format($ventas->sum('total'),0,',','.')}}</h2>
        </div>

        <div class="hidden" :class="{'hidden':!open}" >
            <table id="tablaEntregarHoy" class="table" >
                <thead>
                   
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                        <tr>
                            <td>
                                <div class="py-4 pb-8">

                                
                                    <div class="flex gap-4 items-center text-gray-500 font-bold">
                                        <div> {{ $venta->id }} </div>
                                        <div class="text-left">
                                            <a href="{{ route('admin.customers.edit', $venta->customer) }}">{{ $venta->customer->name }}</a>
                                        </div>
                                    </div> 
                                
                                
                                    <div class="text-gray-500 text-left">
                                        <a href='https://www.google.cl/maps/place/{{ $venta->customer->direccion }}' target='_blank'>{{ $venta->customer->direccion }}
                                            @if ($venta->customer->block != '') Torre: {{$venta->customer->block}} @endif
                                        </a>
                                    </div>
                                    <div class="text-red-700 text-left bg-red-200">
                                        {{ $venta->customer->comments }}
                                    </div>
                                    <div class="text-red-700 text-left bg-red-200">
                                        {{ $venta->comments }}
                                    </div>
                                    <div class="w-full flex items-center gap-4 text-3xl" >
                                        @if ($venta->customer->celular)
                                            <a href="tel:{{ $venta->customer->celular }}" target="_blank"><i
                                                    class="fas fa-phone-square p-2  bg-success"></i></a>
                                            <a href="https://api.whatsapp.com/send?phone={{ $venta->customer->celular }}&text=Hola,%20soy%20el%20repartidor,%20traigo%20su%20pedido"
                                                target="_blank"><i class="fab fa-whatsapp p-2 bg-success"></i></a>
                                            <a href="https://api.whatsapp.com/send?phone={{ $venta->customer->celular }}&text=Hola,%20Le%20envío%20datos.%0ACuenta%20Rut%20Patricia%20Arias%2017.007.186-2%0Apatriciaariasolivares27@gmail.com"
                                                target="_blank"><i class="fab fa-whatsapp p-2 bg-success"></i></a>
                                            <a href="https://api.whatsapp.com/send?phone={{ $venta->customer->celular }}&text=Hola,%20Le%20envío%20datos.%0ACuenta%20corriente%20Santander%0ASantiago%20Inostroza%2016.720.449-k%0Anúmero%20cuenta%2076828369%0Asantiagoinostroza2@gmail.com"
                                                target="_blank"><i class="fab fa-whatsapp p-2 bg-success"></i></a>
                                        @endif
                                        <a href='https://www.google.cl/maps/place/{{ $venta->customer->direccion }}'  target='_blank'><i class="fas fa-map-marker-alt p-2 shadow border"></i></a>
                                    </div>
                                    <div class="py-4 text-gray-500 ">
                
                                        @foreach ($venta->sale_items as $item)
                                            <div class="flex items-start gap-2 justify-between">
                                                <div class="flex w-max-content">
                                                    {{ $item->cantidad }}x{{ $item->cantidad_por_caja }}
                                                </div>
                                                <div class="text-left">
                                                    {{ $item->product->name }}
                                                </div>
                        
                                                <div class="text-right">
                                                    ${{ number_format($item->precio_total, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        @endforeach
                        
                                        <div class="flex justify-end mt-2 text-gray-500 ">
                                            <div class="grid grid-cols-2 gap-x-4">
                                                <div class="text-left">Subtotal</div>
                                                <div class="text-right">${{ number_format($venta->subtotal,0,',','.')}}</div>
                                                <div class="text-left">Despacho</div>
                                                <div class="text-right">${{ number_format($venta->delivery_value,0,',','.')}}</div>
                                                <div class="font-bold text-left">Total</div>
                                                <div class="text-right font-bold">${{ number_format($venta->total,0,',','.')}}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex md:justify-start gap-6">
                                        <div class="relative" x-data="{loading:false}" id="pay2_{{$venta->id}}">
                                            <div class="hidden" :class="{'hidden': !loading}">
                                                <x-spinner.spinner2 size="8"></x-spinner.spinner2>
                                            </div>
                                            {{-- <i class="far fa-money-bill-alt  mr-2"></i> --}}
                                            @if ($venta->payment_status == 1)
                                                <div>
                                                    <x-jet-button x-on:click="loading=true; $wire.payOrder({{ $venta }}).then(()=>loading=false)"> Pagar </x-jet-button>
                                                </div>
                                            @elseif($venta->payment_status==2)
                                                Abonado<div wire:click='pagarDiferencia({{ $venta->id }})' style="background: #d0e80a" class="btn ml-2">Pagar</div>
                                            @elseif($venta->payment_status==3) {{-- PAGADO --}}
                                            <div class="bg-green-500 text-white p-1 rounded">
                                                <span> 
                                                    Pagado el 
                                                    {{ Helper::fecha($venta->payment_date)->dayName}} {{ Helper::fecha($venta->payment_date)->format('H:i') }} 
                                                
                                                    @if ($venta->paymentBy())
                                                        por {{$venta->paymentBy()->name}}
                                                    @endif
                                                    <i class="fas fa-check"></i>
                                                </span>
                                            </div>
                                                
                                            @endif
                                        </div>
                                        

                                        <div class="relative" x-data="{loading:false}" id="deliver2_{{$venta->id}}">
                                            <div class="hidden" :class="{'hidden': !loading}">
                                                <x-spinner.spinner2 size="8"></x-spinner.spinner2>
                                            </div>
                                            <div class="flex justify-between items-center"  >
                                                @if ($venta->delivery_stage == null)
                                                    <x-jet-button  x-on:click="loading=true; $wire.deliverOrder({{ $venta }}).then(()=>loading=false)">Entregar</x-jet-button>
                                                @elseif($venta->delivery_stage==1) {{-- PAGADO --}}
                                                    <div class="bg-green-500 text-white p-1 rounded">
                                                        <span> 
                                                            Entregado  el {{ Helper::fecha($venta->date_delivered)->dayName}} {{ Helper::fecha($venta->date_delivered)->format('H:i') }} </span>
                                                            <i class="fas fa-check"></i>
                                                            @if ($venta->deliveredBy())
                                                                por  {{$venta->deliveredBy()->name}}
                                                            @endif
                                                            
                                                        </span>
                                                    </div>
                                                
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                
                                    <div>
                                        <input type="hidden" class="latitud" value="{{ $venta->customer->latitud }}">
                                        <input type="hidden" class="longitud" value="{{ $venta->customer->longitud }}">
                                        <input type="hidden" class="id_venta" value="{{ $venta->id }}">
                                        <input type="hidden" class="direccion" value="{{ $venta->customer->direccion }}">
                                    </div>

                                </div>
                    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
</div>