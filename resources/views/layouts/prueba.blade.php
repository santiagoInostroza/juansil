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

        {{-- CONTENIDO --}}
        <div class="w-full">
            @isset($slot)
                {{ $slot }}
            @endisset
            <div class="max-w-10xl mx-auto px-2 md:px-6 xl:px-8">
                @yield('content')
            
            </div>
        </div>

      

        @stack('modals')

        @stack('scripts')

        @livewireScripts
     

    </body>
</html>