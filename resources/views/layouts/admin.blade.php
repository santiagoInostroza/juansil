<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Juansil') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        {{-- FONT AWESOME 5 --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

        {{-- SWEET ALERT --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @livewireStyles

        <style> 
            [x-cloak] { display: none; }
            @media screen and (max-width: 768px) {
                [x-cloak="mobile"] { display: none; }
            }
            .scroll-hidden::-webkit-scrollbar {
            display: none;
            }
        </style>

        <!-- Scripts -->
        <script src="{{asset('js/myJs.js') }}"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        
    </head>
    <body class="font-sans antialiased bg-gray-100">

        <div class=" ">
            <main>
                <div x-on:resize.window="resize()" x-data="main()" class="h-screen w-full text-gray-500">
                    {{-- BARRA LATERAL--}}
                    <div x-on:click="isOpenAside = false"  class="bg-gray-500 opacity-50 fixed inset-0" :class="(isMobile && isOpenAside) ? '' : 'hidden'"></div>
                    <div x-cloak x-show="isOpenAside" class="w-64 h-full shadow fixed bg-gray-800 text-gray-400"  x-transition >
                        {{-- <template  x-if="isMobile">
                            <div x-on:click="isOpenAside = !isOpenAside" class="p-2 cursor-pointer hover:font-bold hover:text-gray-400 ">
                                <i class="fas fa-arrow-left"></i>
                            </div>
                        </template> --}}
                        <div class="h-full overflow-auto scroll-hidden">
                            @livewire('admin2.aside.index-aside',key('aside'))
                        </div>
                    </div>

                    <div class="w-full h-full" :class="isMobile ? 'pl-0' :  isOpenAside  ? 'pl-64':'pl-0'">


                        <header class="">
                            @if (session()->has('message'))
                                <x-alerts.alert-success>
                                    {{ session('message') }}
                                </x-alerts.alert-success>   
                            @endif

                            @if (isset($header))
                                {{ $header }}
                            @endif
                            
                            @hasSection('header')
                                    @yield('header')
                            @endif
                        </header>



                        {{-- HEADER --}}
                        <div class="w-full h-16 flex items-center shadow bg-white">
                            <div x-on:click="isOpenAside = !isOpenAside" class="p-4 cursor-pointer hover:font-bold hover:text-gray-400 "><i class="fas fa-bars"></i></div>
                            <div class="flex-1">
                                @livewire('admin2.header.index-header', key('header'))    
                            </div>                              
                        </div>

                        @if (isset($title))
                            <header class="max-w-10xl mx-auto p-2 md:px-6 xl:px-8">
                                    {{ $title }}
                            </header>
                        @endif
                        @hasSection('title')
                            <header class="max-w-10xl mx-auto p-2 md:px-6 xl:px-8">
                                @yield('title')
                            </header>
                        @endif



                        {{-- CONTENIDO --}}
                        <div class="w-full">
                            @isset($slot)
                                {{ $slot }}
                            @endisset
                            <div class="max-w-10xl mx-auto px-2 md:px-6 xl:px-8">
                                @yield('content')
                            
                            </div>
                        </div>
                    </div>
                    <script>
                        function main(){
                            return{
                                isOpenAside : (window.innerWidth < 1024) ? false : false,
                                isMobile : (window.innerWidth < 768) ? true : false,
                                resize:function(){
                                    this.isOpenAside =  (window.innerWidth < 1024) ? false : false; 
                                    this.isMobile = (window.innerWidth < 768) ? false : false;
                                },
                            }
                        }
                    </script>
                </div>
            </main>
        </div>

      

        @stack('modals')

        @livewireScripts
     

    </body>
</html>
