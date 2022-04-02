<div x-data="{isOpenDetail:false}">
    <div class="flex flex-wrap justify-center mt-6">
        <div class="w-full ">
            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

                <div class="font-semibold bg-indigo-100 text-gray-700 py-3 px-6 mb-0">
                    {{ __('Ventas del mes') }}  ({{ $totalSales }})
                    @if (auth()->user()->hasRole('SuperAdmin'))
                        $ {{ number_Format($totalAmountOfSales,0,',','.') }}
                    @endif
                </div>

                <div class="w-full p-6">
                    <div class="flex flex-wrap">
                    
                        <div class="w-1/4">
                            <div class="p-3">
                                <p class="text-gray-700 text-sm">
                                    {{ __('Ventas menores a $30.000') }}
                                </p>
                                <div class="font-bold text-xl mb-2">
                                    {{ $salesLessThan30k }}
                                </div>
                            </div>
                        </div>
                        <div class="w-1/4">
                            <div class="p-3">
                                <p class="text-gray-700 text-sm">
                                    {{ __('Ventas mayores a $30.000') }}
                                </p>
                                <div class="font-bold text-xl mb-2">
                                    {{ $salesgreaterThan30k }}
                                </div>
                            </div>
                        </div>
                        <div class="w-1/4">
                            <div class="p-3">
                                <p class="text-gray-700 text-sm">
                                    {{ __('Ventas mayores a $50.000') }}
                                </p>
                                <div class="font-bold text-xl mb-2">
                                    {{ $salesgreaterThan50k }}
                                </div>
                            </div>
                        </div>
                    
                        <div class="w-1/4">
                            <div class="p-3">
                                <p class="text-gray-700 text-sm">
                                    {{ __('Total a pagar') }}
                                </p>
                                <div class="font-bold text-xl mb-2">
                                    @if (auth()->user()->hasRole('SuperAdmin'))
                                        $ {{ number_Format($totalToPay,0,',','.') }}
                                    @else
                                        <div id='tooltip_' x-data='{tooltip:false}' x-on:mouseleave='tooltip=false'>
                                            <div x-on:mouseover='tooltip=true'>
                                                <div class="cursor-pointer">
                                                    ??
                                                </div>
                                            </div>
                                            <div x-show='tooltip' x-cloak x-transition >
                                                <div class='bg-white rounded shadow p-4 absolute'>
                                                    $ {{ number_Format($totalToPay,0,',','.') }}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div> 
    
    </div>

    @if ($salesOfTheMonthCompleted)
        <div class="mb-8 pb-12">
            <div x-on:click="isOpenDetail = !isOpenDetail" class="py-4 cursor-pointer">
                {{-- show details --}}
                <div class="flex justify-between items-center border-b border-indigo-100">
                    <div class="font-semibold text-gray-700 text-xl">
                        {{ __('Mostrar detalles de ventas') }}
                    
                    </div>
                    <div class="text-gray-700 text-xl">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
            <div x-cloak x-show="isOpenDetail" class="shadow">

                <x-table.table>
                    <x-slot name='thead'>
                        <x-table.tr>
                        
                            <x-table.th>Nombre cliente</x-table.th>
                            <x-table.th>Total</x-table.th>
                            <x-table.th>Estado de pago</x-table.th>
                            <x-table.th>fecha creada la venta</x-table.th>
                            <x-table.th>Fecha de pago</x-table.th>
                        </x-table.tr>
                    </x-slot>
                    <x-slot name='tbody'>
                        @foreach ($salesOfTheMonthCompleted as $sale)
                            <x-table.tr>
                            
                                <x-table.td>{{$sale->customer->name}}</x-table.td>
                                <x-table.td>${{ number_format($sale->total,0,',','.') }}</x-table.td>
                                <x-table.td>{{($sale->payment_status ==3)? 'Pagado' : 'No está pagado'}}</x-table.td>
                                <x-table.td>{{$sale->date}}</x-table.td>
                                <x-table.td>{{$sale->payment_date}}</x-table.td>
                            </x-table.tr>
                        @endforeach
                    </x-slot>
                </x-table.table>
            </div>
        </div>
    @endif


    {{-- dashboard --}}
    




</div>
