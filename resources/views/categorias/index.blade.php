<x-app-layout>
    <x-slot name="header">

    </x-slot>


    <div class="container mx-auto w-max-content">
        <h1 class="text-4xl text-gray-500 mx-auto my-4 p-4">Categorias</h1>

        <!-- component -->
      

       
            <table class="w-96">
                <thead class="">
                    <tr class="bg-gray-800">

                        <th class="py-2">
                            <span class="text-gray-300">Nombre</span>
                        </th>

                        <th colspan="2">
                        </th>
                        
                    </tr>
                </thead>
                <tbody class="bg-gray-200">
                    @foreach ($categorias as $categoria)
                        <tr class="bg-white border-4 border-gray-200">
                            <td class="py-2">
                                <span class="text-center ml-2 font-semibold">{{ $categoria->name }}</span>
                            </td>
                            <td  width='10px' >
                                <a href="{{ route('categorias.edit', $categoria) }}"
                                    class="border-green-400  px-4 py-2 border rounded-md hover:text-white  hover:bg-green-400  mx-1 my-4">
                                    Editar
                                </a>
                            </td>
                            <td  width='10px'> 
                                <a href=""
                                    class="border-red-400  px-4 py-2 border rounded-md hover:text-white hover:bg-red-400 ">
                                    Borrar
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        

    </div>
</x-app-layout>
