@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
    <h1>Editar Producto</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>
                {{ session('info') }}
            </strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($producto, ['route' => ['admin.products.update', $producto], 'files' => 'true', 'method' =>
            'put']) !!}
            @include('admin.products.partials.form')
            {!! Form::submit('Actualizar Producto', ['class' => 'btn btn-primary']) !!}


            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('css')
    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img {
            position: absolute;
            object-fit: contain;
            width: 100%;
            height: 100%;
        }

    </style>

@stop

@section('js')
    <script src="{{ asset('vendor\jQuery-Plugin-stringToSlug-1.3\jquery.stringToSlug.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>

    <script>
        //Cambiar imagen
        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };

            reader.readAsDataURL(file);
        }

    </script>
@stop
