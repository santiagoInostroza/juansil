<div class="row">

    {{-- NOMBRE --}}
    <div class="form-group col-sm">
        {!! Form::label('name', 'Nombre', ['class' => '']) !!}
        {!! Form::text('name', null, ['class' => 'form-control to_slug', 'placeholder' => 'Ingresa Nombre']) !!}

        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- SLUG --}}
    <div class="form-group d-none">
        {!! Form::label('slug', 'Slug', ['class' => '']) !!}
        {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => 'Ingresa Slug', 'readonly' => true]) !!}
        @error('slug')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    {{-- Telefono --}}
    <div class="form-group col-sm d-none">
        {!! Form::label('telefono', 'Telefono (codigo + telefono)', ['class' => '']) !!}
        {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Ingresa Telefono']) !!}


        @error('telefono')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
@isset($cliente)
    @livewire('input.celular', ['celular' => $cliente->celular])
@else
    @livewire('input.celular')
@endisset
   
   

</div>
<div class="row">

    {{-- Direccion --}}
    <div class="form-group col-sm">
        {!! Form::label('direccion', 'Direccion', ['class' => '']) !!}
        {!! Form::text('direccion', null, ['id' => 'direccion', 'class' => 'form-control', 'placeholder' => 'Ingresa Direccion']) !!}

        @error('direccion')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>


    {{-- PLACE ID --}}
    <div class="form-group col-sm d-none">
        {!! Form::label('place_id', 'Place Id', ['class' => '']) !!}
        {!! Form::text('place_id', null, ['id' => 'place_id', 'class' => 'form-control', 'placeholder' => '', 'readonly' => true]) !!}
        @error('place_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

</div>
<div class="row">

    {{-- LATITUD --}}
    <div class="form-group col-sm d-none">
        {!! Form::label('latitud', 'Latitud', ['class' => '']) !!}
        {!! Form::text('latitud', null, ['class' => 'form-control', 'placeholder' => 'Latitud', 'readonly' => true]) !!}

        @error('latitud')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>


    {{-- LONGITUD --}}
    <div class="form-group col-sm d-none">
        {!! Form::label('longitud', 'Longitud', ['class' => '']) !!}
        {!! Form::text('longitud', null, ['class' => 'form-control', 'placeholder' => 'longitud', 'readonly' => true]) !!}
        @error('longitud')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

</div>


<div class="row">
    {{-- COMUNA --}}
    <div class="form-group col-sm">
        {!! Form::label('comuna', 'Comuna', ['class' => '']) !!}
        {!! Form::text('comuna', null, ['class' => 'form-control', 'placeholder' => 'Comuna', 'readonly' => true]) !!}

        @error('comuna')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- Block --}}
    <div class="form-group col-sm">
        {!! Form::label('block', 'Torre/Block', ['class' => '']) !!}
        {!! Form::text('block', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}

        @error('block')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    {{-- Depto --}}
    <div class="form-group col-sm">
        {!! Form::label('depto', 'Depto', ['class' => '']) !!}
        {!! Form::text('depto', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}

        @error('depto')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

</div>

{{-- Comentario --}}
<div>
    {!! Form::label('', 'Comentario +', ['id' => 'comentario', 'class' => 'btn btn-sm btn-light']) !!}
</div>

<div class="form-group" id="comentario-in">
    {!! Form::textarea('comentario', null, ['class' => 'form-control', 'style' => 'height:50px', 'placeholder' => 'Ingresa Comentario']) !!}
    @error('comentario')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

{{-- <div id='map' class="mb-3" ></div> --}}

<div id="map"></div>
<div id="infowindow-content">
    <span id="place-name" class="title"></span><br />
    {{-- <strong>Place ID</strong>: <span id="place-id"></span><br /> --}}
    <span id="place-address"></span>
</div>