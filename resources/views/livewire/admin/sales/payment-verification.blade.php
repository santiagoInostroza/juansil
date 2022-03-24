<div>
    hola 2
    @if ($paymentsPendingVerification->count()>0)
    

        <div x-data="{isOpenPaymentVerification:false}">
            
        <div class="fixed p-4 bottom-0 right-0 shadow rounded border-l-4 bg-white border-red-500 cursor-pointer" x-on:click="isOpenPaymentVerification=true">
            <div class="animate-bounce">
                @if ($paymentsPendingVerification->count()>1)
                    Hay {{$paymentsPendingVerification->count()}} pagos que necesitan ser verificados
                @else
                    Hay {{$paymentsPendingVerification->count()}} pago que necesita ser verificado
                @endif
            </div>
        </div>
        <div x-cloak x-show="isOpenPaymentVerification" x-on:click.away="isOpenPaymentVerification=false" class="h-screen absolute" >
            
            <div class="fixed bottom-1 right-1 p-4 bg-white shadow rounded max-w-screen-xl max-h-9/12  z-10">
                
                <div class="flex items-center gap-2 justify-between">
                    <h2 class="font-bold text-gray-500">Verificacion de pagos</h2>
                    <div class="p-2 cursor-pointer" x-on:click="isOpenPaymentVerification=false"><i class="fas fa-times"></i></div>
                </div>
                <div class="h-full overflow-auto">
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.tr>
                                <x-table.th>id</x-table.th>
                                <x-table.th>nombre</x-table.th>
                                <x-table.th>Total</x-table.th>
                                <x-table.th>img</x-table.th>
                                <x-table.th>comentario</x-table.th>
                                <x-table.th></x-table.th>
                            </x-table.tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @foreach ($paymentsPendingVerification as $payment)
                                <x-table.tr>
                                    <x-table.td>{{ $payment->id}}</x-table.td>
                                    <x-table.td>{{ $payment->customer->name}}</x-table.td>
                                    <x-table.td> ${{ number_format($payment->total,0,',','.')}}</x-table.td>
                                    <x-table.td> <img class="max-h-72" src="{{ Storage::url($payment->payment_receipt_url) }}" alt=""></x-table.td>
                                    <x-table.td> 
                                        {!!$payment->driver_comment!!}    
                                    </x-table.td>
                                    <x-table.td> 
                                        <x-jet-button wire:click="verify({{ $payment->id }})">Verificar</x-jet-button>
                                    </x-table.td>
                                </x-table.tr>
                            @endforeach
                        </x-slot>
                    </x-table.table>                               
            
                </div>

            </div>
        </div>
            
    @endif    
</div>
