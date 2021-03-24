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
        {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => 'Ingresa Slug', 'readonly' => true])
    !!}
    @error('slug')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

{{-- ESTADO --}}
<div class="form-group col-sm">
    <p>Estado</p>
    <label> {!! Form::radio('status', 1, true, ['class' => 'mr-2']) !!} Activo </label>
    <label> {!! Form::radio('status', 2, false, ['class' => 'mx-2']) !!} Inactivo </label>
    @error('status')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
</div>

{{-- DESCRIPCION --}}
<div class="form-group">
    {!! Form::label('description', 'Descripcion', ['class' => '']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control ckeditor', 'placeholder' => 'Ingresa
    Descripcion']) !!}


    @error('description')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>



<hr>

{{-- IMAGEN --}}
<div class="row mb-3">

    <div class="col-sm">
        <div class="image-wrapper">
            @isset($producto->image)
                <img id='picture' src="{{ Storage::url($producto->image->url) }}" alt="">
            @else
                <img id='picture' src="{{ Storage::url('products/sinFoto.png') }}" alt="">
            @endisset

        </div>
    </div>
    <div class="col-sm">
        <div class="form-group">
            {!! Form::label('file', 'Imagen que se mostrara en el post') !!}
            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}
            @error('file')
                <br>
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

</div>

<hr>
<div class="row">

    {{-- CATEGORIA --}}
    <div class="form-group col-sm">
        {!! Form::label('category_id', 'Categoria', ['class' => '']) !!}
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'placeholder' =>
        'Selecciona Categoria']) !!}
        @error('category_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- MARCA --}}
    <div class="form-group col-sm">
        {!! Form::label('brand_id', 'Marca', ['class' => '']) !!}
        {!! Form::select('brand_id', $brand, null, [
        'class' => 'form-control select2',
        'placeholder' => 'Selecciona
        Marca',
        ]) !!}

        @error('brand_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

</div>
{{-- ETIQUETAS --}}
<div class="form-group col-sm">
    {!! Form::label('tags', 'Etiquetas', ['class' => '']) !!}
    {!! Form::select('tags[]', $tags, null, ['class' => 'select2Mul form-control', 'multiple' => 'multiple']) !!}

    @error('tags')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

{{-- PRECIOS --}}
<p>Precios</p>
<div class="form-group border p-2">

    <livewire:agregar-precios>




</div>



{{-- <div class="form-group ">
    {!!  Form::label('color', 'Color', ['class' => '']) !!}

    {!!  Form::select('color', '', null, ['class' => 'form-control']) !!}
    @error('color')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div> --}}
