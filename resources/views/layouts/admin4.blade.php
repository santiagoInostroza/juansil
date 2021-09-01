<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,admin templates, admin template, admin dashboard, free tailwind templates, tailwind example">
    <!-- Css -->
    <link rel="stylesheet" href="{{asset('css/templateAdmin4A.css')}}">
    <link rel="stylesheet" href="{{asset('css/templateAdmin4B.css')}}">
   
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    {{-- <title>Dashboard | Tailwind Admin</title> --}}


    <title>{{ config('app.name', 'Juansil') }}</title>
    <link rel="icon" type="image/png" href="{{url('images/iconos/jsyellow.png')}}" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @livewireStyles

    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    {{-- SELECT2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- CKEDITOR --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="{{asset('css/ckStyles.css')}}">
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/balloon/ckeditor.js"></script> --}}
</head>

<body>
    <!--Container -->
    <div class="mx-auto bg-grey-400">
        <!--Screen-->
        <div class="min-h-screen flex flex-col" x-data="{openSidebar:false}">
            <!--Header Section Starts Here-->
            
            <header class="bg-nav">
                <div class="flex justify-between">
                    <div class="p-1 mx-3 inline-flex items-center">
                        <i class="fas fa-bars pr-2 text-white cursor-pointer p-3" x-on:click="openSidebar=!openSidebar"></i>
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
                    <div class="p-1 flex flex-row items-center">
                        <a href="https://github.com/tailwindadmin/admin" class="text-white p-2 mr-2 no-underline hidden md:block lg:block">Github</a>


                        <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="https://avatars0.githubusercontent.com/u/4323180?s=460&v=4" alt="">
                        <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block">Adam Wathan</a>
                        <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                            <ul class="list-reset">
                            <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">My account</a></li>
                            <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Notifications</a></li>
                            <li><hr class="border-t mx-2 border-grey-ligght"></li>
                            <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <!--/Header-->

            <div class="flex flex-1">
                <!--Sidebar-->
                <aside x-show="openSidebar" id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden" :class="{'hidden' : !openSidebar}">

                    <ul class="list-reset flex flex-col">
                        <li class=" w-full h-full  border-b border-light-border @if (Request::is('admin')) bg-white @endif">
                        <a href="{{route('admin.home')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fas fa-tachometer-alt float-left mx-2"></i>
                                Dashboard
                                <span><i class="fas fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full  border-b border-light-border  @if (Request::is('admin/users*')) bg-white @endif">
                            <a href="{{route('admin.users.index')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fas fa-users float-left mx-2"></i>
                                Usuarios
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full  border-b border-light-border  @if (Request::is('admin/users*')) bg-white @endif">
                            <a href="{{route('admin.users.newIndex')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fas fa-users float-left mx-2"></i>
                                Usuarios Nuevo
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full  border-b border-light-border  @if (Request::is('admin/users*')) bg-white @endif">
                            <a href="{{route('admin.users.newIndex')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fas fa-users float-left mx-2"></i>
                                Roles
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full  border-b border-light-border  @if (Request::is('admin/users*')) bg-white @endif">
                            <a href="{{route('admin.users.newIndex')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fas fa-users float-left mx-2"></i>
                                Roles Nuevo
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full  border-b border-light-border  @if (Request::is('admin/inventory*')) bg-white @endif">
                            <a href="{{route('admin.inventory')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Inventario
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        
                        <li class="w-full h-full  border-b border-light-border  @if (Request::is('admin/routes*')) bg-white @endif">
                            <a href="{{route('routes.index')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Calendario
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full border-b border-light-border  @if (Request::is('admin/routes*')) bg-white @endif">
                            <a href="{{route('admin.resumen')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Resumen
                                
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full border-b border-light-border  @if (Request::is('admin/ventas*')) bg-white @endif">
                            <a href="{{route('admin.sales.index')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Ventas
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full border-b border-light-border  @if (Request::is('admin/compras*')) bg-white @endif">
                            <a href="{{route('admin.purchases.index')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Compras
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full  border-b border-light-border  @if (Request::is('admin/sectors*')) bg-white @endif">
                            <a href="{{route('routes.sectors')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Sectores
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full border-b border-light-border  @if (Request::is('')) bg-white @endif">
                            <a href="{{route('admin.deliveries.index')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Deliveries
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full  border-b border-light-border  @if (Request::is('')) bg-white @endif">
                            <a href="{{route('admin.deliveries.index')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Deliveries2
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full border-b border-light-border  @if (Request::is('admin/report*')) bg-white @endif">
                            <a href="{{route('admin.report')}}"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Reportes
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full border-b border-light-border  @if (Request::is('admin/productos*')) bg-white @endif">
                            <a href="{{ route('admin.products.index') }}" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Productos
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full border-b border-light-border  @if (Request::is('admin/customers*')) bg-white @endif">
                            <a href="{{ route('admin.customers.index') }}" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Clientes
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full border-b border-light-border  @if (Request::is('admin/customers*')) bg-white @endif">
                            <a href="{{ route('admin.customers.lista') }}" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline block p-3 px-2 w-full h-full">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Clientes Nuevo
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        {{-- <li class="w-full h-full py-3 px-2 border-b border-light-border">
                            <a href="forms.html"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Forms
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2 border-b border-light-border">
                            <a href="buttons.html"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-grip-horizontal float-left mx-2"></i>
                                Buttons
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2 border-b border-light-border">
                            <a href="tables.html"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-table float-left mx-2"></i>
                                Tables
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2 border-b border-light-border">
                            <a href="ui.html"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fab fa-uikit float-left mx-2"></i>
                                Ui components
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2 border-b border-300-border">
                            <a href="modals.html" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-square-full float-left mx-2"></i>
                                Modals
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>--}}
                        {{-- <li class="w-full h-full py-3 px-2">
                            <a href="#"
                            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="far fa-file float-left mx-2"></i>
                                Pages
                                <span><i class="fa fa-angle-down float-right"></i></span>
                            </a>
                            <ul class="list-reset -mx-2 bg-white-medium-dark">
                                <li class="border-t mt-2 border-light-border w-full h-full px-2 py-3">
                                    <a href="login.html"
                                    class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                        Login Page
                                        <span><i class="fa fa-angle-right float-right"></i></span>
                                    </a>
                                </li>
                                <li class="border-t border-light-border w-full h-full px-2 py-3">
                                    <a href="register.html"
                                    class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                        Register Page
                                        <span><i class="fa fa-angle-right float-right"></i></span>
                                    </a>
                                </li>
                                <li class="border-t border-light-border w-full h-full px-2 py-3">
                                    <a href="404.html"
                                    class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                        404 Page
                                        <span><i class="fa fa-angle-right float-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        <li>
                            <div class="flex justify-end">
                                <x-tooltip.tooltip>
                                    <x-slot name="tooltip">
                                     {{Request::url()}}
                                    </x-slot>
                                
                                     <i class="far fa-comment"></i>
                                    
                                </x-tooltip.tooltip>
                            </div>
                           
                        </li>
                    </ul>

                </aside>
                <!--/Sidebar-->
              
                <main class="bg-white-300 flex-1 p-3 overflow-hidden">
                    @isset($slot)
                        {{ $slot }}
                    @endisset
                    @yield('content')
                </main>
              
            </div>
            <!--Footer-->
            <footer class="bg-grey-darkest text-white p-2">
                <div class="flex flex-1 mx-auto">&copy; My Design</div>
                <div class="flex flex-1 mx-auto">Distributed by:  <a href="https://themewagon.com/" target=" _blank">Themewagon</a></div>
            </footer>
            <!--/footer-->

        </div>

    </div>

    <script src="{{asset('js/templateAdmin4.js')}}"></script>
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

    {{--MI DROPDOWN --}}
    <script>
        function dropdown(){
        
            return {
                start(){
                    // console.log(this.id);
                    // console.log(this.value);
                    // console.log(this.items);
                },
                id:  '',
                name : "",
                items: '',
                value:'',

                valor:'',

                filter: "",
                show: false,
                selected: null,
                focusedOptionIndex: null,
                options: null,

                scrollIfNeeded(element,container){
                    if (element.offsetTop < container.scrollTop) {
                        container.scrollTop = element.offsetTop;
                    } else {
                        const offsetBottom = element.offsetTop + element.offsetHeight;
                        const scrollBottom = container.scrollTop + container.offsetHeight;
                        if (offsetBottom > scrollBottom) {
                        container.scrollTop = offsetBottom - container.offsetHeight;
                        }
                    }
                },

                close() { 
                    this.show = false;
                    // this.filter = this.selectedName();
                    this.focusedOptionIndex = this.selected ? this.focusedOptionIndex : null;
                },
                open() { 
                    this.show = true; 
                    this.start();
                    // this.filter = '';
                },
                openIf(){
                    if (!this.show) {
                        this.open()
                    }
                },
                toggle() { 
                    if (this.show) {
                        this.close();
                    }
                    else {
                        this.open()
                    }
                },
                isOpen() { return this.show === true },

                classOption(id, index) {
                    const isSelected = this.selected ? (id == this.selected.login.uuid) : false;
                    const isFocused = (index == this.focusedOptionIndex);
                    return {
                        'cursor-pointer w-full border-gray-100 border-b hover:bg-blue-50 flex items-center p-4': true,
                        'bg-blue-100': isSelected,
                        'bg-blue-50': isFocused
                    };
                },


                filteredOptions() {                    
                
                    if (this.filter === "") {
                        return this.items;
                    }
                    var myArray = this.filter.split(' ')
                
                    
                    if(myArray.length == 1){
                        return this.items.filter((item) => {
                            return item.name
                                .toLowerCase()
                                .includes(this.filter.toLowerCase());
                            }
                        );
                    }else{
                        elementos = this.items;
                        myArray.forEach(element => {
                            elementos = elementos.filter((item) => {
                                return item.name
                                    .toLowerCase()
                                    .includes(element.toLowerCase());
                                }
                            );
                        });
                       
                        return elementos;
                    }
                },
                onOptionClick(index) {
                    this.focusedOptionIndex = index;
                    this.selectOption();
                },
                selectOption(){
                    if (!this.isOpen()) {
                        return;
                    }
                    try {
                        this.focusedOptionIndex = this.focusedOptionIndex ?? 0;
                        const item = this.filteredOptions()[this.focusedOptionIndex];
                    
                        this.value=item.id;
                        if( this.value > 0){
                            this.name=item.name;
                            this.filter = this.name;
                            this.show=false;
                            
                            var element = document.getElementById('buscador_' + this.id);
                            element.value=this.value;
                            nameWire =element.getAttribute('wire:model') ;
                            nameWire2 =element.getAttribute('wire:model.defer') ;
                            nameWire3 =element.getAttribute('wire:model.lazy') ;
                            if(nameWire != null){
                                this.$wire.set(nameWire, this.value)
                            }
                            if(nameWire2 != null){
                                this.$wire.set(nameWire2, this.value)
                            }                                
                            if(nameWire3 != null){
                                this.$wire.set(nameWire3, this.value)
                            }                                
                        }  
                    } catch (error) {
                        this.close();
                    }                      
                },
                setName(){
                    // setTimeout(() => {
                        element = document.getElementById('buscador_' + this.id);
                        if(element){
                            if( document.getElementById('buscador_' + this.id).value>0){
                                this.value =document.getElementById('buscador_' + this.id).value;
                                item = this.items.filter(item => this.value == item.id);
                                this.name=item[0].name;
                                this.filter = this.name;
                            }
                        }
                        
                    // }, 400);
                },

                focusPrevOption() {
                    if (!this.isOpen()) {
                        return;
                    }
                    const optionsNum =  Object.keys(this.filteredOptions()).length - 1;
                    if (this.focusedOptionIndex > 0 && this.focusedOptionIndex <= optionsNum) {
                        this.focusedOptionIndex--;
                    }
                    else if (this.focusedOptionIndex == 0) {
                        this.focusedOptionIndex = optionsNum;
                    }
                    else{
                        this.focusedOptionIndex = 0;
                    }
                    container = document.getElementById('opcion_' + this.id);
                    element = document.getElementById( this.id + "_opcion_" +  this.focusedOptionIndex);
                    this.scrollIfNeeded(element,container);
                },
                focusNextOption() {
                    const optionsNum =  Object.keys(this.filteredOptions()).length - 1;                        
                    if (!this.isOpen()) {
                        this.open();
                    }
                    if (this.focusedOptionIndex == null || this.focusedOptionIndex == optionsNum) {
                        this.focusedOptionIndex = 0;
                    }
                    else if (this.focusedOptionIndex >= 0 && this.focusedOptionIndex < optionsNum) {
                        this.focusedOptionIndex++;
                    }
                    else{
                        this.focusedOptionIndex = 0;
                    }
                    container = document.getElementById('opcion_' + this.id);
                    element = document.getElementById( this.id + "_opcion_" +  this.focusedOptionIndex);
                    this.scrollIfNeeded(element,container);
                },
            
            }
        }
    </script>

{{-- SELECT 2 --}}
    <script>
        $(document).ready(function() {
            $('.select').select2();
        });

        $(document).ready(function() {
            $('.selectMultiple').select2();
        });
    </script>




</body>

</html>