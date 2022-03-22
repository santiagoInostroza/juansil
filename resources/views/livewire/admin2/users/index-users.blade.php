<div>
   <x-table.table>
       <x-slot name="thead">
           <x-table.tr>
               <x-table.th>id</x-table.th>
               <x-table.th>name</x-table.th>
               <x-table.th>roles</x-table.th>
               <x-table.th></x-table.th>
            </x-table.tr>
       </x-slot>
       <x-slot name="tbody">
           @foreach ($users as $user)
           <x-table.tr>
               <x-table.td>{{$user->id}}</x-table.td>
               <x-table.td>{{$user->name}}</x-table.td>
               <x-table.td>
                   <ul class="flex flex-wrap gap-1">
                       @foreach ($user->roles as $roles)
                       <li class="bg-white shadow rounded p-1 ">{{$roles->name}}</li>
                       @endforeach
                    </ul>
               </x-table.td>

               <x-table.td>
                    @can('admin.users.edit')
                        <a href="{{route('admin2.users.edit',$user)}}">
                            <x-jet-secondary-button>
                                <i class="fas fa-pen"></i>
                            </x-jet-secondary-button>
                        </a>
                    @endcan
               </x-table.td>

            </x-table.tr>
            @endforeach
       </x-slot>
   </x-table.table>
</div>
