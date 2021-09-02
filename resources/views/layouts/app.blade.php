{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Juansil - Venta de abarrotes, lacteos, articulos de aseo, etc') }}</title>
        <link rel="icon" type="image/png" href="{{url('images/iconos/jsyellow.png')}}" />

        <meta name="google-site-verification" content="ERZr-zK0pEA3MxEAyEHN7kOmzFqhQ45PseekfBfJ3yM" />
        

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

       
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>

       


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


        <footer>
           
           
            <div class="bg-gradient-to-r from-gray-400 to-gray-600 p-4">
                <div class="flex justify-center gap-12">
                    <div>
                        <h3 class="text-2xl text-gray-200 ">Siguenos</h3>
                        <div class="flex my-2">
                            <i style="background-color: #3B5998;"
                            class="flex items-center justify-center h-12 w-12 mx-1 rounded-full fab fill-current text-white text-xl fa-facebook-f"></i>
                            <i style="background-color:#dd4b39"
                            class="flex items-center justify-center h-12 w-12 mx-1 rounded-full fas fill-current text-white text-xl fa-envelope"></i>
                  
                        </div> 
                    </div>
                                      
                    <div>
                        <h3 class="text-2xl text-gray-200 ">Medios de pago</h3>
                        <ul class="my-2">
                           <li class="text-xl text-gray-200">Transferencia</li>
                           <li class="text-xl text-gray-200">Efectivo</li>
                        </ul> 
                    </div>
                </div>
                <div>
                   
                </div>
               <div class="border-b-2 my-4  mx-6 sm:mx-20"></div>
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
            </div>
            <div class="flex justify-center flex-wrap gap-2  text-sm bg-gray-700 text-white p-2 ">
                <div class="w-max-content"> Comercial Juansil Spa. Derechos reservados {{date('Y')}} </div>
                <div  class="w-max-content"> Sistema comercial realizado por <div class="inline-block underline cursor-pointer font-bold tracking-widest transform hover:scale-110"> Vonaltein </div>
            </div>
            
        </footer>

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
      
   

        @isset($js)
            {{$js}}
        @endisset

       {{-- TA GALERY --}}
        <script src="https://unpkg.com/@markusantonwolf/ta-gallery@latest/dist/js/ta-gallery.min.js"></script>
        <script>
    
            var elms = document.getElementsByClassName( 'splideIndex' );
            for ( var i = 0, len = elms.length; i < len; i++ ) {
            new Splide( elms[ i ],{
                type: 'loop',
                rewind : true,
                perPage: 6,
                trimSpace: false,
                // focus : 'center' ,
                breakpoints: {
                        // 640: {
                        //     perPage: 2,
                        // },
                        // 768: {
                        //     perPage: 2,
                        // },
                        1024: {
                        perPage: 2,
                        },
                        // 1280: {
                        //     perPage: 2,
                        // },
                        1563: {
                        perPage: 4,
                        },
                },
                pagination: false,
                lazyLoad: 'sequential',
            }).mount();
            }

            var elms = document.getElementsByClassName( 'splideBanner' );
            for ( var i = 0, len = elms.length; i < len; i++ ) {
            new Splide( elms[ i ],{
                type: 'loop',
                perPage: 1,
                easing: 'linear',
                autoplay: true,
                // trimSpace: false,
                // focus : 'center' ,
                 lazyLoad: 'sequential',
            }).mount();
            }
            
        </script>


       

        
    </body>
</html>
