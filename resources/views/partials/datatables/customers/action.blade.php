<div class="d-flex ">

    <a href="{{ route('admin.customers.datos_cliente', $cliente) }}" title="Ver datos del cliente" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
    <a href="{{ route('admin.customers.edit', $cliente) }}" class="btn btn-primary btn-sm mx-2"><i class="fas fa-pen"></i></a>
    <form action="{{ route('admin.customers.destroy', $cliente) }}" method='POST' class="alerta_eliminar">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
    </form>
</div>
