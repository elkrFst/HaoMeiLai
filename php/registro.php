<?php
// Puedes agregar validaciones y mensajes aquí si lo deseas
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Hao Mei Lai</title>
    <link rel="stylesheet" href="../css/stylelogin.css">
</head>
<body style="background: url('../imagenes/fondo comida.jpg') no-repeat center center fixed; background-size: cover;">
    <div class="login-bg">
        <div class="login-container">
            <div class="login-logo">
                <img src="../imagenes/logo comida.png" alt="Hao Mei Lai Logo">
            </div>
            <h2>Crear Nueva Cuenta</h2>
            <form action="procesar_registro.php" method="post">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
                
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" placeholder="tu@email.com" required>
                
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="********" required>
                
                <button type="submit" class="btn-login">Registrarse</button>
            </form>
            <div class="divider"></div>
            <button class="btn-register" onclick="window.location.href='iniciodesesión.php'">Volver al inicio de sesión</button>
        </div>
    </div>
</body>
</html>