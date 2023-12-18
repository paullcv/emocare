<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerta de Respuestas Negativas</title>
    <!-- Estilos personalizados si es necesario -->
</head>
<body>
    <div class="container">
        <h1>Alerta: Respuestas Negativas</h1>
        <p>Estudiante: {{ $nombreEstudiante }}</p>
        <p>Cuestionario: {{ $tituloCuestionario }}</p>
        <p>Porcentaje de Respuestas Negativas: {{ $porcentajeNegativas }}%</p>
        <p>{{ $mensajeAdicional }}</p>
    </div>
</body>
</html>
