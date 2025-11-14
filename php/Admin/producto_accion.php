<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../../iniciodesesion.php');
    exit();
}
require_once '../../conexion.php';

$accion = $_POST['accion'];

if ($accion == 'agregar' || $accion == 'editar') {
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];
    $imagen = 'default.jpg';

    // Si hay imagen subida
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombreImg = uniqid() . '_' . basename($_FILES['imagen']['name']);
        $rutaDestino = '../menu2/imagenes_productos/' . $nombreImg;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);
        $imagen = $nombreImg;
    }

    if ($accion == 'agregar') {
        $sql = "INSERT INTO almacen (producto, precio, stock, imagen, categoria) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdiss", $producto, $precio, $stock, $imagen, $categoria);
        $stmt->execute();
    } else { // editar
        $id = $_POST['id'];
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $sql = "UPDATE almacen SET producto=?, precio=?, stock=?, imagen=?, categoria=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdissi", $producto, $precio, $stock, $imagen, $categoria, $id);
        } else {
            $sql = "UPDATE almacen SET producto=?, precio=?, stock=?, categoria=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdssi", $producto, $precio, $stock, $categoria, $id);
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
