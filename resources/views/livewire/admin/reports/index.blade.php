<div>
  
    <h1 class="text-2xl font-bold text-gray-600 bg-gray-200 p-4 text-center mb-2">Reportes</h1>
    <div class="p-4">
        <div class="flex justify-center items-center gap-4">
            <div wire:click="lastMonth" class="cursor-pointer text-sm font-bold">Anterior</div>
            <div class="relative">
                <x-jet-input class="" type="month" id="start" name="start" min="2021-06" value="{{date('Y-m')}}" max="{{date('Y')}}-12" wire:model="month"></x-jet-input>
                <div wire:loading wire:target="month" class="absolute right-10 top-2">
                    <x-spinner.spinner size="7"></x-spinner.spinner>
                </div>
            </div>

            <div wire:click="nextMonth" class="cursor-pointer text-sm font-bold">Siguiente</div>

        </div>
    </div>

    {{-- SALES --}}
    <div x-data="salesMain()" class="border rounded">
        <h2 @click="toggleShowSales" class="text-xl font-bold text-gray-400 bg-gray-100 p-2 text-center hover:bg-gray-200 cursor-pointer">Ventas</h2>
        <div x-show="showSales" >
            @if ($sales->count())
                    <div class="p-4 flex items-center gap-2">
                        <x-jet-label>Ordenar</x-jet-label>
                        <select class="border rounded p-2" name="" id="" wire:model="order_by">
                            <option class="p-2" value="id">Id</option>
                            <option value="date">Fecha</option>
                            <option value="total">Total</option>
                        </select>
                        <x-jet-label>Direccion</x-jet-label>
                        <select class="border rounded p-2" name="" id="" wire:model="direccion">
                            <option value="desc">Mayor a menor</option>
                            <option value="asc">Menor a mayor</option>
                        </select>
                    </div>
                    <x-table>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Id
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Fecha venta
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Costo
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        diferencia
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Porcentaje
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Vendedor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Aciones
                                    </th>

                                
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>{{$sale->id}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{$sale->customer->name}} 
                                                        @if ($sale->comments)
                                                            <x-tooltip.tooltip>
                                                                <i class="fas fa-comment"></i>
                                                                <x-slot name="tooltip">
                                                                    {{$sale->comments}}
                                                                </x-slot>
                                                            </x-tooltip.tooltip>
                                                        @endif
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <div class="font-bold tracking-wide">
                                                    {{ $this->fecha($sale->date)->dayName}} 
                                                    {{-- {{($sale->date)}}  --}}
                                                </div>
                                                {{ $this->fecha($sale->date)->format('d-m-y')}}
                                            </div>
                                            {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                                        </td>
                                        {{-- TOTAL --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                ${{number_format($sale->total,0,',','.')}}  
                                            </div>
                                        </td>
                                        {{-- COSTO --}}
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                ${{number_format($sale->total_cost,0,',','.')}}  
                                            </div>
                                        </td>
                                        {{-- DIFERENCIA --}}
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                ${{number_format($sale->total - $sale->total_cost,0,',','.')}}  
                                            </div>
                                        </td>
                                        {{-- PORCENTAJE --}}
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ number_format( ($sale->total - $sale->total_cost) / $sale->total * 100 ,2,',','.')}}  %
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <div class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                @if ($sale->created_by())
                                                    {{$sale->created_by()->name}}   <br>
                                                    {{$sale->created_at->timezone('America/Santiago')->format('d-m-y H:i:s')}}   
                                                
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-2 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex flex-col items-center justify-between gap-1 w-max-content">                                            
                                                <x-jet-secondary-button wire:click="showSale({{$sale}})"> <i class="fas fa-eye"></i></x-jet-secondary-button>
                                                {{-- <x-jet-secondary-button  > <i class="fas fa-pen"></i> </x-jet-secondary-button> --}}
                                                {{-- <x-jet-secondary-button wire:click="deletePurchase({{$sale}})"><i class="far fa-trash-alt"></i></x-jet-secondary-button> --}}
                                                {{-- <a href="{{ route('admin.purchases.show', $purchase) }}" title="Ver datos del cliente" class="mr-2 btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('admin.purchases.edit', $purchase) }}" class="mr-2 btn btn-secondary btn-sm"><i class="fas fa-pen"></i></a>
                                                <form action="{{ route('admin.purchases.destroy', $purchase) }}" method='POST' class="mr-2 alerta_eliminar">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                                </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                    
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th scope="col" colspan="3">
                                </th>
                                <th scope="col" class="px-6 py-3  text-left text-gray-600 uppercase">
                                    
                                    @if ($sales->count())
                                        ${{number_format($sales->sum('total'),0,',','.')}}     
                                    @endif
                                </th>
                                <th scope="col" class="px-6 py-3  text-left text-gray-600 uppercase">
                                    @if ($sales->count())
                                        ${{number_format($sales->sum('total_cost'),0,',','.')}}  
                                    @endif
                                </th>
                                <th scope="col" class="px-6 py-3  text-left text-gray-600 uppercase">
                                    @if ($sales->count())
                                        ${{number_format($sales->sum('total') - $sales->sum('total_cost'),0,',','.')}}     
                                    @endif
                                </th>
                                <th scope="col" class="px-6 py-3  text-left text-gray-600 uppercase">
                                    @if ($sales->count())
                                        {{number_format( ($sales->sum('total') - $sales->sum('total_cost') ) / $sales->sum('total') * 100 ,2,',','.')}}   %
                                    @endif
                                    
                                </th>

                            </tfoot>
                        </table>
                    </x-table>
                    
            
            @else
                <div class="p-4 text-xl font-bold text-gray-600 text-center">
                    No hay ventas que mostrar
                </div>
            @endif
        </div>
    
        @if ($openShowSale)
            <div x-show="openShowSale">
                <x-modal.modal2>
                    <x-slot name="titulo">
            
                            <div class="p-4 flex justify-between items-center">
                                <div>
                                    <h2 class="text-xl text-gray-600 font-bold">
                                        Venta {{$sale_selected->id}} {{$sale_selected->customer->name}}
                                    </h2>
                                
                                </div>
                                <div class="p-4 hover:shadow-xl cursor-pointer rounded-full">
                                    <i class="fas fa-times" @click="closeOpenShowSale"></i>
                                </div>
                            </div>             
                    </x-slot>

                    <div>
                        {{ $this->fecha($sale_selected->date)->dayName }}   {{ $this->fecha($sale_selected->date)->format('d')  }}  {{ $this->fecha($sale_selected->date)->monthName }}
                        <div>
                            Venta Por {{$sale_selected->created_by()->name}}
                        </div>
                    </div>

                    <div class="grid  gap-4 my-6">
                    
                        <div class="border rounded p-4"> 
                            <div class="font-bold">Estado</div> 
                            @if ($sale_selected->payment_status == 1)
                                Pendiente
                                <div> Monto pendiente  ${{number_format($sale_selected->pending_amount,0,',','.') }}</div>
                            @elseif($sale_selected->payment_status == 2)
                                Abonado
                                <div> Monto abonado ${{number_format($sale_selected->payment_amount,0,',','.') }} </div>
                                <div> Monto pendiente  ${{number_format($sale_selected->pending_amount,0,',','.') }}</div>
                            @elseif($sale_selected->payment_status == 3)
                                Pagado el {{$sale_selected->payment_date}}
                                <div> Monto pagado ${{number_format($sale_selected->payment_amount,0,',','.') }} </div>
                                
                            @endif
                        </div>

                    

                        @if ($sale_selected->delivery)
                            <div class="border rounded p-4">
                                <div class="font-bold">Reparto</div>
                                @if ($sale_selected->delivery_stage == 1)
                                    Reparto pendiente para el {{$sale_selected->delivery_date}}
                                @elseif($sale_selected->delivery_stage == 2)
                                    <div> Fecha entregado {{$sale_selected->date_delivered}} </div>
                                    @if ($sale_selected->delivered_by())
                                        <div> Entregado por  {{$sale_selected->delivered_by()->name}}</div>
                                    @endif
                                @endif
                            </div>
                        @endif
                    
                        @if ($sale_selected->comments)
                            <div class="border rounded p-4"> 
                                <h3 class="font-bold">
                                Comentario
                                </h3> 
                                <textarea name="" id="">{{$sale_selected->comments}}</textarea>
                            </div>
                        @endif

                
                    
                    
                        @if ($sale_selected->payment_status == 3)
                            <div class="border rounded p-4"> 
                                <h3 class="font-bold">Estado Boleta</h3>
                                @if ($sale_selected->boleta)
                                    <div> Boleta entregada el {{$sale_selected->fecha_boleta}}</div>
                                    <div>por{{$sale_selected->boleta_by()->name}}</div>
                                @else
                                    <div>Pendiente</div>
                                @endif
                            </div>
                        @endif
                        
                    </div>

                    <x-table>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    id
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    nombre
                                    </th>
                                
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Cantidad total
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        precio total
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        costo unitario
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        costo total
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        diferencia
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    porcentaje
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Aciones
                                    </th>

                                
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($sale_selected->sale_items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>{{$item->id}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <figure>
                                                    <img class="h-16 w-16 object-cover" src="{{ Storage::url($item->product->image->url) }}" alt="">
                                                </figure>
                                            
                                                <div class="text-sm font-medium text-gray-900">
                                                    <div>
                                                        {{ $item->cantidad}}   x  {{ $item->cantidad_por_caja}}   {{$item->product->name}} 
                                                    </div>
                                                    <div>
                                                        ${{ number_format($item->precio,0,',','.') }} c/u
                                                    </div>
                                                    <div>
                                                        ${{ number_format($item->precio_por_caja,0,',','.') }} x caja
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $item->cantidad_total}} 
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                ${{ number_format($item->precio_total,0,',','.') }} 
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                ${{ number_format($item->costo,0,',','.') }} 
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                ${{ number_format($item->costo * $item->cantidad_total,0,',','.') }} 
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                ${{ number_format( $item->precio_total - ($item->costo * $item->cantidad_total) ,0,',','.') }} 
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ number_format(  ($item->precio - $item->costo) / $item->precio * 100  ,2,',','.') }} %
                                            </div>
                                        </td>
                                        <td class="px-6 py-2 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex flex-col items-center justify-between gap-1 w-max-content">                                            
                                                {{-- <x-jet-secondary-button wire:click="showSale({{$sale}})"> <i class="fas fa-eye"></i></x-jet-secondary-button> --}}
                                                {{-- <x-jet-secondary-button  > <i class="fas fa-pen"></i> </x-jet-secondary-button> --}}
                                                {{-- <x-jet-secondary-button wire:click="deletePurchase({{$sale}})"><i class="far fa-trash-alt"></i></x-jet-secondary-button> --}}
                                                {{-- <a href="{{ route('admin.purchases.show', $purchase) }}" title="Ver datos del cliente" class="mr-2 btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('admin.purchases.edit', $purchase) }}" class="mr-2 btn btn-secondary btn-sm"><i class="fas fa-pen"></i></a>
                                                <form action="{{ route('admin.purchases.destroy', $purchase) }}" method='POST' class="mr-2 alerta_eliminar">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                                </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                    
                                @endforeach
                            </tbody>
                    
                        </table>
                    </x-table>

                    <div class="flex justify-end">
                        <div class="grid grid-cols-2 gap-x-4">

                            <div>Subtotal </div>
                            <div class="text-right">${{number_format($sale_selected->subtotal,0,',','.')}}</div>
            
                            <div> Despacho</div>
                            <div class="text-right"> ${{number_format($sale_selected->delivery_value,0,',','.') }}</div>
            
                            <div>Total </div>
                            <div class="text-right">${{number_format($sale_selected->total,0,',','.')}}</div>
            
                            <div>Costo total </div>
                            <div class="text-right">${{number_format($sale_selected->total_cost,0,',','.')}}</div>
            
                            <div>Diferencia</div>
                            <div class="text-right">${{number_format( $sale_selected->total - $sale_selected->total_cost,0,',','.')}}</div>
            
                            <div>Porcentaje</div>
                            <div class="text-right"> {{number_format( ($sale_selected->total - $sale_selected->total_cost) / $sale_selected->total * 100,2,',','.')}}% </div>
            
                        </div>
                    </div>
                </x-modals.modal2>
            </div>
        @endif
    </div>

    @push('js')
        <script>
            function salesMain(){
                return{
                    openShowSale : @entangle('openShowSale'),
                    showSales : @entangle('showSales'),
                    toggleShowSales(){
                        this.showSales = !this.showSales;
                    },
                    closeOpenShowSale(){
                        this.openShowSale = false;
                    }
                }
            }
        </script>        
    @endpush


</div>
