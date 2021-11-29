<div class="card mt-5" x-data="{open:false}">
   
    <div class="card-header">
        <h2 class="" x-on:click="open=!open" style="cursor: pointer">Reporte diario</h2>
    </div>

    <div class="hidden" :class="{'hidden':!open}" >
        <div id="" class="bg-gray-200" >

            <div>
                Pedidos totales {{$orders->count()}}
                Pedidos entregados {{$orders->where('delivery_stage', '1')->count() }}
                Pedidos Pagados {{$orders->where('payment_status', '3')->count() }}

                @if ($orders->where('payment_account',1)->count()>0)
                    <div>Efectivo {{$orders->where('payment_account',1)->count()}}</div>
                @endif
                @if ($orders->where('payment_account',2)->count()>0)
                    <div>Cuenta rut Paty {{$orders->where('payment_account',2)->count()}}</div>
                @endif
                @if ($orders->where('payment_account',3)->count()>0)
                    <div>Cuenta rut Santy {{$orders->where('payment_account',3)->count()}}</div>
                @endif
                @if ($orders->where('payment_account',4)->count()>0)
                    <div>Cuenta rut Silvia Gonzalez {{$orders->where('payment_account',4)->count()}}</div>
                @endif
                @if ($orders->where('payment_account',5)->count()>0)
                    <div>Cuenta corriente Santy {{$orders->where('payment_account',5)->count()}}</div>
                @endif
                @if ($orders->where('payment_account',6)->count()>0)
                    <div>Otros {{$orders->where('payment_account',6)->count()}}</div>
                @endif

            </div>
           
          
        </div>
    </div>
</div>
