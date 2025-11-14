<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = 'usuario'; // Siempre asigna el rol usuario
    $fecha_registro = date('Y-m-d H:i:s'); // Fecha actual

    // Codificar las variables para la URL en caso de error
    $nombre_url = urlencode($nombre);
    $email_url = urlencode($email);

    // 🚩 VALIDACIÓN 1: Verifica si el correo contiene "@gmail.com"
    if (strpos($email, '@gmail.com') === false) {
        // Redirige al formulario con el error y los datos antiguos
        header("Location: registro.php?error=gmail_required&nombre={$nombre_url}&email={$email_url}");
        exit(); 
    }
    // Fin de validación

    // Puedes cifrar la contraseña si lo deseas:
    // $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // 🚩 VALIDACIÓN 2: Verifica si el correo ya existe
    $sql_check = "SELECT cliente_id FROM usuarios WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Redirige con el error de correo ya registrado y los datos antiguos
        header("Location: registro.php?error=email_exists&nombre={$nombre_url}&email={$email_url}");
        exit(); 
    } else {
        // 🚩 INSERCIÓN DE DATOS
        $sql = "INSERT INTO usuarios (nombre, email, contraseña, rol, fecha_registro) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // NOTA: Se recomienda encarecidamente usar password_hash() para cifrar la contraseña.
        $stmt->bind_param("sssss", $nombre, $email, $password, $rol, $fecha_registro);
        
        if ($stmt->execute()) {
            // Éxito en el registro
            header("Location: iniciodesesion.php?registro=exito");
            exit();
        } else {
            // Error genérico de base de datos
            header("Location: registro.php?error=db_error&nombre={$nombre_url}&email={$email_url}");
            exit(); 
        }
        $stmt->close();
    }
    $stmt_check->close();
    $conn->close();
} else {
    // Si se accede directamente, redirige al formulario
    header("Location: registro.php");
    exit();
}
?>