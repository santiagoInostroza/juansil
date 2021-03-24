<div style="width: max-content">
    @if ($venta->payment_status==1) {{-- PENDIENTE --}}
   <span class="p-2 m-1 bg-warning">$</span>  Pendiente 
    @elseif($venta->payment_status==2) {{-- ABONADO --}}
    <span class="p-2  m-1"  style="background: #d0e80a">$</span>  Abonado
    @elseif($venta->payment_status==3) {{-- PAGADO --}}
       <span class="p-2  m-1 bg-success">$</span>   Pagado
    @endif
</div>