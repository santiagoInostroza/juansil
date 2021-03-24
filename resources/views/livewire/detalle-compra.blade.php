
<div>

    
    {{-- DETALLE COMPRA --}}
    <table id='detalleCompra' class="table table-striped table-bordered table-hover table-sm table-responsive-xl"
        style="width:100%">
        <thead class="thead-light">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Cantidad x Caja</th>
                <th>Cantidad Total</th>
                <th>Precio</th>
                <th>Precio x Caja</th>
                <th>Total Producto</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>

            @isset($items)
                @foreach ($items as $indice => $item)
                    <livewire:item-compra-component :item="$item" :indice="$indice" :key="$indice">
                @endforeach
            @endisset

        </tbody>
        <tfoot>
            <tr>
                <td colspan="8" class="">
                    <div wire:click='agregarItemCompra' class="btn btn-secondary validar_item_compra">
                        Agregar Item Compra
                    </div>
                    <div class="" style="margin: 0 0 0 auto; width:max-content">
                        Total
                        <input name="total" class="form-control d-inline-block" style="width: 100px" value="" readonly
                            wire:model='total'>
                    </div>
                    <input type="hidden" wire:model='eliminados' name="eliminados">
                   
                </td>
            </tr>
            <tr>
                <td colspan="8">


                </td>
            </tr>
        </tfoot>

    </table>

</div>


{{-- FIN DETALLE COMPRA --}}
