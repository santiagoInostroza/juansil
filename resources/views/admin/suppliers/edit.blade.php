@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>Editar Proveedor</h1>
    <div class="btn btn-primary "><a class='text-white' href="{{route('admin.purchases.create')}}/{{$proveedore->id}}">Ir a venta</a></div>
</div>
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
            {!! Form::model($proveedore, ['route' => ['admin.suppliers.update', $proveedore], 'files' => 'true', 'method' =>
            'put']) !!}
            @include('admin.suppliers.partials.form')
            {!! Form::submit('Actualizar Proveedor', ['class' => 'btn btn-primary']) !!}


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

@stop
