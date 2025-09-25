<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'conexion.php';

$error_email = '';
$error_password = '';
$error_login = '';

// 🟢 Lógica para "Entrar como Invitado"
if (isset($_POST['invitado'])) {
    $_SESSION['usuario'] = 'Invitado'; // O cualquier nombre que prefieras
    $_SESSION['rol'] = 'invitado';
    header("Location: inicio"); // Redirige a la página principal
    exit();
}
// 🔴 Fin Lógica Invitado

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
            // 1️⃣ Verificar en tabla usuarios
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND contraseña = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                $_SESSION['usuario'] = $row['nombre'];
                $_SESSION['rol'] = $row['rol'];
                if ($row['rol'] === 'admin') {
                    header("Location: panel");
                } else {
                    header("Location: inicio");
                }
                exit();
            }

            // 2️⃣ Verificar en tabla empleados
            $stmt2 = $conn->prepare("SELECT * FROM empleados WHERE numero_trabajador = ? AND contraseña = ?");
            $stmt2->bind_param("ss", $email, $password); 
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if ($empleado = $result2->fetch_assoc()) {
                $_SESSION['usuario'] = $empleado['nombre'];
                $_SESSION['rol'] = 'Empleado';
                $_SESSION['foto'] = $empleado['foto'];
                header("Location: caja"); 
                exit();
            }

            $error_login = "Correo/N° Trabajador o contraseña incorrectos.";
            // Cierre de statements y conexión si el login falló
            if (isset($stmt)) $stmt->close();
            if (isset($stmt2)) $stmt2->close();
            if (isset($conn)) $conn->close();
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
        .error-msg { color: #d90427; font-size: 0.95em; margin-top: 4px; }
        /* 💡 ESTILO EXTRA para separar el botón de invitado del login */
        .btn-guest-margin {
             margin-top: 15px; 
        }
    </style>
</head>
<body style="background: url('imagenes/fondo comida.jpg') no-repeat center center fixed; background-size: cover;">
    <?php if (isset($_GET['registro']) && $_GET['registro'] === 'exito'): ?>
        <div class="success-floating">
            Registro completado con éxito
        </div>
    <?php endif; ?>
    <?php if ($error_email || $error_password || $error_login): ?>
        <div class="error-floating">
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
            © 2024 Hao Mei Lai. Todos los derechos reservados.
        </footer>
    </div>
</body>
</html>