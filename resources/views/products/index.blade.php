<x-app-layout>
    
    <div class="container max-w-7xl py-8">
        @if (count($productos)>0)
            @isset($name)
                <h2 class="font-bold text-gray-600 pt-8 pb-4 text-xl">Busquedas relacionadas con "{{$name}}"</h2>
            @endisset

            <div class="grid grid-cols-2  md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 lg:max-w-5xl xl:max-w-7xl mx-auto" style="height: max-content">
                @foreach ($productos as $producto)
                    <livewire:producto :producto='$producto' :key="$producto->id" />
                @endforeach
            </div>

            <div class="mt-4">
                {{ $productos->links() }}
            </div>

        @else
            @isset($name)
            <h2 class="font-bold text-gray-600 pt-8 pb-4 text-xl">No se encontraron productos relacionados con la busqueda '{{$name}}'</h2>
            <p class="font-bold text-gray-600 pt-8 pb-4" >Si quieres revisa nuestros otros productos</p>
            @endisset
        @endif

        <hr>
        <h2 class="font-bold text-gray-600 pt-8 pb-4 text-xl">Destacados</h2>
        <div class="grid grid-cols-2  md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 lg:max-w-5xl xl:max-w-7xl mx-auto" style="height: max-content">
            @foreach ($destacados as $key => $producto)
                <livewire:producto :producto='$producto' :key="$producto->id" />
            @endforeach
        </div>

    </div>

</x-app-layout>
