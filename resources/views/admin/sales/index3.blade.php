@extends('layouts.simple')

<style>
    .miti{
        height: calc(55vh - 114px);
    }
    .miti2{
        height: calc(100vh - 224px);
    }
    .mite{
        height: calc(45vh - 110px);
    }
    .mite2{
        height: calc(100vh - 175px);
    }

</style>

@section('content')
{{-- <h1>VENTAS NUEVO</h1> --}}
<div class="bg-gray-300 w-full h-full px-4">
    <div x-data="{showOrders:true,showNewOrders:false,showMenuListOrders:false,showButtonAddNewSale:true}">

        {{-- PEDIDO NUEVO --}}
        <div x-show="showNewOrders" class="hidden" :class="{'hidden': !showNewOrders}" >
            <div class="flex items-center justify-between">
                <div></div>
                <h2 class="bg-gray-300 text-gray-800 text-xl font-bold text-center p-2">Nuevo Pedido</h2>
                <div x-on:click="showNewOrders=false;showOrders=true;showButtonAddNewSale=true;showMenuListOrders=false" class="hover:bg-gray-600 p-4">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div :class="showOrders ? 'miti' : 'miti2' ">
                @livewire('admin.sales.new-order')
            </div>
            
        </div>

        {{-- LISTA PEDIDOS --}}
        <div class="flex justify-between items-center gap-4 bg-gray-300 text-gray-800">
            <div></div>
            <h2 class="text-xl font-bold text-center p-2">Lista Pedidos</h2>
            <div x-show="!showMenuListOrders"></div>
            <div x-show="showMenuListOrders" class="hidden" :class="{'hidden':!showMenuListOrders}" class="menu">
                <div x-show="!showOrders" x-on:click="showOrders=true" class="hover:bg-gray-600 p-4">
                    <i class="fas fa-chevron-up"></i>
                </div>
                <div x-show="showOrders" x-on:click="showOrders=false" class="hover:bg-gray-600 p-4">
                    <i class="fas fa-chevron-down"></i>
                </div>
               
            </div>
        </div>
        
        <div x-show="showOrders" class="rounded bg-white p-2 overflow-auto" :class="(showOrders && showNewOrders) ? 'mite' : 'mite2'"  >
            @livewire('admin.sales.orders')
        </div>
           
       

        {{-- BOTON NUEVO PEDIDO --}}
        <div x-show="showButtonAddNewSale" x-on:click="showNewOrders=true;showOrders=false;showButtonAddNewSale=false;showMenuListOrders=true" class="fixed right-4 bottom-4 p-6 rounded-full shadow bg-gray-900 text-white transform hover:scale-125 cursor-pointer">
            <i class="fas fa-plus text-2xl"></i>
        </div>
    </div>


</div>
  
@endsection