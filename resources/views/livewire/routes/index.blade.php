<div class="">
    <div x-data="routesCalendar()"  class="header sm:p-6">
        <div class="w-screen sm:max-w-screen-sm ">
            <h1 class="text-2xl font-bold text-gray-600 py-4 px-2">Calendario Juansil</h1>

         

            <div class="px-2">
                    
                <x-jet-secondary-button wire:click="$set('tipoBusqueda', 1)">Por mes</x-jet-secondary-button> 
                <x-jet-secondary-button wire:click="$set('tipoBusqueda', 2)">Por rango</x-jet-secondary-button> 
            </div>
            <div class="border rounded my-2">
               
                    
                <div class="p-2">               
                    @if ($tipoBusqueda == 1)
                        <x-jet-label>Selecciona mes:
                            <x-jet-input class="w-full" type="month" id="start" name="start" min="2021-06" value="{{date('Y-m')}}" max="{{date('Y')}}-12" wire:change="seleccionaMes" wire:model="por_mes"></x-jet-input>
                        </x-jet-label>
                       
                    @elseif($tipoBusqueda == 2)
                        <x-jet-label>Desde:
                            <x-jet-input class="w-full" type="date" id="start" name="start" min="2021-06" value="{{date('Y-m')}}" max="{{date('Y')}}-12" wire:change="selecciona_rango1" wire:model="por_rango1"></x-jet-input>
                        </x-jet-label>
                        <x-jet-label>Hasta:
                            <x-jet-input class="w-full" type="date" id="start" name="start" min="2021-06" value="{{date('Y-m')}}" max="{{date('Y')}}-12" wire:change="selecciona_rango2" wire:model="por_rango2"></x-jet-input>
                        </x-jet-label>
                    @endif
                </div>
                
            </div>
           
            <div class="grid grid-cols-7 gap-2 text-sm sm:text-base p-2">
            
                        @foreach ($period as $fecha)
                        {{-- {{$fecha->format('N')}} --}}
                            @if ($mes1 != $fecha->format('m') && $mes1 != 0 && $fecha->format('N') != 1)
                                @for ($i = 1; $i <= 7; $i++)
                                    @if ($fecha->format('N') <= $i)
                                        <div class="border h-16 p-2">
                    
                                        </div>
                                    @endif
                                @endfor
                            @endif
                            @if ($mes1 != $fecha->format('m'))
                                <div class="col-span-7 text-center bg-gray-200 text-gray-600 font-bold py-2 mb-2">
                                    <h2 class="text-xl">
                                        @switch($fecha->format('m'))
                                            @case(1)
                                            Enero
                                                @break
                                            @case(2)
                                                Febrero
                                                @break
                                            @case(3)
                                                Marzo
                                                @break
                                            @case(4)
                                                Abril
                                                @break
                                            @case(5)
                                                Mayo
                                                @break
                                            @case(6)
                                                Junio
                                                @break
                                            @case(7)
                                                Julio
                                                @break
                                            @case(8)
                                                Agosto
                                                @break
                                            @case(9)
                                                Septiembre
                                                @break
                                            @case(10)
                                                Octubre
                                                @break
                                            @case(11)
                                                Noviembre
                                                @break
                                            @case(12)
                                                Diciembre
                                                @break
                                            @default
                                        @endswitch
                                    </h2>
                                </div>
                                @php
                                    $mes1 = $fecha->format('m');
                                @endphp

                                <div>Lunes</div>
                                <div>Martes</div>
                                <div>Miercoles</div>
                                <div>Jueves</div>
                                <div>Viernes</div>
                                <div>Sabado</div>
                                <div>Dom</div>


                                @for ($i = 1; $i <= 7; $i++)
                                    @if ($fecha->format('N') != $i)
                                        <div class="border h-16 p-2">
                
                                        </div>
                                    @else
                                        @break
                                    @endif
                                @endfor
                            @endif

                            @isset($calendario)
                                @if ($calendario->containsStrict('fecha', $fecha->format('Y-m-d')))
                                    @php 
                                        $calendar = $calendario->where('fecha',$fecha->format('Y-m-d'))->first(); 
                                        if($calendar->agendable){
                                            $agendable = true; 
                                        } else{
                                            $agendable = false;
                                        }
                                    @endphp
                                @else
                                @php
                                    $agendable = true; 
                                @endphp

                                @endif
                            @endisset
                            
                            <div class="border h-16 p-2 text-sm text-gray-600 font-bold transform hover:scale-110 cursor-pointer @if(!$agendable) bg-red-500 @endif" id="fecha_{{$fecha->format('Ymd')}}" 
                                x-on:click="verFecha({{$fecha->format('Ymd')}})"
                                data-dia="{{$fecha->format('d')}}"
                                data-mes="{{$fecha->format('m')}}"
                                data-anio="{{$fecha->format('Y')}}"
                                data-agendable="{{$agendable}}"
                                @isset($calendar)
                                    data-comentario="{{$calendar->comentario}}"
                                    data-user_created="{{$calendar->user_created}}"
                                    data-calendario_id="{{$calendar->id}}"
                                @endisset
                              
                            >
                                <div>
                                    {{$fecha->locale('es_ES')->format('d')}}
                                </div>
                               
                               

                            </div>                           

                        @endforeach

                        @for ($i = 1; $i <= 7; $i++)
                            @if ($period->last()->format('N') < $i)
                                <div class="border h-16 p-2">
            
                                </div>
                            @endif
                        @endfor               
            </div>
        </div>

        <div  class="hidden" :class="{hidden:!modal}">
            <div class="inset-0 fixed opacity-25 bg-gray-800 flex justify-center items-center"></div>
            <div class="inset-0 absolute  flex justify-center items-center">
               <section class="bg-gray-200 rounded-lg shadow max-w-screen-sm w-full">
                   <header class="header  p-4 ">
                       <h1 class="text-xl font-bold text-gray-800" x-text="titulo"></h1>
                   </header>
                   <main class="p-4 bg-white">
                        <div>
                            <template x-if="agendable">
                                <div class="">
                                    <div class="font-bold text-gray-600">
                                    <div class="my-2">
                                            Ingresa un motivo por el cual no se realizará reparto en este día
                                        </div>
                                        <x-jet-input class="w-full" placeholder="Ingresa motivo" id="comentario"></x-jet-input>
                                    </div>
                                   
                                </div>
                               
                            </template>

                            <template x-if="!agendable">
                                <div>
                                    <div class="font-bold text-gray">Este día no se podrá agendar entregas por el siguiente motivo</div>
                                    <div class="my-2" x-text="comentario"></div>
                                </div>
                            </template>
                            
                        </div>
                   </main>
                   <footer class="header p-4">
                    
                    <template x-if="!agendable">
                        <div class="flex justify-between">
                            <x-jet-danger-button x-on:click="quitarRestriccion">Quitar restriccion</x-jet-danger-button>
                            <x-jet-button x-on:click="cerrarModal">Cerrar</x-jet-button>
                        </div>
                    </template>
                    <template x-if="agendable">
                        <div class="flex justify-between">
                            <x-jet-button x-on:click="noAgendable">Agregar restriccion</x-jet-secondary-button>
                            <x-jet-button x-on:click="cerrarModal">Cerrar</x-jet-button>
                        </div>
                    </template>
                   </footer>
               </section>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            function routesCalendar(){
                return{
                    tipoBusqueda : @entangle('tipoBusqueda'),
                    titulo: "Titulo",
                    modal: @entangle('modal'),
                    dia:"",
                    mes:"",
                    anio:"",
                    comentario:"",
                    agendable:"",
                    user_created:"",
                    calendario_id:"",

                    verFecha : function(id){
                        element= document.getElementById('fecha_'+id);
                        this.dia = element.dataset.dia;
                        this.mes = element.dataset.mes;
                        this.anio = element.dataset.anio;
                        this.agendable = element.dataset.agendable;
                        this.comentario = element.dataset.comentario;
                        this.user_created = element.dataset.user_created;
                        this.calendario_id = element.dataset.calendario_id;
                    
                        this.titulo = this.dia + "-" + this.mes + '-' + this.anio;
                        this.modal = true;
                    },
                    cerrarModal:function(){
                        this.modal = false;
                    },

                    quitarRestriccion: function(){
                        
                        this.$wire.agendable(this.calendario_id)
                        .then((result) => {
                            if(result){
                                alerta_timer({
                                    title:'Se ha quitado la restriccion, ahora se puede agendar en este día'
                                });
                                this.modal=false;
                            }else{
                                alerta_timer({
                                    title:'No se ha podido quitar la restriccion',
                                    icon : 'warning',
                                });
                            }
                        }).catch((err) => {
                            
                        });
                    },

                    noAgendable : function(){
                        this.comentario = document.getElementById('comentario').value
                        this.$wire.noAgendable(this.dia,this.mes,this.anio,this.comentario )
                        .then((result) => {
                            if(result){
                                alerta_timer({
                                    title:'Se ha guardado no agendable con exito'
                                });
                                this.modal=false;
                            }else{
                                alerta_timer({
                                    title:'No se ha podido guardar',
                                    icon : 'warning',
                                });
                            }
                        }).catch((err) => {
                            
                        });

                    },

                }
            }
        </script>
    @endpush
</div>
