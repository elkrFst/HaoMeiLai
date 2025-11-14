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

// 🚩 PRUEBA A: ¿Se encontró un usuario en la tabla 'usuarios'? 🚩
if (!$usuario) {
    echo "DEBUG PRUEBA A: Usuario NO ENCONTRADO en la tabla 'usuarios'.";
    // Opcional: puedes eliminar estas 2 líneas después de la prueba
}

// 1️⃣ Verificar usuarios/admins
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND contraseña = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if ($usuario) {
    // Línea 1 (Opcional): Usar 'nombre' para ser consistente si lo usa después
    $_SESSION['nombre'] = $usuario['nombre']; 
    // Línea 2 (CRUCIAL): Definir el ID del cliente
    $_SESSION['cliente_id'] = $usuario['cliente_id']; 
    // Línea 3: Definir el rol
    $_SESSION['rol'] = $usuario['rol'];
    
    // 🚩 DEPURACIÓN 1: ¡LA PRUEBA DEFINITIVA DE CREACIÓN! 🚩
    echo "¡SESIÓN CREADA CORRECTAMENTE! <br>";
    echo "ID del Cliente Creado: " . $_SESSION['cliente_id'] . "<br>";
    echo "Rol Creado: " . $_SESSION['rol'];
    exit(); // Detiene la ejecución aquí para mostrar la información

    //if ($usuario['rol'] === 'admin') {
    //    header('Location: panel');
    //} else {
    //    header('Location: inicio'); // Redirige al menu2.php (o a su ruta 'inicio')
    //}
    //exit();
}

// 2️⃣ Verificar empleados
$stmt2 = $conn->prepare("SELECT * FROM empleados WHERE numero_trabajador = ? AND contraseña = ?");
$stmt2->bind_param("ss", $email, $password);
$stmt2->execute();
$result2 = $stmt2->get_result();
$empleado = $result2->fetch_assoc();

if (!$empleado) {
    // 🚩 PRUEBA C: ¿El script llegó al error final? 🚩
    echo "DEBUG PRUEBA C: Error de credenciales.";
    header('Location: iniciodesesion.php?error=credenciales');
}

if ($empleado) {
    $_SESSION['usuario'] = $empleado['nombre'];
    $_SESSION['rol'] = 'Empleado';
    $_SESSION['foto'] = $empleado['foto'];
    header('Location: caja');
    exit();
}

// Si no encontró nada
header('Location: iniciodesesion.php?error=1');
exit();
}
