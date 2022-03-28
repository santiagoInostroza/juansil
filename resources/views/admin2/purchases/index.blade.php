@extends('layouts.admin')

@section('header')
@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" >
        {{-- title --}}
        <h1 class="">
            Compras
        </h1>
        {{-- buttons --}}
        @can('admin.purchases.create')
            <a href="{{route('admin2.purchases.create')}}">
                <x-jet-button>Crear nueva compra</x-jet-button>
            </a>
        @endcan
    </div>
@endsection


@section('content')
    @livewire('admin2.purchases.index-purchases', key('purchases'))
@endsection