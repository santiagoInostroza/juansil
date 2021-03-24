<div style="width: max-content">
    @if ($venta->delivery_stage == 0) {{-- PENDIENTE --}}
        <span class="p-2 m-1 bg-warning">Pendiente</span>
        <div class="btn btn-secondary">Entregar</div>
   
    @elseif($venta->delivery_stage==1) {{-- PAGADO --}}
        <span class="p-2  m-1 ">{{ date("d-m-Y H:i",strtotime($venta->delivery_date)) }}</span>
    @endif
</div>