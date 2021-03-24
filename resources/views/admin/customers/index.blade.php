@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')

    <div class="float-right ">
        <a href="{{ route('admin.customers.create') }}" class="btn btn-secondary"> Agregar Cliente</a>
    </div>
    <h1>Lista de Clientes</h1>

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
            <table id="tablaClientes" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Celular</th>
                        <th>Direccion</th>
                        <th>Block</th>
                        <th>Depto</th>
                        <th>Comuna</th>
                        <th>Obs</th>
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
            $('#tablaClientes').DataTable({
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
                ajax: "{{ route('datatable.clientes') }}",

                columns: [
                    {
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'telefono'
                    },
                    {
                        data: 'celular'
                    },
                    {
                        data: 'direccion'
                    },
                    {
                        data: 'block'
                    },
                    {
                        data: 'depto'
                    },
                    {
                        data: 'comuna'
                    },
                    {
                        data: 'comentario'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'asc']
                ]
            });


        });

    </script>




@stop
