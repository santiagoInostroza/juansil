<div class="card">
    <div class="card-header d-flex">
        <input wire:model.debounce.1000ms='search' type="text" class="form-control" placeholder="Ingrese nombre o direccion a buscar">
        {{$search}}
        @livewire('admin.ventas.agregar')
    </div>
    
    <div class="card-body">
        <table class="table table-hover table-responsive-xl table-sm">
            <thead>
                <tr>
                    <th wire:click="order('id')" class="" style="cursor:pointer">
                        Id 
                        {{-- SORT --}}
                        @if ($sort== 'id')
                            @if ($direction =='asc')
                                <i class="fas fa-sort-alpha-up-alt mt-1" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt mt-1" style="float: right"></i>  
                            @endif
                        @else
                            <i class="fas fa-sort mt-1" style="float: right"></i>
                        @endif
                        
                    </th>
                    <th wire:click="order('customers.name')" class="" style="cursor:pointer">
                            Cliente 
                            {{-- SORT --}}
                            @if ($sort== 'customers.name')
                            @if ($direction =='asc')
                                <i class="fas fa-sort-alpha-up-alt mt-1" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt mt-1" style="float: right"></i>  
                            @endif
                        @else
                            <i class="fas fa-sort mt-1" style="float: right"></i>
                        @endif
                    </th>
                    <th wire:click="order('total')" class="" style="cursor:pointer">
                        Total 
                        {{-- SORT --}}
                        @if ($sort== 'total')
                            @if ($direction =='asc')
                                <i class="fas fa-sort-alpha-up-alt mt-1" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt mt-1" style="float: right"></i>  
                            @endif
                        @else
                            <i class="fas fa-sort mt-1" style="float: right"></i>
                        @endif
                    </th>
                    <th wire:click="order('payment_status')" class="" style="cursor:pointer">
                        EstadoPago 
                        {{-- SORT --}}
                        @if ($sort== 'payment_status')
                            @if ($direction =='asc')
                                <i class="fas fa-sort-alpha-up-alt mt-1" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt mt-1" style="float: right"></i>  
                            @endif
                        @else
                            <i class="fas fa-sort mt-1" style="float: right"></i>
                        @endif
                    </th>
                    <th wire:click="order('delivery_stage')" class="" style="cursor:pointer">
                        EstadoDelivery 
                        {{-- SORT --}}
                        @if ($sort== 'delivery_stage')
                            @if ($direction =='asc')
                                <i class="fas fa-sort-alpha-up-alt mt-1" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt mt-1" style="float: right"></i>  
                            @endif
                        @else
                            <i class="fas fa-sort mt-1" style="float: right"></i>
                        @endif
                    </th>
                    <th wire:click="order('date')" class="" style="cursor:pointer">
                        FechaVenta 
                        {{-- SORT --}}
                        @if ($sort== 'date')
                            @if ($direction =='asc')
                                <i class="fas fa-sort-alpha-up-alt mt-1" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt mt-1" style="float: right"></i>  
                            @endif
                        @else
                            <i class="fas fa-sort mt-1" style="float: right"></i>
                        @endif
                    </th>
                    <th wire:click="order('user_created')" class="" style="cursor:pointer">
                        VentaPor 
                        {{-- SORT --}}
                        @if ($sort== 'user_created')
                            @if ($direction =='asc')
                                <i class="fas fa-sort-alpha-up-alt mt-1" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt mt-1" style="float: right"></i>  
                            @endif
                        @else
                            <i class="fas fa-sort mt-1" style="float: right"></i>
                        @endif
                    </th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr style=" @if($venta->payment_status == 3 && ($venta->delivery_stage == 1 || $venta->delivery == 0 ) ) background:#e5ffeb;   @endif">
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
                                <div> 
                                    <span class="text-warning">Pendiente</span> 
                                    ${{number_format($venta->pending_amount,0,',','.')}} 
                                </div> 
                            @elseif ($venta->payment_status == 2)
                                <div class=""> 
                                    <span class="text-success">Abonado</span> 
                                    ${{number_format($venta->payment_amount,0,',','.')}} 
                                </div> 
                                <div> 
                                    <span class="text-warning">Pendiente</span> 
                                    ${{number_format($venta->pending_amount,0,',','.')}} 
                                </div> 
                                
                            @elseif ($venta->payment_status == 3)
                                <i class="fas fa-check text-success d-block"></i>
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
                            <div class="d-flex" style="align-content: center">
                                @livewire('admin.ventas.mostrar', ['venta' => $venta], key($venta->id))
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

