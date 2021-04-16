<div>
    <div wire:click="$set('open',true)" class="btn btn-secondary ml-5" style="width: 200px">Agregar Venta</div>
    
    @if ($open)
        <div class="position-fixed bg-secondary" style="top:0;bottom:0;left:0;right:0;opacity: 0.9"></div>
        
        
        <div class="position-absolute bg-white"  style="top:0;left:0;right:0; border-radius:5px" >
            <div wire:click="$set('open',false)" class="p-3 btn" style="float: right"><i class="fas fa-times"></i></div>
            <h3 class="p-4">Crear venta nueva</h3>
            <div class="p-4" >
                @livewire('select.clientes', ['user' => ''])

            </div>
            <div class="p-4" style="background: #f7f7f7; border-radius:5px" ></div>
        </div>
    @endif
</div>
