<div class="d-flex ">
    
    {{-- <a href="{{ route('admin.purchases.show', $compra) }}" class="btn btn-secondary btn-sm"><i class="far fa-eye"></i></a> --}}
    <a href="{{ route('admin.purchases.edit', $compra) }}" class="btn btn-secondary btn-sm mx-2"><i class="fas fa-pen"></i></a>
    <form action="{{ route('admin.purchases.destroy', $compra->id) }}" method='POST' class="alerta_eliminar">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-secondary btn-sm"><i class="far fa-trash-alt"></i></button>
    </form> 
</div>
