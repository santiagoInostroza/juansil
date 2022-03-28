<div>
    <div class="flex gap-x-4 justify-between">
   
        <div class="w-full">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                {{-- search products --}}
                <div class=" items-center justify-between">
                    @foreach ($allProducts as $product)
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full overflow-hidden">
                                <img src="{{Storage::url('products/'.$product->image->url) }}" alt="">
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-900 font-bold text-xl mb-2">{{$product->name}}</p>
                                <p class="text-gray-700 text-base">{{$product->description}}</p>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                



               
            </div>
          
        </div>


  

        <div class="w-full max-w-lg">
            <form action="{{route('admin2.purchases.store')}}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
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
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="total">
                        Total
                    </label>
                    <input type="number" name="total" id="total" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Total">
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
