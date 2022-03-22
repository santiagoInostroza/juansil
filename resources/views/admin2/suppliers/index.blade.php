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
        Proveedores
        @can('admin.suppliers.create')
            <a href="{{route('admin2.suppliers.create')}}">
                <x-jet-button>Crear nuevo Proveedor</x-jet-button>
            </a>
        @endcan
    </div>
@endsection


@section('content')

    @livewire('admin2.suppliers.index-suppliers', key('suppliers'))

@endsection