@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
    <h1>Editar Compra</h1>
 
@stop

@section('content')

    @if (session('info'))
     
        <div class="alert alert-success">
            <strong>
                {{ session('info') }}
            </strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($compra, ['route' => ['admin.purchases.update', $compra], 'files' => 'true', 'method' => 'put'])
            !!}
            @include('admin.purchases.partials.form')
            {!! Form::submit('Actualizar Compra', ['class' => 'btn btn-primary validar_compra']) !!}


            {!! Form::close() !!}
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
        $(document).on("click", ".validar_compra", function(e) {
            e.preventDefault();

            //VALIDA DATOS DE COMPRA
            if (!validarCompra()) {
                return false;
            }
            //VALIDAR DETALLES COMPRA
            if (!validarDetalleCompras()) {
                return false;
            }
            //REALIZAR SUBMIT
            $("#detalleCompra").closest("form").submit();
        })


        $(document).on("click", ".validar_item_compra", function() {
            //VALIDAR DETALLES COMPRA
            validarDetalleCompras();
        })

        //VALIDA DATOS DE COMPRA
        function validarCompra() {
            let submit = true;

            let supplier_id = $("#supplier_id");
            if (supplier_id.val() == "") {
                supplier_id.focus();
                supplier_id.siblings('span').addClass('border border-danger');
                alerta("Debes seleccionar un proveedor", "Seleciona un proveedor!!");
                submit = false;
                return false;
            } else {
                supplier_id.siblings('span').removeClass('border border-danger');
            }

            let fecha = $("#fecha");

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

        //VALIDAR DETALLES COMPRA
        function validarDetalleCompras() {

            let fila = $("#detalleCompra tbody tr");
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

            });

            return submit;

        }


        //CUANDO SE ACTUALIZA LIVEWIRE    
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('message.processed', (message, component) => {


                $('.select2').select2({
                    width: '100%'
                });
                $('.select2Mul').select2({
                    closeOnSelect: false,
                    width: '100%'
                });
            });
        });

    </script>
@stop
