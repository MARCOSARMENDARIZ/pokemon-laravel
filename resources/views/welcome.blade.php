<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: white;
            padding: 25px;
            width: 320px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #bbb;
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            font-size: 14px;
            font-weight: bold;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #4A90E2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background: #357ABD;
        }

        .back-home {
            margin-top: 15px;
            display: block;
            text-align: center;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="login-card">

        <h2>Iniciar Sesión</h2>

        {{-- Solo diseño, no lógica --}}
        <div class="input-group">
            <label>Correo electrónico</label>
            <input type="email" placeholder="usuario@example.com">
        </div>

        <div class="input-group">
            <label>Contraseña</label>
            <input type="password" placeholder="********">
        </div>

        <button class="btn">Entrar</button>

        {{-- Botón para volver al listado --}}
        <a href="/inicio" class="back-home">← Volver al inicio</a>

    </div>

</body>
</html>

