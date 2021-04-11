<div>
    @if ($vista==0)
        @livewire('admin.pagos-pendientes.all', ['agregar_cliente' => ''])
    @else
        @livewire('admin.pagos-pendientes.customer-pending', ['customer_id' => $customer_id])
    @endif
</div>
