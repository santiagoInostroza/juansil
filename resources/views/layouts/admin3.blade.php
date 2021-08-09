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

        <script src="{{ URL::asset('js/nice-select2.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('css/nice-select2.css') }}">

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
