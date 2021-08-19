<div>

   

  
  

    <div x-data="productsMain()">
        <div>
            <h1 class="text-2xl font-bold text-gray-600 p-4">PRODUCTOS</h1>
        </div>
        <div class="my-4">
            <x-jet-input class="w-full" wire:model="search" placeholder="Buscar..."></x-jet-input>
        </div>
        <div class="my-4 p-4 border rounded">
             FILTROS
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
                                 <div>
                                     NOMBRE 
                                 </div>
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
                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer ">
                             <div class="flex justify-center items-center ">
                                 DESCRIPTION
                             </div>
                         </th>
                         {{-- Stock --}}
                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer " >
                             
                             <div class="flex justify-center items-center ">
                                 <div>
                                     STOCK
                                 </div>
                                 <div class="pl-2"> 
                                     {{-- @if ($sort == 'sales.total' )
                                         @if ($direction == 'asc')
                                             <i class="fas fa-sort-up"></i>
                                         @else
                                             <i class="fas fa-sort-down"></i>
                                         @endif
                                     @else
                                         <i class="fas fa-sort"></i> 
                                     @endif --}}
                                 </div>
                             </div>
                         </th>
                       
                         {{-- Estado --}}
                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" >
                             
                             <div class="flex justify-center items-center ">
                                 <div>
                                     Estado
                                 </div>
                                 <div class="pl-2"> 
                                     {{-- @if ($sort == 'sales.delivery_stage' )
                                         @if ($direction == 'asc')
                                             <i class="fas fa-sort-up"></i>
                                         @else
                                             <i class="fas fa-sort-down"></i>
                                         @endif
                                     @else
                                         <i class="fas fa-sort"></i> 
                                     @endif --}}
                                 </div>
                             </div>
                         </th>
                        
                       
                         {{-- PRECIO ESPECIAL--}}
                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer ">
                             <div class="flex justify-center items-center ">
                                 PRECIO ESPECIAL
                             </div>
                         </th>
                         {{-- ACCION --}}
                         <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer ">
                            
                             {{-- <span class="sr-only">Accion</span> --}}
                         </th>
                     </tr>
                 </thead>
                 
                 <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                     <tr>
                         {{-- ID --}}
                         <td class="px-6 py-4 whitespace-nowrap">
                             <div class="flex items-center">
                                 {{$product->id}}
                             </div>
                         </td>
                        {{-- NOMBRE --}}
                        <td class="px-6 py-4 ">
                            <div class="flex justify-start items-center  min-w-max-content" >
                    
                                <div class="flex flex-col gap-2">
                                    <div class="text-sm text-gray-900 font-bold py-1">{{$product->name}}</div>

                                <div class="text-sm text-gray-500  flex justify-start items-center relative" 
                                    x-data="{ 
                                        change : true, 
                                        product_id: '',
                                        save(){
                                            brand = this.$refs.brand;                                            
                                            this.$wire.saveBrand(this.product_id,brand.value).then(element=> this.change=true); 
                                        }, 
                                    }" x-init=" product_id = {{$product->id}} ;">
                                    <div class="py-1">Marca: </div>
                                    <div @dblclick="change=false" x-show="change" class="cursor-pointer w-full" >{{ $product->brand->name }}</div>
                                    <div wire:ignore x-show="!change" class="flex ml-12 items-center  gap-x-2 hidden absolute shadow-2xl" :class="{'hidden': change}">
                                        <select x-ref="brand" class="select w-36" name="brand">
                                            @foreach ($brands as $brand)
                                                <option value="{{$brand->id}}" @if( $product->brand->id == $brand->id) selected @endif>{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-check p-1 text-green-400 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" @click="save"></i>
                                        <i class="fas fa-times p-1 text-red-500 cursor-pointer transform hover:scale-125 hover:shadow rounded-full" @click="change=true"></i>
                                        
                                    </div>
                                </div>


                                    <div class="text-sm text-gray-500 py-1">
                                    Formato: {{$product->formato}} un. 
                                    </div>
                                    <div class="text-sm text-gray-500 py-1">
                                    Categoria: {{$product->category->name}}
                                    </div>
                                </div>
                            </div>
                        </td>
                         {{-- ETIQUETAS --}}
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <ul class="grid text-sm">
                                @foreach ($product->tags as $tag)
                                    <li class="min-w-max-content w-full flex justify-between p-1 gap-1 hover:bg-gray-100 rounded-full">
                                        <div >{{$tag->name}}</div>
                                        <i class="far fa-trash-alt p-1 cursor-pointer"></i>
                                     </li>
                                @endforeach
                               
                                <div class="p-1 cursor-pointer border rounded-full flex justify-center items-center gap-2" >
                                    <i class="fas fa-plus"></i> 
                                    <div> Agregar</div>
                                </div>
                              
                            </ul>
                         </td>
                         {{-- Description --}}
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                             <div>
                                 <textarea name="" > {{$product->description}}</textarea>
                             </div>
                           
                         </td>
                          {{--Stock--}}
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                           <div class="w-max-content font-bold">Stock {{$product->stock}}</div>
                           <div class="w-max-content">Min {{$product->stock_min}}</div>
                         </td>
                          {{-- ESTADO --}}
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                           
                                            
                                 @if ($product->status)
                                     <div class="text-green-600 font-bold flex items-center gap-2">
                                         Activo <div class="fas fa-check"></div>
                                     </div>
                                     <button class="text-sm text-gray-600" wire:click="desactivar({{ $product->id }})">Desactivar</button>
                                 @else
                                     <div class="text-red-400">
                                         Inactivo
                                     </div>
                                     <button class="text-sm text-gray-600" wire:click="activar({{ $product->id }})">Activar</button>
                                 @endif
                           
                         </td>
                          {{-- Precio ESPECIAL  --}}
                         <td class="px-6 py-4 whitespace-nowrap text-sm ">
                            <div>
                                ${{ number_format($product->special_sale_price,0,',','.')}}
                            </div>
                         </td>
                          {{--  FECHA PAGO --}}
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            
                            
                         </td>
                          {{--  VENTA POR  --}}
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                             <div></div>
                         </td>
                          {{--  COMENTARIOS  --}}
                         <td class="px-6 py-4 text-sm text-gray-500">
                             <div class="w-24 text-sm">
                                
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

    <div>
        @push('js')
        <script>
            function productsMain(){
                return {
                    showRemoveTag:false,
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
