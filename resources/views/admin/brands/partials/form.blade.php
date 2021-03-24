{{-- NOMBRE --}}
<div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => '']) !!}
    {!! Form::text('name', null, ['class' => 'form-control to_slug', 'placeholder' => 'Ingresa Marca']) !!}

    @error('name')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>

{{-- SLUG --}}
<div class="form-group d-none" >
    {!! Form::label('slug', 'Slug', ['class' => '']) !!}
    {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => 'Ingresa Slug','readonly'=>true]) !!}
    @error('slug')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
