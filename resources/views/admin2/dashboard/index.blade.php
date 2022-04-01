@extends('layouts.admin')

@section('header')
@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" ></div>
@endsection


@section('content')

    <div class="bg-indigo-200 text-gray-900 p-8 tracking-wide">
        <h2 class="font-bold text-3xl">Bienvenid@, {{auth()->user()->name}} 👋</h2>
        <div class="font-sans">Aqui verás como va tu producción...</div>
    </div>

    <div>
        {{-- month --}}
        

    </div>


    @if (auth()->user()->hasRole('SuperAdmin'))
        @foreach ($users as $user)
        <div>
            {{-- title --}}
            <div class="flex justify-between items-center p-4 border-b-2 border-indigo-500">
                <div class="font-bold text-xl">{{ $user->name }}</div>
                <div class="font-bold text-xl">{{ $user->email }}</div>
            </div>
            {{-- content --}}
            @livewire('admin2.dashboard.seller.index-dashboard-seller', ['user' => $user], key('seller'.$user->id))
        </div>
        @endforeach
     
       
    @endif

    @if (auth()->user()->hasRole('Vendedor'))
        @livewire('admin2.dashboard.seller.index-dashboard-seller', ['user' => auth()->user()], key('seller'))
     
       
    @endif

    @if (auth()->user()->hasRole('Driver'))
        @livewire('admin2.dashboard.driver.index-dashboard-driver', ['user' => auth()->user()], key('driver'))
    @endif

@endsection