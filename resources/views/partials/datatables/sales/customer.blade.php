<div>
    <a href="{{route('admin.customers.edit',$venta->customer)}}">{{$venta->customer->name}}</a>
    <div>
       {{ $venta->customer->direccion}}
    </div>
</div>