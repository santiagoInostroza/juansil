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
        {{-- <script src="https://js.stripe.com/v3/"></script> --}}

        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
{{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
{{-- <link href="https://unpkg.com/@markusantonwolf/ta-gallery@latest/dist/css/ta-gallery.css" rel="stylesheet"> --}}



        {{-- ESTILOS DE CARRUSEL --}}
        <style>
			.carousel-open:checked + .carousel-item {
				position: static;
				opacity: 100;
			}
			.carousel-item {
				-webkit-transition: opacity 0.6s ease-out;
				transition: opacity 0.6s ease-out;
			}
			#carousel-1:checked ~ .control-1,
			#carousel-2:checked ~ .control-2,
			#carousel-3:checked ~ .control-3 {
				display: block;
			}
			.carousel-indicators {
				list-style: none;
				margin: 0;
				padding: 0;
				position: absolute;
				bottom: 2%;
				left: 0;
				right: 0;
				text-align: center;
				z-index: 9;
			}
			#carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
			#carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
			#carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
				color: #2b6cb0;  /*Set to match the Tailwind colour you want the active one to be */
			}
		</style>





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

        @stack('modals')
        @stack('js')
        @livewireScripts

        {{-- ALERTAS --}}
      
   

        @isset($js)
            {{$js}}
        @endisset

        <!-- at the end of <body> -->
<script src="https://unpkg.com/@markusantonwolf/ta-gallery@latest/dist/js/ta-gallery.min.js"></script>
    </body>
</html>
