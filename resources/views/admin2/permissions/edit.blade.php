@extends('layouts.admin')

@section('header')
@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" >
        Editar Permiso {{$permission->id}} {{$permission->name}}
        @can('admin.permissions.index')
            <a href="{{route('admin2.permissions.index')}}">
                <x-jet-button>Ir a lista de Permisos</x-jet-button>
            </a>
        @endcan
    </div>
@endsection


@section('content')

    @livewire('admin2.permissions.edit-permission',['permission' => $permission], key('edit-permission'))

@endsection