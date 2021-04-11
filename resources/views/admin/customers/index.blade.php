@extends('adminlte::page')

@section('title', 'Juansil-Clientes')

@section('content_header')
@stop

@section('content')

  
    @livewire('admin.customers.index', ['user' => ''])

    
@stop

