<div>
    <div class="p-4">
        <div class="flex justify-center items-center gap-4">
            <div wire:click="lastMonth" class="cursor-pointer text-sm font-bold">Anterior</div>

            <div class="relative">
                <x-jet-input class="" type="month" id="start" name="start" min="2021-06"  max="{{date('Y')}}-12"  wire:model="period"></x-jet-input>
                <div wire:loading wire:target="month" class="absolute right-10 top-2">
                    <x-spinner.spinner size="7"></x-spinner.spinner>
                </div>
            </div>

            <div wire:click="nextMonth" class="cursor-pointer text-sm font-bold">Siguiente</div>

        </div>
    </div>
    <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
        <div class="shadow-lg bg-red-vibrant border-l-8 hover:bg-red-vibrant-dark border-red-vibrant-dark mb-2 p-2 md:w-1/4 mx-2">
            <div class="p-4 ">
                <a href="#" class="no-underline text-white text-lg grid grid-cols-2 gap-4">
                    <div>Total Ventas</div>
                    <div class="text-right"> ${{ number_format($totalSales,0,',','.')}}</div>
                </a>
                <a href="#" class="no-underline text-white text-lg grid grid-cols-2 gap-4">
                   <div> Total Costo </div>
                   <div class="text-right"> ${{ number_format($totalCost,0,',','.')}}</div>
                </a>
                <a href="#" class="no-underline text-white text-lg grid grid-cols-2 gap-4">
                   <div> Diferencia </div>
                   <div class="text-right"> ${{ number_format($diferencia,0,',','.')}}</div>
                </a>
                <a href="#" class="no-underline text-white text-lg grid grid-cols-2 gap-4">
                   <div> Porcentaje </div>
                   <div class="text-right"> {{ number_format($porcentaje,2,',','.')}}% </div>
                </a>
            </div>
        </div>

        <div class="shadow bg-info border-l-8 hover:bg-info-dark border-info-dark mb-2 p-2 md:w-1/4 mx-2">
            <div class="p-4 flex flex-col">
                <a href="#" class="no-underline text-white text-2xl">
                    ${{ number_format($totalPurchases,0,',','.')}}
                </a>
                <a href="#" class="no-underline text-white text-lg">
                    Total Compras 
                </a>                                  
            </div>
        </div>
   

        <div class="shadow bg-warning border-l-8 hover:bg-warning-dark border-warning-dark mb-2 p-2 md:w-1/4 mx-2">
            <div class="p-4 flex flex-col">
                <a href="#" class="no-underline text-white text-2xl">
                    ${{ number_format($inventario,0,',','.')}}
                </a>
                <a href="#" class="no-underline text-white text-lg">
                   Inventario
                </a>
                <a href="#" class="no-underline text-white text-lg">
                    ${{ number_format($inventario2,0,',','.')}}
                </a>
            </div>
        </div>

        <div class="shadow bg-success border-l-8 hover:bg-success-dark border-success-dark mb-2 p-2 md:w-1/4 mx-2">
            <div class="p-4 flex flex-col">
                <a href="#" class="no-underline text-white text-2xl">
                    500
                </a>
                <a href="#" class="no-underline text-white text-lg">
                    Total Products
                </a>
            </div>
        </div>
    </div>
</div>
