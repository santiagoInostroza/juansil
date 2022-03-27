@extends('layouts.admin')

@section('header')

@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" >
        Editar proveedor {{$supplier->id}} {{$supplier->name}}
        @can('admin.suppliers.index')
            <a href="{{route('admin2.suppliers.index')}}">
                <x-jet-button>Ir a lista de proveedores</x-jet-button>
            </a>
        @endcan
    </div>
@endsection


@section('content')

    @livewire('admin2.suppliers.edit-supplier',['supplier' => $supplier], key('edit-supplier'))

@endsection