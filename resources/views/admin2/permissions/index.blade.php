@extends('layouts.admin')

@section('header')
@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" >
        Permisos
        @can('admin.permissions.create')
            <a href="{{route('admin2.permissions.create')}}">
                <x-jet-button>Crear nuevo Permiso</x-jet-button>
            </a>
        @endcan
    </div>
@endsection


@section('content')

    @livewire('admin2.permissions.index-permissions', key('permissions'))

@endsection