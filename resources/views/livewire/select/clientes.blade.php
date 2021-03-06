
<div class="text-secondary selectClientes form-group col-sm" style="min-width: 200px">

    <label for="">Nombre</label>
    <div class='d-flex'>
        
        <div wire:loading.delay class="position-absolute">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <input type="hidden" class="indice" wire:model='indice'>
        <input type="hidden" wire:model='customer_id' class="customer_id"  name="customer_id" >
        <input type="text" placeholder="Seleciona Cliente" class="form-control inputCliente" 
            wire:model='query'
            wire:focus="$set('showList',true)"       
            wire:blur="$set('showList',false)" 
            wire:keydown.arrow-down='incrementIndex'
            wire:keydown.arrow-up='decrementIndex'
            wire:keydown.enter.prevent='seleccionarOpcion'
            wire:keydown.arrow-left="$set('showList',true)" 
            wire:keydown.arrow-right="$set('showList',true)" 
            wire:keydown.Backspace="$set('showList',true)" 
        >
        @error('customer_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror

        @if ($agregar_cliente)
            <div class="p-1 ml-2 mb-1 rounded btn" style="width:40px">
                <a href="{{ route('admin.customers.create') }}"><i class="fas fa-user">+</i></a>
            </div>
        @endif
        

 
    </div>
    @if ($showList)
            <div class="shadow bg-white position-absolute " style="min-width: 200px;max-height: 300px; overflow: auto; z-index: 10;">
                @forelse ($clientes as $cliente)
                    <div class="cursor-pointer p-2 @if($index == $loop->iteration) bg-secondary @endif" style="cursor: pointer"
                        wire:click="setCustomerId('{{$cliente->id}}','{{$cliente->name}}')" 
                        wire:mouseover="marcarSeleccion({{ $loop->iteration }})"
                    >
                    {{ $cliente->name }} - {{ $cliente->direccion }}
                    </div>
                @empty
                    <div 
                    wire:click="$set('showCreateCustomer',true)"
                    wire:mouseover='marcarSeleccion(1)'
                    class="cursor-pointer p-2 hover @if($index == 1) bg-secondary @endif" style="cursor: pointer;">
                        <div>
                            Crear Cliente nuevo
                            <input type="hidden" class="customerName" wire:model='query'>
                        </div>
                    </div>
                @endforelse
            </div>
        @endif



        @if ($showCreateCustomer)
            <div class="position-fixed bg-secondary" 
            style="top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0.5;"
            >
            </div>
            <div class="shadow p-1 m-1 position-absolute bg-white rounded" style="top: 0;bottom: 0;left: 0;right: 0;">
                <div wire:click="$set('showCreateCustomer',false)" class="position-absolute p-2" style="right: 0; cursor: pointer;">
                    <i class="fas fa-times"></i>
                </div>
            <h2 class="text-center">
                Cliente Nuevo
                </h2> 
            </div>
        @else
            
        @endif

</div>
