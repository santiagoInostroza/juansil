<nav class="fixed w-full z-10">
    {{-- BARRA PRINCIPAL --}}
    <div class="bg-white h-20" x-data="{ open:false }">
        <div class=" mx-auto px-2 sm:px-6 lg:px-8 xl:max-w-7xl" >
            <div class="relative flex items-center justify-between gap-6 h-16 ">

                <div class="flex items-center gap-2">
                     <!-- BOTON SE MUESTRA SOLO EN DISPOSITIVOS PEQUEÑOS-->
                    <div class="flex items-center sm:hidden">
                    
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
                    <div class="flex-1 sm:flex-none ">
                        
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
                </div>

               <div class="flex-1 flex items-center gap-6">

                    {{-- BUSCADOR --}}
                    <div class="flex-1 sm:flex items-center justify-start">
                            @livewire('buscador-productos', ['user' => '']) 
                    </div>


                    {{-- CARRITO --}}
                    <div class="">
                        @livewire('cart.index', ['user' => ""])
                    </div>

                </div>



                <div  class="flex items-center gap-4">

                    @auth
                        <div class="flex items-center gap-4">
                            
                              {{-- NOTIFICACIONES --}}
                            <div class="">
                                @livewire('navigation.notification')
                            </div>
                            
                            {{-- boton notificacion --}}
                            {{-- <button  class=" ml-2 bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                <span class="sr-only">View notifications</span>
                                <!-- Heroicon name: bell -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </button> --}}

                            {{-- MENU USUARIO --}}
                            <div class=" relative" x-data="{ open:false }">
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
                                    
                                    @can('admin.dashboard.fintech')
                                        <a href="{{ route('admin.home') }}"  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tablero antiguo</a>
                                    @endcan
                                    @can('admin.dashboard.index')
                                        <a href="{{ route('admin2.dashboard.index') }}"  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Dashboard</a>
                                    @endcan
                                    @can('products.specialPrice')
                                        <a href="{{ route('products.specialPrice') }}"  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Ver catalogo especial</a>
                                      
                                    @endcan   
                                    @auth
                                        {{-- <a href="{{ route('orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Mis compras</a> --}}
                                    @endauth                  
                                
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
                                class="text-gray-500 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Acceder</a>
                            <a href="{{ route('register') }}"
                                class="text-gray-500 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Registrarse</a>
                        </div>
                    @endauth
                </div>

            </div>
        </div>
    </div> 

   
    
</nav>
<div class="h-20 w-full">   </div>
<div  class=" flex sm:hidden  bg-gray-700 w-full h-10 px-3 items-center">
     <label for="buscador" class="p-1 m-1 bg-white text-gray-400 flex items-center w-full rounded">
       <div>
           ¿Qué estás buscando?
        </div>
        <div class=" text-black absolute px-2 right-6" >     
            <svg class="w-6 h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
     </label>
</div> 


