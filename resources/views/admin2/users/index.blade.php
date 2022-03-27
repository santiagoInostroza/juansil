@extends('layouts.admin')

@section('header')
@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" >
        Usuarios
        @can('admin.users.create')
            <a href="{{route('admin2.users.create')}}">
                <x-jet-button>Crear nuevo usuario</x-jet-button>
            </a>
        @endcan
    </div>
@endsection


@section('content')

    @livewire('admin2.users.index-users', key('users'))

@endsection