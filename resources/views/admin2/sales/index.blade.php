@extends('layouts.admin')

@section('header')
@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" >
        Ordenes
        @can('admin.sales.create')
            <a href="{{route('admin2.sales.create')}}">
                <x-jet-button>Crear nueva orden</x-jet-button>
            </a>
        @endcan
    </div>
@endsection


@section('content')
    @livewire('admin2.sales.index-sales', key('sales'))
@endsection
