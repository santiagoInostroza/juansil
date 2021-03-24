<x-app-layout>
    <div class="container py-8 lg:max-w-7xl">
       
        {{-- CONTENIDO PRINCIPAL --}}
        <div>
            <div class="grid grid-cols md:grid-cols-2 gap-4">
                <figure>
                    @isset($producto->image->url)
                            <img class="object-contain h-96 w-full object-center"
                        src="{{ Storage::url($producto->image->url) }}" alt="">
                    @endisset
                </figure>

                <div class="">
                    <div class="pt-15">
                        @foreach ($producto->tags as $tag)
                            <a href="{{route('products.tag',$tag)}}">
                                <span
                                    class=" text-xs bg-{{ $tag->color }}-400 rounded-full p-1 mr-2 my-6 text-white">{{ $tag->name }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                    <h1 class="text-xl font-bold text-gray-600">{{ $producto->name }}</h1>
                    {{ $producto->brand->name }}
                    <hr>
                    <livewire:precios-producto :producto='$producto'>


                </div>
            </div>
            <hr>

            @isset($producto->description)
            <h2 class="text-2xl m-4 p-2 ">Descripcion del producto</h2>
            <div class="m-4 p-2">
                    {!!$producto->description!!}
            </div>
            
            @endisset
        </div>


            
            
    
        
        {{-- CONTENIDO RELACIONADO --}}
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


</x-app-layout>
