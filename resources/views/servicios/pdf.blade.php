<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Servicios</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        h2 { text-align: center; color: #047857; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px 5px; text-align: center; }
        th { background-color: #f0fdf4; color: #065f46; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        footer { text-align: center; margin-top: 20px; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <h2>Reporte de Servicios - Peluquería Alejandra C</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Duración (min)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $servicio)
            <tr>
                <td>{{ $servicio->id }}</td>
                <td>{{ $servicio->nombre }}</td>
                <td>{{ $servicio->descripcion }}</td>
                <td>${{ number_format($servicio->precio, 2) }}</td>
                <td>{{ $servicio->duracion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        Generado automáticamente el {{ now()->format('d/m/Y H:i') }}
    </footer>
</body>
</html>
