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
            @if ($vistaPicking == 1)

                @foreach ($ventas as $venta)
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
                                @if ( count($item->product->purchasePrices)>0 )
                                    ${{  number_format($item->cantidad_total * $item->product->purchasePrices[0]->precio,0,',','.') }}
                                @else
                                    0
                                @endif
                            </div>
                            <div style="width: 60px">
                                @php
                                    $costo = $item->costo;
                                    if(count($item->product->purchasePrices)>0){
                                        $diferencia =  $item->precio_total - ( $item->cantidad_total * $item->product->purchasePrices[0]->precio );
                                    }else{
                                        $diferencia = $item->precio_total;
                                    }
                                    $totalisimo += $costo;
                                @endphp
                                    ${{number_format( $costo ,0,',','.')}}
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
              Total  ${{number_format($totalisimo,0,',','.')}}
            </div>

        </div>
    @endif

</div>
