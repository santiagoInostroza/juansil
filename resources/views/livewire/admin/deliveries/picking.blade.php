<div class="card mt-5" x-data="{show:false}">
    @if (count($ventas) == 0)

    @else


        <div class="card-header">
            <h1  x-on:click="show = !show" class="w-full"> Picking </h1>
        </div>
        <div class="card-body hidden" :class="{ 'hidden' : !show }">
            <div class="mt-4">
                <label wire:click="$set('vistaPicking','1')" class="p-2 shadow rounded  @if ($vistaPicking==1) bg-gray-500 text-white @endif">Detalle</label>
                <label wire:click="$set('vistaPicking','2')" class="p-2 shadow rounded @if ($vistaPicking==2) bg-gray-500 text-white @endif">Total</label>

            </div>
            @php
                $despacho = 0;
            @endphp
            <div class="mt-4">
                @if ($vistaPicking == 1)
                

                    @foreach ($ventas as $venta)
                        <h2 class="font-bold">{{$venta->id}} {{$venta->customer->name}}</h2>
                        @php
                            $despacho+=$venta->delivery_value;
                        @endphp
                        
                        @foreach ($venta->sale_items as $item)

                            <div class="flex gap-2 items-center justify-between">
                                <div class="flex" style="width: max-content">
                                    {{ $item->cantidad }}x{{ $item->cantidad_por_caja }}
                                </div>
                                <div >
                                    {{ $item->product->name }}
                                </div>

                                <div>
                                    ${{ number_format($item->precio_total, 0, ',', '.') }}
                                </div>
                                <div>
                                    @php
                                        $costoXItem = $item->cantidad_total * $item->costo;
                                    @endphp
                                    @if ( count($item->product->purchasePrices)>0 )
                                        ${{  number_format( $costoXItem,0,',','.') }}
                                    @else
                                        0
                                    @endif
                                </div>
                                <div>
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

                    <div>
                        SubTotal  ${{number_format($totalisimo,0,',','.')}}
                    </div>
                    <div>
                        Despacho ${{number_format($despacho,0,',','.')}}
                    </div>
                    <div>
                        Total ${{number_format($totalisimo + $despacho,0,',','.')}}
                    </div>

                @else
                
                        
                        @foreach ($arreglo as $key => $value)
                            <label for="{{$key}}">
                                <div class="py-4">

                                    <input id="{{$key}}"  type="checkbox">  
                                    <span class="mr-2 ml-2">{{ $value }}</span>  
                                    {{ $key }}
                                    
                                </div>
                            </label>
                        @endforeach
                        
                
                @endif
            </div>
           

        </div>
    @endif

</div>
