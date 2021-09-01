<div>
    <div class="relative">
        <x-jet-input wire:model.debounce.500ms="search" class="w-full"></x-jet-input>
        <div  wire:loading wire:target="search" >
            <x-spinner.spinner2 size="6" ></x-spinner.spinner2>
        </div>
    </div>
    <div>
        <x-table>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre
                    </th>
                     <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                       Direccion
                    </th>
                    {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                    </th> --}}
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Rol
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        @if (!$this->editRow[$user->id])
                            <tr wire:click="editRowTrue({{ $user->id }})" wire:key="row_{{$user->id}}" class="cursor-pointer @if($user->customer()) bg-green-200 @elseif($user->eventualCustomer()) bg-yellow-200 @endif">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->customer())Esta enlazado @endif @if($user->eventualCustomer())Tiene posibles cuentas @endif
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <figure class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                                                </figure>
                                            @else
                                                <div class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                    <div>{{ $user->name }}</div>
                                                    <div class="ml-1">
                                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"> <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /> </svg>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$user->name}}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{$user->email}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">@if($user->customer()) {{$user->customer()->direccion}} {{$user->customer()->block}} {{$user->customer()->depto}} @endif </div>
                                    <div class="text-sm text-gray-500">@if($user->customer()) {{$user->customer()->telefono}} {{$user->customer()->celular}} {{$user->customer()->comments}} @endif</div>
                                </td>
                                {{--<td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                </td> --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @foreach ($user->roles as $role)
                                        <div>{{$role->name}}</div>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                        @else
                            <tr class="bg-green-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <figure class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                                                </figure>
                                            @else
                                                <div class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                    <div>{{ $user->name }}</div>
                                                    <div class="ml-1">
                                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"> <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /> </svg>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$user->name}}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{$user->email}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
                                    <div class="text-sm text-gray-500">Optimization</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                </td> --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @foreach ($user->roles as $role)
                                        <div>{{$role->name}}</div>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    @if ($user->customer())
                                        <h2 class="text-xl font-bold text-gray-600"> Esta cuenta de usuario está vinculada a la o las siguientes cuentas de cliente:</h2>
                                        @foreach ($user->customer() as $cust)
                                            <div> {{ $cust->name }}  {{ $cust->email }} {{ $cust->celular }} {{ $cust->direccion }} {{ $cust->comentario }}</div>
                                        @endforeach
                                    @endif
                                    @if($user->eventualCustomer())
                                        <h2 class="text-xl font-bold text-gray-600">Esta cuenta de usuario se puede vincular con la o las siguientes cuentas de cliente: </h2>
                                        @foreach ($user->eventualCustomer() as $cust)
                                            <div> {{ $cust->name }}  {{ $cust->email }} {{ $cust->celular }} {{ $cust->direccion }} {{ $cust->comentario }}</div>
                                        @endforeach
                                    @endif
                                    
                                </td>
                            </tr>
                        @endif
                    @endforeach
    
                <!-- More people... -->
                </tbody>
            </table>
                   
                 
                    
               
           
        </x-table>
        

   
  


    </div>
</div>
