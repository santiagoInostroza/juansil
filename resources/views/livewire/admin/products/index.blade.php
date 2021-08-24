<div id="productsMain" x-data="productsMain()">
    <div>
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-600 py-4">PRODUCTOS</h1>
            <x-jet-button x-on:click="openCreateProduct" >Agregar Producto</x-jet-button>
        </div>
        <div class="my-4">
           
        </div>
        <div class="my-4 p-4 border rounded flex gap-2 items-center">
            <x-jet-input class="w-full" wire:model="search" placeholder="Buscar..."></x-jet-input>
            <label for="onlyStock" class="flex justify-center flex-col items-center">
                <div class="w-max-content">Solo stock</div>
                <label class="switch">
                    <input id="onlyStock" type="checkbox" wire:model="onlyStock">
                    <span class="slider round"></span>
                </label>
            </label>
        </div>
        <div>
          
         <x-table>
             <table class="min-w-full divide-y divide-gray-200">
                 <thead class="bg-gray-50">
                     <tr>
                         {{-- ID --}}
                         <th  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer @if ($sort == 'products.id' ) font-bold text-gray-700 @endif" style="" wire:click="order('products.id')">
                             <div class="flex justify-center items-center ">
                                 <div>Id</div>
                                 <div class="pl-2">  
                                     @if ($sort == 'products.id' )
                                         @if ($direction == 'asc')
                                             <i class="fas fa-sort-up"></i>
                                         @else
                                             <i class="fas fa-sort-down"></i>
                                         @endif
                                     @else
                                         <i class="fas fa-sort"></i> 
                                     @endif
                                 </div>
                                     
                             </div>
                         </th>
                         {{-- NOMBRE --}}
                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer  @if ($sort == 'products.name' ) font-bold text-gray-700 @endif" wire:click="order('products.name')">
                            <div class="flex justify-center items-center ">
                                <div>NOMBRE</div>
                                <div class="pl-2"> 
                                     @if ($sort == 'products.name' )
                                         @if ($direction == 'asc')
                                             <i class="fas fa-sort-up"></i>
                                         @else
                                             <i class="fas fa-sort-down"></i>
                                         @endif
                                     @else
                                         <i class="fas fa-sort"></i> 
                                     @endif
                                </div>
                            </div>
                         </th>
                         {{-- ETIQUETAS --}}
                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                             <div class="flex justify-center items-center ">
                                 ETIQUETAS
                             </div>
                         </th>
                         {{-- Description --}}
                         <th class=" py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer ">
                             <div class="flex justify-center items-center ">
                                 DESCRIPCION
                             </div>
                         </th>
                         {{-- Stock --}}
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer " >
                            <div class="flex justify-center items-center ">STOCK</div>
                        </th>

                         {{-- Costo--}}
                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer ">
                             <div class="flex justify-center items-center ">
                                 Costo
                             </div>
                         </th>

                         {{-- VENTA--}}
                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer ">
                             <div class="flex justify-center items-center ">
                                 VENTA
                             </div>
                         </th>

                         {{-- PRECIO ESPECIAL--}}
                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer ">
                             <div class="flex justify-center items-center ">
                                 ESPECIAL
                             </div>
                         </th>

                          {{-- Estado --}}
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" >
                            <div class="flex justify-center items-center ">
                                Estado
                            </div>
                         </th>

                         {{-- ACCION --}}
                         <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer ">
                            
                             {{-- <span class="sr-only">Accion</span> --}}
                         </th>
                     </tr>
                 </thead>
                 
                 <tbody class="bg-white divide-y divide-gray-200 text-gray-600">
                    @foreach ($products as $product)
                     <tr>
                         {{-- ID --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center font-bold text-gray-600">
                                {{$product->id}}
                            </div>
                        </td>
                        {{-- NOMBRE --}}
                        <td class="px-6 py-4  whitespace-nowrap ">
                            <div class="flex justify-between items-center gap-4 w-max-content" >
                                @if ($product->image)
                                    <figure><img class=" rounded h-24 w-24 object-cover transform hover:scale-150 transition-all duration-500 ease-in-out delay-75" src="{{ Storage::url($product->image->url) }}" alt=""></figure>
                                @endif
                                <div class="grid w-full">
                                    <div id="nombre_{{ $product->id }}" class="text-sm text-gray-500 hover:bg-gray-100  flex justify-between items-center relative w-full p-1 px-2 rounded" 
                                        x-data="{ 
                                            change : true, 
                                            edit: false,
                                            product_id: '',
                                            openChange(){
                                                this.change=false;
                                                this.edit=false;
                                            },
                                            closeChange(){
                                                this.change=true;
                                                this.edit=true;
                                            },
                                            save(){
                                                name = this.$refs.name.value;                               
                                                this.$wire.saveName(this.product_id,name).then(element=> this.change=true); 
                                            }, 

                                        }" 
                                        x-on:mouseenter="edit = true"
                                        x-on:mouseleave="edit = false"
                                        x-on:dblclick="openChange"
                                        x-init="product_id={{ $product->id }}">
                                        <div class="flex justify-start gap-x-1 h-6">
                                            <div  x-show="change" class="w-max-content font-bold"> {{ $product->name }}</div>
                                            <div  x-show="!change" class="flex items-center hidden absolute top-0 left-0 pr-1 bg-white gap-x-2 z-10" :class="{'hidden': change}" x-on:click.away="change = !change">
                                                <x-jet-input x-ref="name" name="name" class="p-1" value="{{ $product->name }}"/>
                                                <i class="fas fa-check p-1 text-green-400 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="save"></i>
                                                <i class="fas fa-times p-1 text-red-500 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="closeChange"></i>
                                            </div>
                                        </div>                                     
                                        <div x-show="edit" class="cursor-pointer hidden absolute right-0 bg-gray-100  p-1 px-2 rounded " :class="{'hidden' : !edit}" x-on:click="openChange"><i class="fas fa-pen"></i></div>
                                    </div>

                                    {{-- MARCA --}}
                                    <div id="marca_{{ $product->id }}" class="text-sm text-gray-500 hover:bg-gray-100  flex justify-between items-center relative  p-1 px-2 rounded  w-full" 
                                        x-data="{ 
                                            change : true, 
                                            edit: false,
                                            product_id: '',
                                            openChange(){
                                                this.change=false;
                                                this.edit=false;
                                            },
                                            closeChange(){
                                                this.change=true;
                                            },
                                            save(){
                                                brand = this.$refs.brand.value;                                            
                                                this.$wire.saveBrand(this.product_id,brand).then(element=> this.change=true); 
                                            }, 
                                        }"
                                        x-on:dblclick="openChange" 
                                        x-on:mouseenter="edit = true"  
                                        x-on:mouseleave="edit = false" 
                                        x-init=" product_id = {{$product->id}} ;">
                                        <div class="flex justify-start gap-x-1">
                                            <div>Marca: </div>
                                            <div x-show="change">{{ $product->brand->name }}</div>
                                            <div x-show="!change" class="absolute top-0 left-13 z-10 | flex items-center gap-x-2 | bg-white | hidden" :class="{'hidden': change}" wire:ignore x-on:click.away="change = !change">
                                                <select x-ref="brand" class="select w-40" name="brand">
                                                    @foreach ($brands as $brand)
                                                        <option value="{{$brand->id}}" @if( $product->brand->id == $brand->id) selected @endif>{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                                <i class="fas fa-check p-1 text-green-400 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="save"></i>
                                                <i class="fas fa-times p-1 text-red-500 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="closeChange"></i>
                                            </div>
                                        </div>
                                        <div x-show="edit" class="cursor-pointer hidden absolute right-0 bg-gray-100  p-1 px-2 rounded " :class="{'hidden' : !edit}" x-on:click="openChange"><i class="fas fa-pen"></i></div>
                                    </div>

                                    {{-- FORMATO --}}
                                    <div id="formato_{{ $product->id }}" class="text-sm text-gray-500 hover:bg-gray-100  flex justify-between items-center relative  p-1 px-2 rounded  w-full" 
                                        x-on:dblclick="openChange" 
                                        x-on:mouseenter="edit = true"  
                                        x-on:mouseleave="edit = false" 
                                        x-data="{ 
                                            change : true, 
                                            edit: false,
                                            product_id: '',
                                            openChange(){
                                                this.change=false;
                                                this.edit=false;
                                            },
                                            closeChange(){
                                                this.change=true;
                                            },
                                            save(){
                                                formato = this.$refs.formato.value;                                            
                                                this.$wire.saveFormato(this.product_id,formato).then(element=> this.change=true); 
                                            }, 
                                        }" x-init=" product_id = {{$product->id}} ;">
                                        <div class="flex justify-start gap-x-1">
                                            <div>Formato: </div>
                                            <div x-show="change">{{ $product->formato }}</div>
                                            <div x-show="!change" class="absolute top-0 left-16 z-10 flex items-center gap-x-2 bg-white hidden " :class="{'hidden': change}" x-on:click.away="change=!change">
                                                <x-jet-input x-ref="formato" name="name" class="p-0 px-2 w-20" value="{{ $product->formato }}"/>
                                                <i class="fas fa-check p-1 text-green-400 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="save"></i>
                                                <i class="fas fa-times p-1 text-red-500 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="closeChange"></i>
                                            </div>
                                        </div>
                                        <div x-show="edit" class="cursor-pointer hidden absolute right-0 bg-gray-100  p-1 px-2 rounded " :class="{'hidden' : !edit}" x-on:click="openChange"><i class="fas fa-pen"></i></div>
                                    </div>

                                    {{-- CATEGORIA --}}
                                    <div id="categoria_{{ $product->id }}" class="text-sm text-gray-500 hover:bg-gray-100  flex justify-between items-center relative  p-1 px-2 rounded  w-full" 
                                        x-on:dblclick="openChange" 
                                        x-on:mouseenter="edit = true"  
                                        x-on:mouseleave="edit = false" 
                                        x-data="{ 
                                            change : true, 
                                            edit: false,
                                            product_id: '',
                                            openChange(){
                                                this.change=false;
                                                this.edit=false;
                                            },
                                            closeChange(){
                                                this.change=true;
                                            },
                                            save(){
                                                categoria = this.$refs.categoria.value;     
                                                console.log(categoria);
                                                console.log({{$product->category_id}});
                                                this.$wire.saveCategoria(this.product_id,categoria).then(element=> this.change=true); 
                                            }, 
                                        }" x-init=" product_id = {{$product->id}} ;">
                                        <div class="flex justify-start gap-x-1">
                                            <div>Categoria: </div>
                                            <div x-show="change">{{ $product->category->name }}</div>
                                            <div x-show="!change" class="absolute top-0 left-20 z-10  flex items-center gap-x-2 bg-white hidden" :class="{'hidden': change}" x-on:click.away="change = !change">
                                                <select x-ref="categoria" class="select w-40 p-2" name="brand">
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->id}}" @if( $product->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                <i class="fas fa-check p-1 text-green-400 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="save"></i>
                                                <i class="fas fa-times p-1 text-red-500 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="closeChange"></i>
                                            </div>
                                        </div>
                                        <div x-show="edit" class="cursor-pointer hidden absolute right-0 bg-gray-100  p-1 px-2 rounded " :class="{'hidden' : !edit}" x-on:click="openChange"><i class="fas fa-pen"></i></div>
                                    </div> 

                                </div>
                            </div>
                        </td>
                         {{-- ETIQUETAS --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="relative">
                                <div class="flex flex-col items-center justify-start p-4">
                                    @foreach ($product->tags as $tag)
                                        <div x-data="{openRemove:false,product_id:'',tag_id:'', loading:false}" x-init="product_id = {{$product->id}}; tag_id={{$tag->id}}" class="relative p-1" x-on:mouseenter="openRemove=true" x-on:mouseleave="openRemove=false">
                                            <div  class="px-1 border rounded-full bg-orange-200 ">{{$tag->name}}</div>
                                            <div x-on:click="{loading=true; $wire.removeTag(product_id,tag_id).then( ()=> loading=false) }" x-show="openRemove" class="absolute top-0 right-0 transform translate-x-4 p-1 bg-white cursor-pointer hidden" :class="{'hidden': !openRemove}"><i class="fas fa-trash"></i></div>
                                            <div x-show="loading" class="absolute z-10 inset-0 bg-gray-800 opacity-25 hidden" :class="{'hidden' : !loading}"></div>
                                            <div x-show="loading" class="absolute z-10 inset-0 flex items-center justify-center hidden" :class="{'hidden' : !loading}">
                                                <x-spinner.spinner size="8"  class="spinner"></x-spinner.spinner>
                                            </div>
                                        </div>
                                    @endforeach
                                </div> 
                                <div id="etiquetas_{{ $product->id }}" 
                                    x-data="{ openAddTag: false,  valor: '',   product_id: '', loading: false, 
                                        addTag(){
                                            
                                            valor = document.getElementById('buscador_searchTag_{{ $product->id }}').value;
                                            console.log(valor);
                                            if(valor !=''){
                                                this.loading=true; 
                                                this.$wire.saveTag(this.product_id, valor)
                                                .then( resp => { 
                                                    if(resp){
                                                        this.openAddTag=false;
                                                    }
                                                    console.log(resp);
                                                    this.loading=false; 
                                                })
                                            } 
                                        } 
                                    }" 
                                    x-init="product_id={{$product->id}}" >
                                    <div class="flex justify-center">
                                        <div x-on:click="openAddTag=true" class="px-2 border shadow rounded-full hover:bg-green-400 hover:text-white  cursor-pointer transform hover:scale-125">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                   
                                    <div x-show="openAddTag" x-on:click.away="openAddTag = !openAddTag" class="hidden" :class="{'hidden': !openAddTag}">
                                       
                                        <div class="absolute bottom-0 z-10 w-52 flex items-center justify-center">
                                            <x-dropdowns.dropdown :items="$tags" id="searchTag_{{ $product->id }}"></x-dropdowns.dropdown>
                                            <div class=" flex justify-around items-center bg-white w-full  p-3 rounded">
                                                <i class="fas fa-check p-1 text-green-400 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="addTag"></i>
                                                <i class="fas fa-times p-1 text-red-500 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="openAddTag=false"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-show="loading" class="absolute z-10 inset-0 bg-gray-800 opacity-25 hidden" :class="{'hidden' : !loading}"></div>
                                    <div x-show="loading" class="absolute z-10 inset-0 flex items-center justify-center hidden" :class="{'hidden' : !loading}">
                                        <x-spinner.spinner size="8"  class="spinner"></x-spinner.spinner>
                                    </div>
                                </div> 
                            </div>
                        </td>
                        {{-- Description --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if ( $product->description )     
                                <div  id="descripcion_{{ $product->id }}"  x-data="{
                                    open:false,
                                    }"  x-on:mouseenter="open = true" x-on:mouseleave="open=false" >
                                    <i class="fas fa-comment cursor-pointer"></i>
                                    <div x-show="open"
                                        x-transition:enter="transition ease-out duration-1000" 
                                        x-transition:enter-start="opacity-0 transform scale-90"  
                                        x-transition:enter-end="opacity-100 transform scale-100"  
                                        x-transition:leave="transition ease-in duration-1000"  
                                        x-transition:leave-start="opacity-100 transform scale-100"  
                                        x-transition:leave-end="opacity-0 transform scale-90"
                                        class="hidden absolute shadow-lg rounded border p-4 bg-white transform -translate-x-6/12 -translate-y-6/12 z-10" :class="{'hidden': !open}">
                                        {!!$product->description!!}
                                    </div>
                                </div>
                            @endif                                   
                        </td>
                        {{--Stock--}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="w-max-content font-bold">Stock {{$product->stock}}</div>
                            <div id="stock_{{ $product->id }}" x-data="{open:false,show:false,valor:''}" x-init="valor={{ $product->stock_min }}" x-on:mouseover="show=true" x-on:mouseleave="show=false">
                                <div  x-show="!open" class="relative" >
                                    <div class="w-max-content py-2 hover:bg-gray-100 rounded">Min {{$product->stock_min}}</div>
                                    <div x-show="show" x-on:click="open=true" class="absolute right-0 transform translate-x-2  top-0 p-2 hidden cursor-pointer bg-white" :class="{'hidden':!show}"><i class="fas fa-pen"></i></div>
                                </div>
                                <div x-show="open"  x-on:click.away="open=false" class="hidden relative" :class="{'hidden':!open}">
                                    <x-jet-input x-model="valor" class="w-16"></x-jet-input>
                                    <div class="absolute top-1 right-6" wire:loading>
                                        <x-spinner.spinner size="8"  class="spinner"></x-spinner.spinner>
                                    </div>
                                    <div x-ref="btns" class="absolute w-20 flex justify-around items-center bg-white shadow p-2 rounded right-0 top-0 transform translate-x-20">
                                        <i class="fas fa-check p-1 text-green-400 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="$wire.setStockMin({{ $product->id }},valor).then(elmnt=>open=false)"></i>
                                        <i class="fas fa-times p-1 text-red-500 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="open=false"></i>
                                    </div>
                                </div>

                            </div>
                        </td>

                          {{--COSTO--}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($product->purchasePrices->count())
                                <div class="text-sm text-gray-500 max-h-96 overflow-auto rounded w-max-content"> 
                                    @foreach ($product->purchasePrices as $precio)
                                        {{-- @if (!$mostrarTodosLosProductos && $precio->stock <=0)
                                            @continue
                                        @endif --}}
                                        <div class="grid grid-cols-2 hover:bg-gray-100 p-1 w-max-content text-center">
                                            <div class="">
                                                {{$precio->stock}}/<span class="font-bold">{{$precio->cantidad}}</span>
                                            </div>
                                            <div class="" style="min-width: 45px">
                                                ${{number_format($precio->precio,0,',','.')}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </td>

                        {{-- PRECIO VENTA --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @foreach ($product->salePrices as $price)
                                <div id="precioVenta_{{$price->id}}" x-data="{ openEdit:false, openRemove:false, show:false , valor:'', valor_por_caja:'' , quantity:'' , price_id:'' }" x-init="valor_por_caja={{$price->total_price}}; valor={{$price->price}}; quantity={{$price->quantity}}; price_id={{ $price->id }}" x-on:mouseover="show=true" x-on:mouseleave="show=false">
                                    <div class="relative">
                                        <div class="flex p-2 hover:bg-gray-100 rounded">
                                            <div class="w-max-content">  
                                                {{$price->quantity}} x ${{number_format($price->total_price,0,',','.')}}  
                                            </div>
                                            @if ($price->total_price != $price->price)
                                                <div class="text-red-500 px-2"> (${{number_format($price->price,0,',','.')}}) </div> 
                                            @endif
                                        </div>
                                        <div x-show="show" class="absolute right-0 top-0 transform translate-x-14  bg-white cursor-pointer flex items-center gap-1 hidden" :class="{'hidden': !show}" >
                                            <div x-on:click="openEdit=true" class="border rounded shadow p-2"> <i class="fas fa-pen  transform hover:scale-110"></i> </div>
                                            <div x-on:click="$wire.removePrice(price_id)"  class="border rounded shadow p-2"><i class="far fa-trash-alt  transform hover:scale-110 hover:bg-red-200"></i> </div> 
                                        </div>                                        
                                        <div x-show="openEdit" x-on:click.away="openEdit=false" class="hidden" :class="{'hidden' : !openEdit}">
                                            <div class="absolute z-20 p-2 shadow border rounded  bg-white transform -translate-x-3/12 -translate-y-6/12">
                                                <div class=" flex items-center gap-2">
                                                    <div>
                                                        <x-jet-label>Cantidad</x-jet-label>
                                                        <x-jet-input class="w-14" x-model="quantity" type="number"  x-on:keyup="{ valor_por_caja = quantity * valor }" required></x-jet-input>
                                                    </div>
                                                    <div>
                                                        <x-jet-label>Valor</x-jet-label>
                                                        <x-jet-input  class="w-20" x-model="valor" type="number" x-on:keyup="{ valor_por_caja = Math.round(quantity * valor) }" required></x-jet-input>
                                                    </div>
                                                    <div>
                                                        <x-jet-label>Valor x caja</x-jet-label>
                                                        <x-jet-input class="w-24" x-model="valor_por_caja" type="number" x-on:keyup="{ valor = valor_por_caja / quantity }" required></x-jet-input>
                                                    </div>
                                                </div>
                                                <div class="flex items-center justify-around pt-4">
                                                    <div><i class="fas fa-check p-1 text-green-400 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="$wire.setSalePrice(price_id,quantity, valor,valor_por_caja).then(elmnt=>openEdit=false)"></i></div>
                                                    <div> <i class="fas fa-times p-1 text-red-500 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="openEdit=false"></i></div>
                                                </div>
                                                <div class="absolute inset-0 bg-gray-800 opacity-25" wire:loading>
                                                </div>
                                                <div class="absolute inset-0 flex justify-center items-center" wire:loading.flex>
                                                    <x-spinner.spinner size="8"  class="spinner"></x-spinner.spinner>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div  id="precio_venta_{{ $product->id }}" x-data="{open:false,product_id:'',quantity:'',valor:'',valor_por_caja:''}" x-init="product_id={{$product->id}}">
                                <div class="flex justify-center">
                                    <div x-on:click="open=true" class="px-2 border shadow rounded-full hover:bg-green-400 hover:text-white  cursor-pointer transform hover:scale-125">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div x-show="open" class="hidden" :class="{'hidden':!open}">
                                    <div class="absolute z-20 p-2 shadow border rounded  bg-white transform -translate-x-3/12 ">
                                        <div class=" flex items-center gap-2">
                                            <div>
                                                <x-jet-label>Cantidad</x-jet-label>
                                                <x-jet-input class="w-14" x-model="quantity" type="number"  x-on:keyup="{ valor_por_caja = quantity * valor }" required></x-jet-input>
                                            </div>
                                            <div>
                                                <x-jet-label>Valor</x-jet-label>
                                                <x-jet-input  class="w-20" x-model="valor" type="number" x-on:keyup="{ valor_por_caja = Math.round(quantity * valor) }" required></x-jet-input>
                                            </div>
                                            <div>
                                                <x-jet-label>Valor x caja</x-jet-label>
                                                <x-jet-input class="w-24" x-model="valor_por_caja" type="number" x-on:keyup="{ valor = valor_por_caja / quantity }" required></x-jet-input>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-around pt-4">
                                            <div><i class="fas fa-check p-1 text-green-400 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="$wire.createSalePrice(product_id, quantity, valor,valor_por_caja).then(elmnt=>openEdit=false)"></i></div>
                                            <div> <i class="fas fa-times p-1 text-red-500 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="open=false"></i></div>
                                        </div>
                                        <div class="absolute inset-0 bg-gray-800 opacity-25" wire:loading>
                                        </div>
                                        <div class="absolute inset-0 flex justify-center items-center" wire:loading.flex>
                                            <x-spinner.spinner size="8"  class="spinner"></x-spinner.spinner>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </td>

                          {{-- Precio ESPECIAL  --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex flex-col items-center justify-center">
                                <div id="precio_especial_{{ $product->id }}" x-data="{openEdit:false, open:false, valor:''}"  x-init="valor = @if($product->special_sale_price != null)  {{$product->special_sale_price}} @else 0 @endif " x-on:mouseenter="openEdit=true" x-on:mouseleave="openEdit=false">
                                    <div x-show="!open" class="relative p-2  font-bold w-20 hover:bg-gray-100 rounded hover:border">
                                        ${{ number_format($product->special_sale_price,0,',','.')}}
                                        <div x-show="openEdit" class="hidden absolute transform right-0 translate-x-4 top-0 p-2 bg-white cursor-pointer shadow border rounded" :class="{'hidden':!openEdit}"  x-on:click=" open=true;  setTimeout(() => { $refs.valor.focus(); }, 200);">
                                            <i class=" fas fa-pen" ></i>
                                        </div>
                                    </div>
                                    <div x-show="open" x-on:click.away="open = false" class="hidden relative" :class="{'hidden' : !open}">
                                        <x-jet-input x-ref="valor" x-model="valor" type='number' class="w-20"></x-jet-input>
                                        <div class="absolute top-1 right-6" wire:loading>
                                            <x-spinner.spinner size="8"  class="spinner"></x-spinner.spinner>
                                        </div>
                                        <div x-ref="btns" class="absolute w-20 flex justify-around items-center bg-white shadow p-2 rounded">
                                            <i class="fas fa-check p-1 text-green-400 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="$wire.setSpecialSalePrice({{ $product->id }},valor).then(elmnt=>open=false)"></i>
                                            <i class="fas fa-times p-1 text-red-500 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" x-on:click="open=false"></i>
                                        </div>
                                    </div>  
                                                            
                                </div>
                                <div class="w-max-content">
                                    {{ $product->formato }} x  ${{ number_format($product->special_sale_price * $product->formato ,0,',','.') }}
                                </div>
                                @if (count($product->purchasePrices)>0)
                    
                                    <div class="text-red-400 px-2 cursor-pointer">
                                        <x-tooltip.tooltip>
                                            <x-slot name="tooltip">
                                                Ganancia por unidad
                                            </x-slot>
                                            ${{ number_format( $product->special_sale_price - ( $product->purchasePrices->sum('precio') / count($product->purchasePrices)  ),0,',','.') }}
                                        </x-tooltip.tooltip>
                                            
                                    </div>   
                                    <div class="text-red-400 px-2 cursor-pointer">
                                        <x-tooltip.tooltip>
                                            <x-slot name="tooltip">
                                                Ganancia por caja  
                                            </x-slot>
                                            ${{ number_format( ($product->special_sale_price - ( $product->purchasePrices->sum('precio') / count($product->purchasePrices)  )) *  $product->formato ,0,',','.') }} 
                                        </x-tooltip.tooltip>
                                            
                                    </div>   
                                    @if ($product->special_sale_price>0)
                                        <div class="px-2">
                                            {{ number_format(($product->special_sale_price - ( $product->purchasePrices->sum('precio') / count($product->purchasePrices)) )  / $product->special_sale_price * 100,2,',','.') }}%
                                        </div> 
                                    @endif 
                                @endif
                            </div> 
                        </td>

                           {{-- ESTADO --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                            <div id="estado_{{ $product->id }}" x-data="{valor:''}" x-init="valor = {{$product->status}}">
                                <label class="switch ">
                                    <input x-model="valor"  type="checkbox" @if($product->status) checked @endif x-on:change="$wire.setStatus({{ $product->id }},valor)">
                                    <span class="slider round"></span> 
                                </label>
                         
                                @if ($product->status)
                                    <div class="text-gray-600 w-max-content">Activo</div>
                                @else
                                    <div class="text-gray-200">Inactivo</div>
                                @endif
                            </div>
                        </td>
                        
                       
                         {{-- ACCION --}}
                         <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium ">
                             <div class="flex lg:flex-col items-center gap-2">
                                 {{-- <x-jet-button wire:click="open_show({{$sale}})" class=""><i class="far fa-eye"></i></x-jet-button> --}}
                               
                             </div>
                         </td>
                     </tr>
                     @endforeach             
                 </tbody>
             </table>
         </x-table>
        </div>
    </div>

    <div x-show="showCreateProduct" class="hidden" :class="{'hidden' : !showCreateProduct }">
            @livewire('admin.products.create-product', ['user' => ''] )
    </div>

    <div>
        @push('js')
        <script>
            function productsMain(){
                return {
                    showRemoveTag:false,
                    showCreateProduct: @entangle('showCreateProduct'),
                    openCreateProduct(){
                        this.showCreateProduct = true;
                    },
                    closeCreateProduct(){
                        this.showCreateProduct = false;
                    },
                    openShowRemoveTag(){
                        this.showRemoveTag = true;
                    },
                    closeShowRemoveTag(){
                        this.showRemoveTag = false;
                    },

                }
            }
        </script>
            
        @endpush
    </div>
   

</div>
