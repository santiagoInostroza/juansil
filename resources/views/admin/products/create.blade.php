@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
<div class="container">
    <h1>Crear Producto</h1>
</div>
@stop

@section('content')

    <div class="card container">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.products.store', 'autocomplete' => 'off','files'=>'true']) !!}
            @include('admin.products.partials.form')
            {!! Form::submit('Crear Producto', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@stop

 @section('css')
    
 <style>
     .image-wrapper{
         position: relative;
         padding-bottom: 56.25%;
     }
     .image-wrapper img{
         position: absolute;
         object-fit: contain;
         width: 100%;
         height: 100%;
     }

 </style>
@stop 

@section('js')
    <script>
        //Cambiar imagen
        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event){
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result); 
            };

            reader.readAsDataURL(file);
        }


    </script>
@stop
