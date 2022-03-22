@extends('layouts.admin')

@section('header')
    @if (session()->has('message'))
        <x-alerts.alert-success>
            {{ session('message') }}
        </x-alerts.alert-success>   
    @endif
@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" >
        Roles
        @can('admin.roles.create')
            <a href="{{route('admin2.roles.create')}}">
                <x-jet-button>Crear nuevo Rol</x-jet-button>
            </a>
        @endcan
    </div>
@endsection


@section('content')

    @livewire('admin2.roles.index-roles', key('roles'))

@endsection