<div>
    <div class="card">
        <div class="card-header">
            <input wire:model='search' type="text" class="form-control"
                placeholder="Ingrese nombre o correo de usuario">
        </div>
        @if ($pendientes)
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Monto Pagado</th>

                            <th>Monto Pendiente</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendientes as $pendiente)
                            <tr>
                                <td>{{ $pendiente->id }}</td>
                                <td>
                                    <div>{{ $pendiente->name }} </div>
                                    <div>{{ $pendiente->direccion }}</div>
                                </td>

                                <td> ${{ number_format($pendiente->sales->sum('total'), 0, ',', '.') }}</td>
                                <td> ${{ number_format($pendiente->sales->sum('payment_amount'), 0, ',', '.') }}</td>
                                <td> ${{ number_format($pendiente->sales->sum('pending_amount'), 0, ',', '.') }}</td>
                                <td>
                                    <div class="bg-secondary btn"
                                        wire:click='verDetallePagosPendientes({{ $pendiente->id }})'>
                                        Detalle
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endif
    </div>
</div>
