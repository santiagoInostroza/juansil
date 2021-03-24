<div class="d-flex ">
    <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="btn btn-primary btn-sm mx-2"><i class="fas fa-pen"></i></a>
    <form action="{{ route('admin.suppliers.destroy', $supplier) }}" method='POST' class="alerta_eliminar">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
    </form>
</div>
