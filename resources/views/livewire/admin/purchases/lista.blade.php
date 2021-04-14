<div class="card">
    <div class="card-header">
        <input wire:model='search' type="text" class="form-control" placeholder="Ingrese nombre o direccion a buscar">
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Proveedor</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Comentarios</th>
                    <th>Ingresado por</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                <tr>
                    {{-- ID --}}
                    <td width='10px'>
                        <div>{{$purchase->id}}</div>
                    </td> 
                    
                    {{-- NOMBRE --}}
                    <td>
                        <div class="h5 ">
                            {{$purchase->supplier->name}}
                        </div>
                    </td>   
                    
                    {{-- TOTAL --}}
                    <td>
                        ${{number_format($purchase->total,0,',','.')}}
                    </td>

                    {{-- FECHA --}}
                    <td>
                        {{date("d-m-Y",strtotime($purchase->fecha))}}
                    </td>

                    {{-- COMENTARIOS --}}
                    <td>
                        {{$purchase->comments}}
                    </td>

                    <td>
                        @if ($purchase->created_by())
                            {{$purchase->created_by()->name}}   
                        @endif
                    </td>

                    {{-- ACCION --}}
                    <td width='10px'>
                        <div class="d-flex">
                            <a href="{{ route('admin.purchases.show', $purchase) }}" title="Ver datos del cliente" class="btn btn-secondary btn-sm  mr-2"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.purchases.edit', $purchase) }}" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('admin.purchases.destroy', $purchase) }}" method='POST' class="alerta_eliminar  mr-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </td>

                </tr>     
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $purchases->links() }}
    </div>

</div>
