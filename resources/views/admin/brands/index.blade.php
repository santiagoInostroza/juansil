@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
    <h1>Lista de Marcas</h1>
@stop

@section('content')


@if (session('eliminado') == 'ok')
    <script>
        Swal.fire(
            'Eliminado!',
            'Se ha eliminado!.',
            'success'
        )
    </script>
    
@endif

@if (session('info'))
    <div class="alert alert-success">
        <strong>
            {{session('info')}}
        </strong>
    </div>
@endif

    <div class="card">
        <div class="card-header">
            <a href="{{route('admin.brands.create')}}" class="btn btn-secondary"> Agregar Marca</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th colspan="2"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{$brand->id}}</td>
                            <td>{{$brand->name}}</td>
                            
                            <td width='10'>
                                <a href="{{route('admin.brands.edit',$brand)}}" class="btn btn-primary btn-sm">Editar</a>
                            </td>

                            <td width='10'>
                                <form action="{{route('admin.brands.destroy',$brand) }}" method='POST' class="alerta_eliminar">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}

@section('js')
@stop 