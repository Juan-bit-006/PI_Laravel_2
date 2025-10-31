<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Empleados</title>
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
    <h2>Reporte de Empleados - Peluquería Alejandra C</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role ?? 'N/A') }}</td>
                <td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        Generado automáticamente el {{ now()->format('d/m/Y H:i') }}
    </footer>
</body>
</html>
