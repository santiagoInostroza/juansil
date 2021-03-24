<div>

    <div class="d-flex my-4">
        <a class="btn btn-dark " href="{{ route('admin.deliveries.index') }}/{{ $prev }}"> Anterior </a>
        <input type="date" name="fecha" id="" class="form-control mx-3" value="{{ $fecha }}"onchange="return cambiarFecha(this);">
        <a class="btn btn-dark" href="{{ route('admin.deliveries.index') }}/{{ $next }}">Siguiente </a>
    </div>

    @if (count($ventas) == 0)
        <div class="card  mt-5">
            <div class="card-header">
                <h2>
                    No hay pedidos para este día
                </h2>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-header">
                <h2 class="">
                    Pedidos {{ count($ventas) }}
                </h2>
            </div>
            <div id="map" class="card-body">
                Cargando mapa...
            </div>
            <div class="card-body" id='info_venta'>
                <livewire:deliveries.info-venta>
            </div>
        </div>
    @endif

    <livewire:deliveries.pendientes :fecha='$fecha'>
    <livewire:deliveries.entregados :fecha='$fecha'>
    <livewire:deliveries.picking :fecha='$fecha'>

</div>
