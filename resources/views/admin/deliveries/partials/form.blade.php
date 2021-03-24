<div class="row">
    {{--CLIENTE --}}
    <div class="form-group col-sm">
        <i class="fas fa-user"></i>
        {!! Form::label('customer_id', 'Cliente', ['class' => '']) !!}
        {!! Form::select('customer_id', $customers, null, [
        'class' => 'form-control select2',
        'placeholder' => 'Selecciona
        Cliente',
        ]) !!}
        @error('customer_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- FECHA --}}
    <div class="form-group col-sm">
        {!! Form::label('date', 'Fecha', ['class' => '']) !!}
        @isset($venta)
            {!! Form::date('date', null, ['class' => 'form-control']) !!}
        @else
            {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        @endisset

        @error('date')
            <span class="text-danger">{{ $message }}</span>
        @enderror
       
    </div>
</div>


{{-- DETALLE VENTA --}}

@isset($venta)
    <livewire:detalle-venta :venta='$venta' > 
@else
    <livewire:detalle-venta> 
@endisset  

    
{{-- FIN DETALLE VENTA  --}}



