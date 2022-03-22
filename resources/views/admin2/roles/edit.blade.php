@extends('layouts.admin')

@section('header')
    @if (session()->has('message'))
        <div x-data="{isOpenAlert:true}" class=" shadow">

            <div  x-show="isOpenAlert" class="animate-bounce flex justify-between items-center alert alert-success w-full p-4 bg-green-500 text-white font-bold">
                {{ session('message') }}

              
                <div class="p-2 cursor-pointer text-white" x-on:click="isOpenAlert=false">
                    <i class="fas fa-times"></i>
                </div>
              
                   
            </div>
        </div>
    @endif
@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" >
        Editar Rol {{$role->id}} {{$role->name}}
        @can('admin.roles.index')
            <a href="{{route('admin2.roles.index')}}">
                <x-jet-button>Ir a lista de Roles</x-jet-button>
            </a>
        @endcan
    </div>
@endsection


@section('content')

    @livewire('admin2.roles.edit-roles',['role' => $role], key('edit-roles'))

@endsection