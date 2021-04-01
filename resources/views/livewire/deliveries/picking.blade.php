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
                            <div class="pr-2" style="width: max-content">
                                {{ $item->product->name }}
                            </div>

                            <div class="" style="width: 60px">
                                ${{ number_format($item->precio_total, 0, ',', '.') }}
                            </div>
                            <div>
                                {{   $item->product->purchasePrices[0]->precio }}
                            </div>
                        </div>

                    @endforeach
                @endforeach
            @else
                @foreach ($arreglo as $key => $value)
                    <div>
                        {{ $value }} {{ $key }}
                    </div>
                @endforeach
            @endif

        </div>
    @endif

</div>
