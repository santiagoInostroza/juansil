<div>
    <div class="position-fixed" style="background: grey;top:0;right:0;bottom:0;left:0;opacity: 0.2;">
    </div>
    <div class="position-absolute bg-white m-3 py-1 px-3" style=" top:100px">
        <div wire:click="closeAgregarProducto" class="p-3 position-absolute" style="right: 0; cursor: pointer" >
            <i class="fas fa-times"></i>
        </div>
        <div class="container">
            <h3 class="mb-5 mt-1">
                Agregar despacho
               
            </h3>
            <div class="row">
                <div class="form-group col-sm">
                    <label for="">
                        Nombre
                    </label>
                    <input type="text" class="form-control" wire:model="name">
                </div>
                <div class="form-group col-sm">
                    <label for="">
                        Direccion
                    </label>
                    <input type="text" class="form-control" wire:model="direccion">
                </div>
                <div class="form-group col-sm">
                    <label for="">
                        Fecha
                    </label>
                    <input type="date" class="form-control" wire:model="fecha">
                </div>
                <div class="form-group col-sm">
                    <label for="">
                        Vdespacho
                    </label>
                    <input type="number" class="form-control" wire:model="valor_despacho">
                </div>
            </div>

            <div class="border p-1">
                <div class="row">
                    <div class="col-md">
                        <label for="">Producto</label>
                        @livewire('select.productos', ['user' => ''])
                        {{$product_id}}
                    </div>
                    <div class="col-md">
                        <label for="">Cantidad</label>
                        <input type="number" class="form-control" wire:model='cantidad'>
                    </div>
                    <div class="col-md">
                        <label for="">Cxcaja</label>
                        <input type="number" class="form-control"  wire:model='cantidad_por_caja'>
                    </div>
                    <div class="col-md">
                        <label for="">Ctotal</label>
                        <input type="number" class="form-control" wire:model='cantidad_total'>
                    </div>
                    <div class="col-md">
                        <label for="">Precio</label>
                        <input type="number" class="form-control" wire:model='precio'>
                    </div>
                    <div class="col-md">
                        <label for="">Pxcaja</label>
                        <input type="number" class="form-control" wire:model='precio_por_caja'>
                    </div>
                    <div class="col-md">
                        <label for="">Ptotal</label>
                        <input type="number" class="form-control" wire:model='precio_total'>
                    </div>
                    <div class="col-md">
                        <label for="">Accion</label><br>
                        <div wire:click="agregarItem" class="btn bnt-sm border rounded"><i class="fas fa-plus"></i></div>
                    </div>
                </div>
            </div>

            
            {{-- mostrar datos despacho --}}
            @if(session()->has('despacho'))
                <div class="border p-1">
                    <table>
                        <thead>
                            <tr>
                                <td>Producto</td>
                                <td>Ctotal</td>
                                <td>Precio</td>
                                <td>Ptotal</td>
                                <td>Accion</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session('despacho') as $item)
                            <tr>
                                <td><div class="" style="width: max-content">  {{$item['cantidad']}} {{$item['nombre_producto']}}  x {{$item['cantidad_por_caja']}}  </div></td>
                                <td> <div>{{ $item['cantidad_total'] }} un.</div></td>
                                <td> <div> ${{ number_format($item['precio'],0,',','.')}} c/u</div></td>
                                <td> <div>${{ number_format($item['precio_total'],0,',','.')}}</div></td>
                                <td> <div wire:click="agregarItem" class="btn bnt-sm border rounded"><i class="fas fa-pen"></i></div></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                   
                </div>
            @endif

            {{-- footer --}}
            <div class="row">
                <div class="col-sm">
                    <label for="">Total</label>
                    <input wire:model="total" type="text" class='m-2 p-2' readonly>
                </div>
            </div>

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
    </div>
</div>
