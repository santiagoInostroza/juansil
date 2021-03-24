<div style="width: max-content">
    @if ($venta->delivery == 1) {{-- CON REPARTO --}}
      
      
        @if ($venta->delivery_stage == 1)
            <span class="p-2 m-1 bg-success">  <i class="fas fa-truck"></i>   {{ date('d-m-Y', strtotime($venta->delivery_date)) }}  Entregado </span> 
        @else
        <span class="p-2 m-1 bg-warning">  <i class="fas fa-truck"></i>   {{ date('d-m-Y', strtotime($venta->delivery_date)) }}  Pendiente </span>
        @endif
    @else
        Sin delivery
    @endif

</div>
