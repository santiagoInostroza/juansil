<div class="card mt-5" x-data="{open:false}">
    @if ($entregas_pendientes == 0)
        <div class="card-header">
            <h2>No hay pendientes</h2>
        </div>
    @else
        <div class="card-header">
            <h2 class="" x-on:click="open=!open" style="cursor: pointer">Pendientes ({{ $entregas_pendientes }})</h2>
        </div>

        <div class="hidden" :class="{'hidden':!open}" >
            <table id="tablaEntregarHoy" class="table " >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                       
                        <th> <i class="far fa-money-bill-alt"></i> Estado Pago</th>
                        <th> <i class="fas fa-truck"></i> Estado Entrega</th>
                        <th>Comentarios</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                        <tr>
                            <td> {{ $venta->id }} </td>
                            <td> 
                                <div class="text-left font-bold text-gray-500">
                                    <a href="{{ route('admin.customers.edit', $venta->customer) }}">{{ $venta->customer->name }}</a>
                                </div>
                                <div class="text-gray-500 text-left">
                                    <a href='https://www.google.cl/maps/place/{{ $venta->customer->direccion }}' target='_blank'>{{ $venta->customer->direccion }}
                                        @if ($venta->customer->block != '') Torre: {{$venta->customer->block}} @endif
                                    </a>
                                </div>
                                <div class="text-sm flex items-center gap-2">

                                    @if ($venta->customer->telefono)
                                        <div class="flex items-center gap-2">
                                            <div>
                                                {{ $venta->customer->telefono }}
                                            </div>
                                            <a href="tel:+{{ $venta->customer->telefono }} " target="_blank"><i
                                                    class="fas fa-phone-square p-1 mr-1  bg-success"></i></a>
                                        </div>
                                    @endif
                                    @if ($venta->customer->celular)
                                        <div class="flex items-center gap-2" >

                                            <div > {{ $venta->customer->celular }} </div>

                                            <a href="tel:{{ $venta->customer->celular }}" target="_blank"><i
                                                    class="fas fa-phone-square p-1 bg-success"></i></a>
                                            <a href="https://api.whatsapp.com/send?phone={{ $venta->customer->celular }}&text=Hola,%20Le%20hablo%20de:%20'Precios%20Convenientes'."
                                                target="_blank"><i
                                                    class="fab fa-whatsapp p-1 bg-success"></i></a>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        
                            <td>{{-- ESTADO PAGO --}}
                                <div class='text-sm' style="width: max-content;margin: auto">
                                    <i class="far fa-money-bill-alt  mr-2"></i>
                                    @if ($venta->payment_status == 1)
                                        Pendiente
                                        <div wire:click='payOrder({{ $venta }})' class="btn bg-warning  ml-2">
                                            Pagar
                                        </div>
                                    @elseif($venta->payment_status==2)
                                        Abonado
                                        style="background: #d0e80a"
                                        <div wire:click='pagarDiferencia({{ $venta->id }})'
                                            class="btn bg-warning  ml-2">Pagar</div>
                                    @elseif($venta->payment_status==3) {{-- PAGADO --}}
                                        Pagado <span class="p-1 bg-success  ml-2"><i
                                                class="fas fa-check"></i></span>
                                    @endif
                                </div>
                            </td>
                            <td>{{-- ESTADO ENTREGA --}}
                                <div class="text-sm" style="width: max-content;margin: auto">
                                    <i class="fas fa-truck mr-2"></i>
                                    @if ($venta->delivery_stage == 0)
                                        Pendiente <div wire:click='deliverOrder({{ $venta }})'
                                            class="btn bg-warning  ml-2"> Entregar</div>
                                    @elseif($venta->delivery_stage==1) {{-- PAGADO --}}
                                        Entregado <span class="p-1 bg-success ml-2"><i class="fas fa-check"></i></span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                {{ $venta->comments }}
                            </td>
                            <td>
                                <div class="d-flex ">
                                    <input type="hidden" class="latitud" value="{{ $venta->customer->latitud }}">
                                    <input type="hidden" class="longitud"
                                        value="{{ $venta->customer->longitud }}">
                                    <input type="hidden" class="id_venta" value="{{ $venta->id }}">
                                    <input type="hidden" class="direccion"
                                        value="{{ $venta->customer->direccion }}">

                                    {{-- <a href="{{ route('admin.sales.datos_cliente', $venta) }}" title="Ver datos del cliente" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a> --}}
                                    <a href="{{ route('admin.sales.edit', $venta) }}"
                                        class="btn btn-secondary btn-sm mx-2"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('admin.sales.destroy', $venta) }}" method='POST'
                                        class="alerta_eliminar">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-secondary btn-sm"><i
                                                class="far fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="5">
                                <div class="">
                                   @foreach ( $venta->saleItems as $item)
                                       <div class="text-left flex items-center gap-4 w-max-content">
                                           <div>{{$item->cantidad}} x {{$item->cantidad_por_caja}} </div>
                                           <div> {{$item->product->name}}</div>
                                           <div> ${{ number_format($item->precio_total,0,',','.')}}</div>
                                          
                                          
                                       </div>                                       
                                   @endforeach
                                   <div class="text-left">
                                   Delivery $ {{ number_format($venta->delivery_value, 0, ',', '.') }}
                                   </div>
                                   <div class="text-left">
                                   Total $ {{ number_format($venta->total, 0, ',', '.') }}
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