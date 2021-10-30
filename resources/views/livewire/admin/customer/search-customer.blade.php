<div>
    <style>
        #map {
          height: 300px;
        }
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
        }
    </style>

    <div class="relative" 
        x-data="searchCustomer()" 
        x-init="mapa()" 
    >
 
       
        {{-- BUSCADOR DE CLIENTES --}}
        <div x-show='open_search'>
            <x-jet-label value='Seleccione Cliente' />
            <x-jet-input wire.ignore
                id='search' type='' class="w-full" 
                wire:model.debounce='search' 
                @keydown="alEscribir"
                @keydown.arrow-down="aumentaIndex" 
                @keydown.escape="open_list=false"
                @keydown.tab="open_list=false"
                
                @keydown.arrow-up="restaIndex" 
                @keydown.enter="seleccionar" 
                @click.away="open_list=false"
                @click="open_list=true" 
               

            />
            <x-spinner.spinner wire:loading.delay size='8' class="absolute top-0 right-0 mr-2 mt-6"></x-spinner.spinner>
            <div x-show='open_list' class="border bg-white w-full absolute shadow overflow-auto max-h-96 z-10" id="lista_clientes" tabindex="-1">
                @forelse ($customers as $key => $customer)
                    <div class=" p-2 cursor-pointer border-b z-50 customer h-16" 
                        tabindex="-1"
                        id="customer_{{ $customer->id }}" 
                        data-id="{{$customer->id}}"
                        data-nombre="{{$customer->name}}"
                        @mouseenter="preseleccionar"
                        @click="seleccionar";

                        
                       
                    >
                        <div class="font-bold">
                            {{ $customer->name }}
                          
                        </div>
                        <div class="">
                            {{ $customer->direccion }}
                        </div>
                    </div>
                    
                @empty
                    <div class="p-2 hover:bg-gray-200 cursor-pointer customer" id="customer_-1"
                        data-id="-1"
                        data-nombre="{{$search}}"
                        @mouseenter="preseleccionar"
                        @click="seleccionar";
                    >
                        <div class="font-bold">
                            No existe
                        </div>
                        <div>
                            Crear cliente "{{$search}}"
                        </div>
    
                    </div>
                @endforelse
            </div>
        </div>

        {{-- DATOS DEL CLIENTE OPCIONAL --}}
        @if ($showDataCustomer)  
            @if ($customer_id>0)
                <div x-show='open_data_customer' class="border rounded p-4 mt-2">
                  
                        <h2 class="text-lg font-bold text-gray-600 flex gap-4 items-center"> 
                            {{$selected_customer->name}} 
                            <a href="{{ route('admin.customers.edit',$customer->id) }}" target="_blank"> <i class="fas fa-pen"></i>  </a>
                        </h2>
                       <div>
                            <strong class="text-right pr-2">Direccion</strong>
                            <span>
                                {{$selected_customer->direccion}} 
                                @if ($selected_customer->block)
                                    torre {{$selected_customer->block}} 
                                @endif
                                @if ($selected_customer->depto)
                                    depto {{$selected_customer->depto}} 
                                @endif
                            </span>
                       </div>


                        @if ($selected_customer->telefono)
                            <div>
                                <strong class="text-right pr-2">Telefono</strong>
                                <span>{{$selected_customer->telefono}}</span>
                            </div>
                        @endif
                        <div>
                            <strong class="text-right pr-2">Celular</strong>
                            <span>
                                @if ($selected_customer->celular)
                                    {{$selected_customer->celular}}
                                @else
                                    No hay registro
                                @endif
                            </span>
                        </div>
                       
                   
                    @if ($selected_customer->comentario)
                        <div>
                            <strong class="text-right pr-2">Comentario</strong>
                            <span>
                                {{$selected_customer->comentario}}
                            </span>
                        </div>
                    @endif
            
                </div>
            @endif

        @endif


        {{-- AGREGAR NUEVO CLIENTE --}}
        <div x-show='open_new_customer' >
            <div class="bg-gray-900 fixed opacity-75 top-0 left-0 right-0 bottom-0"></div>
            
            <div class="p-6 border absolute bg-white w-full rounded-xl" style="top: -60px">
                  
                <h2 class="text-xl my-2">Crear Cliente Nuevo</h2>
                
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <x-jet-label value='Nombre'></x-label>
                        <x-jet-input wire:model.defer='name' class="w-full"></x-input>
                        @error('name') <span class="text-xs text-red-400">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <x-jet-label value='Telefono'></x-label>
                        <x-jet-input wire:model.defer='telefono'  class="w-full"></x-input>
                    </div>
                    <div>
                        <x-jet-label value='Celular'></x-label>
                        <x-jet-input wire:model.defer='celular'  class="w-full"
                            wire:blur='validarCelular()'
                        />
                        <span class="text-xs text-red-400">{{$msjErrorCelular}}</span>
                    </div>
                </div>

                <div>
                    <x-jet-label value='Direccion'></x-label>
                    <x-jet-input wire:model.defer='direccion'  id='direccion' class="w-full"></x-input>
                    @error('direccion') <span class="text-xs text-red-400">{{ $message }}</span> @enderror    
                </div>
            
                <div class="grid grid-cols-3 gap-3 hidden">
                    <x-jet-input  wire:model.defer='numero'  id='numero' class="w-full"></x-input>
                    <x-jet-input  wire:model.defer='latitud'  id='latitud' class="w-full"></x-input>
                    <x-jet-input  wire:model.defer='longitud'  id='longitud' class="w-full"></x-input>
                </div>
                @error('numero') <span class="text-xs text-red-400">{{ $message }}</span> @enderror   
                
                @error('longitud') @enderror    

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label for="direccion">
                            <x-jet-label value='Comuna'></x-label>
                            <x-jet-input wire:model.defer='comuna' id='comuna'  class="w-full" readonly></x-input>
                        </label>
                        @error('comuna') <span class="text-xs text-red-400">{{ $message }}</span> @enderror   
                    </div>
                    <div>
                        <x-jet-label value='Torre'></x-label>
                        <x-jet-input wire:model.defer='block'  class="w-full"></x-input>
                    </div>
                    <div>
                        <x-jet-label value='Depto'></x-label>
                        <x-jet-input wire:model.defer='depto'  class="w-full"></x-input>
                    </div>
                    
                </div>

                <div>
                    <x-jet-label value='Comentario'></x-label>
                    <x-jet-input wire:model.defer='comentario'  class="w-full"></x-input>
                </div>

                <div wire:ignore id="map" class="my-2">cargando mapa...</div>

                <div class="flex justify-between">
                    <x-jet-button wire:click="save_customer()">Crear cliente</x-jet-button>
                    <x-jet-button  @click="closeNewCustomer">Cerrar</x-jet-button>
                </div>
            
            </div>
        </div>

        
    </div>

    @push('js')
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC30rciXdqyWlqQXQJYrwE3Qs220le3PvY&libraries=places">
        </script> 
        <script>
            function searchCustomer() {
                return {
                    open_search:@entangle('open_search'),
                    open_list:@entangle('open_list'),
                    open_data_customer: @entangle('open_data_customer'),
                    open_new_customer: @entangle('open_new_customer'),
                    search:document.getElementById('search'),
                    index:0,
                    nombre:'',
                    customer_id:'',


                    alEscribir: function(){
                        this.open_list=true;
                        this.getClientes();
                    },

                    aumentaIndex:function(){
                        this.index++;
                        this.getClientes();
                    },
                    restaIndex:function(){

                        this.index--;
                        this.getClientes();
                       
                    },
                    getClientes : function(){
                        let clientes = document.querySelectorAll('.customer')
                        if(this.index >= clientes.length){
                            this.index=0;
                        }
                        if(this.index <0 ){
                            this.index=clientes.length-1;
                        }
                        
                        clientes.forEach((element,index) => {
                            element.classList.remove("bg-gray-300")
                            if(index == this.index){
                                element.classList.add("bg-gray-300");
                                this.nombre = element.dataset['nombre'];
                                this.customer_id = element.dataset['id'];
                                this.scrollIfNeeded (document.getElementById(element.id),document.getElementById('lista_clientes'));
                            }
                        });

                    },

                    preseleccionar:function(event){
                        let element1 = event.target;
                        let clientes = document.querySelectorAll('.customer')

                        clientes.forEach((element,index) => {
                            element.classList.remove("bg-gray-300")
                            if(element1 == element){
                                this.index = index;
                            }
                        });
                        element1.classList.add("bg-gray-300");
                        this.nombre = element1.dataset['nombre'];
                        this.customer_id = element1.dataset['id'];
                 
                    },
                    closeNewCustomer:function(){
                        this.open_new_customer = false;
                        this.open_search = true
                    },
                    seleccionar:function(){
                        this.search.blur();
                        this.search.value=this.nombre
                        Livewire.emit('setSearch',this.nombre,this.customer_id);    
                       if(this.customer_id == -1){
                            // this.open_search = false;
                            this.open_data_customer = false;
                            this.open_new_customer = true;
                            @this.set('name',this.nombre)  
                       } else{
                            this.open_data_customer = true;
                            this.open_new_customer = false;
                       }
                       this.open_list=false; 
                            
                    },
                    mapa:function(){
                        const ciudad_santiago = { //coordenadas de la ciudad santiago
                            lat: -33.4577756,
                            lng: -70.6504502
                        }

                        const map = new google.maps.Map(document.getElementById("map"), {
                            center: ciudad_santiago,
                            zoom: 10,
                        });
            
                        //RESTRINGIR BUSQUEDA A 10 KM DE SANTIAGO
                        const defaultBounds = {
                            north: ciudad_santiago.lat + 0.1,
                            south: ciudad_santiago.lat - 0.1,
                            east: ciudad_santiago.lng + 0.1,
                            west: ciudad_santiago.lng - 0.1,
                        };
            
                        const options = {
                            bounds: defaultBounds,
                            componentRestrictions: {
                                country: "cl"
                            },
            
                            //IMPORTANTE ESPECIFICAR LAS FIELDS CON LO NECESARIO PARA NO PAGAR DE MÁS
                            fields: ["geometry","address_components"],
                            origin: ciudad_santiago,
                            strictBounds: false,
                            types: ["address"],
                        };
            
                        const input = document.getElementById("direccion");
            
            
                        const autocomplete = new google.maps.places.Autocomplete(input, options);
                        autocomplete.bindTo("bounds", map);
                        
                        let markers = [];
                        autocomplete.addListener("place_changed", function() {

                            const place = autocomplete.getPlace();
                            console.log(place);
                            let calle, numero, comuna1, comuna2, ciudad, region, pais, lat, lng;

                            if (place.address_components) {
                                calle = (place.address_components[1] && place.address_components[1].short_name || ' ');
                                numero = (place.address_components[0] && place.address_components[0].short_name || '');
                                comuna1 = (place.address_components[2] && place.address_components[2].short_name || '');
                                comuna2 = (place.address_components[3] && place.address_components[3].short_name || '');
                                ciudad = (place.address_components[4] && place.address_components[4].short_name || '');
                                region = (place.address_components[5] && place.address_components[5].short_name || '');
                                pais = (place.address_components[6] && place.address_components[6].short_name || '');

                            }
                            if (place.geometry) {
                                lat = place.geometry.location.lat();
                                lng = place.geometry.location.lng();
                            }

                            newDireccion = input.value;
                            console.log('new direccion', newDireccion);
                            console.log('calle', calle);
                            console.log('numero', numero);
                            console.log('comuna1', comuna1);
                            console.log('comuna2', comuna2);
                            console.log('ciudad', ciudad);
                            console.log('region', region);
                            console.log('pais', pais);
                            console.log('lat', lat);
                            console.log('lng', lng);

                            @this.set('latitud',String(lat));
                            @this.set('longitud',String(lng));
                            @this.set('comuna',comuna1);
                            @this.set('direccion',newDireccion);
                            @this.set('numero',numero);

                            // ELIMINAR MARCADOR
                            for (let i = 0; i < markers.length; i++) {
                                markers[i].setMap(null);
                            }
                            // AGREGAR MARCADOR
                            const marker = new google.maps.Marker({
                                position:  { lat: lat, lng: lng },
                                map: map,
                                animation: google.maps.Animation.DROP,
                            });
                            markers.push(marker)



                        });
                    },
                    scrollIfNeeded: function (element, container) {
                        if (element.offsetTop < container.scrollTop) {
                            container.scrollTop = element.offsetTop;
                        } else {
                            const offsetBottom = element.offsetTop + element.offsetHeight;
                            const scrollBottom = container.scrollTop + container.offsetHeight;
                            if (offsetBottom > scrollBottom) {
                            container.scrollTop = offsetBottom - container.offsetHeight;
                            }
                        }
                    }    
                }
            }   

               
        </script>
    @endpush

</div>
