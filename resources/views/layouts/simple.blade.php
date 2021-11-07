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
</head>

<body>
    <!--Container -->
    <div class="mx-auto bg-grey-400">
        <!--Screen-->
        <div class="min-h-screen flex flex-col">
            <!--Header Section Starts Here-->
            <div class="p-4 flex justify-between items-center">

                <div class="">
                    <a href="/" class="flex-shrink-0 flex items-center">
                        {{-- OTROS DISPOSITIVOS --}}
                        <div class="flex h-8 w-autotext-xl text-white transform p-2  items-center" >
                            <img class="h-20" src="{{url('images/iconos/juansil.png')}}" alt="">
                        </div>
                    </a>  
                </div>

                <div class="inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0 ">
                        
                        
                  

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

                        
                        <div x-show='open'  x-on:click.away="open=false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-40 hidden" :class="{'hidden': !open}" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Perfil</a>
                           
                            
                            @can('admin.home')
                                <a href="{{ route('admin.home') }}"  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tablero</a>
                            @endcan
                            @can('products.specialPrice')
                                <a href="{{ route('products.specialPrice') }}"  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Ver catalogo especial</a>
                               
                            @endcan
                            @auth
                                <a href="{{ route('orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Mis compras</a>
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

            </div>
      
            <!--/Header-->

            <div class="flex flex-1">
                <!--Sidebar-->
       
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
                <div class="flex flex-1 mx-auto">&copy; Juansil</div>
                {{-- <div class="flex flex-1 mx-auto">Distributed by:  <a href="https://themewagon.com/" target=" _blank">Themewagon</a></div> --}}
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
        window.addEventListener('toast', event => {
        
            Swal.fire({
                toast:true,
                position: 'bottom-end',
                icon: event.detail.icon,
                title: event.detail.title,
                showConfirmButton: false,
                timer: 5000
            })
        
        })
        function toast(title,icon){
            Swal.fire({
                toast:true,
                position: 'bottom-end',
                icon: icon,
                title:title,
                showConfirmButton: false,
                timer: 7000
            })
        }



     


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
</body>

</html>