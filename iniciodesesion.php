<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'conexion.php';

$error_email = '';
$error_password = '';
$error_login = '';

// Lógica para "Entrar como Invitado"
if (isset($_POST['invitado'])) {
    $_SESSION['usuario'] = 'Invitado'; // O cualquier nombre que prefieras
    $_SESSION['rol'] = 'invitado';
    header("Location: inicio"); // Redirige a la página principal
    exit();
}
// Fin Lógica Invitado

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el post es de un formulario de login normal o el de invitado
    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $valid = true;

        if (empty($email)) {
            $error_email = "El correo es obligatorio.";
            $valid = false;
        }
        if (empty($password)) {
            $error_password = "La contraseña es obligatoria.";
            $valid = false;
        }

        if ($valid) {
            // Lógica de verificación de usuarios y empleados existente...
            
            // 1️⃣ Verificar en tabla usuarios
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND contraseña = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuario = $result->fetch_assoc();
            
            if ($usuario) {
                // Inicio de sesión exitoso como usuario/admin
                $_SESSION['nombre'] = $usuario['nombre']; 
                $_SESSION['cliente_id'] = $usuario['cliente_id']; 
                $_SESSION['rol'] = $usuario['rol'];
                
                if ($usuario['rol'] === 'admin') {
                   header('Location: panel');
                } else {
                   header('Location: inicio');
                }
                exit();
            }

            // 2️⃣ Verificar empleados
            $stmt2 = $conn->prepare("SELECT * FROM empleados WHERE numero_trabajador = ? AND contraseña = ?");
            $stmt2->bind_param("ss", $email, $password); // Aquí 'email' puede ser el número de trabajador
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $empleado = $result2->fetch_assoc();

            if ($empleado) {
                 // Inicio de sesión exitoso como empleado
                 $_SESSION['nombre'] = $empleado['nombre']; 
                 $_SESSION['cliente_id'] = $empleado['empleado_id']; // Usar empleado_id o similar
                 $_SESSION['rol'] = 'empleado';
                 header('Location: inicio_empleados');
                 exit();
            }
            
            // Si no se encuentra en ninguna tabla
            $error_login = "Credenciales incorrectas o usuario no encontrado.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Hao Mei Lai</title>
    <link rel="stylesheet" href="css/stylelogin.css">
    <style>
        /* ESTILOS PARA EL BOTÓN DE GOOGLE */
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
        .error-message {
            color: #d9534f; 
            background-color: #f2dede; 
            border: 1px solid #ebccd1;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.9em;
            text-align: center;
        }
    </style>
</head>
<body style="background: url('imagenes/fondo comida.jpg') no-repeat center center fixed; background-size: cover;">
    <?php if ($error_email || $error_password || $error_login): ?>
        <div class="error-message">
            <?= $error_email ?: ($error_password ?: $error_login) ?>
        </div>
    <?php endif; ?>
    <div class="login-bg">
        <div class="login-container">
            <div class="login-logo">
                <img src="imagenes/logo comida.png" alt="Hao Mei Lai Logo">
            </div>
            <h2>Bienvenido</h2>
            <p class="login-subtitle">Inicia sesión con tu cuenta</p>
            
            <button class="btn-google" onclick="window.location.href='google_auth.php?action=login'">
                <img src="imagenes/google_icon.png" alt="Google"> Iniciar Sesión con Google
            </button>
            <div class="divider">O</div>
            
            <form action="login" method="post">
                <label for="email">Correo electrónico o N° Trabajador</label>
                <input type="text" id="email" name="email" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </form>
            
            <form action="login" method="post" class="btn-guest-margin">
                <button type="submit" name="invitado" class="btn-register">Entrar como Invitado</button>
            </form>
            
            <div class="divider"></div>
            <button class="btn-register" onclick="window.location.href='registro'">Crear Nueva Cuenta</button>
            <p class="forgot-link">
                <a href="recuperar">¿Olvidaste tu contraseña?</a>
            </p>
        </div>
        <footer>
            </footer>
    </div>
</body>
</html>