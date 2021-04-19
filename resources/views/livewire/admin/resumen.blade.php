<div class="card">
    <x-slot name='titulo'>Resumen</x-slot>

    <div class="card-body">
    
        <div>
            <x-jet-label>Total de Compras</x-jet-label>
            ${{ number_format($total_purchases, 0, ',', '.') }}
        </div>
       
        
        <hr>
        <div>
            <x-jet-label>Total ventas</x-jet-label>
            ${{ number_format($total_venta, 0, ',', '.') }}
        </div>
        <div>
            <x-jet-label>Costo total ventas</x-jet-label>
            ${{ number_format($total_compra, 0, ',', '.') }}
        </div>
       
        <div>
            <x-jet-label>Diferencia</x-jet-label>
            ${{ number_format($diferencia, 0, ',', '.') }}
        </div>
        <div>
            <x-jet-label>Porcentaje</x-jet-label>
            %{{ number_format($porcentaje, 2) }}
        </div>

        <hr>

        <div>
            <x-jet-label>Total Pendiente</x-jet-label>
            ${{ number_format($total_pendiente, 0, ',', '.') }}
        </div>


        <div>
            <x-jet-label>Total de Bodega</x-jet-label>
            ${{ number_format($total_bodega, 0, ',', '.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="grid grid-cols-12">
            <div>Nombre</div>
            <div>fecha</div>
            <div class="col-span-6">Detalle</div>
            <div class="col-span-4 grid grid-cols-3">
                <div>Costo</div>
                <div>Venta</div>
                <div>Diferencia</div>
            </div>
        </div>
        @foreach ($sales as $sale)
            <div class="border p-2 grid grid-cols-12">
               
                <div class="">
                    {{$sale->customer->name}}
                </div>
                <div class="">
                    {{date("d-m-Y",strtotime($sale->date))}}
                </div>
               
                <div class="col-span-6">
                  
                @foreach ($sale->sale_items as $item)

                    <div class="flex justify-between pb-2">
                        <div>
                            {{$item->cantidad_total}}  {{$item->product->name}} x  {{$item->cantidad_por_caja}}
                        </div>
                        <div>
                            {{$item->cantidad_total}} un. a ${{number_format($item->precio,0,',','.')}} c/u  ${{number_format($item->precio_total,0,',','.')}}
                        </div>
                        <div>
                            @foreach ($item->product->purchasePrices as $precio)
                                a ${{number_format($precio->precio,0,',','.')}} =  ${{number_format($item->cantidad_total * $precio->precio,0,',','.')}}
                            @endforeach
                        </div>
                        <div>

                        </div>
                     
                    </div>
                    <div>
                       
                     
                    </div>
                @endforeach
                </div>
                <div class="col-span-4 grid grid-cols-3">
                    <div class="">
                        ${{number_format($sale->total,0,',','.')}}
                    </div>
                    <div class="">
                        ${{number_format($sale->total,0,',','.')}}
                    </div>
                    <div class="">
                        ${{number_format($sale->total,0,',','.')}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>