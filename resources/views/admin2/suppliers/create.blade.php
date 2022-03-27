@extends('layouts.admin')

@section('header')

@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" >
        Crear nuevo proveedor
        @can('admin.suppliers.create')
            <a href="{{route('admin2.suppliers.index')}}">
                <x-jet-button>Ir a lista de proveedores</x-jet-button>
            </a>
        @endcan
    </div>
@endsection


@section('content')

    @livewire('admin2.suppliers.create-supplier', key('create-suppliers'))

@endsection