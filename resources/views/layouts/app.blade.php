{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Juansil') }}</title>
        <link rel="icon" type="image/png" href="{{url('images/iconos/jsyellow.png')}}" />
        

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        
        {{-- ESTOS ESTILOS NDAN ALGUNOS PROBLEMAS --}}
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.min.css" /> --}}

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://js.stripe.com/v3/"></script>
        @isset($css)
            {{$css}}
        @endisset
        @isset($jsCabecera)
            {{$jsCabecera}}
        @endisset
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen ">
            {{-- @livewire('navigation-dropdown') --}}
            @livewire('navigation')
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @stack('js')
        @livewireScripts

        {{-- ALERTAS --}}
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
    
        </script>
   

        @isset($js)
            {{$js}}
        @endisset
    </body>
</html>
