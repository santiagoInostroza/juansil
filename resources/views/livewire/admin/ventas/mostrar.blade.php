<div>
    <div wire:click="$set('open',true)" class="btn btn-secondary btn-sm mr-2"><i class="far fa-eye"></i></div>
    @if ($open)
        <div class="position-fixed bg-secondary" style="top:0;bottom:0;left:0;right:0;opacity: 0.5;z-index: 9998"></div>
        
        
        <div class="position-fixed bg-white m-5"  style="top:0;left:0;right:0; border-radius:5px;z-index: 9999;max-height: 80vh" >
            <div wire:click="$set('open',false)" class="p-3 btn" style="float: right"><i class="fas fa-times"></i></div>
            <h3 class="p-4">Detalle de venta</h3>
            <h4 class="px-4">{{$venta->customer->name}} {{date("d-m-Y",strtotime($venta->date))}}</h4>

            <div class="p-4"  style="max-height: 60vh; overflow: auto">
                <table class="table table-hover">
                   <thead>
                    <tr>
                        <th>Producto</th>
                        <th>total</th>
                    </tr>
                   </thead>
                   <tbody>
                       @foreach ($venta->sale_items as $item)
                       <tr>
                           <td> {{$item->cantidad}} {{$item->product->name}} x {{$item->cantidad_por_caja}} un. </td>
                           <td>${{number_format($item->precio_total,0,',','.')}}</td>
                       </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4" style="background: #f7f7f7; border-radius:5px" >
                <h4>
                    ${{number_format($venta->total,0,',','.')}}
                </h4>
            </div>
        </div>
    @endif
</div>
