{{-- @extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')

    <div class="float-right ">
        <a href="{{ route('admin.purchases.create') }}" class="btn btn-secondary"> Agregar Compra</a>
    </div>
    <h1>Lista de Compras</h1>

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


    
@extends('layouts.admin3')

@section('content')
    @livewire('admin.purchases.index')    
@endsection

