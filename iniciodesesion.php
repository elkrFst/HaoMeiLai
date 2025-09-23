<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'conexion.php';

$error_email = '';
$error_password = '';
$error_login = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        header("Location: php/Admin/dashboard.php");
    } else {
        header("Location: index.php");
    }
    exit();
}

// 2️⃣ Verificar en tabla empleados
$stmt2 = $conn->prepare("SELECT * FROM empleados WHERE numero_trabajador = ? AND contraseña = ?");
$stmt2->bind_param("ss", $email, $password); // aquí el campo que pongas en el input puede ser numero_trabajador
$stmt2->execute();
$result2 = $stmt2->get_result();

if ($empleado = $result2->fetch_assoc()) {
    $_SESSION['usuario'] = $empleado['nombre'];
    $_SESSION['rol'] = 'Empleado';
    $_SESSION['foto'] = $empleado['foto'];
    header("Location: php/Empleado/empleado.php"); // crea este dashboard para empleados
    exit();
}

$error_login = "Correo/N° Trabajador o contraseña incorrectos.";
        $stmt->close();
        $conn->close();
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
            <form action="iniciodesesion.php" method="post">
                <label for="email">Correo electrónico o N° Trabajador</label>
                <input type="text" id="email" name="email" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </form>
            <div class="divider"></div>
            <button class="btn-register" onclick="window.location.href='registro.php'">Crear Nueva Cuenta</button>
            <p class="forgot-link">
                <a href="recuperar_contrasena.php">¿Olvidaste tu contraseña?</a>
            </p>
        </div>
        <footer>
            © 2024 Hao Mei Lai. Todos los derechos reservados.
        </footer>
    </div>
</body>
</html>