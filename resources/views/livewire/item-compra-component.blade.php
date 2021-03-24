<tr> 
    <input type="hidden" name='id[]' value="{{$item_id}}">
   
    <td>
         {{-- {!!  Form::select('product_id[]', $nombreProductos, $itemCompra['product_id'], ['class' => 'select2', 'placeholder' => 'Selecciona producto'/*,'wire:model'=>'product_id'*/]) !!}  --}}
   
           <select name="products[]" id='product_id' class="form-control"  name="states" wire:change='calculos' wire:model='product_id' style="width: max-content" >
               <option value="">Selecciona Producto</option>
               @foreach ($nombreProductos as $key => $lista)
               <option value="{{ $key }}">{{ $lista }}</option>
               @endforeach
            </select> 
            @error('products') <span class="error">{{ $message }}</span> @enderror
      
       
       
    </td>
    <td>
        {{-- {!!  Form::number('cantidad[]', $itemCompra['cantidad'], ['class' => 'form-control','wire:keyup'=>'calculos','wire:model'=>'cantidad']) !!}  --}}
        <input wire:model='cantidad' id='cantidad' wire:keyup='calculos' type="number" name='cantidad[]' class="form-control" style="min-width: 80px"  >
        @error('cantidad') <span class="error">{{ $message }}</span> @enderror
    </td>
    <td>
        {!! Form::number('cantidad_por_caja[]', null, ['class' => 'form-control','wire:model'=>'cantidad_por_caja','wire:keyup'=>'calculos','style'=>'min-width: 80px','id'=>'cantidad_por_caja']) !!}
    </td>
    <td>
        {!! Form::number('cantidad_total[]', null, ['class' => 'form-control','wire:model'=>'cantidad_total', 'readonly' => 'readonly','style'=>'min-width: 80px','id'=>'cantidad_total']) !!}
    </td>
    <td>
        {!! Form::number('precio[]', null, ['class' => 'form-control','wire:model'=>'precio','wire:keyup'=>'calculaPrecioTotal','style'=>'min-width:80px','id'=>'precio']) !!}
    </td>
    <td>
        {!! Form::number('precio_por_caja[]',null, ['class' => 'form-control','wire:model'=>'precio_por_caja','wire:keyup'=>'calculaPrecio','style'=>'min-width:80px','id'=>'precio_por_caja']) !!}
    
    </td>
    <td>
        {!! Form::number('total_producto[]', null, ['class' => 'form-control', 'readonly' => 'readonly','wire:model'=>'total_producto','style'=>'min-width:80px','id'=>'total_producto']) !!}
    </td>
    <td>
        <div wire:click='eliminarItemCompra' class="btn btn-secondary btn"><i
                class="far fa-trash-alt"></i></div>
    </td>

</tr>
