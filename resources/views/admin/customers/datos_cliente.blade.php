@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
    <h1>Datos Cliente</h1>
@stop

@section('content')

   {{$cliente}}
<hr>
   {{$cliente->customer_data}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
    
    </script>
@stop