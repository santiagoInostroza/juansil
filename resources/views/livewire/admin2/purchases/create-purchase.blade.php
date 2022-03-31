<div>
    <div>
        <div class="grid col-span-1 md:grid-cols-7 gap-x-4 justify-between ">
            <div class="col-span-1 md:col-span-5">

                {{-- BUSCADOR DE PRODUTOS --}}
                    <div>
                        <livewire:admin2.products.search-product  wire:key="search-product">
                    </div>

                {{-- NUEVA COMPRA --}}
                <div class="mb-4">

                    @if (session()->has('newPurchase.items') && count(session('newPurchase.items')) >0)
                        <x-table.table>
                            <x-slot name='thead'>
                                <x-table.tr class="bg-indigo-200 hover:bg-indigo-200 shadow">
                                    <x-table.th>Id</x-table.th>
                                    <x-table.th class="text-left">Nombre</x-table.th>
                                    <x-table.th class="text-right">Stock</x-table.th>
                                    <x-table.th class="text-left">Cantidad</x-table.th>
                                    <x-table.th class="text-left">Cantidad x caja</x-table.th>
                                    <x-table.th class="text-left">Cantidad total</x-table.th>
                                    <x-table.th class="text-left">Precio</x-table.th>
                                    <x-table.th class="text-left">Precio x caja</x-table.th>
                                    <x-table.th class="text-left">Precio total</x-table.th>
                                    <x-table.th></x-table.th>
                                </x-table.tr>
                            </x-slot>
                            <x-slot name='tbody'>
                                @foreach (session('newPurchase.items') as $key => $item)
                                    <tr class="shadow hover:bg-indigo-50 relative" 
                                        x-data="{ 
                                            quantity:'{{($item['quantity'])?$item['quantity']:0}}', 
                                            quantity_box:'{{$item['quantity_box']}}', 
                                            total_quantity:'{{$item['total_quantity']}}', 
                                            price:'{{$item['price']}}', 
                                            price_box:'{{$item['price_box']}}', 
                                            total_price:'{{$item['total_price']}}',
                                            loading:false,
                                            getTotal: function(){
                                                this.loading=true;
                                                this.total_quantity =  this.quantity * this.quantity_box;
                                                this.total_price = this.total_quantity * this.price;
                                                this.price_box = this.price * this.quantity_box;
                                                this.$wire.setPurchase('{{$key}}',this.quantity, this.quantity_box, this.total_quantity, this.price, this.price_box, this.total_price).then(()=>{
                                                    this.loading=false;
                                                });
                                            },
                                            getTotal2: function(){
                                                this.loading=true;
                                                this.total_quantity =  this.quantity * this.quantity_box;
                                                if(this.quantity_box != 0){
                                                    this.price = this.price_box / this.quantity_box;
                                                }
                                                this.total_price = this.total_quantity * this.price;
                                                this.$wire.setPurchase('{{$key}}',this.quantity, this.quantity_box, this.total_quantity, this.price, this.price_box, this.total_price).then(()=>{
                                                    this.loading=false;
                                                });
                                            },
                                        }"
                                        x-init="console.log('init')"
                                        >
                                        <x-table.td>{{$item['product_id']}}</x-table.td>
                                        <x-table.td>{{$item['name']}}</x-table.td>
                                        <x-table.td class="text-right">{{$item['stock']}}</x-table.td>
                                        <x-table.td> 
                                            
                                            <x-jet-input type="number" x-on:keyup.debounce.600ms="getTotal()" min="0"  class="w-16 h-6 text-sm" x-model="quantity"></x-jet-input>
                                        </x-table.td>
                                        <x-table.td> 
                                            <x-jet-input type="number" x-on:keyup.debounce.600ms="getTotal()" min="0"  class="w-16 h-6 text-sm" x-model="quantity_box"></x-jet-input>
                                        </x-table.td>
                                        <x-table.td> <span x-text="number_format(total_quantity)"></span></x-table.td>
                                        <x-table.td> 
                                            <x-jet-input type="number" x-on:keyup.debounce.600ms="getTotal()" min="0"  class="w-16 h-6 text-sm" x-model="price"></x-jet-input>
                                        </x-table.td>
                                        <x-table.td> 
                                            <x-jet-input type="number" x-on:keyup.debounce.600ms="getTotal2()"  min="0"  class="w-20 h-6 text-sm" x-model="price_box"></x-jet-input>
                                        </x-table.td>
                                        <x-table.td> $ <span x-text="number_format(total_price)"></span></x-table.td>
                                        <x-table.td> 
                                        <div class="text-red-500  cursor-pointer" wire:click="removeFromPurchase( '{{ $item['name'] }}' )">
                                            <svg class="w-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>   
                                            <div x-cloak x-cloack x-show="loading" >
                                                <div class='absolute inset-0 bg-gray-200 z-10 opacity-50' ></div>
                                                <div class='absolute inset-0 flex justify-center items-center z-10'>
                                                    <div class='text-gray-800'>
                                                        <i class='fas fa-spinner animate-spin text-4xl'></i>
                                                    </div>
                                                </div>
                                            </div>                         
                                        </div>
                                        </x-table.td>
                                    
                                    <tr>
                                @endforeach   
                            </x-slot>
                        </x-table.table>
                    @else 
                        <div class="py-10">
                            <p class="text-gray-600">Aún no has agregado productos</p>
                        </div>
                    @endif
                </div>
            </div>
    
            {{-- DATOS DE LA COMPRA --}}
            <div class="col-span-1 md:col-span-2">
                <form action="{{route('admin2.purchases.store')}}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 ">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="supplier_id">
                            Proveedor
                        </label>
                        <select name="supplier_id" id="supplier_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Seleccione un proveedor</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Total </label>
                        <span>$ {{number_format((session()->has('newPurchase.total'))? session('newPurchase.total'): 0 ,0,',','.')}}</span>
                        
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="comment">
                            Comentario
                        </label>
                        <textarea name="comment" id="comment" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Comentario"></textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>

        </div>
       
    </div>
</div>
