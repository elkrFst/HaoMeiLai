<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Hao Mei Lai</title>
    <link rel="stylesheet" href="../css/stylelogin.css">
</head>
<body>
    <div class="login-bg">
        <div class="login-container">
            <div class="login-logo">
                <img src="../img/logo.png" alt="Hao Mei Lai Logo">
            </div>
            <h2>Bienvenido</h2>
            <p class="login-subtitle">Inicia sesión en tu cuenta</p>
            <form action="procesar_login.php" method="post">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" placeholder="tu@email.com" required>
                
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="********" required>
                
                <div class="login-options">
                    <label class="remember">
                        <input type="checkbox" name="remember"> Recordar sesión
                    </label>
                    <a href="#" class="forgot">¿Olvidaste tu contraseña?</a>
                </div>
                
                    <button type="submit" class="btn-login">Iniciar Sesión</button>
                    <!-- El botón ahora envía el formulario a procesar_login.php -->
            </form>
            <div class="divider"></div>
            <button class="btn-register" onclick="window.location.href='registro.php'">Crear Nueva Cuenta</button>
            <div class="login-help">
                <span>¿Necesitas ayuda? <a href="#">Contáctanos</a></span>
            </div>
            <div class="login-info">
                <span>🍜 Auténtica comida china tradicional</span><br>
                <span>🕒 Lun-Dom: 11:00 AM - 10:00 PM</span>
            </div>
        </div>
        <footer>
            © 2024 Hao Mei Lai. Todos los derechos reservados.
        </footer>
    </div>
</body>
</html>
