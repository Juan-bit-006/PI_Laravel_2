<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Reservas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        h2 { text-align: center; margin-bottom: 20px; color: #047857; } /* verde elegante */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px 6px; text-align: center; }
        th { background-color: #f0fdf4; color: #065f46; } /* verde claro */
        tr:nth-child(even) { background-color: #f9f9f9; }
        footer { text-align: center; margin-top: 20px; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <h2>Reporte de Reservas - Peluquería Alejandra C</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Empleado</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->id }}</td>
                    <td>{{ $reserva->cliente->nombre ?? 'N/A' }}</td>
                    <td>{{ $reserva->servicio->nombre ?? 'N/A' }}</td>
                    <td>{{ $reserva->user->name ?? 'N/A' }}</td>
                    <td>{{ $reserva->fecha }}</td>
                    <td>{{ $reserva->hora }}</td>
                    <td>{{ ucfirst($reserva->estado) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        Generado automáticamente el {{ now()->format('d/m/Y H:i') }}
    </footer>
</body>
</html>
