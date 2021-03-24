@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
    <h1>Lista de Categorias</h1>
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
            <a href="{{route('admin.categories.create')}}" class="btn btn-secondary"> Agregar categoria</a>
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
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            
                            <td width='10'>
                                <a href="{{ route('admin.categories.edit',$category) }}" class="btn btn-primary btn-sm">Editar</a>
                            </td>

                            <td width='10'>
                                <form action="{{route('admin.categories.destroy',$category) }}" method='POST' class="alerta_eliminar">
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
@stop--}}

@section('js')
@stop 