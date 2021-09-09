<div>
    <x-modal.modal2>
        <x-slot name='titulo'>
            <div class="flex items-center justify-between">
                <h2 class="text-gray-600 font-bold text-xl px-6">
                        CREAR PRODUCTO
                </h2>
                <i x-on:click="closeCreateProduct" class="fas fa-times p-2 transform hover:scale-110 hover:bg-red-500 hover:text-white rounded"></i>
            </div>
        </x-slot>
        <div  class="relative p-4 px-6 w-screen md:w-max-content">
           
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 w-full">
                    {{-- <div wire:loading wire:target="photo"  class="w-full h-full">
                        <x-spinner.spinner size="10"></x-spinner.spinner>
                    </div> --}}

                    <div x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                        
                            <div class="cursor-pointer relative text-white font-bold">
                                @if ($photo)
                                    <div class="absolute inset-0 flex justify-center items-end ">
                                        <label for="photo" wire:loading.remove wire:target="photo">
                                            <div class="p-2 bg-gray-800 opacity-25 hover:opacity-75 text-white">
                                                EDITAR IMAGEN
                                            </div>
                                        </label>
                                    </div>
                                    <img class="w-full max-h-96 object-contain" src="{{ $photo->temporaryUrl() }}">
                                @else
                                    <div class="absolute inset-0 flex justify-center items-end">
                                        <label for="photo" wire:loading.remove wire:target="photo">
                                            <div class="p-2 bg-gray-800 opacity-25 hover:opacity-75 text-white">
                                                AGREGAR IMAGEN
                                            </div>
                                        </label>
                                    </div>
                                    <img class="w-full  max-h-96 object-contain" id='picture' src="{{asset('images/otros/sinFoto.webp')}}" alt="">
                                @endif
                            </div>
                        </label>
                    
                        <form>
                            <input type="file" class="hidden" id="photo" wire:model="photo">
                            {{-- @error('photo') <span class="error">{{ $message }}</span> @enderror    --}}
                            <x-jet-input-error for="photo" class="mt-2" />                    
                        </form>

                        <div x-show="isUploading">
                            <progress max="100" class="w-full" x-bind:value="progress"></progress>
                        </div>
                    </div>
                   
                   

                </div>

                <div class="col-span-2 grid grid-cols-2 gap-2">
                    <div class="col-span-2">
                        <x-jet-label>Estado</x-jet-label>
                        <div class="flex items-center justify-start py-2 gap-4">
                            <label class="switch">
                                <input type="checkbox" wire:model="isActive">
                                <span class="slider round"></span>

                            </label>
                            @if ($isActive)
                               <div class="text-green-600 font-bold"> ACTIVO </div>
                            @else
                               <div class="text-gray-300 font-bold"> INACTIVO </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-2 ">
                        <x-jet-label >Nombre</x-jet-label>
                        <x-jet-input class="w-full" wire:model.defer="name" ></x-jet-input>
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label>Formato</x-jet-label>
                        <x-jet-input wire:model.defer="formato" type="number" class="w-full" ></x-jet-input>
                        <x-jet-input-error for="formato" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label>Stock Min</x-jet-label>
                        <x-jet-input wire:model.defer="stock_min" type="number" class="w-full" ></x-jet-input>
                        <x-jet-input-error for="formato" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label>Marca</x-jet-label>
                        <x-dropdowns.dropdown wire:model.lazy="brand"  :items="$brands"  id="searchBrands"></x-dropdowns.dropdown>
                        {{-- <x-dropdowns.dropdown  wire:model.lazy="supplier_id" :items="$suppliers" placeholder="Ingresa nombre del proveedor" id="searchSupliers"></x-dropdowns.dropdown> --}}
                     
                        <x-jet-input-error for="brand" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label>Categoria</x-jet-label>
                        <x-dropdowns.dropdown wire:model.lazy="category" :items="$categories"  id="searchCategory">
                        </x-dropdowns.dropdown>
                        <x-jet-input-error for="category" class="mt-2" />
                    </div>
                   
                    <div class="col-span-2">
                        <x-jet-label>Etiquetas</x-jet-label>
                        <div x-data="{openAddTag:false,loading:false,tags:[],etiquetas:[], open:false,loading2:false,nameTag:'',typeTag:''}" class="p-2 border rounded flex flex-col  gap-1">
                            <div  class="flex items-center justify-start gap-2">
                                <template x-for="(tag,index ) in tags" :key="tag.id">
                                    <div :id="tag.id" class="flex items-center gap-1" >
                                        <div x-text="tag.nombre" class="px-2 border rounded-full shadow bg-red-50"></div>  
                                        <div x-on:click="tags.splice(index,1);$wire.etiquetas=etiquetas" class=" cursor-pointer"><i class="far fa-trash-alt"></i></div>
                                    </div>
                                </template>
                            </div>
                            <div class="flex justify-center items-center gap-4">   
                                <div class="relative">
                                    <div  x-on:click="openAddTag=true" class="px-2 my-2 border shadow rounded-full w-max-content hover:bg-green-400 hover:text-white  cursor-pointer transform hover:scale-125">
                                        Agregar existente
                                    </div>
                                    <template x-if="openAddTag">
                                        <div x-show="openAddTag" x-on:click.away="openAddTag = !openAddTag" class="hidden" :class="{'hidden': !openAddTag}">
                                            <x-modal.modal2>
                                                <div class="p-4 ">
                                                    <h3 class="text-xl font-bold text-gray-600 mb-2 text-center">Etiquetas</h3>
                                                    <x-dropdowns.dropdown :items="$tags" id="searchTag"></x-dropdowns.dropdown>
                                                    <div class=" flex justify-around items-center bg-white w-full  p-3 rounded">
                                                        <i class="fas fa-check p-1 text-green-400 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" 
                                                        x-on:click="
                                                            openAddTag=false; 
                                                            if(document.getElementById('buscador_searchTag').value !=''){ 
                                                                etiquetas.push(document.getElementById('buscador_searchTag').value);
                                                                $wire.etiquetas=etiquetas;
                                                                tags.push( {
                                                                    id: document.getElementById('buscador_searchTag').value,
                                                                    nombre : document.getElementById('searchField_searchTag').value, 
                                                                } );   
                                                        } "></i>
                                                        <i class="fas fa-times p-1 text-red-500 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="openAddTag=false"></i>
                                                    </div>
                                                </div>
                                            </x-modal.modal2>
                                        </div>
                                    </template>
                                    <template x-if="loading">
                                        <div>
                                            <div x-show="loading" class="absolute z-10 inset-0 bg-gray-800 opacity-25 hidden" :class="{'hidden' : !loading}"></div>
                                            <div x-show="loading" class="absolute z-10 inset-0 flex items-center justify-center hidden" :class="{'hidden' : !loading}">
                                                <x-spinner.spinner size="8"  class="spinner"></x-spinner.spinner>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div>
                                    <div x-on:click="open=true">
                                        <div  class="px-2 my-2 border shadow rounded-full w-max-content hover:bg-green-400 hover:text-white  cursor-pointer transform hover:scale-125">
                                            Crear nuevo
                                        </div>
                                        {{-- <x-jet-button>Nueva</x-jet-button> --}}
                                        <div x-show="loading2">
                                            <x-spinner.spinner2></x-spinner.spinner2>
                                        </div>
                                    </div>
                                    <template x-if="open">
                                    
                                            <x-modal.modal2>
                                                <div class="p-2 grid gap-2">
                                                    <div class="flex justify-between items-center gap-4">
                                                        <div class="text-xl uppercase font-bold text-gray-600">Agregar etiqueta</div>
                                                        <div x-on:click="open=false" class="p-1 px-3 cursor-pointer hover:bg-red-500 hover:text-white border shadow rounded-full">
                                                            <i class="fas fa-times"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <x-jet-label>Nombre</x-jet-label>
                                                        <x-jet-input x-model="nameTag" class="w-full"></x-jet-input>
                                                    </div>
                                                    <div>
                                                        <x-jet-label>Tipo</x-jet-label>
                                                        <select name="" id="" x-ref="typeTag" class="p-2 border shadow rounded w-full">
                                                            <option value="1">Nombre</option>
                                                            <option value="2">Grupo</option>
                                                            <option value="3">Especial</option>
                                                        </select>
                                                    </div>   
                                                    <div class="mt-4">
                                                        <x-jet-button class="w-full text-center" 
                                                        x-on:click="
                                                        loading=true;
                                                        open=false;
                                                        $wire.saveNewTag(nameTag,$refs.typeTag.value)
                                                        .then( response => { 
                                                            loading=false; 
                                                            tags.push( {nombre: nameTag, id:response} ) ;
                                                            etiquetas.push(response); 
                                                            $wire.etiquetas=etiquetas;
                                                        });
                                                            "
                                                            >Agregar</x-jet-button>    
                                                    </div>                                         
                                                </div>
                                            </x-modal.modal2>
                                    
                                    </template>
                                </div>
                            </div>
                        </div>
                        <x-jet-input-error for="etiquetas" class="mt-2" />
                       
                    </div>
                   

                    <div class="col-span-2">
                        <x-jet-label  type="number" >Precio de venta</x-jet-label>
                        <div class="border rounded p-2">
                            <div x-data="agregarPreciosMain()">
                                <div class="flex">
                            
                                    @if ($salePrices)
                                              
                                        @foreach ($salePrices as $precio)
                                            <div class="shadow rounded inline-block p-2 my-2 mr-2 @if ($precio['check']) bg-green-100  text-green-600 @else bg-red-100  text-red-600 @endif">
                                              
                                                <div class="m-auto w-max-content text-sm">
                                                    x {{ $precio['quantity'] }}
                            
                                                    @if ($precio['price'] != $precio['total_price'])
                                                        ${{ number_format($precio['total_price'],0,',','.') }}
                                                    @endif
                                                </div>
                                                <div class="text-xl text-center">${{ number_format($precio['price'],0,',','.') }}</div>
                            
                                                @if ($precio['check'])    
                                                    <div class="text-sm">Precio registrado</div>
                                                    <div class="text-red-800 text-center cursor-pointer hover:font-bold" wire:click="eliminarPrecio({{ $precio['quantity'] }})"> Eliminar </div>
                                                @else  
                                                    <div class="text-sm text-red-400 font-bold">Este precio se eliminará</div>
                                                    <div wire:click='restaurarPrecio({{ $precio['quantity'] }})' class="text-green-800 text-center cursor-pointer hover:font-bold">restaurar</div>
                                                @endif
                            
                                            </div>
                            
                                        @endforeach
                                    @endif
                                    <x-jet-secondary-button x-on:click="open=true">+ Agregar precio</x-jet-secondary-button>
                                </div>
                            
                                <div x-show="open">
                                    <x-modal.modal2>
                                        <x-slot name="titulo">
                                            <h2 class="font-bold text-xl text-gray-600 uppercase text-center">Agregar precio</h2>
                                        </x-slot>
                                        <div class="flex flex-col gap-4 p-4 rounded ">
                                            <x-jet-label>
                                                Desde
                                                <x-jet-input x-on:keyup="calcular(1)"  type="number" x-ref="cantidad" wire:model.defer='cantidad' class="w-full"></x-jet-input>
                                            </x-jet-label>
                            
                                            <x-jet-label>
                                                Precio Unitario
                                                <x-jet-input  x-on:keyup="calcular(2)"  type="number"  x-ref="precio_unitario" wire:model.defer='precio_unitario' class="w-full"></x-jet-input>
                                            </x-jet-label>
                            
                                            <x-jet-label>
                                                Precio Total
                                                <x-jet-input  x-on:keyup="calcular(3)"  type="number"  x-ref="precio_total" wire:model.defer='precio_total' class="w-full"></x-jet-input>
                                            </x-jet-label>
                            
                                            <x-slot name="footer">
                                                <div class="flex justify-between gap-4 mx-2">                    
                                                    <x-jet-button  wire:click='agregarPrecio' class="btn btn-light my-3">GUARDAR</x-jet-button>
                                                    <x-jet-button  x-on:click="open=false" class="btn btn-primary my-3">Cancelar</x-jet-button>
                                                </div>
                                            </x-slot>
                            
                                            
                                        </div>
                                    </x-modal.modal2>
                                
                                </div>
                            
                                @push('js')
                                    <script>
                                        function agregarPreciosMain(){
                                            return {
                                                open:@entangle('openAgregarPrecios'),
                                                calcular(tipo){
                                                    cantidad = this.$refs.cantidad.value;
                                                    precio_unitario = this.$refs.precio_unitario.value;
                                                    precio_total = this.$refs.precio_total.value;
                            
                                                    if(tipo == 1){
                                                        if(precio_unitario =="" && precio_total != ""){
                                                            this.$refs.precio_unitario.value =  precio_total / cantidad
                                                        }
                                                        if(precio_unitario !="" && precio_total == ""){
                                                            this.$refs.precio_total.value = cantidad * precio_unitario
                                                        }
                                                        if(precio_unitario !="" && precio_total != ""){
                                                            this.$refs.precio_total.value = cantidad * precio_unitario
                                                        }
                                                    }
                            
                                                    if(tipo == 2){
                                                        if(cantidad =="" && precio_total != ""){
                                                            this.$refs.cantidad.value = precio_total / precio_unitario
                                                        }
                                                        if(cantidad !="" && precio_total == ""){
                                                            this.$refs.precio_total.value = cantidad * precio_unitario
                                                        }
                                                        if(precio_unitario !="" && precio_total != ""){
                                                            this.$refs.precio_total.value = cantidad * precio_unitario
                                                        }
                                                    }
                            
                                                    if(tipo == 3){
                                                        if(cantidad =="" && precio_unitario != ""){
                                                            this.$refs.cantidad.value = precio_total / precio_unitario
                                                        }
                                                        if(cantidad !="" && precio_unitario == ""){
                                                            this.$refs.precio_unitario.value = precio_total / cantidad
                                                        }
                                                        if(precio_unitario !="" && precio_total != ""){
                                                            this.$refs.cantidad.value = precio_total / precio_unitario
                                                        }
                                                    }
                                                    this.$refs.cantidad.dispatchEvent(new Event('input'));
                                                    this.$refs.precio_unitario.dispatchEvent(new Event('input'));
                                                    this.$refs.precio_total.dispatchEvent(new Event('input'));
                                                },
                            
                                            }
                                        }
                                    </script>
                                @endpush                            
                            </div>
                        </div>
                        {{-- <x-jet-input-error for="formato" class="mt-2" /> --}}
                    </div>  
                          
                    <div class="col-span-2">
                        <x-jet-label>Precio de venta especial</x-jet-label>
                        <x-jet-input class="w-full" wire:model="special_sale_price"></x-jet-input>
                        <x-jet-input-error for="special_sale_price" class="mt-2" />
                    </div>

                    <div class="col-span-2" wire:ignore>
                        <x-jet-label>Descripcion</x-jet-label>
                        <textarea wire:model="description" class="w-full border rounded editor" id="editor"></textarea>
                        <x-jet-input-error for="description" class="mt-2" /> 
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-8 mt-8">
                <x-jet-button wire:click="save">Crear</x-jet-button>
                <x-jet-button x-on:click="closeCreateProduct">Cancelar</x-jet-button>
            </div>

        </div>
       
    </x-modal.modal2>

    @push('js')   
        <script>
            $(document).ready(function() {
                $('.selectMultiple').on('change',function(){
                    @this.set( 'etiquetas', $(this).val() );
                });
            });
        </script>

        
        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
            } );
        </script>
     @endpush
</div>