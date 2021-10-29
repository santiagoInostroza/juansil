@extends('layouts.simple')

@section('content')
{{-- <h1>VENTAS NUEVO</h1> --}}
<div class="bg-gray-200 w-full h-full">
    <div class="grid grid-cols-5 gap-2 p-2 h-full">
        <div class="md:col-span-3 h-full">
            <h2 class=" w-full p-1 font-bold text-xl text-center text-gray-600"> Lista Productos</h2>
            <div class="rounded bg-white p-2 overflow-auto" style="height: calc(55vh - 110px)">
               @livewire('admin.sales.products')
            </div>
            <h2 class=" w-full p-1 font-bold text-xl text-center text-gray-600"> Pedidos Hoy</h2>
            <div class="rounded bg-white p-2 overflow-auto" style="height: calc(45vh - 110px )">

                @livewire('admin.sales.today-orders')
            </div>
        </div>
        <div class="col-span-2">
            <h2 class=" w-full p-1 font-bold text-xl text-center text-gray-600"> Nuevo Pedido</h2>
            <div class=" rounded bg-white p-2 overflow-auto overflow-x-hidden" style="height: calc(100vh - 182px)">
                @livewire('admin.sales.pending-orders')
            </div>
        </div>
    </div>

</div>
  
@endsection
    