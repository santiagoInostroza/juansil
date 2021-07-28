<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Juansil') }} | ADMIN</title>
        <link rel="icon" type="image/png" href="{{url('images/iconos/jsyellow.png')}}" />

       
        

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.min.css" />
        @livewireStyles

      

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        @isset($css)
            {{$css}}
        @endisset
        @isset($jsCabecera)
            {{$jsCabecera}}
        @endisset

       


</head>

<body class="text-blueGray-700 antialiased">
    <noscript>Necesitas habilitar Javascript para correr esta página.</noscript>
    <div id="root">
        <nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
            <div
                class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
                <button
                    class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                    type="button" onclick="toggleNavbar('example-collapse-sidebar')">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="/">
                    Juansil
                </a>
                {{--NAV MOBIL --}}
                <ul class="md:hidden items-center flex flex-wrap list-none">
                    <li class="inline-block relative">
                        <a class="text-blueGray-500 block py-1 px-3" href="#pablo" onclick="openDropdown(event,'notification-dropdown')">
                            <i class="fas fa-bell"></i>
                        </a>
                        <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1"
                            style="min-width: 12rem;" id="notification-dropdown">
                            <a href="#pablo"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Accion</a><a
                                href="#pablo"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Otra
                                accion</a><a href="#pablo"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Something
                                else here</a>
                            <div class="h-0 my-2 border border-solid border-blueGray-100"></div>
                            <a href="#pablo"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Seprated
                                link</a>
                        </div>
                    </li>
                    @auth
                        <li class="inline-block relative">
                            <a class="text-blueGray-500 block" href="#pablo"
                                onclick="openDropdown(event,'user-responsive-dropdown')">
                                <div class="items-center flex">
                                    <span
                                        class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full">
                                        <img alt="..." class="w-full rounded-full align-middle border-none shadow-lg" src="{{Auth()->user()->profile_photo_url}}" />
                                    </span>
                                </div>
                            </a>
                            <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1"
                                style="min-width: 12rem;" id="user-responsive-dropdown">
                                <a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Action</a>
                                <a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Another action</a>
                                <a href="#pablo"class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Something else here</a>
                                <div class="h-0 my-2 border border-solid border-blueGray-100"></div>
                                <a class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700" onclick="document.getElementById('cerrar_sesion').submit()">Cerrar sesion</a>
                                <form id="cerrar_sesion" action="{{route('logout')}}" class="hidden" method="post">@csrf</form>
                            </div>
                        </li>
                    @else
                        
                    @endauth
                   
                </ul>
                {{-- MENU MOBIL --}}
                <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
                    id="example-collapse-sidebar">
                    <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200">
                        <div class="flex flex-wrap">
                            <div class="w-6/12">
                                <a class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                                    href="javascript:void(0)">
                                    Juansil
                                </a>
                            </div>
                            <div class="w-6/12 flex justify-end">
                                <button type="button"
                                    class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                                    onclick="toggleNavbar('example-collapse-sidebar')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <form class="mt-6 mb-4 md:hidden">
                        <div class="mb-3 pt-0">
                            <input type="text" placeholder="Buscar..."
                                class="border-0 px-3 py-2 h-12 border border-solid  border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal" />
                        </div>
                    </form>

                    {{-- ASIDE --}}
                    <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                        <li class="items-center">
                            <a class="text-pink-500 hover:text-pink-600 text-xs uppercase py-3 font-bold block"
                                href="{{route('admin.home2')}}"><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
                                Dashboard</a>
                        </li>
                        <li class="items-center">
                            <a class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
                                href="{{route('admin.resumen')}}"><i class="fas fa-file text-blueGray-400 mr-2 text-sm"></i>
                                Resumen</a>
                        </li>
                        <li class="items-center">
                            <a class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
                                href="{{route('admin.sales')}}"><i class="fas fa-file text-blueGray-400 mr-2 text-sm"></i>
                                Ventas</a>
                        </li>
                        <li class="items-center">
                            <a class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
                                href="{{route('routes.index')}}"><i class="fas fa-file text-blueGray-400 mr-2 text-sm"></i>
                                Calendario</a>
                        </li>
                        <li class="items-center">
                            <a class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
                                href="{{route('routes.sectors')}}"><i class="fas fa-file text-blueGray-400 mr-2 text-sm"></i>
                                Sectores</a>
                        </li>
                        {{-- <li class="items-center">
                            <a class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
                                href="#/landing"><i class="fas fa-newspaper text-blueGray-400 mr-2 text-sm"></i>
                                Landing Page</a>
                        </li>
                        <li class="items-center">
                            <a class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
                                href="#/profile"><i class="fas fa-user-circle text-blueGray-400 mr-2 text-sm"></i>
                                Profile Page</a>
                        </li>
                        <li class="items-center">
                            <a class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
                                href="#/login"><i class="fas fa-fingerprint text-blueGray-400 mr-2 text-sm"></i>
                                Login</a>
                        </li>
                        <li class="items-center">
                            <a class="text-blueGray-300 text-xs uppercase py-3 font-bold block" href="#pablo"><i
                                    class="fas fa-clipboard-list text-blueGray-300 mr-2 text-sm"></i>
                                Register (soon)</a>
                        </li>
                        <li class="items-center">
                            <a class="text-blueGray-300 text-xs uppercase py-3 font-bold block" href="#pablo"><i
                                    class="fas fa-tools text-blueGray-300 mr-2 text-sm"></i>
                                Settings (soon)</a>
                        </li> --}}
                    </ul>
                    <hr class="my-4 md:min-w-full" />

                    <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                        Documentation
                    </h6>
                    <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
                        {{-- <li class="inline-flex">
                            <a class="text-blueGray-700 hover:text-blueGray-500 text-sm block mb-4 no-underline font-semibold"
                                href="#/documentation/styles"><i
                                    class="fas fa-paint-brush mr-2 text-blueGray-400 text-base"></i>
                                Styles</a>
                        </li>
                        <li class="inline-flex">
                            <a class="text-blueGray-700 hover:text-blueGray-500 text-sm block mb-4 no-underline font-semibold"
                                href="#/documentation/alerts"><i
                                    class="fab fa-css3-alt mr-2 text-blueGray-400 text-base"></i>
                                CSS Components</a>
                        </li>
                        <li class="inline-flex">
                            <a class="text-blueGray-700 hover:text-blueGray-500 text-sm block mb-4 no-underline font-semibold"
                                href="#/documentation/vue/alerts"><i
                                    class="fab fa-vuejs mr-2 text-blueGray-400 text-base"></i>
                                VueJS</a>
                        </li>
                        <li class="inline-flex">
                            <a class="text-blueGray-700 hover:text-blueGray-500  text-sm block mb-4 no-underline font-semibold"
                                href="#/documentation/react/alerts"><i
                                    class="fab fa-react mr-2 text-blueGray-400 text-base"></i>
                                React</a>
                        </li>
                        <li class="inline-flex">
                            <a class="text-blueGray-700 hover:text-blueGray-500  text-sm block mb-4 no-underline font-semibold"
                                href="#/documentation/angular/alerts"><i
                                    class="fab fa-angular mr-2 text-blueGray-400 text-base"></i>
                                Angular</a>
                        </li>
                        <li class="inline-flex">
                            <a class="text-blueGray-700 hover:text-blueGray-500  text-sm block mb-4 no-underline font-semibold"
                                href="#/documentation/javascript/alerts"><i
                                    class="fab fa-js-square mr-2 text-blueGray-400 text-base"></i>
                                Javascript</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>

       
        <div class="relative md:ml-64 bg-blueGray-50">
            {{-- NAV PC --}}
            <nav class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
                <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
                    <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold" href="{{route('admin.home2')}}">Dashboard</a>
                    <form class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
                        <div class="relative flex w-full flex-wrap items-stretch">
                            <span
                                class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"><i
                                    class="fas fa-search"></i></span>
                            <input type="text" placeholder="Buscar..."
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10" />
                        </div>
                    </form>
                    @auth
                        <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
                            <a class="text-blueGray-500 block" href="#pablo" onclick="openDropdown(event,'user-dropdown')">
                                <div class="items-center flex">
                                    <span
                                        class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"><img
                                            alt="..." class="w-full rounded-full align-middle border-none shadow-lg"
                                            src="{{Auth()->user()->profile_photo_url}}" /></span>
                                </div>
                            </a>
                            <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1"
                                style="min-width: 12rem;" id="user-dropdown">
                                <a href="#pablo"
                                    class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Action</a>
                                    <a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Another action</a>
                                    <a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Something else here</a>
                                <div class="h-0 my-2 border border-solid border-blueGray-100"></div>
                                <a class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700" onclick="document.getElementById('cerrar_sesion').submit()">Cerrar sesion</a>
                                <form id="cerrar_sesion" action="{{route('logout')}}" class="hidden" method="post">@csrf</form>
                            </div>
                        </ul>
                    @endauth
                </div>
            </nav>

            <!-- Header -->
            @isset($titulo)
                <div class="relative bg-gray-900 md:py-10 py-0">
                </div>
                <div class=" bg-gray-700 text-gray-200">
                    <h1 class="mx-auto px-4 sm:px-6 lg:px-8 p-4 text-2xl" style="max-width:100rem">{{$titulo}}</h1>
                </div>
            @endisset
            @isset($slot)
                <div class=" mx-auto px-4 sm:px-6 lg:px-8 py-12" style="max-width: 100rem">
                    {{$slot}}
                </div>
            @endisset
            @yield('content')

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" charset="utf-8"></script>
    <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
    <script type="text/javascript">
        /* Sidebar - Side navigation menu on mobile/responsive mode */
        function toggleNavbar(collapseID) {
            document.getElementById(collapseID).classList.toggle("hidden");
            document.getElementById(collapseID).classList.toggle("bg-white");
            document.getElementById(collapseID).classList.toggle("m-2");
            document.getElementById(collapseID).classList.toggle("py-3");
            document.getElementById(collapseID).classList.toggle("px-6");
        }
        /* Function for dropdowns */
        function openDropdown(event, dropdownID) {
            let element = event.target;
            while (element.nodeName !== "A") {
                element = element.parentNode;
            }
            var popper = Popper.createPopper(element, document.getElementById(dropdownID), {
                placement: "bottom-end"
            });
            document.getElementById(dropdownID).classList.toggle("hidden");
            document.getElementById(dropdownID).classList.toggle("block");
        }


        (function() {
            /* Add current date to the footer */
            document.getElementById("javascript-date").innerHTML = new Date().getFullYear();
            /* Chart initialisations */
            /* Line Chart */
            var config = {
                type: "line",
                data: {
                    labels: [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July"
                    ],
                    datasets: [{
                            label: new Date().getFullYear(),
                            backgroundColor: "#4c51bf",
                            borderColor: "#4c51bf",
                            data: [65, 78, 66, 44, 56, 67, 75],
                            fill: false
                        },
                        {
                            label: new Date().getFullYear() - 1,
                            fill: false,
                            backgroundColor: "#ed64a6",
                            borderColor: "#ed64a6",
                            data: [40, 68, 86, 74, 56, 60, 87]
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    title: {
                        display: false,
                        text: "Sales Charts",
                        fontColor: "white"
                    },
                    legend: {
                        labels: {
                            fontColor: "white"
                        },
                        align: "end",
                        position: "bottom"
                    },
                    tooltips: {
                        mode: "index",
                        intersect: false
                    },
                    hover: {
                        mode: "nearest",
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                fontColor: "rgba(255,255,255,.7)"
                            },
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: "Month",
                                fontColor: "white"
                            },
                            gridLines: {
                                display: false,
                                borderDash: [2],
                                borderDashOffset: [2],
                                color: "rgba(33, 37, 41, 0.3)",
                                zeroLineColor: "rgba(0, 0, 0, 0)",
                                zeroLineBorderDash: [2],
                                zeroLineBorderDashOffset: [2]
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                fontColor: "rgba(255,255,255,.7)"
                            },
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: "Value",
                                fontColor: "white"
                            },
                            gridLines: {
                                borderDash: [3],
                                borderDashOffset: [3],
                                drawBorder: false,
                                color: "rgba(255, 255, 255, 0.15)",
                                zeroLineColor: "rgba(33, 37, 41, 0)",
                                zeroLineBorderDash: [2],
                                zeroLineBorderDashOffset: [2]
                            }
                        }]
                    }
                }
            };
            var ctx = document.getElementById("line-chart").getContext("2d");
            window.myLine = new Chart(ctx, config);

            /* Bar Chart */
            config = {
                type: "bar",
                data: {
                    labels: [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July"
                    ],
                    datasets: [{
                            label: new Date().getFullYear(),
                            backgroundColor: "#ed64a6",
                            borderColor: "#ed64a6",
                            data: [30, 78, 56, 34, 100, 45, 13],
                            fill: false,
                            barThickness: 8
                        },
                        {
                            label: new Date().getFullYear() - 1,
                            fill: false,
                            backgroundColor: "#4c51bf",
                            borderColor: "#4c51bf",
                            data: [27, 68, 86, 74, 10, 4, 87],
                            barThickness: 8
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    title: {
                        display: false,
                        text: "Orders Chart"
                    },
                    tooltips: {
                        mode: "index",
                        intersect: false
                    },
                    hover: {
                        mode: "nearest",
                        intersect: true
                    },
                    legend: {
                        labels: {
                            fontColor: "rgba(0,0,0,.4)"
                        },
                        align: "end",
                        position: "bottom"
                    },
                    scales: {
                        xAxes: [{
                            display: false,
                            scaleLabel: {
                                display: true,
                                labelString: "Month"
                            },
                            gridLines: {
                                borderDash: [2],
                                borderDashOffset: [2],
                                color: "rgba(33, 37, 41, 0.3)",
                                zeroLineColor: "rgba(33, 37, 41, 0.3)",
                                zeroLineBorderDash: [2],
                                zeroLineBorderDashOffset: [2]
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: "Value"
                            },
                            gridLines: {
                                borderDash: [2],
                                drawBorder: false,
                                borderDashOffset: [2],
                                color: "rgba(33, 37, 41, 0.2)",
                                zeroLineColor: "rgba(33, 37, 41, 0.15)",
                                zeroLineBorderDash: [2],
                                zeroLineBorderDashOffset: [2]
                            }
                        }]
                    }
                }
            };
            ctx = document.getElementById("bar-chart").getContext("2d");
            window.myBar = new Chart(ctx, config);
        })();

    </script>

@stack('modals')

@stack('js')
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
            position: 'top-end',
            icon: event.detail.icon,
            title: event.detail.msj,
            showConfirmButton: false,
            timer: 1500,
          
        })
       
    })

</script>

@livewireScripts

@isset($js)
    {{$js}}
@endisset
</body>

</html>
