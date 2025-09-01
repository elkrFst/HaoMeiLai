<?php
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Consulta para obtener el usuario y su rol
    $stmt = $conexion->prepare('SELECT password, rol FROM usuarios WHERE correo = :correo');
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Comparación directa de contraseña (sin hash)
    if ($usuario && $password === $usuario['password']) {
        session_start();
        $_SESSION['correo'] = $correo;
        $_SESSION['rol'] = $usuario['rol'];
        // Redirigir según el rol
        if ($usuario['rol'] === 'admin') {
            header('Location: Admin/indexadmin.php');
            exit();
        } else {
            header('Location: indexusuario.php');
            exit();
        }
    } else {
        // Credenciales incorrectas
        header('Location: iniciodesesión.php?error=1');
        exit();
    }
} else {
    header('Location: iniciodesesión.php');
    exit();
}
?>
