<div class="text-secondary selectProductos" style="min-width: 200px">
    <div wire:loading.delay class="position-absolute">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
          </div>
    </div>
    <input type="hidden" class="indice" wire:model='indice'>
  
    <input type="hidden" wire:model='product_id' class="product_id"  name="products[]" >
    <input type="text" placeholder="Seleciona producto" class="form-control inputProducto" 
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

    @if ($showList)
        <div class="shadow bg-white position-absolute " style="min-width: 200px;max-height: 300px; overflow: auto; z-index: 10;">
            @forelse ($productos as $producto)
                <div class="cursor-pointer p-2 @if($index == $loop->iteration) bg-secondary @endif" style="cursor: pointer"
                    wire:click="setProductId('{{$producto->id}}','{{$producto->name}}')" 
                    wire:mouseover="marcarSeleccion({{ $loop->iteration }})"
                >
                    {{ $producto->name }}
                </div>
            @empty
                <div 
                wire:click="$set('showCreateProduct',true)"
                wire:mouseover='marcarSeleccion(1)'
                 class="cursor-pointer p-2 hover @if($index == 1) bg-secondary @endif" style="cursor: pointer;">
                    <div>
                        Crear Producto nuevo
                        <input type="hidden" class="productName" wire:model='query'>
                    </div>
                </div>
            @endforelse
        </div>
    @endif



    @if ($showCreateProduct)
        <div class="position-fixed bg-secondary" 
        style="top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        opacity: 0.5;"
        >
        </div>
        <div class="shadow p-1 m-1 position-absolute bg-white rounded" style="top: 0;bottom: 0;left: 0;right: 0;">
            <div wire:click="$set('showCreateProduct',false)" class="position-absolute p-2" style="right: 0; cursor: pointer;">
                <i class="fas fa-times"></i>
            </div>
           <h2 class="text-center">
               Producto Nuevo
            </h2> 
        </div>
    @else
        
    @endif

 

</div>