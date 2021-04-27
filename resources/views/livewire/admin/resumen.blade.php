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
            ${{ number_format($sales->sum('total'), 0, ',', '.') }}
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







<div class="flex flex-col mb-20">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          
            @php
                $costos=0;
                $ventas=0;
                $diferencias=0;
                $porcentajes=0;
            @endphp

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Id
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fecha
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Detalle
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Costo
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Venta
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Porcentaje
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Diferencia
                        </th>
                        <th scope="col" class="relative px-6 py-3">

                        
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($sales as $sale)
                    @php
                        $costo=0;
                        $costo_total=0;
                        $diferencia=0;
                        $porcentaje=0;
                        $venta=0;
                    @endphp
                        <tr>
                            {{-- ID VENTA --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{$sale->id}}
                                    </div>
                                </div>
                            </td>
                            {{-- NOMBRE --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{$sale->customer->name}}
                                    </div>
                                </div>
                            </td>
                            {{-- FECHA --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"> {{date("d-m-Y",strtotime($sale->date))}}</div>
                            </td>

                            {{-- DETALLE --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach ($sale->sale_items as $item)
                                    <div>
                                        @php
                                        try {
                                            $precio_compra = $item->product->purchasePrices->first()->precio ;
                                            $costo = $precio_compra * $item->cantidad_total ;
                                            $venta = $item->precio * $item->cantidad_total;
                                        } catch (\Throwable $th) {
                                            $costo = 0;
                                        } 
                                        $costo_total+=$costo;
                                        @endphp
                                    </div>
                                    {{$item->cantidad_total}} {{$item->product->name}}
                                    @if ($item->product->purchasePrices->first())
                                        ${{ number_format($item->product->purchasePrices->first()->precio,0,',','.')}}
                                    @endif 
                                    ${{number_format($costo,0,',','.')}}

                                    ${{number_format($item->precio,0,',','.')}}
                                    ${{number_format($venta,0,',','.')}}
                                    
                                   
                                @endforeach
                                
                                @php
                                    $diferencia = $sale->total - $costo_total;
                                    $porcentaje = $diferencia *100  / $sale->total ;


                                    $costos += $costo_total;
                                    $ventas += $sale->total;
                                

                                @endphp

                            </td>
                            {{-- COSTO --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                ${{number_format($costo_total,0,',','.')}}
                            </td>
                            {{-- TOTAL --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                ${{number_format($sale->total,0,',','.')}}
                            </td>
                            {{-- PORCENTAJE --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                %{{number_format($porcentaje,2,',','.')}}
                            </td>
                            {{-- DIFERENCIA --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                ${{number_format($diferencia,0,',','.')}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>

                        </tr>
                    

                    @endforeach

                    @php
                        $diferencias = $ventas - $costos;
                        $porcentajes = $diferencias / $ventas * 100;
                    @endphp

                
                </tbody>
            </table>

            <div class="w-full h-16 sm:h-8 bg-gray-900 fixed bottom-0 flex ">
                <div class="p-2 text-white">
                    ventas ${{number_format($ventas,0,',','.')}}
                </div>
                <div class="p-2 text-white">
                    costos ${{number_format($costos,0,',','.')}}
                </div>
                <div class="p-2 text-green-500">
                    diferencia ${{number_format($diferencias,0,',','.')}}
                </div>
                <div class="p-2 text-white">
                    porcentaje %{{number_format($porcentajes,2,',','.')}}
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
 
</div>