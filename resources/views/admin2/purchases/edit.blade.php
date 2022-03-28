@extends('layouts.admin')

@section('header')
@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" >
        {{-- title --}}
        <h1 class="">
            Editar compra
        </h1>
        {{-- buttons --}}
        @can('admin.purchases.index')
            <a href="{{route('admin2.purchases.index')}}">
                <x-jet-button>Ver lista de compras</x-jet-button>
            </a>
        @endcan
    </div>
@endsection


@section('content')
    @livewire('admin2.purchases.edit-purchase', ['purchase'] ,  key('edit-purchase'))
@endsection