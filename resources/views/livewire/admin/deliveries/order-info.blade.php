<div>
    @if ($mostrar_venta)
        <section class="relative w-full">  

            {{-- COMENTARIOS --}}
            @if ( $venta->customer->comentario != null || $venta->comments != null )
                <article class=" shadow rounded p-4 bg-red-200">
                    <div class="text-red-600"  >
                        <div> {{ $venta->customer->comentario }}</div>
                        <div> {{ $venta->comments }}  </div>
                    </div>
                </article>  
            @endif


            {{-- DATOS DEL CLIENTE --}}
            <article class="bg-white shadow rounded p-4">
                <h2 class="font-bold text-gray-500 my-2">Datos del cliente</h2>
                <div class="flex justify-between items-center flex-wrap gap-2 ">

                    <div class="flex gap-2 items-center">
                        {{-- ICONO DEL VENDEDOR --}}
                        <div>
                            @if ($venta->sale_type== 1)
                                @if ($venta->created_by())
                                    <img class="h-8 w-8 rounded-full" src="{{ $venta->created_by()->profile_photo_url }}" alt="">
                                @else
                                    
                                @endif
                                
                            @elseif ($venta->sale_type== 2)  
                                <i class="fas fa-shopping-cart"></i>
                            @elseif ($venta->sale_type== 3)  
                                <i class="fas fa-user"></i>
                            @endif
                        </div>

                        {{-- NOMBRE DEL CLIENTE --}}
                        <a href="{{ route('admin.customers.edit', $venta->customer) }}">{{ $venta->customer->name }}</a>
                        
                    </div>
                    {{-- TOTAL DE LA VENTA --}}
                    <div class="text-3xl  "> ${{ number_format($venta->total,0,',','.')}}</div>
                   
                </div>
                {{-- DIRECCION --}}
                <div class="w-full pb-2">
                    <a class="pb-2"  href='https://www.google.cl/maps/place/{{ $venta->customer->direccion }}'  target='_blank'>
                    
                        {{ $venta->customer->direccion }}
                        @if ($venta->customer->block != '') 
                            Torre  {{ $venta->customer->block }},
                        @endif
                        @if ($venta->customer->depto != '') 
                            Depto: {{ $venta->customer->depto }}
                        @endif
                    </a>
                </div>
                

                {{-- BOTONERA DE OPCIONES DE INTERACCION CLIENTE --}}
                <div class=" flex flex-wrap items-center gap-2 " >
                    @if ($venta->customer->celular)
                        {{-- BOTON LLAMADA --}}
                        <x-jet-secondary-button>
                            <a href="tel:{{ $venta->customer->celular }}" target="_blank"><i class="fas fa-phone-square text-lg"></i></a>
                        </x-jet-secondary-button>
                        
                        {{-- BOTONES WASAP --}}
                        <div id="sendWasap_{{$venta->id}}" x-data="{isOpenSendWasap:false}">
                            <x-jet-secondary-button x-on:click="isOpenSendWasap = true">
                                <i class="fab fa-whatsapp text-lg"></i>
                            </x-jet-secondary-button>
                            <div x-cloak x-show="isOpenSendWasap" x-on:click.away="isOpenSendWasap = false" x-on:click="isOpenSendWasap = false">
                                <h2 class="font-bold text-gray-500 my-2">Acceso directo a wasap</h2>
                                <div class="shadow absolute p-4 bg-white rounded text-sm grid gap-2">
                                    <div>
                                        <a href="https://api.whatsapp.com/send?phone={{ $venta->customer->celular }}&text=Hola,%20soy%20el%20repartidor,%20traigo%20su%20pedido" target="_blank">
                                            <x-jet-secondary-button>
                                                <i class="fab fa-whatsapp"></i>
                                            </x-jet-secondary-button>
                                            Soy el repartidor...
                                        </a>
                                    </div>
                                    <div>
                                        <a href="https://api.whatsapp.com/send?phone={{ $venta->customer->celular }}&text=Hola,%20Le%20envío%20datos.%0ACuenta%20vista%20Banco%20Estado%0ANombre:%20Sociedad%20Comercial%20Juansil%0Arut:%2076.449.384-2%0ANúmero%20de%20cuenta:%20360%207%20277892%202%0AMail:%20santiagoinostroza2@gmail.com%0A(No%20cobra%20comisión%20desde%20cuenta%20rut)" target="_blank">
                                            <x-jet-secondary-button>
                                                <i class="fab fa-whatsapp"></i>
                                            </x-jet-secondary-button>
                                            Cuenta juansil
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                    
                    @endif
                    {{-- BOTON DE UBICACION --}}
                    <x-jet-secondary-button>
                        <a href='https://www.google.cl/maps/place/{{ $venta->customer->direccion }}'  target='_blank'><i class="fas fa-map-marker-alt text-lg"></i></a>
                    </x-jet-secondary-button> 

                    {{-- BOTON HISTORIAL DE PEDIDOS DE CLIENTE --}}
                    <div id="info_{{$venta->id}}" x-data="{open:false}" class="text-base">
                      
                        <x-jet-secondary-button x-on:click="open= !open"   >
                            <div class="flex items-center">
                                <i class="fas fa-info  text-lg"> </i>
                                <span class="text-md p-0">{{$venta->customer->sales->count()}}</span>
                            </div>
                        </x-jet-secondary-button>
                        
                        <div x-show="open" x-transition x-on:click.away="open = false">
                            {{-- <x-modal.modal2> --}}
                                <div class="p-4 absolute bg-white max-h-96 overflow-auto shadow rounded right-0 left-0 -ml-2 -mr-2  border">
                                    <h2 class=" text-gray-500 font-bold ">
                                        Historial pedidos {{$venta->customer->name}}
                                    </h2>                                  
                                    <ul class="mt-2 flex flex-col gap-2 text-sm">
                                        @foreach ($venta->customer->sales as $sale)
                                            <li>
                                              
                                                <div class="font-bold">
                                                    @if ($sale->date_delivered)
                                                        {{Helper::fecha($sale->date_delivered)->diffForHumans()}} {{ Helper::fecha($sale->date_delivered)->dayName }} a las {{ Helper::fecha($sale->date_delivered)->format('H:i') }}
                                                    @else
                                                        Aún no se ha entregado
                                                    @endif
                                                    
                                                
                                                </div>
                                                @if ($sale->comments)
                                                    <div class="bg-red-200 p-2">
                                                        {{$sale->comments}}
                                                    </div>
                                                @endif
                                                @if ($sale->driver_comment)
                                                    <div class="bg-red-200 p-2">
                                                        {!!$sale->driver_comment!!}
                                                    </div>
                                                @endif
                                                @if ($sale->deliveredBy() )
                                                    <div>
                                                        Entregado por {{$sale->deliveredBy()->name}}
                                                    </div>
                                                @endif

                                                
                                                <div>
                                                    @foreach ($sale->saleItems as $item)

                                                        <div class="flex justify-between items-start">
                                                            <div class="flex items-start gap-2">
                                                                <div class="w-15">
                                                                    {{$item->cantidad}} x {{$item->cantidad_por_caja}}
                                                                </div>
                                                                <div>
                                                                    {{$item->product->name}}
                                                                </div>
                                                            
                                                            </div>
                                                            <div> ${{number_format($item->precio_total,0,',','.')}} </div>
                                                            
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="flex justify-end">
                                                    <div class="w-max-content grid grid-cols-2 gap-x-2 text-right">
                                                        <div> Delivery</div>
                                                        <div> ${{number_format($sale->delivery_value,0,',','.')}} </div>
                                                        <div class="font-bold"> Total</div>
                                                        <div class="font-bold"> ${{number_format($sale->total,0,',','.')}} </div>
                                                    </div>
                                                    
                                                </div>
                                            </li>
                                            <hr>
                                            
                                        @endforeach
                                        </ul>
                                    
                                </div>
                            {{-- </x-modal.modal2> --}}

                        </div>
                    </div>

                    {{-- BOTON SUBIR IMAGEN --}}
                    <livewire:admin2.upload-images.payment-receipt :sale="$venta" size="text-md"  :key="'sale_'.$venta->id" />

                     {{-- AGREGAR COMENTARIOS DEL CONDUCTOR --}}
                    <div class="my-2" id="addComments_{{$venta->id}}" x-data="{ isOpenAddComment:false, isOpenComments:false, comment:'' }">
                        @if ($sale->driver_comment!=null)
                            <x-jet-secondary-button  x-on:click="isOpenComments = true">
                                <span class="flex items-center"><i  class="fas fa-comment  text-lg"></i>  {{ $sale->driver_comment!=null ? 1 : '' }}</span>
                            </x-jet-secondary-button>
                        @else
                            <x-jet-secondary-button >
                                <i x-on:click="isOpenAddComment = true" class="fas fa-comment  text-lg"></i> 
                            </x-jet-secondary-button>
                        @endif
                        
                        @if ($sale->driver_comment!=null)
                           
                            <div x-show="isOpenComments" x-on:click.away="isOpenComments = false" class="text-gray-500 text-sm shadow bg-white p-4 rounded mt-2 absolute right-0 left-0 border max-h-96">
                                <div class="my-2 mb-4">
                                    {!!$sale->driver_comment!!}
                                </div>
                                <x-jet-secondary-button x-on:click="isOpenAddComment = true" >
                                    <i class="fas fa-comment"></i>+ 
                                </x-jet-secondary-button>
                            </div>
                        @endif
                        <div x-show="isOpenAddComment">
                            <x-modal.alert2>
                                <x-slot name="header">Ingresa un comentario</x-slot>
                                <x-slot name="body">
                                    <textarea x-model="comment" name="" id="" class="bg-white w-full border rounded"></textarea>
                                </x-slot>
                                <x-slot name="footer">
                                    <x-jet-secondary-button x-on:click="isOpenAddComment=false">Cancelar</x-jet-secondary-button>
                                    <x-jet-button x-on:click="$wire.saveDriverComment({{$sale}},comment).then(()=>{isOpenAddComment=false})">Guardar Comentario</x-jet-button>
                                </x-slot>
                            </x-modal.alert2>
                        </div>
                    </div>
                </div>
               
            </article>
            
            {{-- DETALLES DEL PEDIDO --}}
            <article class="bg-white shadow rounded p-4">
                <h2 class="font-bold text-gray-500 my-2">Detalles del pedido</h2>
                <div>
                    @foreach ($venta->sale_items as $item)
                        <div class="flex items-start gap-2 justify-between">
                            <div class="flex w-max-content">
                                {{ $item->cantidad }}x{{ $item->cantidad_por_caja }}
                            </div>
                            <div>
                                {{ $item->product->name }}
                            </div>

                            <div class="text-right">
                                ${{ number_format($item->precio_total, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                    <hr>

                    <div class="flex justify-end mt-2 ">
                        <div class="grid grid-cols-2 gap-x-4">
                            <div>Subtotal</div>
                            <div class="text-right">${{ number_format($venta->subtotal,0,',','.')}}</div>
                            <div class="">delivery</div>
                            <div class="text-right">${{ number_format($venta->delivery_value,0,',','.')}}</div>
                            <div class="font-bold">Total</div>
                            <div class="text-right font-bold">${{ number_format($venta->total,0,',','.')}}</div>
                        </div>
                    </div>
                </div>
            </article>

            {{-- BOTONES DE ACCION --}}
            <article class="bg-white shadow rounded p-4">
                <div class="flex justify-between md:justify-start gap-4">

                    {{-- BOTON PAGAR --}}
                    <div class="" x-data="{loading:false,showPay:false,showPay2:false,loading2:false,loading3:false}" id="pay_{{$venta->id}}">
                        
                        @if ($venta->payment_status == 1)
                            <div class="hidden" :class="{'hidden': !loading}">
                                <x-spinner.spinner2 size="8"></x-spinner.spinner2>
                            </div>
                            <div>
                                <x-jet-button x-on:click="showPay=true"> Pagar </x-jet-button>
                                <div class="hidden" :class="{'hidden' : !showPay}">
                                    <x-modal.modal2>
                                        <div class="p-4">
                                            <div class="flex items-center justify-between gap-4">
                                                <h2 class="text-gray-600 font-bold text-xl">Pagar</h2>
                                                <div x-on:click="showPay=false" class="rounded-full shadow p-2 px-3">
                                                    <i class="fas fa-times "></i>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2 gap-2 gap-y-4 mt-8 relative">
                                                <x-jet-button x-on:click="loading2=true;loading=true; $wire.payOrder({{ $venta }}, 1).then(()=>{loading2=false;loading3=false; showPay=false;})"> Efectivo </x-jet-button>
                                                <x-jet-button x-on:click="loading2=true;loading=true; $wire.payOrder({{ $venta }}, 2).then(()=>{loading2=false;loading3=false; showPay=false;})"> Cuenta rut Paty </x-jet-button>
                                                <x-jet-button x-on:click="loading2=true;loading=true; $wire.payOrder({{ $venta }}, 3).then(()=>{loading2=false;loading3=false; showPay=false;})"> Cuenta rut Santy </x-jet-button>
                                                <x-jet-button x-on:click="loading2=true;loading=true; $wire.payOrder({{ $venta }}, 4).then(()=>{loading2=false;loading3=false; showPay=false;})"> Cuenta rut Silvia </x-jet-button>
                                                <x-jet-button x-on:click="loading2=true;loading=true; $wire.payOrder({{ $venta }}, 5).then(()=>{loading2=false;loading3=false; showPay=false;})"> Cuenta Santander </x-jet-button>
                                                <x-jet-button x-on:click="loading2=true;loading=true; $wire.payOrder({{ $venta }}, 6).then(()=>{loading2=false;loading3=false; showPay=false;})"> Cuenta Juansil </x-jet-button>
                                                <x-jet-button x-on:click="loading2=true;loading=true; $wire.payOrder({{ $venta }}, 7).then(()=>{loading2=false;loading3=false; showPay=false;})"> Otra </x-jet-button>
                                            
                                                <div class="hidden" :class="{'hidden': !loading2}">
                                                    <x-spinner.spinner2 size="8"></x-spinner.spinner2>
                                                </div>
                                            </div>


                                        </div>
                                    </x-modal.modal2>
                                </div>
                            </div>
                        @elseif($venta->payment_status==2)
                            Abonado<div wire:click='pagarDiferencia({{ $venta->id }})' style="background: #d0e80a" class="btn ml-2">Pagar</div>
                        @elseif($venta->payment_status==3) {{-- PAGADO --}}
                            <div class="hidden" :class="{'hidden': !loading3}">
                                <x-spinner.spinner2 size="8"></x-spinner.spinner2>
                            </div>

                            <div class="bg-green-100 text-sm p-1 rounded text-green-600 shadow">
                                <div> 
                                    <div class="flex justify-between gap-2">
                                        <div class="flex gap-2 items-center"> Pagado <i class="fas fa-check"></i>  </div>
                                        <a class="cursor-pointer text-yellow-500 px-2"  x-on:click="showPay2 = true"> <i class="fas fa-pen"></i> </a>
                                    </div>
                                    <div>
                                         {{ Str::limit(Helper::fecha($venta->payment_date)->dayName, 3,'') }} {{ Helper::fecha($venta->payment_date)->format('H:i') }} hrs. 
                                    </div>
                                    
                                    @if ($venta->paymentBy())
                                        <div> por {{$venta->paymentBy()->name}} </div>
                                    @endif
                                    
                                    <div>
                                        
                                        @switch($venta->payment_account)
                                            @case(1)
                                                Efectivo
                                                @break
                                            @case(2)
                                                Rut Paty
                                                @break
                                            @case(3)
                                                Rut Santy
                                                @break
                                            @case(4)
                                                Rut Silvia
                                                @break
                                            @case(5)
                                                Cuenta santander
                                                @break
                                            @case(6)
                                                Cuenta Juansil
                                                @break
                                            @case(7)
                                                Otra
                                                @break
                                            @default
                                                
                                        @endswitch
                                    </div>

                                </div>
                            </div>
                           
                            <div class="hidden" :class="{'hidden' : !showPay2}">
                                <x-modal.modal2>
                                    <div class="p-4">
                                        <div class="flex items-center justify-between gap-4">
                                            <h2 class="text-gray-600 font-bold text-xl">Cambiar metodo de pago</h2>
                                            <div x-on:click="showPay2=false" class="rounded-full shadow p-2 px-3">
                                                <i class="fas fa-times"></i>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-2 gap-2 gap-y-4 mt-8 relative">
                                            <x-jet-button x-on:click="loading2=true;loading3=true; $wire.payOrder({{ $venta }}, 1).then(()=>{loading2=false;loading=false; showPay2=false;})"> Efectivo </x-jet-button>
                                            <x-jet-button x-on:click="loading2=true;loading3=true; $wire.payOrder({{ $venta }}, 2).then(()=>{loading2=false;loading=false; showPay2=false;})"> Cuenta rut Paty </x-jet-button>
                                            <x-jet-button x-on:click="loading2=true;loading3=true; $wire.payOrder({{ $venta }}, 3).then(()=>{loading2=false;loading=false; showPay2=false;})"> Cuenta rut Santy </x-jet-button>
                                            <x-jet-button x-on:click="loading2=true;loading3=true; $wire.payOrder({{ $venta }}, 4).then(()=>{loading2=false;loading=false; showPay2=false;})"> Cuenta rut Silvia </x-jet-button>
                                            <x-jet-button x-on:click="loading2=true;loading3=true; $wire.payOrder({{ $venta }}, 5).then(()=>{loading2=false;loading=false; showPay2=false;})"> Cuenta Santander </x-jet-button>
                                            <x-jet-button x-on:click="loading2=true;loading3=true; $wire.payOrder({{ $venta }}, 6).then(()=>{loading2=false;loading=false; showPay2=false;})"> Cuenta Juansil </x-jet-button>
                                            <x-jet-button x-on:click="loading2=true;loading3=true; $wire.payOrder({{ $venta }}, 7).then(()=>{loading2=false;loading=false; showPay2=false;})"> Otra </x-jet-button>
                                            <x-jet-button x-on:click="loading2=true;loading3=true; $wire.payOrder({{ $venta }}, null).then(()=>{loading=false;loading2=false; showPay2=false;})"> Quitar pago </x-jet-button>
                                        
                                            <div class="hidden" :class="{'hidden': !loading2}">
                                                <x-spinner.spinner2 size="8"></x-spinner.spinner2>
                                            </div>
                                        </div>


                                    </div>
                                </x-modal.modal2>
                            </div>

                        
                            
                        @endif
                    </div>

                    {{-- BOTON ENTREGAR --}}
                    <div class="" x-data="{loading:false,deliverOrder:false}" id="deliver_{{$venta->id}}">
                    
                        <div class="flex justify-between items-center"  >
                            @if ($venta->delivery_stage == null)
                                <div class="hidden" :class="{'hidden': !loading}">
                                    <x-spinner.spinner2 size="8"></x-spinner.spinner2>
                                </div>
                                <x-jet-button  x-on:click="loading=true; $wire.deliverOrder({{ $venta }}).then(()=>{loading=false}) ">Entregar</x-jet-button>
                            @elseif($venta->delivery_stage==1) {{-- ENTREGADO --}}
                                <div class="bg-green-100 text-green-600 shadow p-1 rounded text-sm">
                                    <div class="flex gap-2 justify-between">
                                        <div class="flex gap-2 items-center">
                                            Entregado <i class="fas fa-check"></i>
                                        </div>
                                        <a class="cursor-pointer text-yellow-500 px-2"  x-on:click="deliverOrder = true"> <i class="fas fa-pen"></i> </a>
                                    </div>
                                    <div>{{ Str::limit(Helper::fecha($venta->date_delivered)->dayName, 3, '') }}  {{ Helper::fecha($venta->date_delivered)->format('H:i') }} hrs. </div> 
                                    
                                    @if ($venta->deliveredBy())
                                        <div>
                                            por  {{ $venta->deliveredBy()->name}}
                                        </div>
                                    @endif

                                    <div class="hidden" :class="{'hidden' : !deliverOrder}">
                                        <x-modal.modal2>
                                            <div class="p-4">
                                                <div class="flex items-center justify-between gap-4">
                                                    <h2 class="text-gray-600 font-bold text-xl">Quitar entregado</h2>
                                                    <div x-on:click="deliverOrder=false" class="rounded-full shadow p-2 px-3">
                                                        <i class="fas fa-times"></i>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-4">
                                                    <x-jet-secondary-button x-on:click=" deliverOrder=false"> Cancelar</x-jet-secondary-button>
                                                    <x-jet-button  x-on:click="loading=true; $wire.deliverOrder({{ $venta }}, true).then(()=>{loading=false;deliverOrder=false}) ">Marcar como no entregado</x-jet-button>
                                                   
                                                    <div class="hidden" :class="{'hidden': !loading}">
                                                        <x-spinner.spinner2 size="8"></x-spinner.spinner2>
                                                    </div>
                                                </div>
        
        
                                            </div>
                                        </x-modal.modal2>
                                    </div>
                                        
                                        
                                </div>
                            
                            @endif
                        </div>
                    </div>

                </div>
            </article>


           



           
            
        </section>
    @endif
</div>
