<div class="border">
    <x-slot name='titulo'>Resumen</x-slot>

    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
                class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded-full p-5 bg-green-600"><i class="fas fa-dollar-sign fa-2x fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-gray-600">Total Ventas</h5>
                        <h3 class="font-bold text-3xl">
                            ${{ number_format($total_venta, 0, ',', '.') }} 
                            <span class="text-green-500"><i class="fas fa-caret-up"></i></span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-gray-600">Compras</h5>
                        <h3 class="font-bold text-3xl">
                            ${{ number_format($total_purchases, 0, ',', '.') }} 
                            <span class="text-yellow-600"><i class="fas fa-caret-up"></i></span>
                        </h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
    </div>

    <div>
        <x-jet-label>Total de Bodega</x-jet-label>
        ${{ number_format($total_bodega, 0, ',', '.') }} 
    </div>


<hr>

    <div>
        <x-jet-label>Diferencia</x-jet-label>
        ${{ number_format($diferencia, 0, ',', '.') }} 
    </div>
    <div>
        <x-jet-label>Costo</x-jet-label>
        ${{ number_format($total_compra, 0, ',', '.') }} 
    </div>
    <div>
        <x-jet-label>Total venta</x-jet-label>
        ${{ number_format($total_venta, 0, ',', '.') }} 
    </div>
    <div>
        <x-jet-label>Porcentaje</x-jet-label>
        ${{$porcentaje}} 
    </div>
    <div>
        <x-jet-label>Total Pendiente</x-jet-label>
        ${{ number_format($total_pendiente, 0, ',', '.') }} 
    </div>



</div>
