<div>
    <div wire:click="$set('vista','0')" class=" p-2  btn @if($vista == 0) bg-secondary @endif">Todos</div>
    <div wire:click="$set('vista','1')"  class=" p-2  btn @if($vista == 1) bg-secondary @endif">Por cliente</div>
    
    @if ($vista==0)
        @livewire('admin.pagos-pendientes.all', ['agregar_cliente' => ''])
    @else
        @livewire('admin.pagos-pendientes.customer-pending', ['customer_id' => $customer_id])
    @endif
    
    


</div>
