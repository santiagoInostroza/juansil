<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    </head>
    <body>
        <div class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll font-sans antialiased text-gray-900">
            @isset($slot)
                {{ $slot }}
            @endisset
            @yield('content')
        </div>

        <script>
            window.addEventListener('alerta_express', event => {
                // alert(event.detail.msj);
                Swal.fire(event.detail.msj)
            })
            window.addEventListener('alerta', event => {
                Swal.fire({
                    icon: event.detail.icon,
                    title: event.detail.title,
                    text: event.detail.msj,
                    footer: event.detail.footer,
                })
            })
            window.addEventListener('alerta_timer', event => {
            
                Swal.fire({
                    position: 'top-center',
                    icon: event.detail.icon,
                    title: event.detail.msj,
                    showConfirmButton: false,
                    timer: 800,
                
                })
            
            })

         


            function alerta_timer(data = ""){

                position =(data.position)?data.position:'center';
                icon =(data.icon)?data.icon:'success';
                title =(data.title)?data.title:'ingresa texto';
                timer =(data.timer)?data.timer: 1000;

                Swal.fire({
                    position: position,
                    icon: icon,
                    title: title,
                    showConfirmButton: false,
                    timer: timer,
                });

            }
    
        </script>

        @stack('js')
        @isset($js)
            {{$js}}
        @endisset
        @livewireScripts


    </body>
</html>
