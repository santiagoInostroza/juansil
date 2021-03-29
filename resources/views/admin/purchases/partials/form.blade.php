<div>
    <div class="row">
        {{-- PROVEEDOR --}}
        <div class="form-group col-sm">
            <i class="fas fa-user"></i>
            {!! Form::label('supplier_id', 'Proveedor', ['class' => '']) !!}

            <div class="d-flex">
                <div style="width: 100%">
                    {!! Form::select('supplier_id', $suppliers, $proveedor_id, [
                            'class' => 'form-control select2',
                            'placeholder' => 'Selecciona Proveedor',
                        ]) !!}
                    @error('supplier_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="p-1 ml-2 mb-1 rounded btn" style="width:40px">
                    <a href="{{ route('admin.suppliers.create') }}"><i class="fas fa-user">+</i></a>
                </div>
            </div>

         

        </div>
        {{-- FECHA --}}
        <div class="form-group col-sm">
            {!! Form::label('fecha', 'Fecha', ['class' => '']) !!}
            @isset($compra)
                {!! Form::date('fecha', null, ['class' => 'form-control']) !!}
            @else
                {!! Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
            @endisset

            @error('supplier')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div>
        @isset($compra)
            <livewire:detalle-compra :compra='$compra'>
        @else
            <livewire:detalle-compra>
        @endisset
    </div>
</div>
