{{-- NOMBRE --}}
<div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => '']) !!}
    {!! Form::text('name', null, ['class' => 'form-control to_slug', 'placeholder' => 'Ingresa Nombre']) !!}

    @error('name')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>

{{-- SLUG --}}
<div class="form-group d-none">
    {!! Form::label('slug', 'Slug', ['class' => '']) !!}
    {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => 'Ingresa Slug','readonly'=>true]) !!}
    @error('slug')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
{{-- COLOR --}}
<div class="form-group ">
    {!! Form::label('color', 'Color', ['class' => '']) !!}

    @isset($etiqueta->color)
    <span  class="rounded text-white p-1 " style="background: {{$etiqueta->color}}; width:100px; text-align:center">  Color actual</span>
    @endisset

    {{-- {!! Form::text('color', null, ['class' => 'form-control', 'placeholder' => 'Ingresa Color']) !!} --}}
    {!! Form::select('color', $colors, null, ['class'=>'form-control']) !!}
    @error('color')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
