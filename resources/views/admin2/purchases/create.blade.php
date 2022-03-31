@extends('layouts.admin')

@section('header')
@endsection

@section('title') 
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-lg font-bold">Crear Compra</h3>
        </div>
        <div>
            @can('admin.purchases.index')
                <a href="{{route('admin2.purchases.index')}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-left"></i>
                    Ver lista de compras
                </a>
            @endcan
        </div>
    </div>
    {{-- <div class="flex justify-between items-center gap-4" >
       
        <h1 class="">
            Crear nueva compra
        </h1>
      
        @can('admin.purchases.index')
            <a href="{{route('admin2.purchases.index')}}">
                <x-jet-button>Ver lista de compras</x-jet-button>
            </a>
        @endcan
    </div> --}}
@endsection


@section('content')
    <div>
        <livewire:admin2.purchases.create-purchase wire:key="create-purchase">
    </div>
@endsection