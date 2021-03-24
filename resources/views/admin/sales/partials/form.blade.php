


{{-- DETALLE VENTA --}}
@isset($venta)
    <livewire:detalle-venta :venta='$venta' > 
@else
    <livewire:detalle-venta :cliente_id='$cliente_id'> 
@endisset  

    
{{-- FIN DETALLE VENTA  --}}



