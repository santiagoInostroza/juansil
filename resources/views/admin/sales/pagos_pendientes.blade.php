@extends('adminlte::page')

@section('title', 'Juansil')

@section('content_header')
    <h1>Pagos pendientes</h1>
@stop

@section('content')
  @livewire('admin.pagos-pendientes.index', ['user' => ''])
@stop