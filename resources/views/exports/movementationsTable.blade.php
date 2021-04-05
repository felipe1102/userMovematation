
<table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Data nascimento</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->birthday }}</td>
            <td>{{ number_format($user->opening_balance, 2, ',', '.') }}</td>
        </tr>
    </tbody>

    <thead>
        <tr>
            <th>id</th>
            <th>Valor</th>
            <th>Tipo</th>
            <th>estonado</th>
            <th>Data criação </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movements as $movement)
            <tr>
                <td>{{ $movement->id }}</td>
                <td>{{ number_format($movement->value, 2, ',', '.') }}</td>
                <td>{{ $movement->type }}</td>
                <td>{{ $movement->reversed ? "sim": "não" }}</td>
                <td>{{ $movement->created_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
