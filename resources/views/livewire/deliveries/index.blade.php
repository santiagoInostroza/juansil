<div>
    <div class="d-flex my-4">
        <a class="btn btn-dark " href="{{ route('admin.deliveries.index') }}/{{ $prev }}"> Anterior </a>
        <input type="date" name="fecha" id="" class="form-control mx-3" value="{{ $fecha }}"
            onchange="return cambiarFecha(this);">
        <a class="btn btn-dark" href="{{ route('admin.deliveries.index') }}/{{ $next }}">Siguiente </a>
    </div>

    <div>

        @if (date('Y-m-d', strtotime($fecha)) == date('Y-m-d'))
            <h4 class=" text-center ">
                Despacho para hoy
            </h4>
        @else
            <h3 class=" text-center ">
                Despacho {{ $fecha2->locale('es')->dayName }} {{ $fecha2->locale('es')->day }} de
                {{ $fecha2->locale('es')->monthName }}
            </h3>
        @endif
        <div wire:click="$set('showAgregarDespacho', true)" class="btn btn-secondary ">
            Agregar
        </div>
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
    @if ($showAgregarDespacho)
        @livewire('deliveries.agregar-despacho', ['delivery_date' => $fecha,'' => ''])  
    @endif

</div>
