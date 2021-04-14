@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')

    <div class="float-right ">
        <a href="{{ route('admin.purchases.create') }}" class="btn btn-secondary"> Agregar Compra</a>
    </div>
    <h1>Lista de Compras</h1>

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

    @livewire('admin.purchases.index')


    <div class="card">
        <div class="card-body">
            <table id="tablaCompras" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Proveedor</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Comentarios</th>
                        <th>Accion</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@stop


@section('js')
    <script>
        $(document).ready(function() {
            $('#tablaCompras').DataTable({
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
                ajax: "{{ route('datatable.compras') }}",

                columns: [
                    {
                        data: 'id'
                    },
                   
                    {
                        data: 'supplier_id'
                    },
                    {
                        data: 'total'
                    },
                    {
                        data: 'fecha'
                    },
                    {
                        data: 'comments'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });

    </script>




@stop
