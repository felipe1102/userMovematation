
<table class="table">
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
