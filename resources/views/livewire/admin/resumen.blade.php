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
            {{ number_format($porcentaje, 2) }}
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
</div>