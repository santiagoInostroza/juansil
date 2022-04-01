<div>

{{-- {{ $salesOfTheMonthCompleted}} --}}

 <div class="flex flex-wrap justify-center mt-6">
    <div class="w-full ">
        <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

            <div class="font-semibold bg-indigo-100 text-gray-700 py-3 px-6 mb-0">
                {{ __('Ventas del mes') }}  ({{ $salesOfTheMonthCompleted->count() }})
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
                               $ {{ number_Format($totalToPay,0,',','.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> 
  
</div>


    <x-table.table>
        <x-slot name='thead'>
            <x-table.tr>
                <x-table.th>Id</x-table.th>
                <x-table.th>Cliente</x-table.th>
                <x-table.th>Total</x-table.th>
                <x-table.th>Estado de pago</x-table.th>
                <x-table.th>fecha creada la venta</x-table.th>
                <x-table.th>Fecha de pago</x-table.th>
            </x-table.tr>
        </x-slot>
        <x-slot name='tbody'>
            @foreach ($salesOfTheMonthCompleted as $sale)
                <x-table.tr>
                    <x-table.td>{{$sale->id}}</x-table.td>
                    <x-table.td>{{$sale->customer->name}}</x-table.td>
                    <x-table.td>{{$sale->total}}</x-table.td>
                    <x-table.td>{{$sale->payment_status}}</x-table.td>
                    <x-table.td>{{$sale->date}}</x-table.td>
                    <x-table.td>{{$sale->payment_date}}</x-table.td>
                </x-table.tr>
            @endforeach
        </x-slot>
    </x-table.table>


    {{-- dashboard --}}
    




</div>
