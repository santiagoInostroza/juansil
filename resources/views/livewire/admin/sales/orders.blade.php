<div  class="text-gray-800">
    <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="w-2/12 px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider ">Nombre</th>
                   
                    <th class="w-1/12 px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider  text-left">EstadoPago</th>
                    <th class="w-1/12 px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider  text-left">FechaReparto</th>
                    <th class="w-1/12 px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider  text-right">Subtotal</th>
                    <th class="w-1/12 px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider  text-right">ValorDespacho</th>
                    <th class="w-1/12 px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider  text-right">Total</th>
                    <th class="w-1/12 px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider  text-right"></th>
                   
    
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($sales as $sale)
    
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <div class=" text-sm text-gray-900">{{$sale->customer->name}}</div>
                                <div class=" text-sm text-gray-500">{{$sale->customer->direccion}}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($sale->payment_status == 1)
                                <div class="text-yellow-300">
                                    Pendiente
                                </div>
                                <x-jet-button class="bg-green-300 hover:bg-green-400">Pagar</x-jet-button>
                            @elseif  ($sale->payment_status == 2)
                                <div class=" p-1 text-orange-300">
                                    Abonado
                                </div>
                            @else
                                <div class="font-semibold text-green-300">
                                    Pagado
                                    <i class="fas fa-check ml-2"></i> 
                                </div>
                                <div>
                                    {{ Str::substr(Helper::fecha($sale->payment_date)->dayName, 0, 3)  }} {{ Helper::fecha($sale->payment_date)->format('d') }} {{ Str::substr(Helper::fecha($sale->payment_date)->monthName, 0, 3)  }}</td>        
                                </div>
                            @endif
                            
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-left">
                            <div class="">
                                <div>
                                    @if ($sale->delivery == 0)
                                        Bodega
                                    @else
                                        @if ($sale->date_delivered != null)
                                            <div class="text-green-300 font-semibold">
                                                Entregado
                                                <i class="fas fa-check ml-2"></i> 
                                            </div>
                                        @else
                                            <div class="text-yellow-300">
                                                Entregar 
                                                {{-- <i class="far fa-clock"></i> --}}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div>
                                    @if ($sale->delivery == 1)
                                        {{ Str::substr(Helper::fecha($sale->delivery_date)->dayName, 0, 3)  }} {{ Helper::fecha($sale->delivery_date)->format('d') }} {{ Str::substr(Helper::fecha($sale->delivery_date)->monthName, 0, 3)  }}</td>        
                                    @endif
                                </div>
                            </div> 
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-right">
                                ${{ number_format($sale->subtotal,0,',','.') }}
                            </div> 
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap"> 
                            <div class="text-right">
                                ${{ number_format($sale->delivery_value,0,',','.') }} 
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap"> 
                            <div class="text-right">
                                ${{ number_format($sale->total,0,',','.') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div x-data="{deleteSale:false}">
                                <div class="text-right">
                                    <x-jet-button class="bg-yellow-200 hover:bg-yellow-400"><i class="fas fa-pen"></i></x-jet-button>
                                    <x-jet-button x-on:click="deleteSale=true" class="bg-red-500 hover:bg-red-700"><i class="fas fa-trash"></i></x-jet-button>
    
                                    <div x-show="deleteSale" class="hidden" :class="{'hidden': !deleteSale}">
                                        <x-modal.modal2>
                                            <div class="p-4">
                                                <h2 class="my-4 text-xl font-bold">¿Seguro desea eliminar la venta {{$sale->id}} de {{$sale->customer->name}}?</h2>
                                                <div class="flex gap-4">
                                                    {{-- <x-jet-danger-button x-on:click="$wire.deleteSale({{ $sale }})" >Si, eliminar</x-jet-button> --}}
                                                    auú no se puede eliminar desde esta pantalla
                                                        <x-jet-button x-on:click="deleteSale=false">No por favorsito</x-jet-button>
                                                </div>
                                            </div>
                                        </x-modal.modal2>
                                    </div>
                                </div>
                                
                            </div>
                        </td>
                    </tr>
            
                @endforeach
                
            </tbody>
        </table>
    </x-table>

 


    
   
</div>
