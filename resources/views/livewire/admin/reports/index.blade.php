<div>
  
    <h1 class="text-2xl font-bold text-gray-600 bg-gray-200 p-4 text-center mb-2">Reportes</h1>
    <div class="p-4">
        <div class="flex justify-center items-center gap-4">
            <div wire:click="lastMonth" class="cursor-pointer text-sm font-bold">Anterior</div>
            <div class="relative">
                <x-jet-input class="" type="month" id="start" name="start" min="2021-06" value="{{date('Y-m')}}" max="{{date('Y')}}-12" wire:change="seleccionaMes" wire:model="month"></x-jet-input>
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
                    <div class="p-4 ">
                        FILTROS
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
                                                <x-jet-secondary-button wire:click="showPurchase({{$sale}})"> <i class="fas fa-eye"></i></x-jet-secondary-button>
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
    </div>

    @push('js')
        <script>
            function salesMain(){
                return{
                    showSales : @entangle('showSales'),
                    toggleShowSales(){
                        this.showSales = !this.showSales;
                    },
                }
            }
        </script>        
    @endpush


</div>
