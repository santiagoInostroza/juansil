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







<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                    $diferencia=0;
                    $porcentaje=0;
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

                        {{-- COSTO --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @foreach ($sale->sale_items as $item)
                                <div>
                                    @php
                                    try {
                                        $costo += $item->product->purchasePrices->first()->precio * $item->cantidad_total ;
                                    } catch (\Throwable $th) {
                                        //throw $th;
                                    } 
                                    @endphp
                                </div>
                            @endforeach
                            {{$item->cantidad_total}} {{$item->product->name}} 
                            @if ($item->product->purchasePrices)
                                {{ $item->product->purchasePrices->first()->precio}}
                            @endif
                             ${{number_format($costo,0,',','.')}}
                            @php
                                $diferencia = $sale->total - $costo;
                                $porcentaje = $diferencia *100  / $sale->total ;
                            @endphp

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
             
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
 
</div>