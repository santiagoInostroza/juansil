<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="container mx-auto w-max-content">
        <h1 class="text-4xl text-gray-500 mx-auto my-4 p-4">Editar Categoria</h1>

        <form action="{{route("categorias.update",$categorium) }}" method="POST">
            @csrf
            <input class='block m-4 p-4 rounded' type="text" placeholder="Nombre" name="name">
            <button class="block m-4 p-4 rounded bg-gray-400 text-white">Editar</button>
        </form>

        {{ $categorium }}
</x-app-layout>
