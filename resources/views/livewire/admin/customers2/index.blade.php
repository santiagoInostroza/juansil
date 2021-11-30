<div>

    <h1 class="text-3xl font-bold text-gray-600 text-center">CLIENTES</h1>
    <div class="p-4 border rounded my-4">
        FILTRO
    </div>

    <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider"> Id   </th>
                    <th class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider"> Nombre   </th>
                    <th class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider"> Comuna   </th>
                    <th class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider"> Cantidad Compras  </th>
                    <th class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider"> Total Compras  </th>
                    <th class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider"> Ultima Compra  </th>
                </tr>
            </thead>
            
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($customers as $customer)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">  {{$customer->id}} </td> 
                
                        <td class="px-6 py-4 ">
                            <div class="" style="max-width: 200px;" >
                                <div class="text-sm text-gray-900">{{$customer->name}}</div>
                                {{-- <div class="text-sm text-gray-500">
                                        {{$customer->direccion}} 
                                        @isset($customer->block) Torre {{$customer->block}} @endisset 
                                        @isset($customer->depto) depto {{$customer->depto}} @endisset    
                                </div> --}}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{$customer->comuna}}</div>
                        </td>
                        <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{$customer->sales->count()}} </div>
                        </td>
                        <td class="px-6 py-4">
                                <div class="text-sm text-gray-900"> ${{ number_format($customer->sales->sum('total'),0,',','.' )}} </div>
                        </td>
                        <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                   
                                    @foreach ($customer->sales as $sale)
                                        <div>
                                            @if (isset($sale->date_delivered))
                                                {{ Helper::fecha($sale->date_delivered)->diffForHumans() }}
                                            @else
                                            
                                            @endif
                                           
                                          
                                        </div>
                                    @endforeach
                                </div>
                        </td>
                    </tr>
                    @endforeach             
            </tbody>
        </table>
    </x-table>

</div>
