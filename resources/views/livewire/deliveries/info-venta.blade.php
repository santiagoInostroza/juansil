<div class="px-2">
    @if ($mostrar_venta)
        <div class="row">
            <div class="col-md">
                <div class="text-xl form-group pb-0 mb-0" style="">
                    <a href="{{ route('admin.customers.edit', $venta->customer) }}">{{ $venta->customer->name }}</a>
                </div>
                <div class="form-group" style="width: max-content">
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
            </div>
            <div class="text-xl form-group col-md ">
                $ {{ number_format($venta->total, 0, ',', '.') }}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md">
                @if ($venta->customer->telefono)
                    <div class="mb-2" style="width: max-content">
                        <div class="d-inline-block " style="width: max-content">
                            {{ $venta->customer->telefono }}
                        </div>
                        <a href="tel:+{{ $venta->customer->telefono }} " target="_blank"><i
                                class="fas fa-phone-square p-1 mr-1  bg-success"></i></a>
                    </div>
                @endif
                @if ($venta->customer->celular)
                    <div class="" style="width: max-content">
                        <div class="d-inline-block " style="width: 100px">
                            {{ $venta->customer->celular }}
                        </div>

                        <a href="tel:{{ $venta->customer->celular }}" target="_blank"><i
                                class="fas fa-phone-square p-1 mr-1  bg-success"></i></a>
                        <a href="https://api.whatsapp.com/send?phone={{ $venta->customer->celular }}&text=Hola,%20Le%20hablo%20de:%20'Precios%20Convenientes'."
                            target="_blank"><i class="fab fa-whatsapp p-1 mr-1 bg-success"></i></a>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">

            <div class='form-group col-md' style="">
                <i class="far fa-money-bill-alt  mr-2"></i>
                @if ($payment_status == 1)
                    Pendiente
                    <div wire:click="pagar({{ $venta->id }})" class="btn bg-warning  ml-2">
                        Pagar
                    </div>
                @elseif($payment_status==2)
                    Abonado
                    
                    <div wire:click='pagarDiferencia({{ $venta->id }})' style="background: #d0e80a" class="btn ml-2">Pagar</div>
                @elseif($payment_status==3) {{-- PAGADO --}}
                    Pagado
                    {{ date('d-m-Y H:i:s', strtotime($venta->payment_date)) }}
                    <span class="btn btn-success ml-2"> <i class="fas fa-check"></i></span>
                @endif
            </div>

            <div class="form-group col-md" style="">
                <i class="fas fa-truck mr-2"></i>
                @if ($venta->delivery_stage == 0)
                    Pendiente <div wire:click="$emit('entregar',{{ $venta->id }})" class="btn bg-warning  ml-2"> Entregar
                    </div>
                @elseif($venta->delivery_stage==1) {{-- PAGADO --}}
                    Entregado
                    {{ date('d-m-Y H:i:s', strtotime($venta->date_delivered)) }}
                    <span class="btn btn-success ml-2"><i class="fas fa-check"></i></span>
                @endif
            </div>

        </div>

        <div>
            {{ $venta->comments }}
        </div>

        <hr>
        @foreach ($venta->sale_items as $item)
            <div class="d-flex" style="width: max-content">
                <div class="" style="width: 60px">
                    {{ $item->cantidad }} x {{ $item->cantidad_por_caja }}
                </div>
                <div class="pr-2" style="width: 200px" >
                    {{ $item->product->name }}
                </div>

                <div class="" style="width: 60px">
                    ${{ number_format($item->precio_total, 0, ',', '.') }}
                </div>
            </div>

        @endforeach


    @endif
</div>
