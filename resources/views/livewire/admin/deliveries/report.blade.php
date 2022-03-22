<div class="card mt-5" x-data="{open:false}">
   
    <div class="card-header cursor-pointer">
        <h2 class="" x-on:click="open=!open">Reporte diario</h2>
    </div>

    <div class="hidden" :class="{'hidden':!open}" >
        <div class="bg-white grid gap-2 p-4">
            <div class="text-xl">Pedidos totales {{$orders->count()}}</div>
            <div>Pedidos entregados {{$orders->where('delivery_stage', '1')->where('payment_status','!=', '3')->count() }}</div>
            <div>Pedidos Pagados {{$orders->where('delivery_stage','!=', '1')->where('payment_status', '3')->count() }}</div>
            <div>Pedidos Pendientes {{ ($orders->where('payment_status', '1')->where('delivery_stage','!=', 1))->count() }}</div>
            <div>Pedidos Completados {{ ($orders->where('payment_status', '3')->where('delivery_stage', 1))->count() }}</div>
            
            <div class="grid grid-cols-3 gap-4 px-4 w-max-content">
                @if ($orders->where('payment_account',1)->count()>0)
                        <div class="col-span-2"> {{ $orders->where('payment_account',1)->count() }} Efectivo </div>
                        <div> ${{ number_format($orders->where('payment_account',1)->sum('total'),0,',','.') }}</div>
                @endif
                @if ($orders->where('payment_account',2)->count()>0)
                    <div class="col-span-2">{{$orders->where('payment_account',2)->count()}} Cuenta rut Paty</div>                    
                    <div> ${{ number_format($orders->where('payment_account',2)->sum('total'),0,',','.') }}</div>
                @endif
                @if ($orders->where('payment_account',3)->count()>0)
                    <div class="col-span-2">{{$orders->where('payment_account',3)->count()}} Cuenta rut Santy</div>
                    <div> ${{ number_format($orders->where('payment_account',3)->sum('total'),0,',','.') }}</div>
                @endif
                @if ($orders->where('payment_account',4)->count()>0)
                    <div class="col-span-2">{{ $orders->where('payment_account',4)->count() }} Cuenta rut Silvia Gonzalez</div>
                    <div> ${{ number_format($orders->where('payment_account',4)->sum('total'),0,',','.') }}</div>
                @endif
                @if ($orders->where('payment_account',5)->count()>0)
                    <div class="col-span-2">{{$orders->where('payment_account',5)->count()}} Cuenta corriente Santy</div>
                    <div> ${{ number_format($orders->where('payment_account',5)->sum('total'),0,',','.') }}</div>
                @endif
                @if ($orders->where('payment_account',6)->count()>0)
                    <div class="col-span-2"> {{$orders->where('payment_account',6)->count()}} Cuenta Juansil</div>
                    <div> ${{ number_format($orders->where('payment_account',6)->sum('total'),0,',','.') }}</div>
                @endif
                @if ($orders->where('payment_account',7)->count()>0)
                    <div class="col-span-2"> {{$orders->where('payment_account',7)->count()}} Otros</div>
                    <div> ${{ number_format($orders->where('payment_account',7)->sum('total'),0,',','.') }}</div>
                @endif
            </div>

        </div>
    </div>
</div>
