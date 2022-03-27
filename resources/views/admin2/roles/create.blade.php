@extends('layouts.admin')

@section('header')
@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" >
        Crear Nuevo Rol
        @can('admin.roles.index')
            <a href="{{route('admin2.roles.index')}}">
                <x-jet-button>Ir a lista de Roles</x-jet-button>
            </a>
        @endcan
    </div>
@endsection


@section('content')

    @livewire('admin2.roles.create-roles', key('create-roles'))

@endsection