@extends('layouts.admin')

@section('header')
    @if (session()->has('message'))
        <x-alerts.alert-success>
            {{ session('message') }}
        </x-alerts.alert-success>   
    @endif
@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" ></div>
@endsection


@section('content')

    <div class="bg-indigo-200 text-gray-900 p-8 tracking-wide">
        <h2 class="font-bold text-3xl">Bienvenid@, {{auth()->user()->name}} 👋</h2>
        <div class="font-sans">Aqui verás como va tu mes...</div>
    </div>

    @if (auth()->user()->hasRole('Seller'))
        @livewire('admin2.dashboard.seller.index-dashboard-seller', ['user' => auth()->user()], key('seller'))
       
    @endif

    @if (auth()->user()->hasRole('Driver'))
        @livewire('admin2.dashboard.driver.index-dashboard-driver', ['user' => auth()->user()], key('driver'))
    @endif

@endsection