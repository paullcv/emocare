<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aviso</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .event-details {
            text-align: left;
            margin-top: 20px;
        }

        .event-details p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tienes un Cuestionario Asignado</h1>
        <p>Cuestionario: {{$cuestionario->titulo}}</p>

        <div class="event-details">
            <p><strong>Descripción:</strong> {{$cuestionario->descripcion}}</p>
             <!-- Enlace a la página de respuestas -->
             <p><a href="http://127.0.0.1:8000/respuestas">Responder al Cuestionario</a></p>
        </div>
    </div>
</body>
</html>
