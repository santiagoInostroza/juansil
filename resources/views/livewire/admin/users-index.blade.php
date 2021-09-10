<div class="card">

   

    <div class="card-body" wire:poll.60s>

        <div>
            <h4>Cantidad total de visitas {{ $userCounts->count() }}</h4>
            <h4>Cantidad total de usuarios que han visitado {{ $userCountsTotalDistinct }}</h4>
            <h4>Cantidad total de usuarios chilenos que han visitado {{ $userCountsChile }}</h4>
        </div>

        <table class="table table-stripe">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>IP</th>
                    <th>Pagina</th>
                    <th>Navegador</th>
                    <th>Agente</th>
                    <th>Visitas</th>
                    <th>Pais</th>
                    <th>Fecha creeado</th>
                    <th>Fecha modificado</th>
                    <th>Ultima visita</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userCounts as $user)
                    <tr>
                        <td>  {{ $user->id }}</td>
                        <td>
                            @if ($user->ip == '190.114.35.111')
                                Santi
                            @elseif($user->ip == '45.232.92.56')
                            Romi Celu
                            @elseif($user->ip == '201.219.236.243')
                            Santy Celu 1
                            @else
                            {{ $user->ip }}
                            @endif
                        </td>

                        <td>{{ $user->page }}</td>
                        <td>{{ $user->nameNavigator }}</td>
                        <td>{{ $user->agent }}</td>
                        <td>{{ $user->visitas }}</td>
                        <td>{{ $user->countryName }}</td>
                        <td>{{   Helper::fecha($user->dateCreate)->dayName }} {{  Helper::fecha($user->dateCreate)->format('d-m-y H:i:s') }}</td>
                        <td> {{ ($user->dateModificate != null) ?  Helper::fecha($user->dateModificate)->dayName .' ' . Helper::fecha($user->dateModificate)->format('d-m-y H:i:s') : '' }}
                        </td>
                      
                        <td>{{ ($user->date != null) ?  Helper::fecha($user->date)->diffForHumans() :'' }}</td>

                        <td width='10'>
                            <a class='btn btn-primary' href="{{ route('admin.users.edit', $user) }}">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

            
 
    </div>



    <div class="card-header">

        <input wire:model='search' type="text" class="form-control" placeholder="Ingrese nombre o correo de usuario">
    </div>

    








    @if ($users->count())
        <div class="card-body">
            <table class="table table-stripe">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td width='10'>
                                <a class='btn btn-primary' href="{{ route('admin.users.edit', $user) }}">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $users->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>No hay registros</strong>
        </div>
    @endif
    
</div>
