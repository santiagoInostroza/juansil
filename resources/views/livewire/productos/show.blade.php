    <div class="container py-11 lg:max-w-7xl ">
        <div class="mx-6">
            <div class="grid grid-cols md:grid-cols-2 gap-4">
                <figure>
                    @isset($producto->image->url)
                            <img class="object-contain h-52 sm:h-96 w-full object-center"
                        src="{{ Storage::url($producto->image->url) }}" alt="">
                    @endisset
                </figure>

                <div class="">
                    <div class="">
                        @foreach ($producto->tags as $tag)
                            <a href="{{route('products.tag',$tag)}}">
                                <span
                                    class=" text-xs bg-{{ $tag->color }}-400 rounded-full p-1 mr-2 my-6 text-white">{{ $tag->name }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                    <h1 class="text-xl text-gray-600">{{ $producto->name }}</h1>
                    <div class="font-bold py-2">
                        {{ $producto->brand->name }}
                    </div>
                </div>
            </div>
            <br><hr><br>

            {{-- PRECIOS --}}

            @foreach ($producto->salePrices as $precio)
               
                <div class="text-base w-max-content">
                    <div>
                        Desde {{$precio->quantity}} un. a 
                        <div class="font-bold text-gray-500 text-3xl">
                            ${{number_format($precio->price,0,',','.')}} c/u
                        </div>
                    </div>
                </div>
                @if ($precio->quantity>1)
                    <div class="text-base w-max-content bg-red-100 rounded-xl px-2">
                        Valor al llevar las {{$precio->quantity}} un. 
                        <span class="text-red-500 text-xl">
                            ${{number_format($precio->total_price,0,',','.')}}
                        </span>
                    </div>
                @endif
                
            @endforeach

            <br><br>
                <hr>

            @isset($producto->description)
                <h2 class="text-2xl my-4 py-2 ">Descripcion del producto</h2>
                <div class="">
                        {!!$producto->description!!}
                </div>
            @endisset
        </div>


            
            
    
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <hr>
        <aside class="md:col-span-2 lg:col-span-3 xl:col-span-1 ">
            <div>
                <h1 class="text-2xl font-bold text-gray-600 mb-4">Más de {{ $producto->category->name }}</h1>
                <ul class="flex flex-wrap justify-around ">
                    @foreach ($misma_categoria as $producto)

                        <li class="mb-8 shadow-2xl" >
                            <livewire:producto :producto='$producto'>
                        </li>
                    @endforeach


                </ul>

            </div>
            <hr>
            <div class="mt-4">
                <h1 class="text-2xl font-bold text-gray-600 mb-4">Más de {{ $producto->brand->name }}</h1>
                <ul class="flex flex-wrap justify-around">
                    @foreach ($misma_marca as $producto)
                        <li class="mb-8 shadow-2xl">
                            <livewire:producto :producto='$producto'>
                        </li>
                    @endforeach


                </ul>
            </div>

        </aside>



    </div>

