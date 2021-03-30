<div class="form-group ">
    {!! Form::label('celular', 'Celular', ['class' => '']) !!}
    {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Ingresa celular', 'wire:model' => 'celular' ,'wire:blur' => 'validarCelular']) !!}

    @error('celular')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
    @if ($msjErrorCelular!="")
    <span class="invalid-feedback">{{ $msjErrorCelular }}</span>
    @endif
</div>

