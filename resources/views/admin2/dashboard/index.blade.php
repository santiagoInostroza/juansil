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


    {{-- FILTRO DE FECHA --}}
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

    <div class="my-8">
        @if (auth()->user()->hasRole('SuperAdmin'))
            <ul class="grid gap-4">
                @foreach ($usersWithSales as $user)
                @php
                    $hasSales =($user->salesOfTheMonthCompleted($month,$year)) ? true:false;
                @endphp
                    <li class="shadow p-4 bg-white">
                        {{-- title --}}
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-xl"> {{ $user->name }} </div>
                        
                            <div class="font-bold text-xl">{{ $user->email }}</div>
                        </div>
                        {{-- content --}}
                        @if ($hasSales)
                           <livewire:admin2.dashboard.seller.index-dashboard-seller :user="$user" :month="$month" :year="$year" :wire:key="'seller_'.$user->id. rand()" />
                        @else
                            <div class="text-red-500 text-base font-thin">
                                (No tiene ventas completadas  en  {{ Helper::date(date('Y-m',strtotime($period)), false )->monthName }} {{($year!= date('Y'))? $year : ''}} )
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>  
        @endif

        @if (auth()->user()->hasRole('Vendedor'))
            @if (auth()->user()->salesOfTheMonthCompleted($month,$year) != false)
                <livewire:admin2.dashboard.seller.index-dashboard-seller :user="auth()->user()" :month="$month"  :year="$year" :wire:key="'seller_'. auth()->user() . rand()" />
            @else
                    No tienes ventas completadas en  {{ Helper::date(date('Y-m',strtotime($period)), false )->monthName }} {{($year!= date('Y'))? $year : ''}}
            @endif
            {{-- <div class="mb-8">
                @livewire('admin2.dashboard.seller.index-dashboard-seller', ['user' => auth()->user(),'month' => $month], key('seller'))
            </div> --}}
        @endif

        @if (auth()->user()->hasRole('Driver'))
            <div class="mb-8">
                @livewire('admin2.dashboard.driver.index-dashboard-driver', ['user' => auth()->user(),'month' => $month], key('driver'))
            </div>
        @endif
    </div>

@endsection