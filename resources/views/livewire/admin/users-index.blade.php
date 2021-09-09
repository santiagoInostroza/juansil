<div class="card">

   

    <div class="card-body" wire:poll.10s>

        <table class="table table-stripe">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>IP</th>
                    <th>IP2</th>
                    <th>Pagina</th>
                    <th>Visitas</th>
                    <th>Pais</th>
                    <th>Fecha creeado</th>
                    <th>Fecha modificado</th>
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

                        <td>{{ $user->ip2 }}</td>
                        <td>{{ $user->page }}</td>
                        <td>{{ $user->visitas }}</td>
                        <td>{{ $user->countryName }}</td>
                        <td>{{ $user->dateCreate }}</td>
                        <td>{{ $user->dateModificate }}</td>
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
