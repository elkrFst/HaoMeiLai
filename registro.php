<?php
// Lógica para manejar y definir el mensaje de error
$error_message = '';
$has_error = false; 

// Variables para conservar los datos ingresados
$old_nombre = '';
$old_email = '';

// Si hay un error, procesamos el mensaje y recuperamos los datos antiguos
if (isset($_GET['error'])) {
    $error_code = $_GET['error'];
    $has_error = true; 

    $old_nombre = isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '';
    $old_email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';


    if ($error_code === 'gmail_required') {
        $error_message = '⚠️ Debes incluir @gmail.com para poder continuar';
    } elseif ($error_code === 'email_exists') {
        $error_message = '❌ El correo ya está registrado. Intenta iniciar sesión.';
    } elseif ($error_code === 'db_error') {
        $error_message = '🚨 Ocurrió un error al intentar registrarte. Intenta de nuevo.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Hao Mei Lai</title>
    <link rel="stylesheet" href="css/stylelogin.css">
    <style>
        /* Estilos para hacer el mensaje de error más notorio */
        .error-message {
            color: #d9534f;
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            padding: 10px;
            margin-top: -5px; 
            margin-bottom: 15px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.95em;
        }
        /* NUEVOS ESTILOS para el botón de Google */
        .btn-google {
            background-color: #4285F4; /* Color de Google */
            color: white;
            padding: 12px;
            font-size: 1em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px 0 rgba(0,0,0,.25);
            transition: background-color 0.3s;
        }
        .btn-google:hover {
            background-color: #3374dc;
        }
        .btn-google img {
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }
        .divider {
            text-align: center;
            margin: 15px 0;
            color: #aaa;
            font-size: 0.9em;
        }
    </style>
</head>
<body style="background: url('imagenes/fondo comida.jpg') no-repeat center center fixed; background-size: cover;">
    <div class="login-bg">
        <div class="login-container">
            <div class="login-logo">
                <img src="imagenes/logo comida.png" alt="Hao Mei Lai Logo">
            </div>
            <h2>Crear Nueva Cuenta</h2>

            <button class="btn-google" onclick="window.location.href='google_auth.php?action=register'">
                <img src="imagenes/google_icon.png" alt="Google"> Registrarse con Google
            </button>
            <div class="divider">O con correo y contraseña</div>

            <form action="procesar_registro.php" method="post">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" value="<?php echo $old_nombre; ?>" required>
                
                <label for="email">Correo electrónico</label>
                <input type="text" id="email" name="email" placeholder="tu@email.com" value="<?php echo $old_email; ?>" required>
                
                <?php 
                // Muestra el mensaje de error si existe
                if (!empty($error_message)) {
                    echo '<p class="error-message">' . $error_message . '</p>';
                }
                ?>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="********" required>
                
                <button type="submit" class="btn-login">Registrarse</button>
            </form>
            <div class="divider"></div>
            <button class="btn-register" onclick="window.location.href='login'">Volver al inicio de sesión</button>
        </div>
    </div>

    <?php if ($has_error): ?>
    <script>
        // Esta pequeña función elimina los parámetros de error de la URL para que no aparezcan si se refresca la página.
        if (window.history.replaceState) {
            const url = new URL(window.location.href);
            if (url.searchParams.has('error')) {
                url.searchParams.delete('error');
                url.searchParams.delete('nombre'); 
                url.searchParams.delete('email'); 
                window.history.replaceState({path: url.href}, '', url.href);
            }
        }
    </script>
    <?php endif; ?>
</body>
</html>