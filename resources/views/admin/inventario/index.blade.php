@extends('layouts.admin4')

@section('content')
@php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
@endphp 
    @livewire('admin.inventario.index')
@endsection