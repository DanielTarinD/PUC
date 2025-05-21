<table>
    <thead>
    <tr>
        <th style="width:100px"><b>RFC</b></th>
        <th style="width:100px"><b>Nombre</b></th>
        <th style="width:100px"><b>Email</b></th>
        <th style="width:100px"><b>Total</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->rfc }}</td>

            <td>{{ $usuario->name }}</td>

            <td>{{ $usuario->email }}</td>

            <td>{{ $usuario->observaciones->count() }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
