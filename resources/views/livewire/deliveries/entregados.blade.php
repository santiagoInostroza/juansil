<div class="card  mt-5">
    @if ($ventas_entregadas == 0)
        <div class="card-header">
            <h2>No hay nada entregado</h2>
        </div>
    @else
        <div class="card-header">
            <h2>Entregados ({{ $ventas_entregadas }})</h2>
        </div>

        <div class="card-body">
            <table id="tablaEntregarHoy" class="table table-hover table-bordered table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Direccion</th>
                        <th>Comuna</th>
                        <th>Contacto</th>
                        <th>Total</th>
                        <th> <i class="far fa-money-bill-alt"></i> Fecha Pago</th>
                        <th> <i class="fas fa-truck"></i> Fecha Entrega</th>
                        <th>Comentarios</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                        <tr>
                            <td>
                                {{ $venta->id }}
                            </td>
                            <td>
                                <div>
                                    <a
                                        href="{{ route('admin.customers.edit', $venta->customer) }}">{{ $venta->customer->name }}</a>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <a href="https://goo.gl/maps/NqYgcu6aNg9LNaDH6">{{ $venta->customer->direccion }}
                                        @if ($venta->customer->block != '') "Torre:
                                            " .
                                            $venta->customer->block @endif
                                    </a>
                                </div>
                            </td>
                            <td>{{ $venta->customer->comuna }}</td>
                            <td>
                                <div class="text-sm">

                                    @if ($venta->customer->telefono)
                                        <div class="mb-2" style="width: max-content">
                                            <div class="d-inline-block " style="width: 100px">
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
                            </td>
                            <td>
                                $ {{ number_format($venta->total, 0, ',', '.') }}
                            </td>
                            <td>{{-- FECHA PAGO --}}
                                <div class='text-sm' style="width: max-content;margin: auto">
                                    <i class="far fa-money-bill-alt  mr-2"></i>
                                    {{ date('d-m-Y H:i:s', strtotime($venta->payment_date)) }}
                                </div>
                            </td>
                            <td>{{-- FECHA ENTREGA --}}
                                <div class="text-sm" style="width: max-content;margin: auto">
                                    <i class="fas fa-truck mr-2"></i>
                                    {{ date('d-m-Y H:i:s', strtotime($venta->date_delivered)) }}
                                </div>
                            </td>
                            <td>
                                {{ $venta->comments }}
                            </td>
                            <td>
                                <div class="d-flex ">
                                    <input type="hidden" class="latitud2" value="{{ $venta->customer->latitud }}">
                                    <input type="hidden" class="longitud2" value="{{ $venta->customer->longitud }}">
                                    <input type="hidden" class="id_venta2" value="{{ $venta->id }}">
                                    <input type="hidden" class="direccion2"
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
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
