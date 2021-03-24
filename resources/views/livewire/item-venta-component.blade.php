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
        <input wire:model='cantidad' id='cantidad' wire:keyup='calculos' type="number" name='cantidad[]' class="form-control" style="min-width: 80px" wire:focus='showStock' wire:blur='hideStock' >
        @error('cantidad') <span class="error">{{ $message }}</span> @enderror
    </td>
    <td>
        {!! Form::number('cantidad_por_caja[]', null, ['class' => 'form-control','wire:model'=>'cantidad_por_caja','wire:keyup'=>'calculos','wire:focus'=>'showStock','wire:blur'=>'hideStock','style'=>'min-width: 80px','id'=>'cantidad_por_caja']) !!}
    </td>
    <td>
        {!! Form::number('cantidad_total[]', null, ['class' => 'form-control','wire:model'=>'cantidad_total', 'readonly' => 'readonly','style'=>'min-width: 80px','id'=>'cantidad_total','wire:focus'=>'showStock','wire:blur'=>'hideStock']) !!}
        @if ($showStock && count($stock)>0 )
            <div class="p-2 my-1 shadow rounded @if($cantidad_total > $stock[0]->stock) bg-danger @elseif ($cantidad_total >0 && $stock[0]->stock >0) bg-success @else bg-light  @endif" style="position: absolute">
                  @if ($cantidad_total>0)
                  Stock disponible {{ ($stock[0]->stock - $cantidad_total ) }} 
                  @else
                  Stock disponible {{$stock[0]->stock}}
                  @endif 
              
            </div>
        @endif
    </td>
    <td>
        {!! Form::number('precio[]', null, ['class' => 'form-control','wire:model'=>'precio','wire:focus'=>'showPrices','wire:blur'=>'hidePrices','wire:keyup'=>'calculaPrecioTotal','style'=>'min-width:80px','id'=>'precio']) !!}
        @if ($showPrices && count($lista_precios)>0)
            <div class="p-1 my-1 shadow rounded bg-light" style="position: absolute">
                @foreach ($lista_precios as $item)
                <div>
                    desde {{$item->quantity}} x ${{ number_format($item->price,0,',','.')}}
                </div>

                @endforeach
              
            </div>
        @endif
    </td>
    <td>
        {!! Form::number('precio_por_caja[]', null, ['class' => 'form-control','wire:model'=>'precio_por_caja','wire:keyup'=>'calculaPrecio','style'=>'min-width:80px','id'=>'precio_por_caja']) !!}
    </td>
    <td>
        {!! Form::number('precio_total[]', null, ['class' => 'form-control', 'readonly' => 'readonly','wire:model'=>'precio_total','style'=>'min-width:80px','id'=>'total_producto']) !!}
    </td>
    <td>
        <div wire:click='eliminarItem' class="btn btn-secondary btn"><i
                class="far fa-trash-alt"></i></div>
    </td>

</tr>
