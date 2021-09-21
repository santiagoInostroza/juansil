<div class="card mt-5">
    @if (count($ventas) == 0)

    @else


        <div class="card-header">
            <h1>
                Picking
            </h1>
        </div>
        <div class="card-body">
            <label wire:click="$set('vistaPicking','1')" class="btn @if ($vistaPicking==1) btn-dark @endif">Detalle</label>
            <label wire:click="$set('vistaPicking','2')" class="btn @if ($vistaPicking==2) btn-dark @endif">Total</label>
            @php
                $despacho = 0;
            @endphp
            @if ($vistaPicking == 1)
            
                @foreach ($ventas as $venta)
                    @php
                        $despacho+=$venta->delivery_value;
                    @endphp
                    @foreach ($venta->sale_items as $item)

                        <div class="d-flex" style="width: max-content">
                            <div class="" style="width: 60px">
                                {{ $item->cantidad }} x {{ $item->cantidad_por_caja }}
                            </div>
                            <div class="pr-2" style="width: 200px">
                                {{ $item->product->name }}
                            </div>

                            <div class="" style="width: 60px">
                                ${{ number_format($item->precio_total, 0, ',', '.') }}
                            </div>
                            <div style="width: 60px">
                                @php
                                    $costoXItem = $item->cantidad_total * $item->costo;
                                @endphp
                                @if ( count($item->product->purchasePrices)>0 )
                                    ${{  number_format( $costoXItem,0,',','.') }}
                                @else
                                    0
                                @endif
                            </div>
                            <div style="width: 60px">
                                @php
                                  
                                    if(count($item->product->purchasePrices)>0){
                                        $diferencia =  $item->precio_total - ($item->cantidad_total * $item->costo);
                                    }else{
                                        $diferencia = $item->precio_total;
                                    }
                                    $totalisimo += $diferencia;
                                @endphp
                                    ${{number_format( $diferencia ,0,',','.')}}
                            </div>
                        </div>


                    @endforeach
                    <hr>
                @endforeach

            @else
                @foreach ($arreglo as $key => $value)
                    <div>
                        {{ $value }} {{ $key }}
                    </div>
                @endforeach
            @endif
            <div>
              SubTotal  ${{number_format($totalisimo,0,',','.')}}
            </div>
            <div>
                Despacho ${{number_format($despacho,0,',','.')}}
            </div>
            <div>
                Total ${{number_format($totalisimo + $despacho,0,',','.')}}
            </div>

        </div>
    @endif

</div>
