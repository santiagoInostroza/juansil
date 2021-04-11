<div class="container">

    <div class="float-right ">
        <a href="{{ route('admin.customers.create') }}" class="btn btn-secondary"> Agregar Cliente</a>
    </div>
    <div>
        <div wire:click="$set('vista',0)" class="btn @if($vista == 0) btn-secondary @endif">Lista</div>
        <div wire:click="$set('vista',1)" class="btn @if($vista == 1) btn-secondary @endif">Pagos pendientes</div>
    </div>
    <hr>
    @if ($vista == 0)
        <h2>Lista de Clientes</h2>
        @livewire('admin.customers.lista', ['agregar_cliente' => ''])
    @elseif ($vista==1)
        <h2>Pagos Pendientes</h2>
        @livewire('admin.customers.pagos-pendientes', ['agregar_cliente' => ''])
    @elseif ($vista==2)
        @livewire('admin.customers.pagos-pendientes-por-usuario', ['customer_id' => $customer_id])
    @endif 
</div>
