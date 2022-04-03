<div id="payment_status_{{$sale->id}}" x-data="{isOpenPaymentStatus:false,isOpenEditPaymentStatus:false, loading:false, loading2:false, loading3:false}" >
                        
    @if ($sale->payment_status == 1)
        {{-- <div class="relative">
            <div class="hidden" :class="{'hidden': !loading}">
                <x-spinner.spinner2 size="8"></x-spinner.spinner2>
            </div>
        </div> --}}
        <div>
            <div x-on:click="isOpenPaymentStatus=true" class="text-xs block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-yellow-500 text-white rounded-full cursor-pointer">
                <div>Pendiente</div>
                <span>Pagar</span>
            </div>
            {{--MODAL PARA PAGAR --}}
            <div x-cloak x-show="isOpenPaymentStatus">
                <x-modal.modal2>
                    <div class="p-4">
                        <div class="flex items-center justify-between gap-4">
                            <h2 class="text-gray-600 font-bold text-xl">Pagar</h2>
                            <div x-on:click="isOpenPaymentStatus=false" class="rounded-full shadow p-2 px-3 cursor-pointer">
                                <i class="fas fa-times "></i>
                            </div>
                        </div>

                        <ul class="grid grid-cols-2 gap-2 gap-y-4 mt-8 relative">
                            @foreach ($accounts as $key => $account)
                                <x-jet-button 
                                x-on:click="
                                loading=true; 
                                loading2=true;
                                $wire.payOrder( {{ $sale }}, {{$key}} ).then(()=>{
                                    loading=false;loading2=false; isOpenPaymentStatus=false;
                                })"> 
                                    {{$account}} 
                                </x-jet-button>
                                
                            @endforeach
                            <div x-cloak x-show='loading2'>
                                <x-spinner.spinner2 size="8"></x-spinner.spinner2>
                            </div>
                        </ul>
                    </div>
                </x-modal.modal2>
            </div>
        </div>
            
    @elseif($sale->payment_status==2)
        Abonado<div wire:click='pagarDiferencia({{ $sale->id }})' style="background: #d0e80a" class="btn ml-2">Pagar</div>
    @elseif($sale->payment_status==3) {{-- PAGADO --}}
        {{-- <div class="relative">
            <div class="hidden" :class="{'hidden': !loading3}">
                <x-spinner.spinner2 size="8"></x-spinner.spinner2>
            </div>
        </div> --}}
        <div x-on:mouseout="isOpenPaymentStatus=false" x-on:click="isOpenEditPaymentStatus= true">
            <div x-on:mouseover="isOpenPaymentStatus=true" class="select-none text-xs flex gap-2 items-center py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-500 text-white rounded-full cursor-pointer">
                <span>Pagado</span>
                <i class="fas fa-pen"></i>
            </div>
            <div x-cloak x-show="isOpenPaymentStatus" >
                <div class="bg-white shadow p-4 absolute z-10 rounded">
                
                        <div> {{ ($sale->payment_date) ? Helper::date($sale->payment_date)->dayName : ''}} {{ ($sale->payment_date) ? Helper::date($sale->payment_date)->format('H:i') .' hrs.' : '' }}</div>
                        <div> {{ ($sale->payment_date) ? Helper::date($sale->payment_date)->format('d-m-Y') : '' }}</div>
                        <div> {{ ($sale->paymentBy()) ? 'por '. $sale->paymentBy()->name :''}} </div>
                        <div> {{ ( $sale->payment_account ) ? $accounts[$sale->payment_account] : 'No seleccionado' }} </div>
                    </div>
                </div>
        </div>
    
        {{-- MODAL PARA EDITAR PAGO --}}
        <div x-cloak x-show="isOpenEditPaymentStatus">
            <x-modal.modal2>
                <div class="p-4">
                    <div class="flex items-center justify-between gap-4">
                        <h2 class="text-gray-600 font-bold text-xl">Cambiar metodo de pago</h2>
                        <div x-on:click="isOpenEditPaymentStatus=false" class="rounded-full shadow p-2 px-3 cursor-pointer">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <ul class="grid grid-cols-2 gap-2 gap-y-4 mt-8 relative">
                        @foreach ($accounts as $key => $account)
                                <x-jet-button 
                                x-on:click="
                                loading2=true;
                                loading3=true; 
                                $wire.payOrder({{ $sale }}, {{$key}} ).then(()=>{
                                    loading2=false;loading=false; isOpenEditPaymentStatus=false;
                                })"> {{ $account }} </x-jet-button>
                    
                        @endforeach
                        <x-jet-button 
                        x-on:click="
                        loading2=true;
                        loading3=true; 
                        $wire.payOrder({{ $sale }}, null ).then(()=>{
                            loading2=false;loading=false; isOpenEditPaymentStatus=false;
                        })"> Quitar pago </x-jet-button>
                        
                        <div class="hidden" :class="{'hidden': !loading2}">
                            <x-spinner.spinner2 size="8"></x-spinner.spinner2>
                        </div>
                    </ul>
                </div>
            </x-modal.modal2>
        </div>
   
    @endif
</div>
