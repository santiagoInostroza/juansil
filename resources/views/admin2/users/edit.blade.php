@extends('layouts.admin')

@section('header')
@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" >
        Editar Usuario {{$user->id}} {{$user->name}}
        @can('admin.users.index')
            <a href="{{route('admin2.users.index')}}">
                <x-jet-button>Ir a lista de usuarios</x-jet-button>
            </a>
        @endcan
    </div>
@endsection


@section('content')

    @livewire('admin2.users.edit-users',['user' =>$user], key('users'))

@endsection