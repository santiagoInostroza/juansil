{{-- @extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
    <div class="container">
        <h1>Crear Venta</h1>
    </div>
@stop

@section('content')

    <div class="card container">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.sales.store', 'autocomplete' => 'off', 'files' => 'true']) !!}
            @include('admin.sales.partials.form')
            {!! Form::submit('Crear Venta', ['class' => 'btn btn-primary validar_venta btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>

    </div>

@stop

@section('css')

    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img {
            position: absolute;
            object-fit: contain;
            width: 100%;
            height: 100%;
        }

    </style>
@stop

@section('js')
    <script>
        $(document).on("click", ".validar_venta", function(e) {
            e.preventDefault();

            //VALIDA DATOS DE VENTA
            if (!validarVenta()) {
                return false;
            }
            //VALIDAR DETALLES VENTA
            if (!validarDetalleVenta()) {
                return false;
            }
            //REALIZAR SUBMIT
            $("#detalleVenta").closest("form").submit();
        })


        $(document).on("click", ".validar_item_venta", function() {
            //VALIDAR DETALLES VENTA
            validarDetalleVenta();
        })
        

        //VALIDA DATOS DE VENTA
        function validarVenta() {
            let submit = true;

            let supplier_id = $("#customer_id");
            if (supplier_id.val() == "") {
                supplier_id.focus();
                supplier_id.siblings('span').addClass('border border-danger');
                alerta("Debes seleccionar un cliente", "Seleciona un cliente!!");
                submit = false;
                return false;
            } else {
                supplier_id.siblings('span').removeClass('border border-danger');
            }

            let fecha = $("#date");

            if (fecha.val().length != 10) {

                fecha.focus();
                fecha.addClass('border border-danger');
                alerta("Debes seleccionar fecha", "Seleciona fecha!!");
                submit = false;
                return false;
            } else {
                fecha.removeClass('border border-danger');
            }
            return submit;
        }

        //VALIDAR DETALLES VENTA
        function validarDetalleVenta() {

            let fila = $("#detalleVenta tbody tr");
            let submit = true;
            fila.each(function() {

                //VALIDAR PRODUCTO
                let product_id = $(this).find("#product_id");
                if (product_id.val() == "") {
                    product_id.focus();
                    product_id.addClass('border border-danger');
                    alerta("Debes seleccionar un producto", "Seleciona un producto!!");
                    submit = false;
                    return false;
                } else {
                    product_id.removeClass('border border-danger');
                }

                //VALIDAR CANTIDAD
                let cantidad = $(this).find("#cantidad");
                if (cantidad.val() == "") {
                    cantidad.focus();
                    cantidad.addClass('border border-danger');
                    alerta("Debes ingresar cantidad", "Ingresa cantidad!!");
                    submit = false;
                    return false;
                } else {
                    cantidad.removeClass('border border-danger');
                }

                //VALIDAR CANTIDAD POR CAJA
                let cantidad_por_caja = $(this).find("#cantidad_por_caja");
                if (cantidad_por_caja.val() == "") {
                    cantidad_por_caja.focus();
                    cantidad_por_caja.addClass('border border-danger');
                    alerta("Debes ingresar cantidad por caja", "Ingresa cantidad por caja!!");
                    submit = false;
                    return false;
                } else {
                    cantidad_por_caja.removeClass('border border-danger');
                }

                //VALIDAR PRECIO
                let precio = $(this).find("#precio");
                if (precio.val() == "") {
                    precio.focus();
                    precio.addClass('border border-danger');
                    alerta("Debes ingresar precio", "Ingresa precio!!");
                    submit = false;
                    return false;
                } else {
                    precio.removeClass('border border-danger');
                }

                //VALIDAR PRECIO POR CAJA
                let precio_por_caja = $(this).find("#precio_por_caja");
                if (precio_por_caja.val() == "") {
                    precio_por_caja.focus();
                    precio_por_caja.addClass('border border-danger');
                    alerta("Debes ingresar precio por caja", "Ingresa precio por caja!!");
                    submit = false;
                    return false;
                } else {
                    precio_por_caja.removeClass('border border-danger');
                }

                //VALIDAR ESTADO DEL PAGO
                let payment_status = $('input:radio[name=payment_status]:checked').val()
                if (payment_status == 2) {
                    let payment_amount = $("#payment_amount");
                    if (payment_amount.length) {
                        if (payment_amount.val() == "") {
                            payment_amount.focus();
                            payment_amount.addClass('border border-danger');
                            alerta("Debes ingresar monto abonado", "Ingresa monto abonado!!");
                            submit = false;
                            return false;
                        } else {
                            payment_amount.removeClass('border border-danger');
                        }
                    }
                }

                //VALIDAR DELIVERY
                let delivery = $("#delivery");
                if (delivery.val() == "on") {
                    let delivery_date = $("#delivery_date");
                    if (delivery_date.length) {
                        if (delivery_date.val().length != 10) {
                            delivery_date.focus();
                            delivery_date.addClass('border border-danger');
                            alerta("Debes ingresar fecha para delivery", "Ingresa Fecha para delivery!!");
                            submit = false;
                            return false;
                        } else {
                            delivery_date.removeClass('border border-danger');
                        }
                    }
                }



            });

            return submit;

        }


    </script>
@stop --}}
