@extends('layouts.admin')

@section('header')
@endsection

@section('title') 
    <div class="flex justify-between items-center gap-4" ></div>
@endsection


@section('content')


    <div class="bg-indigo-200 text-gray-900 p-8 tracking-wide">
        @if(auth()->user()->hasRole('SuperAdmin'))
            <h2 class="font-bold text-3xl"> {{auth()->user()->name}} 👋</h2>
        @else
            <h2 class="font-bold text-3xl">Bienvenid@, {{auth()->user()->name}} 👋</h2>
            <div class="font-sans">Aqui verás como va tu producción...</div>
        @endif
    </div>

    <div x-data="{date:'{{$period}}' }">
        <div class="p-4 bg-white rounded shadow flex justify-between items-center">

            <a href="{{ route('admin2.dashboard.index',$prevPeriod)}}" class="flex items-center gap-2">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Anterior
           </a> 

            <input x-model="date"  type="month"  x-on:change="location.replace('/dashboard/' + date)">


            <a href="{{ route('admin2.dashboard.index',$nextPeriod)}}" class="flex items-center gap-2">
                siguiente
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>  
            
        </div>
    </div>


   

    <div class="p-4 shadow rounded bg-white my-8">
        @if (auth()->user()->hasRole('SuperAdmin'))
            
            <ul>
                @foreach ($usersWithSales as $user)
                    <li>
                        {{-- title --}}
                        <div class="flex justify-between items-center p-4 border-b-2 border-indigo-500">
                            <div class="font-bold text-xl">{{ $user->name }}</div>
                            <div class="font-bold text-xl">{{ $user->email }}</div>
                        </div>
                        {{-- content --}}
                        @if ($user->salesOfTheMonthCompleted($month,$year)!= false)
                            
                            {{-- @livewire('admin2.dashboard.seller.index-dashboard-seller', ['user' => $user,'month' => $month], key('seller_'.$user->id. rand())) --}}
                            <livewire:admin2.dashboard.seller.index-dashboard-seller :user="$user" :month="$month" :wire:key="'seller_'.$user->id. rand()" />
                        @else
                            No hay ventas completadas
                        @endif
                    </li>
                @endforeach
            </ul>  
        
        
        
        @endif

        @if (auth()->user()->hasRole('Vendedor'))
            <div class="mb-8">
                @livewire('admin2.dashboard.seller.index-dashboard-seller', ['user' => auth()->user(),'month' => $month], key('seller'))
            </div>
        @endif

        @if (auth()->user()->hasRole('Driver'))
            <div class="mb-8">
                @livewire('admin2.dashboard.driver.index-dashboard-driver', ['user' => auth()->user(),'month' => $month], key('driver'))
            </div>
        @endif
    </div>

@endsection