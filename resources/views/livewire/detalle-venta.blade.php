<div class=" ">
    {{$cliente_id}}
    <div class="row">
        {{-- CLIENTE --}}
        @livewire('select.clientes', ['customer_id' => $customer_id,'query'=>$customer_name])

        {{-- FECHA --}}
        <div class="form-group col-sm">
            {!! Form::label('date', 'Fecha', ['class' => '']) !!}
            {!! Form::date('date', null, ['class' => 'form-control', 'wire:model' => 'date']) !!}
            @error('date')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
    </div>

    {{-- DETALLE VENTA --}}
    <table id='detalleVenta' class="table table-bordered table-hover table-sm table-responsive-xl mt-5" style="width:100%">
        <thead class="thead-light">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Cantidad x Caja</th>
                <th>Cantidad Total</th>
                <th>Precio x unidad</th>
                <th>Precio x Caja</th>
                <th>Precio Total</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>

            @isset($items)
                @foreach ($items as $indice => $item)
                    <livewire:item-venta-component :item="$item" :indice="$indice" :key="$indice">
                @endforeach
            @endisset



        </tbody>
    </table>
    <div class="d-flex justify-content-between mb-5 mt-2">
        <div wire:click='agregarItem' class="btn btn-primary validar_item_venta">
            Agregar Item Venta
        </div>
        <div>
            Total <input name="total" class="form-control d-inline-block" style="width: 100px" wire:model='total'>
        </div>
    </div>
    <input type="hidden" wire:model='eliminados' name="eliminados">



    {{-- PAYMENT STATUS - ESTADO DEL PAGO --}}
    <label>Estado del pago</label>
    <div class="mb-3 pt-2 px-3  border">
        <div class="">
            <label wire:click="$set('payment_status','1')" class="btn btn-sm @if ($payment_status=='1' ) btn-dark @endif"> Pendiente</label>
            <label wire:click="$set('payment_status','2')" class="btn btn-sm @if ($payment_status=='2' ) btn-dark @endif"> Abonado</label>
            <label wire:click="$set('payment_status','3')" class="btn btn-sm @if ($payment_status=='3' ) btn-dark @endif"> Pagado</label>
            <input type="hidden" wire:model='payment_status' name='payment_status'>
        </div>
        @if ($payment_status == 2)
            <div>
                <input type="number" wire:model='payment_amount' id='payment_amount' name='payment_amount'
                    class="mb-4 form-control" placeholder="Ingresa monto abonado">
            </div>
        @endif

    </div>

    {{-- DELIVERY --}}
    <div class="custom-control custom-switch d-inline-block my-4">
        <input type="checkbox" class="custom-control-input" name="delivery" id="delivery" wire:model='delivery'>
        <label class="custom-control-label" for="delivery"><i class="fas fa-truck"></i> Delivery</label>
    </div>

    @if ($delivery == '1')
        <div class="form-group border p-4">
            <div class="form-group">
                {!! Form::label('delivery_date', 'Fecha de entrega') !!}
                {!! Form::date('delivery_date', null, ['wire:model' => 'delivery_date', 'class' => 'form-control']) !!}
               
            </div>


            <div class="custom-control custom-switch d-inline-block my-4">
                <input type="checkbox" class="custom-control-input" name="delivery_stage" id="delivery_stage"
                    wire:model='delivery_stage'>
                <label class="custom-control-label" for="delivery_stage"><i class="fas fa-truck"></i> Entregado</label>
            </div>
        </div>
    @endif

    {{-- COMENTARIOS --}}
    <div class="form-group">
        <div class="custom-control custom-switch d-inline-block my-4">
            <input type="checkbox" class="custom-control-input" id="comentarios" wire:model='tiene_comentarios'>
            <label class="custom-control-label" for="comentarios"></i><i class="far fa-comment"></i> Comentarios</label>
        </div>
        @if ($tiene_comentarios)
            {!! Form::textarea('comments', null, ['style' => 'height:70px', 'class' => 'form-control', 'placeholder' => 'Ingresa Comentario', 'x-show' => 'open']) !!}
        @endif
    </div>





</div>
{{-- FIN DETALLE Venta --}}
