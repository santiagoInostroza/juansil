<div class="pt-2">
    @if ($customer_id >0)

        {{-- NOMBRE CLIENTE --}}
        <div class="px-3">
            <h2>{{$customer->name}}</h2>
        </div>

        {{-- VENTA CON PAGO PENDIENTE --}}
        <div class="card">
            @if (count($customer->pending())>0)
                <div class="card-header">
                    <h3>Ventas con pago pendiente</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Monto Pagado</th>
                                <th>Estado del Pago</th>
                                <th>Monto Pendiente</th>
                                <th>Delivery</th>
                                <th>Venta por</th>
                                <th>Comentarios</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer->pending() as $pending)
                                <tr>
                                    <td>{{$pending->id}}</td>
                                    <td>{{ date("d-m-Y",strtotime($pending->date) ) }}</td>
                                    <td> ${{number_format($pending->total,0,',','.')}}</td>
                                    <td> ${{number_format($pending->payment_amount,0,',','.')}} </td>
                                    <td>
                                    @if ($pending->payment_status == 1)
                                        Pendiente 
                                        @elseif ($pending->payment_status == 2)
                                        Abonado
                                    @endif 
                                    </td>
                                    <td> ${{number_format($pending->pending_amount,0,',','.')}} </td>
                                    <td>{{$pending->delivery_date}}</td>
                                    <td>@if($pending->created_by())  {{$pending->created_by()->name}} @endif</td>
                                    <td>{{$pending->comments}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label> Total Pendiente</label>
                        <div class="d-inline-block p-2">
                            ${{number_format($customer->pending()->sum('pending_amount'),0,',','.')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Monto</label>
                        <input type="number" wire:model='monto' id="monto">
                        @error('monto')
                            <span class="text-danger">{{$message}} </span> 
                        @enderror
                    </div>
                    <div wire:click='pagarMonto' class="btn btn-secondary">
                        Pagar
                    </div>
                </div>
            @else
                <div class="card-header">
                    <h3>No tiene deuda</h3>
                </div>
            @endif   
        </div>

        {{-- LISTA DE PAGOS --}}
        <div class="card">
            @if (count($pays)>0)
                <div class="card-body">
                    <h3>Pagos Realizados</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Ingresado por</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pays as $pay)
                                <tr>
                                    <td>{{ $pay->id }}</td>
                                    <td>${{ number_format($pay->total,0,',','.') }}</td>
                                    <td>{{ date("d-m-Y",strtotime( $pay->fecha)) }}</td>
                                    <td>{{ $pay->created_by()->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $pays->links() }}
                </div>
            @endif
        </div>
    @endif
</div>