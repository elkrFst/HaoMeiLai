<?php
require '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = 'usuario'; // Siempre asigna el rol usuario
    $fecha_registro = date('Y-m-d H:i:s'); // Fecha actual

    // Puedes cifrar la contraseña si lo deseas:
    // $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Verifica si el correo ya existe
    $sql_check = "SELECT id FROM usuarios WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        echo "<script>alert('El correo ya está registrado'); window.location.href='registro.php';</script>";
    } else {
        $sql = "INSERT INTO usuarios (nombre, email, contraseña, rol, fecha_registro) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $email, $password, $rol, $fecha_registro);
        if ($stmt->execute()) {
            header("Location: iniciodesesión.php?registro=exito");
            exit();
        } else {
            echo "<script>alert('Error al registrar. Intenta de nuevo.'); window.location.href='registro.php';</script>";
        }
        $stmt->close();
    }
    $stmt_check->close();
    $conn->close();
} else {
    header("Location: registro.php");
    exit();
}