<div class="card">
    <div class="card-body">

        <table class="table table-full ">
            <thead class="text-lg">
                <tr>
                <td>Nombre</td>
                <td>Despacho</td>
                <td>Descuento</td>
                <td>Sector</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($comunas as $comuna)
            <tr>
                <td>{{ $comuna->name }}</td>
                <td>{{ $comuna->valor_despacho }}</td>
                <td>
                    dia {{$comuna->dia}}
                    {{ $comuna->descuento }}
                </td>
                <td>{{ $comuna->sector }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
