@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
    <h1>Lista de Etiquetas</h1>
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



    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.tags.create') }}" class="btn btn-secondary"> Agregar Etiqueta</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>
                                <div class="rounded text-white inline p-1 "
                                    style="background: {{ $tag->color }}; width:100px; text-align:center">
                                    {{ $tag->color }}
                                </div>

                            </td>

                            <td width='10'>
                                <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-primary btn-sm">Editar</a>
                            </td>

                            <td width='10'>
                                <form action="{{ route('admin.tags.destroy', $tag) }}" method='POST'
                                    class="alerta_eliminar">
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
