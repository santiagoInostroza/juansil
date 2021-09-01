<nav class="fixed w-full z-10">
    {{-- BARRA PRINCIPAL --}}
    <div class="bg-white h-20" x-data="{ open:false }">
        <div class=" mx-auto px-2 sm:px-6 lg:px-8 xl:max-w-7xl" >
            <div class="relative flex items-center justify-between h-16 ">

                <!-- BOTON SE MUESTRA SOLO EN DISPOSITIVOS PEQUEÑOS-->
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                   
                    <button x-on:click="open=true" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon when menu is closed. -->
                        <!-- Heroicon name: menu Menu open: "hidden", Menu closed: "block" -->
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Icon when menu is open. -->
                        <!--  Heroicon name: x  Menu open: "block", Menu closed: "hidden"-->
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

               
                {{-- LOGO --}}
                <div class="flex-1 sm:flex-none  flex items-center justify-center ml-8  sm:mx-0 ">
                    
                    <a href="/" class="flex-shrink-0 flex items-center">
                        {{-- DISPOSITIVOS PEQUEÑOS --}}
                        <div class=" text-white transform p-2 flex items-center lg:hidden" >
                            <img class="h-10" src= "{{url('images/iconos/jsyellow.png')}}" alt="">
                        </div>
                        {{-- OTROS DISPOSITIVOS --}}
                        <div class="hidden lg:flex h-8 w-autotext-xl text-white transform p-2  items-center" >
                            <img class="h-20" src="{{url('images/iconos/juansil.png')}}" alt="">
                        </div>
                      
                    </a>  
                </div>

                {{-- BUSCADOR --}}
                <div class="flex-1 sm:flex items-center justify-start mr-3">
                        @livewire('buscador-productos', ['user' => '']) 
                </div>

                <div class="mr-12 sm:mr-0 sm:ml-12">
                    @livewire('cart.index', ['user' => ""])
                </div>

                

                @auth
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0 ">
                        
                        
                        {{-- boton notificacion --}}
                        <button  class="hidden ml-2 bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                            <span class="sr-only">View notifications</span>
                            <!-- Heroicon name: bell -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>

                        {{-- MENU USUARIO --}}
                        <div class="ml-3 relative" x-data="{ open:false }">
                            {{-- BOTON MENU USUARIO --}}
                            <div>
                                <button x-on:click="open=true"
                                    class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                                    id="user-menu" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="">
                                </button>
                            </div>

                            
                            <div x-show='open'  x-on:click.away="open=false"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-40 hidden" :class="{'hidden': !open}"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Perfil</a>
                                
                                @can('admin.home')
                                    <a href="{{ route('admin.home') }}"  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tablero</a>
                                @endcan
                                @can('products.specialPrice')
                                    <a href="{{ route('products.specialPrice') }}"  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Precios especiales</a>
                                @endcan
                                @can('products.specialPrice')
                                    <a href="{{ route('products.specialPrice') }}"  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Precios especiales</a>
                                @endcan
                               
                               
                                <form method="POST" action="{{ route('logout') }}">@csrf
                                    <a 
                                        href="{{ route('logout') }}"  
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" 
                                        role="menuitem" 
                                        onclick="event.preventDefault();this.closest('form').submit();">
                                        Cerrar sesion
                                    </a>
                                </form>

                            </div>
                        </div>
                    </div>
                @else

                  
                    <div class="flex">
                        <a href="{{ route('login') }}"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Acceder</a>
                        <a href="{{ route('register') }}"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Registrarse</a>
                    </div>
                @endauth

            </div>
        </div>

        {{-- menu mobil --}}
        <div class="hidden sm:hidden absolute" :class="{'hidden': !open}" x-show="open" x-on:click.away="open=false">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-gray-800">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                @foreach ($categories as $category)
                    <a href="{{ route('products.category', $category) }}"
                        class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium">{{ $category->name }}</a>

                @endforeach
            </div>
        </div>
    </div> 

   
    <div  class=" flex sm:hidden  bg-gray-700 w-full h-10 px-3 items-center">
         <label for="buscador" class="p-1 m-1 bg-white text-gray-400 flex items-center w-full rounded">
           <div>
               ¿Qué estás buscando?
            </div>
            <div class=" text-black absolute px-2 right-6" >     
                <svg class="w-6 h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
         </label>
        {{-- @livewire('buscador-productos', ['user' => ''])  --}}
    </div> 

    {{-- BARRA DE ABAJO DE LA BARRA PRINCIPAL --}}

    <div  class="hidden sm:block bg-white w-full h-10">
        <div  class=" mx-auto px-2 sm:px-6 lg:max-w-7xl" >
            <div class="hidden sm:block">
                <div class="flex space-x-4">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    @foreach ($categories as $category)
                        <a href="{{ route('products.category', $category) }}"
                            class="text-gray-500 hover:text-gray-800 hover:font-bold px-3 py-2 rounded-md text-sm font-medium transform hover:scale-110">{{ $category->name }}</a>
                    @endforeach

                    {{-- <a href="#"
                class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a> --}}
                </div>
            </div>
        </div>
    </div>

</nav>
<div class="h-20 w-full">
   
</div>
