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
        <div x-data="orderMain()">

            {{-- PEDIDO NUEVO --}}
            <div x-show="showNewOrder" class="hidden" :class="{'hidden': !showNewOrder}" >
                <div class="flex items-center justify-between">
                    <div></div>
                    <h2 class="bg-gray-300 text-gray-800 text-xl font-bold text-center p-2">Nuevo Pedido</h2>
                    <div x-on:click="closeNewOrder" class="hover:bg-gray-600 p-4">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div :class="showOrders ? 'miti' : 'miti2' ">
                    @livewire('admin.sales.new-order')
                </div>
            </div>

            {{-- MODIFICAR PEDIDO --}}
            {{-- <div x-show="showEditOrder" class="hidden" :class="{'hidden': !showEditOrder}" >
                <div class="flex items-center justify-between bg-yellow-300 ">
                    <div></div>
                    <h2 class="bg-yellow-300 text-gray-800 text-xl font-bold text-center p-2">Modificar Pedido</h2>
                    <div x-on:click="closeEditOrder" class="hover:bg-gray-600 p-4">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div :class="showOrders ? 'miti' : 'miti2' ">
                    @livewire('admin.sales.edit-order')
                   
                </div>
            </div> --}}



            {{-- LISTA PEDIDOS --}}
            <div class="flex items-center gap-4 bg-gray-300 text-gray-800" :class="!showMenuListOrders ? 'justify-center': 'justify-between';">
                <div></div>
                <h2 class="text-xl font-bold text-center p-2">Lista Pedidos</h2>
                <div x-show="showMenuListOrders" class="hidden" :class="{'hidden':!showMenuListOrders}" class="menu">
                    <div x-show="!showOrders" x-on:click="showOrders=true" class="hover:bg-gray-600 p-4">
                        <i class="fas fa-chevron-up"></i>
                    </div>
                    <div x-show="showOrders" x-on:click="showOrders=false" class="hover:bg-gray-600 p-4">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                
                </div>
            </div>
            
            <div x-show="showOrders" class="rounded bg-white p-2 overflow-auto" :class="(showOrders && (showNewOrder || showEditOrder )) ? 'mite' : 'mite2'"  >
                @livewire('admin.sales.orders')
            </div>
            
        

            {{-- BOTON NUEVO PEDIDO --}}
            <div x-show="showButtonAddNewSale" x-on:click="openNewOrder" class="fixed right-4 bottom-4 p-6 rounded-full shadow bg-gray-900 text-white transform hover:scale-125 cursor-pointer">
                <i class="fas fa-plus text-2xl"></i>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            function orderMain(){
                return{
                    showOrders:true,showNewOrder:false,showMenuListOrders:false,showButtonAddNewSale:true, showEditOrder:false,

                    openNewOrder(){
                        this.showNewOrder=true; this.showEditOrder=false; this.showOrders=false; this.showButtonAddNewSale=false; this.showMenuListOrders=true
                    },
                    closeNewOrder(){
                        this.showNewOrder=false; this.showOrders=true; this.showButtonAddNewSale=true; this.showMenuListOrders=false
                    },
                    openEditOrder(){
                        this.showNewOrder=false; this.showEditOrder=true; this.showMenuListOrders=true
                    },
                    closeEditOrder(){
                        this.showEditOrder=false; this.showOrders=true; this.showButtonAddNewSale=true; this.showMenuListOrders=false
                    },


                }
            }
        </script>
    @endpush
  
@endsection