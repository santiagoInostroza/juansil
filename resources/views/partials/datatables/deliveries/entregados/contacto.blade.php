
@if($venta->customer->telefono)
    {{ $venta->customer->telefono }} 
    <a href="tel:+{{ $venta->customer->telefono }} " target="_blank"><i class="fas fa-phone-square p-2 mr-1  bg-success"></i></a>
@endif
@if ($venta->customer->celular)
{{$venta->customer->celular}}
<a href="tel:{{$venta->customer->celular}}"  target="_blank"><i class="fas fa-phone-square p-2 mr-1  bg-success"></i></a>
<a href="https://api.whatsapp.com/send?phone={{$venta->customer->celular}}&text=Hola,%20Le%20hablo%20de:%20'Precios%20Convenientes'." target="_blank"><i class="fab fa-whatsapp p-2 mr-1 bg-success"></i></a>
@endif
