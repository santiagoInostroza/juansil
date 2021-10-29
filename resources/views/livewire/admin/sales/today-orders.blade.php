<div class="text-gray-800">
    

    <table class="table-fixed">
        <thead>
            <tr>
                <th class="w-2/12">Nombre</th>
               
                <th class="w-1/12 text-center">EstadoPago</th>
                <th class="w-1/12 pl-2  text-center">FechaEntrega</th>
                <th class="w-1/12 text-right">Subtotal</th>
                <th class="w-1/12 text-right">ValorDespacho</th>
                <th class="w-1/12 text-right">Total</th>
                <th class="w-1/12 text-right"></th>
               

            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)

                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td>
                        <div>
                            <div class=" text-gray-800">{{$sale->customer->name}}</div>
                            <div class=" text-gray-600">{{$sale->customer->direccion}}</div>
                        </div>
                    </td>
                    <td>
                        @if ($sale->payment_status == 1)
                            <div class="p-1 text-center text-yellow-600">
                                Pendiente
                            </div>
                        @elseif  ($sale->payment_status == 2)
                            <div class=" p-1 text-center">
                                Pendiente
                            </div>
                        @else
                            <div class=" p-1 text-center text-green-800">
                                Pagado
                            </div>
                        @endif
                        
                    </td>
                    <td>
                        <div class="pl-2 text-center">
                            {{ Str::substr(Helper::fecha($sale->delivery_date)->dayName, 0, 3)  }} {{ Helper::fecha($sale->delivery_date)->format('d') }} {{ Str::substr(Helper::fecha($sale->delivery_date)->monthName, 0, 3)  }}</td>
                        </div> 
                    <td>
                        <div class="text-right">
                            ${{ number_format($sale->subtotal,0,',','.') }}
                        </div> 
                    </td>
                    <td> 
                        <div class="text-right">
                            ${{ number_format($sale->delivery_value,0,',','.') }} 
                        </div>
                    </td>
                    <td> 
                        <div class="text-right">
                            ${{ number_format($sale->total,0,',','.') }}
                        </div>
                    </td>
                    <td>
                        <div class="text-right">
                            <x-jet-button class="bg-yellow-200 hover:bg-yellow-400"><i class="fas fa-pen"></i></x-jet-button>
                            <x-jet-button class="bg-red-500 hover:bg-red-700"><i class="fas fa-trash"></i></x-jet-button>
                        </div>
                    </td>
                </tr>
        
            @endforeach
            
        </tbody>
    </table>
   
</div>
