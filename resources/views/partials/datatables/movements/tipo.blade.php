<div class="" style="width: max-content">

    <span class="px-2">
        @if ($movimiento->movement_type == 'Compra' || $movimiento->movement_type == "Ajuste Stock de Ingreso")
            <a class="p-2" href="{{ route('admin.purchases.edit', $movement) }}">
                {{ $movimiento->movement_type }}:{{ $movimiento->movement_id }}</a>

        @elseif($movimiento->movement_type == 'Venta' || $movimiento->movement_type == "Ajuste Stock de Salida")
            <a class="p-2" href="{{ route('admin.sales.edit', $movement) }}">
                {{ $movimiento->movement_type }}:{{ $movimiento->movement_id }}</a>
        @endif
    </span>



</div>
