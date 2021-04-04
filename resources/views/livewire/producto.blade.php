<article class="bg-white mx-auto" style="height:100%" >

    <div class="relative">
        <a href="{{ route('products.show', $producto) }}">
            @isset($producto->image->url)
                <img class="object-contain h-48 w-full" src="{{ Storage::url($producto->image->url) }}" alt="">
            @endisset
        </a>
        {{-- ETIQUETAS --}}
        <div class="m-2 text-left">
            @foreach ($producto->tags as $tag)
                <div class="absolute top-{{ $loop->index * 5 }}">
                    <a href="{{ route('products.tag', $tag) }}"
                        class="text-xs inline-block px-1 bg-{{ $tag->color }}-400 text-white rounded-full">
                        {{ $tag->name }}</a>
                </div>
            @endforeach
        </div>
    </div>



       <livewire:precios-producto :producto='$producto' :key="$producto->id">
 

    





</article>
