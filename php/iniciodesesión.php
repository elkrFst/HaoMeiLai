<?php
session_start();
require '../conexion.php';

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
        $sql = "SELECT * FROM usuarios WHERE email = ? AND contraseña = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $_SESSION['usuario'] = $row['nombre'];
            $_SESSION['rol'] = $row['rol'];
            if ($row['rol'] === 'admin') {
                header("Location: Admin/dashboard.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else {
            $error_login = "Correo o contraseña incorrectos.";
        }
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
    <link rel="stylesheet" href="../css/stylelogin.css">
    <style>
        .error-msg { color: #d90427; font-size: 0.95em; margin-top: 4px; }
    </style>
</head>
<body style="background: url('../imagenes/fondo comida.jpg') no-repeat center center fixed; background-size: cover;">
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
                <img src="../imagenes/logo comida.png" alt="Hao Mei Lai Logo">
            </div>
            <h2>Bienvenido</h2>
            <p class="login-subtitle">Inicia sesión con tu cuenta</p>
            <form action="iniciodesesión.php" method="post">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </form>
            <div class="divider"></div>
            <button class="btn-register" onclick="window.location.href='registro.php'">Crear Nueva Cuenta</button>
            <p class="forgot-link">
                <a href="recuperar_contraseña.php">¿Olvidaste tu contraseña?</a>
            </p>
        </div>
        <footer>
            © 2024 Hao Mei Lai. Todos los derechos reservados.
        </footer>
    </div>
</body>
</html>
