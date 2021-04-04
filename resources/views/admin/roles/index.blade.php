@extends('adminlte::page')

@section('title', 'Juansil - Roles')

@section('content_header') 
<div class="float-right ">
    <a href="{{ route('admin.roles.create') }}" class="btn btn-secondary"> Agregar Rol</a>
</div>
    <h1>Lista de roles</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Rol</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            <td>{{$rol->id}}</td>
                            <td>{{$rol->name}}</td>
                            <td width='10px'>
                                <a href="{{route('admin.roles.edit',$rol)}}" class="btn btn-sm btn-primary">Editar</a>
                            </td>
                            <td width='10px'>
                                <form action="{{route('admin.roles.destroy',$rol)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop