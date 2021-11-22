<div class="p-2">
    @if ($mostrar_venta)
   
        @if ( $venta->customer->comentario != null || $venta->comments != null )
            <div class="p-2 bg-red-500 text-white text-xl"  >
                <div> {{ $venta->customer->comentario }}</div>
                <div> {{ $venta->comments }}  </div>
            </div>
        @endif
        <div class="">
            <div class="">
                <div class="h3 form-group pb-0 mb-0 d-flex" style="justify-content: space-between; align-items: center;">
                    <div class="text-2xl pt-2 relative">
                        <a href="{{ route('admin.customers.edit', $venta->customer) }}">{{ $venta->customer->name }}</a>
                        <div class="absolute top-0 right-0 pt-1 px-4 p text-3xl bg-white "> ${{ number_format($venta->total,0,',','.')}}</div>
                    </div>
                    <div class="w-full pb-2">
                        <a class="pb-2" style="width: max-content" href='https://www.google.cl/maps/place/{{ $venta->customer->direccion }}'  target='_blank'>
                           
                            {{ $venta->customer->direccion }}
                            @if ($venta->customer->block != '') 
                                Torre  {{ $venta->customer->block }},
                            @endif
                            @if ($venta->customer->depto != '') 
                                Depto: {{ $venta->customer->depto }}
                            @endif
                        </a>
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
                </div>
               
            </div>
          
        </div>

       <div class="p-4">
           
            @foreach ($venta->sale_items as $item)
                <div class="flex items-center gap-2 justify-between">
                    <div class="flex w-max-content">
                        {{ $item->cantidad }}x{{ $item->cantidad_por_caja }}
                    </div>
                    <div>
                        {{ $item->product->name }}
                    </div>

                    <div class="text-right">
                        ${{ number_format($item->precio_total, 0, ',', '.') }}
                    </div>
                </div>
            @endforeach
            <hr>

            <div class="flex justify-end mt-2 ">
                <div class="grid grid-cols-2 gap-x-4">
                    <div>Subtotal</div>
                    <div class="text-right">${{ number_format($venta->subtotal,0,',','.')}}</div>
                    <div class="">Despacho</div>
                    <div class="text-right">${{ number_format($venta->delivery_value,0,',','.')}}</div>
                    <div class="font-bold">Total</div>
                    <div class="text-right font-bold">${{ number_format($venta->total,0,',','.')}}</div>
                </div>
            </div>
       </div>

       <div class="flex justify-between md:justify-start gap-4">
           
        <div>
            <div class="relative" x-data="{loading:false}" id="pay_{{$venta->id}}">
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
                        <i class="fas fa-check"></i>
                        @if ($venta->paymentBy())
                            por {{$venta->paymentBy()->name}}
                        @endif
                    </span>
                </div>
                    
                @endif
            </div>
        </div>

        <div class="relative" x-data="{loading:false}" id="deliver_{{$venta->id}}">
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


    @endif
</div>
