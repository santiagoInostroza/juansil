<div>
    
    <div class="card">
      <div class="card-header">
          <input wire:model='search' type="text" class="form-control" placeholder="Ingrese nombre o correo de usuario">
      </div>
      @if ($pendientes)
          <div class="card-body">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Cliente</th>
                          <th>Fecha</th>
                          <th>Total</th>
                          <th>Monto Pagado</th>
                          <th>Estado Pago</th>
                          <th>Monto Pendiente</th>
                          <th>Delivery</th>
                          <th>Venta por</th>
                          <th>Comentarios</th>
                          <th>Accion</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($pendientes as $pendiente)
                          <tr>
                              <td>{{$pendiente->id}}</td>
                              <td>
                                 <div>{{$pendiente->customer->name}}</div> 
                                 <div>{{$pendiente->customer->direccion}}</div> 
                              </td>
                              <td>{{$pendiente->fecha}}</td>
                              <td>{{$pendiente->total}}</td>
                              <td>{{$pendiente->payment_amount}}</td>
                              <td>
                                  @if ($pendiente->payment_status==1)
                                      Pendiente
                                  @elseif ($pendiente->payment_status==2)
                                      Abonado
                                  @elseif ($pendiente->payment_status==3)
                                      Pagado 
                                  @endif
                              </td>
                              <td>{{$pendiente->pending_amount}}</td>
                              <td>
                                  {{$pendiente->delivery_date}}
                              </td>
                              <td>{{$pendiente->created_by()->name}}</td>
                              <td>{{$pendiente->comments}}</td>
                              <td>
                                  <div class="">
                                      Pagar
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
  