@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
    <h1>Editar categoria</h1>
@stop

@section('content')

@if (session('info'))
    <div class="alert alert-success">
        <strong>
            {{session('info')}}
        </strong>
    </div>
@endif
<div class="card">
    <div class="card-body">
        {!! Form::model($categoria, ['route' => ['admin.categories.update',$categoria], 'method'=>'put'  ]) !!}
        @include('admin.categories.partials.form')
        {!! Form::submit('Actualizar categoria', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop