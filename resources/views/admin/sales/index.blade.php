{{-- @extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')

    <div class="float-right ">
        <a href="{{ route('admin.sales.create') }}" class="btn btn-secondary"> Agregar Venta</a>
    </div>
    <h1>Lista de Ventas</h1>

@stop

@section('css')


@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>
                {{ session('info') }}
            </strong>
        </div>
    @endif

    @if (session('eliminado') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'Se ha eliminado!.',
                'success'
            )
        </script>
    @endif

    @stop --}}

    
@extends('layouts.admin4')

@section('content')
    @livewire('admin.sales.index', ['user' => ''])      
@endsection
    
   