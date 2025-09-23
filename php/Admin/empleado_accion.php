<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../../iniciodesesion.php');
    exit();
}

require_once '../../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null; // si es editar
    $nombre = $_POST['nombre'];
    $numero_trabajador = $_POST['numero_trabajador'];
    $contraseña = $_POST['contraseña'];
    $descripcion = $_POST['descripcion'] ?? '';

    $carpeta = '../../trabajadores/';
    if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);

    // Si se envía una foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $nombreArchivo = time() . '_' . basename($_FILES['foto']['name']);
        $rutaDestino = $carpeta . $nombreArchivo;
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
            echo "<script>alert('Error al subir la imagen'); window.history.back();</script>";
            exit();
        }
    }

    if ($id) {
        // --- EDITAR EMPLEADO ---
        if (!isset($nombreArchivo)) {
            // Si no subieron foto, mantener la actual
            $stmt = $conn->prepare("UPDATE empleados SET nombre=?, numero_trabajador=?, contraseña=?, descripcion=?
                                    WHERE id=?");
            $stmt->bind_param("ssssi", $nombre, $numero_trabajador, $contraseña, $descripcion, $id);
        } else {
            $stmt = $conn->prepare("UPDATE empleados SET nombre=?, numero_trabajador=?, contraseña=?, descripcion=?, foto=?
                                    WHERE id=?");
            $stmt->bind_param("sssssi", $nombre, $numero_trabajador, $contraseña, $descripcion, $nombreArchivo, $id);
        }

        if ($stmt->execute()) {
            header('Location: dashboard.php?success=1');
            exit();
        } else {
            echo "<script>alert('Error al actualizar el empleado'); window.history.back();</script>";
        }

    } else {
        // --- AGREGAR EMPLEADO ---
        if (!isset($nombreArchivo)) {
            echo "<script>alert('Debe seleccionar una foto'); window.history.back();</script>";
            exit();
        }
        $stmt = $conn->prepare("INSERT INTO empleados (nombre, numero_trabajador, contraseña, descripcion, foto)
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $numero_trabajador, $contraseña, $descripcion, $nombreArchivo);

        if ($stmt->execute()) {
            header('Location: dashboard.php?success=1');
            exit();
        } else {
            echo "<script>alert('Error al guardar el empleado'); window.history.back();</script>";
        }
    }
    // ELIMINAR EMPLEADO
    if ($accion === 'eliminar') {
        $id = intval($_POST['id']);

        // Eliminar empleado de la base
        $sql = "DELETE FROM empleados WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            header("Location: dashboard.php?msg=empleado_eliminado");
        } else {
            echo "Error al eliminar: " . mysqli_error($conn);
        }
        exit();
    }
} else {
    header('Location: dashboard.php');
    exit();
}
?>
