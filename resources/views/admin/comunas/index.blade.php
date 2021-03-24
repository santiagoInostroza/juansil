@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')

    <div class="float-right ">
        <a href="{{ route('admin.comunas.create') }}" class="btn btn-secondary"> Agregar Comuna</a>
    </div>
    <h1>Lista de Comunas</h1>

@stop

@section('css')



@stop

@section('content')
@livewire('admin.comunas.index')
@stop


@section('js')
@stop
