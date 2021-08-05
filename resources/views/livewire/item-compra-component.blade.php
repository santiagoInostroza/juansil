{{-- <tr> 
    <input type="hidden" name='id[]' value="{{$item_id}}">

   
    <td>
        @livewire('select.productos', ['indice' => $indice, 'product_id'=>$item['product_id'], 'query'=> $item['product_name']], key($indice) )
    </td>
    <td>
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

</tr> --}}
