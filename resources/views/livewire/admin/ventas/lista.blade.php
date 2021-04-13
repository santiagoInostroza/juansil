<div class="card">
    <div class="card-header">
        <input wire:model='search' type="text" class="form-control" placeholder="Ingrese nombre o direccion a buscar">
    </div>
    <div class="card-body">
        <table class="table table-hover table-responsive-xl table-sm">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>cliente</th>
                    <th>Total</th>
                    <th>EstadoPago</th>
                    <th>EstadoDelivery</th>
                    <th>FechaVenta</th>
                    <th>VentaPor </th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                <tr>
                    <td  style="min-width: 50px" class="align-middle">
                        <div>{{$venta->id}}</div>
                    </td>    
                    <td style="min-width: 180px">
                        {{-- <div class="h6"> ${{number_format($venta->total,0,',','.')}}</div> --}}
                        <div class="h5 ">{{$venta->customer->name}}</div> {{-- {{$venta->customer->telefono}} {{$venta->customer->celular}} --}}
                        <div>
                            {{$venta->customer->direccion}} 
                            @isset($venta->customer->block) Torre {{$venta->customer->block}} @endisset 
                            @isset($venta->customer->depto) depto {{$venta->customer->depto}} @endisset
                        </div>
                    </td> 
                    
                   

                    {{-- TOTAL --}}
                    <td  style="min-width: 100px" class="align-middle">
                        <div class="h5">${{number_format($venta->total,0,',','.')}}</div> 
                    </td>

                    {{-- ESTADO DE PAGO --}}
                    <td style="min-width: 100px" class="align-middle">
                        @if ($venta->payment_status == 1)
                            <div class=""> Pendiente  ${{number_format($venta->pending_amount,0,',','.')}} </div> 
                        @elseif ($venta->payment_status == 2)
                            <div class=""> Pendiente  ${{number_format($venta->pending_amount,0,',','.')}} </div> 
                            
                        @elseif ($venta->payment_status == 3)
                            <i class="fas fa-check text-success text-center d-block"></i>
                        @endif
                    </td>

                    {{-- ESTADO DELIVERY --}}
                    <td style="min-width: 150px" class="align-middle">
                        @if ($venta->delivery == 1)
                            @if ($venta->delivery_stage == 1)
                                <i class="fas fa-check text-success"></i> {{date("d-m-Y",strtotime($venta->delivery_date))}}
                                {{-- {{date("d-m-Y",strtotime($venta->date_delivered))}} --}}
                            @else
                                <i class="fas fa-truck text-warning"></i> {{date("d-m-Y",strtotime($venta->delivery_date))}}
                            @endif
                        @else
                            Venta Bodega
                        @endif
                    </td>

                     {{-- FECHA --}}
                     <td style="min-width: 100px" class="align-middle">
                        {{date("d-m-Y",strtotime($venta->date))}}
                     </td>

                    {{-- VENTA POR --}}
                    <td style="min-width: 100px" class="align-middle">
                        <div> @if( $venta->created_by() ) {{ $venta->created_by()->name }} @endif</div>
                    </td>
                   
                    {{-- ACCION --}}
                    <td width='100px' class="align-middle">
                        <div class="d-flex">
                           
                          
                           
                            <a href="{{ route('admin.sales.edit', $venta) }}" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('admin.sales.destroy', $venta) }}" method='POST' class="alerta_eliminar  mr-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </div>
                    
                    </td>
                    <td class="align-middle"></td>
                </tr>     
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="card-footer">
        {{ $ventas->links() }}
    </div>

    <div class="fixed-bottom p-2 bg-white shadow text-center">
        Total ventas ${{number_format($ventas->sum('total'),0,',','.')}}
        Total costo ${{number_format($total_compra,0,',','.')}} 
        Porcentaje % {{number_format($porcentaje,2)}}  
        <span class="text-success">Diferencia ${{number_format($diferencia,0,',','.')}}  </span> 
        <span class="text-warning"> Pendientes ${{number_format($total_pendiente,0,',','.')}}  </span> 
    </div>
</div>

