<div class="bg-gray-200 p-4 rounded">
    <div class="flex items-center">
        <a class="shadow rounded p-2 bg-white" href="{{ route('admin.deliveries.index2',['date'=> date("Y-m-d",strtotime($date . " -1 day"))]) }}"> Anterior </a>
        <x-jet-input  type="date" name="date" id="" class="w-full mx-4" value="{{ $date }}" onchange="return cambiarFecha(this);"></x-jet-input>
        <a class="shadow rounded p-2 bg-white" href="{{ route('admin.deliveries.index2',['date'=> date("Y-m-d",strtotime($date . " +1 day"))] ) }}">Siguiente </a>
    </div>

    <div class="my-4">
        @if (date('Y-m-d', strtotime($date)) == date('Y-m-d'))
            <h2 class="text-2xl text-center ">
                Despacho para hoy
            </h2>
        @else
            <h2 class="text-2xl text-center ">
                Despacho {{ Helper::fecha($date)->locale('es')->dayName }} {{ Helper::fecha($date)->locale('es')->day }} de
                {{ Helper::fecha($date)->locale('es')->monthName }}
            </h2>
        @endif
    </div>




    <div class="border border-gray-100 shadow rounded bg-white">
       
        @if (count($orders) == 0)
            <h2 class="text-xl p-2">
                No hay pedidos para este día
            </h2>
        @else
            <h2 class="text-xl p-2 flex items-center gap-4 justify-between md:justify-start">
                <div>Pedidos {{ count($orders) }}</div> 
                <div>${{ number_format($orders->sum('total'),0,',','.') }}</div>
            </h2>
           <div class="flex flex-col md:flex-row items-start h-full max-h-6/12">
                <div wire:ignore id="map" class="w-full h-full">
                    Cargando mapa...
                </div>
                <div class="h-full" id='info_venta'>
                
                    <livewire:admin.deliveries.order-info>
                </div>
           </div>
           
          
        @endif
    </div>

    <livewire:admin.deliveries.pendings :fecha='$date'>
    <livewire:admin.deliveries.delivered :fecha='$date'>
    <livewire:admin.deliveries.picking :fecha='$date'>

    <div class="fixed bottom-0 left-0 w-full h-12 bg-white">
        <div class="bg-green-500 h-6 text-white border-b" style="width: {{$porcDelivery}}%; text-shadow: 1px 1px #000000;">
            <div class="absolute left-4">
                {{ $porcDelivery}} % entregados
            </div>
        </div>

        <div class="bg-green-500 h-6 text-white" style="width: {{$porcPayment}}%; text-shadow: 1px 1px #000000;">
           
           <div class="absolute left-4">
                {{ $porcPayment}} % pagados
            </div>
        </div>
    </div>


</div>
