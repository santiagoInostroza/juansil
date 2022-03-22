<div>
   
   <div class="bg-white rounded shadow p-4 border-teal-200 border-b-4 mb-4">
        <h2>{{$role->name}}</h2>
   </div>
   <div class="bg-white rounded shadow p-4">
        <ul class="grid grid-cols-4 gap-4">
            @foreach ($role->permissions as $permission)
                <li class="bg-white rounded shadow p-2">
                    <div class="font-bold"> {{$permission->name}}</div>
                    <div class="text-sm"> {{$permission->description}}</div>
                </li>
            @endforeach
        </ul>
   </div>
</div>
