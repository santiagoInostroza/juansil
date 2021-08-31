@extends('layouts.admin4')

@section('content')
<h1 class="text-3xl font-bold text-gray-600 text-center">CLIENTES</h1>
<div class="p-4 border rounded my-4">
    FILTRO
</div>

<div class="grid grid-cols-4 gap-4">
    @foreach ($customers as $customer)

        <div class="border rounded p-4  @isset($customer->user_id) bg-green-50  @endisset  ">
            <div class="flex flex-col justify-between gap-4 h-full">
                <div class="flex justify-between items-center gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-600 "> {{$customer->name}}</h2>
                        <h3 class="text-gray-500 font-semibold">  {{$customer->email}}  </h3>
                        <h3 class="text-gray-500 font-semibold"> {{$customer->comentario}} </h3>
                    </div>
                 
                    @if (isset($customer->user_id))
                        <div>
                            <div> Usuario </div>
                            <div>{{$customer->user_id}} </div>
                        </div>
                       
                    @elseif ($users->contains(Str::lower($customer->email)))
                        <div class="bg-red-600 text-white p-2">
                            Vincular cliente con usuario
                        </div>
                    @endif 
                  
                </div>  
                <div class="my-2"> 
                    <div> {{$customer->telefono}}  {{$customer->celular}}</div>
                    <div> {{$customer->direccion}}  {{$customer->block}} {{$customer->depto}}</div>
                </div>  
                <div>
                  
                    
                    <div> Cantidad ventas {{$customer->sales->count()}} </div>
                    <div>Total ventas ${{ number_format($customer->sales->sum('total'),0,',','.')}}</div>
                </div>                       

            </div>

        </div>
    @endforeach
    
</div>


    {{-- @livewire('admin.products.index', ['user' => ''])       --}}
@endsection