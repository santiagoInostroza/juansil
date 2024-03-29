<div>
    <div class="container m-auto xl:max-w-7xl text-gray-500 pt-10" x-data="pedidoMain()">   
        @if (session('carrito'))
            {{-- REVISAR PEDIDO --}}
            <div class="card my-10">

                <div class="relative ">
                    <div class="card-header flex justify-between">
                        <div class=" flex justify-start  items-center">
                            <h2 class="text-lg font-bold text-gray-600 flex items-center justify-start">
                                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                Revisar pedido
                            </h2>
                            @if ($is_ok_level_1)
                                <svg class="w-6 h-6 ml-2 text-green-600 font-bold " fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                            @endif
                        </div>
                        @if ($is_ok_level_1)
                            <div class="cursor-pointer flex" wire:click="editLevel1">
                                Editar
                                <svg class="ml-3 w-6 h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path> </svg>
                            </div>
                        @endif
                    </div>
                    <div class="relative overflow-hidden transition-all max-h-0 duration-700 mx-auto" style=""
                        x-ref="container1"
                        x-bind:style="open_level_1 == true ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">

                        <table class="min-w-max w-full  table-auto mx-auto mb-4">

                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach (session('carrito') as $item)

                                    <tr class="border-b border-gray-200 hover:bg-gray-100 h-32">
                                        <td class="pl-6 text-left flex items-center h-32">
                                            <div class="flex items-center justify-center w-32 mx-3">
                                                <figure>
                                                    {{-- @if (Storage::exists('products_thumb/' . $item['url'])) --}}
                                                        <img class=" object-cover h-24 mx-auto transform hover:scale-150" src=" {{ ('/storage/products_thumb/' . $item['url']) }}" alt="{{ $item['name'] }}">
                                                    {{-- @else --}}
                                                        {{-- <img class=" object-cover h-24 mx-auto transform hover:scale-150" src=" {{ Storage::url($item['url']) }}" alt=""> --}}
                                                    {{-- @endif --}}
                                                </figure>
                                            </div>
                                            <div class="w-full">
                                                <span class="font-bold"> {{ $item['name'] }} </span>
                                                <div class="text-xl">
                                                    ${{ number_format($item['precio'], 0, ',', '.') }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="py-3 text-right pr-15 w-16">
                                            <div>
                                                {{ $item['cantidad'] }} un.
                                            </div>
                                            <span class="text-xl">
                                                ${{ number_format($item['total'], 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="h-32 ">
                                    <td class="px-15  font-bold text-2xl">
                                    TOTAL
                                    </td>
                                    <td class="pr-15 text-2xl text-right">
                                        ${{number_format($this->totalCarrito, 0, ',', '.')}}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        {{-- BOTONES --}}
                        <div class="flex justify-center items-center my-5 text-sm text-center">
                            <a href="{{route('products.lista')}}"  class="btn rounded shadow bg-teal-500 text-white p-5 cursor-pointer">
                                Agregar más productos
                            </a> 
                            <div class="btn rounded shadow p-5 mx-5 bg-teal-500 text-white cursor-pointer" wire:click="$emitTo('cart.index','openCarrito');"> 
                                Modificar carrito
                            </div>
                            <div wire:click='validateLevel1' class=" text-sm btn rounded shadow p-5 bg-teal-500 text-white cursor-pointer">
                                Continuar <svg class="w-6 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path></svg>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>

            {{-- DATOS DE DESPACHO --}}
            <div class="card my-10 ">
                <div class="relative ">
                    <div class="card-header flex justify-between  items-center ">
                        <div class=" flex justify-start  items-center">

                            @if ($this->is_ok_level_2)
                                <h2 class="text-lg font-bold text-gray-600 flex items-center justify-start">
                                    <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                                    Datos de despacho
                                </h2>
                                <svg class="w-6 h-6 ml-2 text-green-600 font-bold " fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                            @else
                                <h2 class="text-lg font-bold text-gray-600 flex items-center">
                                    Datos de despacho 
                                    @if ($this->direccionValida == 1) 
                                        (Confirmar) 
                                        <div class="w-10 cursor-pointer">
                                            <svg class="w-6 h-6 text-yellow-600 font-bold mx-auto " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"> </path> </svg>
                                        </div>
                                    @endif
                                </h2>
                            @endif
                        </div>
                        @if ($this->is_ok_level_2 || $this->direccionValida == 1)
                            <div class="cursor-pointer flex" wire:click="editLevel2">
                                Editar
                                <svg class="ml-3 w-6 h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container2"
                        x-bind:style="open_level_2 == true ? 'max-height: ' + $refs.container2.scrollHeight + 'px' : ''">
                        <div class="card-body">
                            <form action="" disabled>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    {{-- DIRECCION --}}
                                    <div class="form-group">
                                        {!! Form::label('direccion', 'Direccion', ['class' => '']) !!}
                                        <div class="flex items-center">
                                            <div class="w-full">
                                                {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Direccion', 'wire:model' => 'direccion']) !!}
                                            </div>
                                            @if ($direccionValida == 1){{-- Valida --}}
                                                <div class="w-10 ">
                                                    <svg class="w-6 h-6 text-green-600 font-bold mx-auto " fill="none"stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                            @elseif ($direccionValida==2){{-- Incorrecto --}}
                                                <x-tooltip.tooltip>
                                                    <x-slot name='tooltip'>
                                                        Selecciona una direccion de la lista de opciones
                                                    </x-slot>
                                                    <div class="w-10 cursor-pointer">
                                                        <svg class="w-6 h-6 text-yellow-600 font-bold mx-auto " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"> </path> </svg>
                                                    </div>
                                                </x-tooltip.tooltip>
                                            @endif
                                        </div>

                                        @error('direccion')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        @if ($direccionValida == 3)
                                            <span class="invalid-feedback">
                                                Verifica la numeración de la direccion.
                                            </span>
                                        @endif
                                        @if ($direccionValida == 4)
                                            <span class="invalid-feedback">Lo sentimos, no tenemos reparto a esta direccion.
                                                <br> Revisa el listado de comunas disponibles 
                                                <a  class="p-2 text-primary underline cursor-pointer" wire:click="verComunasDisponibles"> 
                                                Acá
                                                </a>
                                            </span>
                                        @endif
                                    </div>

                                    {{-- COMUNA --}}
                                    <div class="form-group ">
                                        {!! Form::label('comuna', 'Comuna', ['class' => '']) !!}
                                        {!! Form::text('comuna', null, ['class' => 'form-control', 'placeholder' => 'Comuna', 'readonly' => true, 'wire:model' => 'comuna']) !!}

                                        @error('comuna')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                @if ($this->direccionValida ==1)
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

                                        {{-- NOMBRE --}}
                                        <div class="form-group">
                                            {!! Form::label('name', 'Nombre', ['class' => '']) !!}
                                            {!! Form::text('name', null, ['class' => 'form-control to_slug', 'placeholder' => 'Nombre y apellido', 'wire:model' => 'name']) !!}

                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- SLUG --}}
                                        <div class="form-group hidden">
                                            {!! Form::label('slug', 'Slug', ['class' => '']) !!}
                                            {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => 'Ingresa Slug', 'readonly' => true, 'wire:model' => 'slug']) !!}
                                            @error('slug')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Telefono --}}
                                        <div class="form-group hidden">
                                            {!! Form::label('telefono', 'Telefono (codigo + telefono)', ['class' => '']) !!}
                                            {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Ingresa Telefono', 'wire:model' => 'telefono']) !!}


                                            @error('telefono')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- CELULAR --}}
                                        <div class="form-group ">
                                            {!! Form::label('celular', 'Celular', ['class' => '']) !!}
                                            {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Ingresa celular', 'wire:model' => 'celular' ,'wire:blur' => 'validarCelular']) !!}

                                            @error('celular')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            @if ($msjErrorCelular!="")
                                            <span class="invalid-feedback">{{ $msjErrorCelular }}</span>
                                            @endif
                                        </div>

                                        {{-- BLOCK --}}
                                        <div class="form-group">
                                            {!! Form::label('block', 'Torre/Block', ['class' => '']) !!}
                                            {!! Form::text('block', null, ['class' => 'form-control', 'placeholder' => 'Opcional', 'wire:model' => 'block']) !!}

                                            @error('block')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- DEPTO --}}
                                        <div class="form-group">
                                            {!! Form::label('depto', 'Depto', ['class' => '']) !!}
                                            {!! Form::text('depto', null, ['class' => 'form-control', 'placeholder' => 'Opcional', 'wire:model' => 'depto']) !!}

                                            @error('depto')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- LATITUD --}}
                                        <div class="form-group hidden">
                                            {!! Form::label('latitud', 'Latitud', ['class' => '']) !!}
                                            {!! Form::text('latitud', null, ['class' => 'form-control', 'placeholder' => 'Latitud', 'readonly' => true, 'wire:model' => 'latitud']) !!}

                                            @error('latitud')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- LONGITUD --}}
                                        <div class="form-group hidden">
                                            {!! Form::label('longitud', 'Longitud', ['class' => '']) !!}
                                            {!! Form::text('longitud', null, ['class' => 'form-control', 'placeholder' => 'longitud', 'readonly' => true, 'wire:model' => 'longitud']) !!}
                                            @error('longitud')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Email --}}
                                        <div class="form-group col-span-1 sm:col-span-2 lg:col-span-1">
                                            {!! Form::label('email', 'Email', ['class' => '']) !!}
                                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'wire:model' => 'email']) !!}

                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    

                                        {{-- COMENTARIO --}}
                                        <div class="form-group col-span-1 sm:col-span-2 lg:col-span-3">
                                        
                                            <div class="flex items-center">
                                                {!! Form::label('comentario', 'Comentario adicional', ['class' => '']) !!}
                                                <x-tooltip.tooltip>
                                                    <x-slot name='tooltip'>
                                                        Si desea proporcionar alguna informacion extra puede hacerlo acá
                                                    </x-slot>
                                                    <div class="w-10 cursor-pointer">
                                                        <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </x-tooltip.tooltip>
                                            </div>
                                            {!! Form::textarea('comentario', null, ['class' => 'form-control', 'style' => 'height:50px', 'placeholder' => 'Ingresa Comentario', 'wire:model' => 'comentario']) !!}
                                            @error('comentario')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- CONFIRMACION DE DATOS --}}
                                        <div class="form-group col-span-1 sm:col-span-2 lg:col-span-4 text-center">
                                            <label for="" class="text-xs text-gray-400"> Verifica que todos los datos proporcionados sean correcto y presiona confirmar (Guardaremos tu informacion de contacto para futuras compras)</label>
                                            <div wire:click='validateLevel2' class="btn rounded shadow p-5 bg-teal-500 text-white mx-auto cursor-pointer max-w-max-content"> 
                                                Confirmar datos de despacho
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            {{-- SELECCIONAR FECHA DESPACHO--}}
            <div class="card my-10 ">
                <div class="relative">
                    <div class="card-header flex justify-between">
                        <div class=" flex justify-start  items-center">
                            <h2 class="text-lg font-bold text-gray-600 flex items-center justify-start">
                                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Fecha de despacho
                            </h2>
                            @if ($this->is_ok_level_3)
                                <svg class="w-6 h-6 ml-2 text-green-600 font-bold " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @endif
                        </div>
                        @if ($this->is_ok_level_3)
                            <div class="cursor-pointer flex" wire:click="editFecha">
                                Editar
                                <svg class="ml-3 w-6 h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path> </svg>
                            </div>
                        @endif
                    </div>
                    <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container3"
                        x-bind:style="open_level_3 == true ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
                        <div class="card-body">
                            <div>
                                @if ($this->open_level_3)
                                    <div class="text-sm my-5 font-bold">
                                        Los despachos serán realizados entre las 09:00 hrs y las 19:00 hrs, debes contar con disponibilidad para recibir durante ese horario. En caso de no concretar, se reagendará el envío para otra fecha.
                                    </div>
                                    <div class=" form-group flex justify-between items-center  text-sm  overflow-x-auto overflow-y-hidden w-full ">
                                            @foreach ($fechasDespacho as $fecha)
                                                <div  @if($fecha['agendable'] && !$fecha['copado'])  wire:click="validateLevel3('{{ $fecha['fecha_despacho'] }}','{{ $fecha['valor_despacho'] }}' ) " @endif
                                                    class="relative w-full h-full mx-1 shadow p-1  transform @if($fecha['agendable'] && !$fecha['copado']) hover:scale-110 hover:bg-green-300 cursor-pointer @endif   @if ($fechaDespacho==$fecha['fecha_despacho']) scale-110 border-b-4 border-yellow-400 @elseif($fecha['oferta']) text-green-600 @endif " >
                                                

                                                    {{ $fecha['nombre_dia'] }} <br> {{ $fecha['dia_del_mes'] }}
                                                    <div class="text-center my-5 text-lg">
                                                        ${{ number_format($fecha['valor_despacho'], 0, ',', '.') }}
                                                    
                                                    </div>
                                                    @if ($fecha['copado'])
                                                        <div class="absolute inset-0 bg-gray-200 opacity-75  text-red-600 underline flex justify-center items-center font-bold z-10">
                                                            Agotado
                                                            
                                                        </div>
                                                    @elseif (!$fecha['agendable'])
                                                        <div class="absolute inset-0 bg-gray-200 opacity-75 text-red-600 underline flex justify-center items-center font-bold z-10">
                                                            No disponible
                                                            
                                                        </div>
                                                    @endif

                                            
                                                </div>
                                            @endforeach
                                    
                                    </div>
                                @endif
                            </div> 
                        </div>
                    </div>

                </div>
            </div>

            {{-- RESUMEN --}}
            <div class="card my-10 ">
                <div class="relative ">
                    <div class="card-header flex justify-start">
                        <h2 class="text-lg font-bold text-gray-600 flex items-center justify-start">
                            <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"> </path> </svg>
                            Resumen
                        </h2>
                    </div>
                    <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container4"
                        x-bind:style="open_level_4 == true ? 'max-height: ' + $refs.container4.scrollHeight + 'px' : ''">

                        <div class="card-body shadow w-full">
                        <h2 class="my-3 font-bold">
                            DATOS DEL CLIENTE
                            </h2>
                            <div class="my-2">
                                {{$this->name}} 
                            </div>
                            <div class="my-2">
                                {{$this->email}} 
                            </div>
                            <div class="my-2">
                                {{$this->celular}}
                            </div>
                            <div class="my-2">
                                {{$this->direccion}} @if($this->block) Torre {{$this->block}} @endif  @if($this->depto) Depto  {{$this->depto}} @endif
                            </div>
                            <div class="my-2">
                                {{$this->comentario}}
                            </div>
                            @if ($fechaDespacho)
                                <div class="my-2">
                                    Despacho para el día  {{ $fechaDespacho->dayName }} {{ $fechaDespacho->locale('es')->day }} de {{ $fechaDespacho->locale('es')->monthName }} 
                                </div>
                            @endif
                        </div>

                        <div class="card-body shadow w-full ">
                            <div class="flex justify-between items-center py-2">
                                <div class="">Sub total</div>
                                <span class=" text-xl "> ${{ number_format($this->totalCarrito, 0, ',', '.') }} </span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-300">
                                <div class="">Despacho</div>
                                <span class="text-xl"> ${{ number_format($this->totalDespacho, 0, ',', '.') }} </span>
                            </div>
                            <div class="flex justify-between items-center  py-2">
                                <div class="">Total</div>
                                <span class="text-xl">
                                    ${{ number_format($this->totalCarrito + $this->totalDespacho, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex justify-center items-center p-5">
                                <x-jet-button wire:click="agendarPedido">Confirmar Y Agendar pedido</x-jet-button>
                            </div>
                        </div>

                       
                    </div>
                </div>
            </div>
{{-- @php
    echo "<pre>";
        var_dump (Session::all());
    echo" </pre>";
@endphp --}}
         

            {{-- REALIZAR PAGO --}}
            {{-- <div class="card my-10">
                <div class="relative " >
                    <div class="card-header flex justify-start">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <h2 class="text-lg font-bold text-gray-600">
                            Realizar pago
                        </h2>
                    </div>
                    <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container5"
                        x-bind:style="selected == 1 ? 'max-height: ' + $refs.container5.scrollHeight + 'px' : ''">
                        <div class="card-body shadow w-full ">
                            <button class="p-5 shadow bg-green-500 block text-center text-white font-bold">
                                Pagar $
                            </button>
                        
                        </div>
                    </div>
                </div>
            </div> --}}

        @else
            <div class="card my-10 ">
                <div class="relative " x-data="{selected:1 }">
                    <div class="card-header flex justify-between">
                        <h2 class="text-lg font-bold text-gray-600">
                            No hay productos en el carrito
                        </h2>
                    </div>
                        {{-- BOTONES --}}
                        <div class="flex justify-center items-center my-10 text-sm">
                            <a href="{{route('products.index')}}"  class="btn rounded shadow p-5 bg-teal-500 text-white mx-4 cursor-pointer">
                                Ir a agregar productos
                            </a> 
                        </div>

                </div>
            </div>
        @endif

        @isset($comunas_disponibles)
            <x-modal.modal class="">
                <x-slot name='titulo'><h2 class="font-bold text-gray-600 text-xl">Comunas disponibles</h2></x-slot>
                
                <ul>
                    @foreach ($comunas_disponibles as $comuna)
                        <li>{{$comuna->name}}</li>
                    @endforeach
                </ul>
                <x-slot name='footer' >
                    <div class="flex justify-end">

                        <x-jet-button wire:click="$set('modal',false)">
                            Cerrar
                        </x-jet-button>
                    </div>
                </x-slot>
            </x-modal.modal>
        @endisset
    </div>
    
    @slot('css')
        <style>
            #map {
                height: 300px;
            }

        </style>
    @endslot

    @slot('jsCabecera')
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC30rciXdqyWlqQXQJYrwE3Qs220le3PvY&libraries=places">
        </script>
    @endslot

    @slot('js')
        <script>
            function pedidoMain(){
                return{
                
                    open_level_1 : @entangle('open_level_1'),
                    open_level_2 : @entangle('open_level_2'),
                    open_level_3 : @entangle('open_level_3'),
                    open_level_4 : @entangle('open_level_4'),
                    modal: @entangle('modal')
                }
            }
        </script>
        <script>
            google.maps.event.addDomListener(window, "load", function() {
                const santiago = { //coordenadas de la ciudad santiago
                    lat: -33.50,
                    lng: -70.65
                }


                //RESTRINGIR BUSQUEDA A 10 KM DE SANTIAGO
                const defaultBounds = {
                    north: santiago.lat + 0.1,
                    south: santiago.lat - 0.1,
                    east: santiago.lng + 0.1,
                    west: santiago.lng - 0.1,
                };

                const options = {
                    bounds: defaultBounds,
                    componentRestrictions: {
                        country: "cl"
                    },
                    //IMPORTANTE ESPECIFICAR LAS FIELDS CON LO NECESARIO PARA QUE PAGAR DE MÁS
                    fields: ["geometry", "address_components"],
                    origin: santiago,
                    strictBounds: false,
                    types: ["address"],
                };

                const input = document.getElementById("direccion");

                const autocomplete = new google.maps.places.Autocomplete(input, options);
                // autocomplete.bindTo("bounds", map);
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
                    console.log('comuna1', comuna1);
                    console.log('lat', lat);
                    console.log('lng', lng);
                    console.log('numero', numero);
                    Livewire.emit('validarDireccion', newDireccion, comuna1, String(lat), String(lng),numero);

                });
            });

        </script>
    @endslot

</div>