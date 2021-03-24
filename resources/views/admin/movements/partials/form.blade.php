<div class="row">

   

    {{-- PROVEEDOR --}}
    <div class="form-group col-sm">
        {!! Form::label('supplier_id', 'Proveedor', ['class' => '']) !!}
        {!! Form::select('supplier_id', $suppliers, null, [
        'class' => 'form-control select2',
        'placeholder' => 'Selecciona
        Proveedor',
        ]) !!}
        @error('supplier_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
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


{{-- DETALLE COMPRA --}}
@isset($compra)
    <livewire:detalle-compra :compra='$compra' > 
       @else
    <livewire:detalle-compra> 
@endisset 

    
{{-- FIN DETALLE COMPRA --}}



{{-- COMENTARIOS --}}
<div class="form-group">
    {!! Form::label('comments', 'Comentarios', ['class' => '']) !!}
    {!! Form::textarea('comments', null, ['class' => 'form-control ckeditor', 'placeholder' => 'Ingresa Comentario'])!!}
    @error('comments')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
