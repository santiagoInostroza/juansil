@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
    <h1>Crear Proveedor</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.suppliers.store', 'autocomplete' => 'off','files'=>'true']) !!}
            @include('admin.suppliers.partials.form')
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
   
@stop
