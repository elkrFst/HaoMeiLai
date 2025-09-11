<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../iniciodesesión.php');
    exit();
}
require_once '../../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}

$accion = $_POST['accion'] ?? '';
if ($accion == 'agregar') {
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $sql = "INSERT INTO almacen (producto, precio, stock) VALUES ('$producto', '$precio', '$stock')";
    if (!mysqli_query($conn, $sql)) {
        die('Error al agregar: ' . mysqli_error($conn));
    }
} elseif ($accion == 'editar') {
    $id = $_POST['id'];
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $sql = "UPDATE almacen SET producto='$producto', precio='$precio', stock='$stock' WHERE id='$id'";
    if (!mysqli_query($conn, $sql)) {
        die('Error al editar: ' . mysqli_error($conn));
    }
} elseif ($accion == 'eliminar') {
    $id = $_POST['id'];
    $sql = "DELETE FROM almacen WHERE id='$id'";
    if (!mysqli_query($conn, $sql)) {
        die('Error al eliminar: ' . mysqli_error($conn));
    }
}
header('Location: dashboard.php?page=1&section=almacen');
exit();
?>
