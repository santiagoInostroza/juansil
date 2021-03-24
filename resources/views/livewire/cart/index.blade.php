
<div x-data="{animate: {{$openCarrito}} } " class="relative" >
    {{-- ICONO DE CARRITO --}}
    <div class="relative">
        <button @click="animate = (animate) ? false : true" class="z-50 bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
            @if (session()->has('carrito') && count(session('carrito')) > 0)
                <div class="rounded-full bg-red-600 p-1 px-2 text-xs text-white font-bold absolute right-6">
                    {{ (session('totalProductos')) }}
                </div>
            @endif
            <span class="sr-only">Ir a carrito de compras</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                </path>
            </svg>
            @if (session()->has('carrito') && count(session('carrito')) > 0)
            <div class="rounded-full p-1 px-2 text-xs text-white font-bold right-0 absolute">
                ${{ number_format(session('totalCarrito'),0,',','.') }}
            </div>
        @endif

        </button>
    </div>
    <div class="card fixed z-40 top-0 w-screen sm:w-max-content right-0 h-screen"  {{--@click.away="animate = false"--}} x-show="animate" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 transform scale-90"  x-transition:enter-end="opacity-100 transform scale-100"  x-transition:leave="transition ease-in duration-1000"  x-transition:leave-start="opacity-100 transform scale-100"  x-transition:leave-end="opacity-0 transform scale-90">
        
         {{-- HEADER --}}
         <div class="card-header px-6 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                {{session('totalProductos')}}
            </div>
            <h1 class="text-gray-700 text-2xl font-bold w-max-content ml-3">Carrito de compra</h1>
           
            <div @click="animate = (animate) ? false : true" class="cursor-pointer hover:bg-purple-100 rounded-full p-3" wire:click="$set('openCarrito','false')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
        </div>
        @if (session()->has('carrito') && count(session('carrito')) > 0)
            {{-- CUERPO --}}
            <div class="card-body">
                @foreach (session('carrito') as $producto)
                   @livewire('cart.item', ['producto' => $producto], key($producto['producto_id']))
                @endforeach
            </div>

            {{-- FOOTER --}}
            <div class="absolute w-full bottom-0 text-2xl card-footer flex justify-between items-center p-2 mt-10  text-gray-700 font-extrabold">
                <div>
                    Total
                </div>
                <div>
                    ${{ number_format(session('totalCarrito'), 0, ',', '.') }}
                </div>
                <div class="m-2">
                    <a href="{{route('productos.pedido')}}">
                        <div class="btn btn-primary block cursor-pointer text-center"> Realizar Pedido </div>
                    </a>
                </div>
            </div>
        @else
            <div class="card-body p-16">
                <h2 class="text-gray-700 text-lg font-bold w-max-content m-14">No hay productos en el carro</h2>
            </div>
        @endif
    </div>
    
</div>
