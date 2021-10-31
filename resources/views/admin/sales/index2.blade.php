@extends('layouts.simple')

<style>
    .miti{
        height: calc(55vh - 110px);
    }
    .miti2{
        height: calc(100vh - 220px);
    }
</style>

@section('content')
{{-- <h1>VENTAS NUEVO</h1> --}}
<div class="bg-gray-300 w-full h-full">
    <div x-data="{showOrders:false, showNewOrder:true, showProducts:true}" class="grid grid-cols-1  md:grid-cols-5 gap-2 p-2 h-full">
        <div x-show="showNewOrder" class="col-span-1 md:col-span-3 h-full">
            <h2 class=" w-full p-1 font-bold text-xl text-center text-gray-600"> 
               
                Lista Productos 
            </h2>
            
            <div class="rounded bg-white p-2 overflow-auto" :class="showOrders ? 'miti' : 'miti2'" >
               @livewire('admin.sales.products')
            </div>
            <div >
                <div class="">
                    <h2 class=" w-full p-1 font-bold text-xl text-center text-gray-600"> 
                        Pedidos Hoy 
                        <i x-on:click="showOrders = !showOrders"  class="fas cursor-pointer " :class="showOrders ? 'fa-angle-down' : 'fa-angle-up' "></i>
                    </h2>
                </div>
                <div x-show="showOrders" class="rounded bg-white p-2 overflow-auto"  style="height: calc(45vh - 110px )">
                    @livewire('admin.sales.today-orders')
                </div>
            </div>
            
        </div>
        <div class="md:col-span-2"  :class="showNewOrder ? 'md:col-span-2' : 'md:col-span-5'">
            <h2 class=" w-full p-1 font-bold text-xl text-center text-gray-600">  
                <i x-on:click="showNewOrder = !showNewOrder"  class="fas cursor-pointer " :class="showNewOrder ? 'fa-angle-left' : 'fa-angle-right' "></i>
                Nuevo Pedido
            </h2>
            <div class=" rounded bg-white p-2 overflow-auto overflow-x-hidden" style="height: calc(100vh - 182px)">
                @livewire('admin.sales.new-order')
            </div>
        </div>
    </div>

</div>
  
@endsection
    