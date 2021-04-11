<div>
   <div class="card">
       <div class="card-header">
           <input wire:model='search' type="text" class="form-control" placeholder="Ingrese nombre o direccion a buscar">
       </div>
       <div class="card-body">
           <table class="table">
               <thead>
                   <tr>
                       <th>Id</th>
                       <th>cliente</th>
                       <th>contacto</th>
                       <th>obs</th>
                       <th>Accion</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($customers as $customer)
                    <tr>
                        <td>
                            <div class="d-flex">{{$customer->id}}</div>
                        </td>    
                        <td>
                        <div class="h5 ">
                            {{$customer->name}}
                            </div>
                            <div>
                                {{$customer->direccion}} 
                                @isset($customer->block) Torre {{$customer->block}} @endisset 
                                @isset($customer->depto) depto {{$customer->depto}} @endisset
                            </div>
                        </td>    
                        <td>
                            <div>{{$customer->telefono}}</div>
                            <div>{{$customer->celular}}</div>
                        </td>
                        <td></td>
                        <td width='10px'>
                            <div class="d-flex">
                                <a href="{{ route('admin.customers.datos_cliente', $customer) }}" title="Ver datos del cliente" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-secondary btn-sm mx-2"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('admin.customers.destroy', $customer) }}" method='POST' class="alerta_eliminar">
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
            {{ $users->links() }}
        </div>

   </div>
</div>
