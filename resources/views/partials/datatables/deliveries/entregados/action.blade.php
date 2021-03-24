<div class="d-flex ">

    {{-- <a href="{{ route('admin.sales.datos_cliente', $venta) }}" title="Ver datos del cliente" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a> --}}
    <a href="{{ route('admin.sales.edit', $venta) }}" class="btn btn-secondary btn-sm mx-2"><i class="fas fa-pen"></i></a>
    <form action="{{ route('admin.sales.destroy', $venta) }}" method='POST' class="alerta_eliminar">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-secondary btn-sm"><i class="far fa-trash-alt"></i></button>
    </form>
</div>
