<div>
    <x-table.table>
        <x-slot name='thead'>
            <x-table.tr>
                <x-table.th>Id</x-table.th>
                <x-table.th>Proveedor</x-table.th>
                <x-table.th>Total</x-table.th>
                <x-table.th>Fecha</x-table.th>
                <x-table.th>Comentario</x-table.th>
                <x-table.th>Compra por</x-table.th>
                <x-table.th></x-table.th>
            </x-table.tr>
        </x-slot>
        <x-slot name='tbody'>
            @foreach ($allPurchases as $purchase)
                <x-table.tr>
                    <x-table.td>{{$purchase->id}}</x-table.td>
                    <x-table.td>{{$purchase->supplier->name}}</x-table.td>
                    <x-table.td> ${{ number_format($purchase->total,0,',','.')}}</x-table.td>
                    <x-table.td> {{ ($purchase->fecha) ? Str::limit(Helper::date($purchase->fecha)->dayName, 3, '')  :'' }} {{ ($purchase->fecha) ? Helper::date($purchase->fecha)->format('d-m-Y H:i') :'' }}</x-table.td>
                    <x-table.td> 
                        <div id='tooltip_comment_{{$purchase->id}}' x-data='{tooltip:false}' x-on:mouseleave='tooltip=false'>
                            <div x-on:mouseover='tooltip=true'>
                                {{Str::limit($purchase->comment,10)}}
                            </div>
                            <div x-show='tooltip' x-cloak x-transition >
                                <div class='bg-white rounded shadow p-4 absolute'>
                                    {{ $purchase->comment,10 }}
                                </div>
                            </div>
                        </div>
                    </x-table.td>
                    <x-table.td>{{$purchase->createdBy()->name}}</x-table.td>
                    <x-table.td>
                        <div class="flex items-center gap-2">
                            <div>
                                <a href="{{route('admin2.purchases.show',$purchase->id)}}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                            <div>
                                <a href="{{route('admin2.purchases.edit',$purchase->id)}}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            <div>
                                <form action="{{route('admin2.purchases.destroy',$purchase->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </x-table.td>
                </x-table.tr>
            @endforeach
        </x-slot>
    </x-table.table>
</div>
