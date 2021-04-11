<div class="pt-2">
    @livewire('select.clientes', [
        'agregar_cliente' => false,
        'customer_id' => $customer_id ,
    ])
 
    @if ($customer_id >0)
    
        <div class="card">
            <div class="card-header">
               <h2> {{$customer->name}} </h2>
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
                                <td>{{$pending->fecha}}</td>
                                <td>{{$pending->total}}</td>
                                <td>{{$pending->payment_amount}}</td>
                                <td>
                                  @if ($pending->payment_status == 1)
                                    Pendiente 
                                    @elseif ($pending->payment_status == 2)
                                    Abonado
                                  @endif 
                                </td>
                                <td>{{$pending->pending_amount}}</td>
                                <td>{{$pending->delivery_date}}</td>
                                <td>@if($pending->created_by())  {{$pending->created_by()->name}} @endif</td>
                                <td>{{$pending->comments}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                

            </div>

            <div class="card-body">
                <div class="form-group">
                    <label> Total Pendiente</label>
                    <div class="d-inline-block p-2">
                        ${{number_format($customer->pending()->sum('pending_amount'),0,',','.')}}
                    </div>
                </div>
            </div>

         </div>


    @endif
 
 
 </div>