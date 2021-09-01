@extends('layouts.admin4')

@section('content')
    {{-- @livewire('admin.sales.index', ['user' => ''])       --}}
    <div>
        <h1 class="text-3xl font-bold text-gray-600 text-center">Usuarios</h1>
    </div>
    <div>
        @livewire('admin.users.lista')
    </div>
@endsection