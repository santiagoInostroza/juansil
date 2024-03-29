@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')

    {{-- <div class="float-right ">
        <a href="{{ route('admin.movements.create') }}" class="btn btn-secondary"> Agregar Compra</a>
    </div> --}}
    <h1>Movimientos de productos</h1>

@stop

@section('css')


@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>
                {{ session('info') }}
            </strong>
        </div>
    @endif

    @if (session('eliminado') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'Se ha eliminado!.',
                'success'
            )

        </script>
    @endif


    <div class="card">
        <div class="card-body">
            <table id="tablaMovimientos" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th style="width: 60px">Id movimiento</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th style="width: 60px">Stock anterior</th>
                        <th>Cantidad</th>
                        <th style="width: 60px">Stock Actual</th>
                        <th>Obs</th>
                        <th>Fecha</th>
                       
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@stop


@section('js')
    <script>
        $(document).ready(function() {
            $('#tablaMovimientos').DataTable({
                responsive: true,
                language: {
                    "lengthMenu": "Mostrar " +
                        `
                                <select class='custom-select custom-select-sm form-control dorm-control-sm'>
                                    <option value='10'>10</option>
                                    <option value='25'>25</option>
                                    <option value='50' selected>50</option>
                                    <option value='100'>100</option>
                                    <option value='-1'>Todos</option>
                                    </select>
                                ` +
                        "  registros por página",
                    "zeroRecords": "Nada encontrado - disculpa",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    'search': 'Buscar',
                    'paginate': {
                        'next': 'siguiente',
                        'previous': 'anterior'
                    }
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('datatable.movimientos') }}",

                columns: [
                    {
                        data: 'id'
                    },
                    {
                        data: 'id_movimiento'
                    },
                   
                    {
                        data: 'product'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'stock_anterior'
                    },
                    {
                        data: 'cantidad'
                    },
                    {
                        data: 'stock_actual'
                    },
                    {
                        data: 'observacion'
                    },
                    {
                        data: 'fecha'
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // }
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });

    </script>




@stop
