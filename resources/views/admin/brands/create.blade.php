@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
    <h1>Crear Marca</h1>
@stop

@section('content')



    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.brands.store']) !!}
            @include('admin.brands.partials.form')
            {!! Form::submit('Crear Marca', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@stop

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}

@section('js')
@stop
