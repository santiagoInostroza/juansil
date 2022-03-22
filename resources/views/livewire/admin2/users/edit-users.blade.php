<div x-data="{roles:@entangle('roles').defer}">
   <div class="rounded shadow bg-white border-l-4 border-gray-400 p-4 my-4">
    <h2>{{$user->name}}</h2>
   </div>
   <div class="rounded shadow bg-white border-l-4  p-4">
   <h2>Roles</h2>
   <ul class="flex gap-2 my-4">
       @foreach ($allRoles as $role)
           <li class="bg-white shadow rounded p-2">
               <label class="">
                   <input type="checkbox" value="{{$role->name}}" x-model="roles"></input>
                   {{$role->name}}
                </label>
           </li>
       @endforeach
   </ul>
   <div><x-jet-button wire:click="updateUserRole()">Actualizar Rol</x-jet-button></div>
   </div>
</div>
