<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../iniciodesesión.php');
    exit();
}
require_once '../../conexion.php';

$accion = $_POST['accion'];

if ($accion == 'agregar' || $accion == 'editar') {
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $imagen = 'default.jpg';

    // Si hay imagen subida
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombreImg = uniqid() . '_' . basename($_FILES['imagen']['name']);
        $rutaDestino = '../../php/menu2/imagenes_productos/' . $nombreImg;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);
        $imagen = $nombreImg;
    }

    if ($accion == 'agregar') {
        $sql = "INSERT INTO almacen (producto, precio, stock, imagen) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdis", $producto, $precio, $stock, $imagen);
        $stmt->execute();
    } else {
        $id = $_POST['id'];
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $sql = "UPDATE almacen SET producto=?, precio=?, stock=?, imagen=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdssi", $producto, $precio, $stock, $imagen, $id);
        } else {
            $sql = "UPDATE almacen SET producto=?, precio=?, stock=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdis", $producto, $precio, $stock, $id);
        }
        $stmt->execute();
    }
    header("Location: dashboard.php?section=almacen");
    exit();
} elseif ($accion == 'eliminar') {
    $id = $_POST['id'];
    $sql = "DELETE FROM almacen WHERE id='$id'";
    if (!mysqli_query($conn, $sql)) {
        die('Error al eliminar: ' . mysqli_error($conn));
    }
    header('Location: dashboard.php?page=1&section=almacen');
    exit();
}
?>
