@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')

    {{-- <div class="float-right ">
        <a href="{{ route('admin.products.create') }}" class="btn btn-secondary"> Agregar Producto</a>
    </div> --}}
    <h1>Stock de Productos</h1>

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
            <table id="tablaStock" class="table table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th style="width: 50px">Stock</th>
                        <th style="width: 50px">Precio Compra</th>                        
                        <th style="width: 50px">Total</th>
                        {{--<th style="width: 120px">Precios-Venta / margen-bruto</th>
                         <th>Total Venta</th>
                        <th>Diferencia</th>
                        <th>Margen bruto</th> --}}

                    </tr>
                </thead>
            </table>
        </div>
       
    </div>
    

@stop


@section('js')
    <script>
        $(document).ready(function() {
            $('#tablaStock').DataTable({
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
                ajax: "{{ route('datatable.stock') }}",

                columns: [
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'product'
                    },
                    {
                        data: 'stock'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'total'
                    },
                   // {
                    //    data: 'sale_price'
                    //},
                    // {
                    //     data: 'total_sale'
                    // },
                    // {
                    //     data: 'diference'
                    // },
                    // {
                    //     data: 'porcent'
                    // },
                ],
                order: [
                    [0, 'asc']
                ]
            });


        });

    </script>




@stop
