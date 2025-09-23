<?php
include 'conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validar campos vacíos
    if (empty($email) || empty($password)) {
        header('Location: iniciodesesion.php?error=campos');
        exit();
    }

// 1️⃣ Verificar usuarios/admins
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND contraseña = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if ($usuario) {
    $_SESSION['usuario'] = $usuario['nombre'];
    $_SESSION['rol'] = $usuario['rol'];

    if ($usuario['rol'] === 'admin') {
        header('Location: php/Admin/dashboard.php');
    } else {
        header('Location: index.php');
    }
    exit();
}

// 2️⃣ Verificar empleados
$stmt2 = $conn->prepare("SELECT * FROM empleados WHERE numero_trabajador = ? AND contraseña = ?");
$stmt2->bind_param("ss", $email, $password);
$stmt2->execute();
$result2 = $stmt2->get_result();
$empleado = $result2->fetch_assoc();

if ($empleado) {
    $_SESSION['usuario'] = $empleado['nombre'];
    $_SESSION['rol'] = 'Empleado';
    $_SESSION['foto'] = $empleado['foto'];
    header('Location: php/Empleado/empleado.php');
    exit();
}

// Si no encontró nada
header('Location: iniciodesesion.php?error=1');
exit();
}
