<div>
    <div wire:click="$set('open',true)" class="btn btn-secondary ml-5" style="width: 200px">Agregar Venta</div>
    
    @if ($open)
        <div class="position-fixed bg-secondary" style="top:0;bottom:0;left:0;right:0;opacity: 0.9"></div>
        
        
        <div class="position-absolute bg-white"  style="top:0;left:0;right:0; border-radius:5px" >
            <div class="container">
                <div wire:click="$set('open',false)" class="p-3 btn" style="float: right"><i class="fas fa-times"></i></div>
                <h3 class="py-3">Crear venta nueva</h3>
                <div class="row">
                    
                    @livewire('select.clientes', [
                        // 'customer_id' => $customer_id,
                        // 'query' => $customer_name,
                        'agregar_cliente' => false,
                        ])
                
                    {{-- FECHA --}}
                    <div class="form-group col-sm">
                        {!! Form::label('date', 'Fecha', ['class' => '']) !!}
                        {!! Form::date('date', null, ['class' => 'form-control', 'wire:model' => 'date']) !!}
                        @error('date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>

                
                <div wire:click="$set('openAddProduct',true)" class="btn btn-secondary">Agregar Producto</div>    
                @if ($openAddProduct)
                    <div class="position-fixed bg-secondary" style="top:0;bottom:0;left:0;right:0;opacity: 0.9"></div>

                    <div class="position-absolute bg-white"  style="top:0;left:0;right:0; border-radius:5px" >
                        <div class="container py-3">
                            <div wire:click="$set('openAddProduct',false)" class="p-3 btn" style="float: right"><i class="fas fa-times"></i></div>
                            <h2>Agregar Item Venta</h2>
                            <div class="">
                                @livewire('select.productos', [
                                    // 'product_id' => $item['product_id'],
                                    // 'query' => $item['product_name'] 
                                    ])

                                    <div>
                                        <input wire:model='cantidad' id='cantidad' wire:keyup='calculos' type="number" name='cantidad[]' class="form-control" style="min-width: 80px" wire:focus='showStock' wire:blur='hideStock' >
                                        @error('cantidad') <span class="error">{{ $message }}</span> @enderror
                                    </div>

                            </div>
                        </div>

                    </div>
                @endif



            </div>

            <div class="p-4" style="background: #f7f7f7; border-radius:5px" >

           
            
            </div>
        </div>
    @endif
</div>