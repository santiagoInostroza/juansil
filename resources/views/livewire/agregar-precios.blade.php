{{-- <div x-data="{ open:false }">
    <div class="d-flex align-items-stretch">

        @if ($listaProductos)
        
            @foreach ($listaProductos as $precio)

                <div class="shadow rounded text-white  d-inline-block p-2 my-2 mr-2  @if( ($precio['special_price'])  )bg-dark @else bg-light  @endif">
                  
                    <div class="m-auto" style="width: max-content">
                        x {{ $precio['quantity'] }}
                        @if ($precio['price'] != $precio['total_price'])
                            ${{ round($precio['total_price']) }}
                        @endif

                        @if ($precio['check'])

                        @endif

                    </div>
                    <div class="text-xl text-center">${{ round($precio['price']) }}</div>

                    @if ($precio['check'])
                        {!! Form::hidden('quantity[]', $precio['quantity']) !!}
                        {!! Form::hidden('price[]', $precio['price']) !!}
                        {!! Form::hidden('total_price[]', $precio['total_price']) !!}
                        {!! Form::hidden('special_price[]', $precio['special_price']) !!}

                        
                        <div wire:click='eliminar({{ $precio['quantity'] }})'
                            class=" btn btn-sm rounded bg-danger d-block">Eliminar</div>
                        <span class="text-sm">Precio registrado</span>
                    @else
                        
                        <div wire:click='restaurar({{ $precio['quantity'] }})' class="btn btn-sm btn-success d-block">
                            restaurar</div>
                        <span class="text-sm text-danger">Este precio se eliminará</span>
                    @endif

                </div>

            @endforeach
        @endif
        <div class="rounded text-dark shadow border d-inline-block  my-2 mr-2 btn" x-on:click="open=true">
            <div class="m-auto" style="width: max-content" data-toggle="modal" data-target="#exampleModal">
                Agregar precio
            </div>
            <div class="text-xl">+</div>
        </div>
    </div>



    <div class="" x-show="open">
        <div
            class="border origin-top-right p-4 absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-light ring-1 ring-black ring-opacity-5">


            <div class="form-group">
                <label for="cantidad" style="width:150px">Desde</label>
                <input wire:change='calcularTotal' wire:keyup='calcularTotal' type="number" name="" id=""
                    value="$cantidad" wire:model='cantidad' class="form-control">

            </div>
            <div class="form-group">

                <label for="precio_unitario" style="width:150px">Precio Unitario</label>
                <input wire:change='calcularTotal' wire:keyup='calcularTotal' type="number" name="" id=""
                    value="$precio_unitario" wire:model='precio_unitario' class="form-control">

            </div>
            <div class="form-group">
                <label for="precio_total" style="width:150px">Precio Total</label>
                <input wire:change='calcularPrecioUnitario' wire:keyup='calcularPrecioUnitario' type="number" name=""
                    id="" value="$precio_total" wire:model='precio_total' class="form-control">
            </div>
            <div class="custom-control custom-switch my-4">
                <input type="checkbox" class="custom-control-input" name="special_price" id="special_price" wire:model='special_price'>
                <label class="custom-control-label" for="special_price">Precio especial (comerciante)</label>
            </div>

            <div x-on:click="open=false" wire:click='agregarPrecio' class="btn btn-light my-3">Agregar Precio</div>
            <div x-on:click="open=false" class="btn btn-primary my-3">Cancelar</div>
        </div>
    </div>


    
</div> --}}
