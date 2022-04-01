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

    {{-- dashboard --}}
    




</div>
