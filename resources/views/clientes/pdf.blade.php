<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Clientes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        h2 { text-align: center; color: #047857; margin-bottom: 20px; } /* verde elegante */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px 5px; text-align: center; }
        th { background-color: #f0fdf4; color: #065f46; } /* verde claro */
        tr:nth-child(even) { background-color: #f9f9f9; }
        footer { text-align: center; margin-top: 20px; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <h2>Reporte de Clientes - Peluquería Alejandra C</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        Generado automáticamente el {{ now()->format('d/m/Y H:i') }}
    </footer>
</body>
</html>
