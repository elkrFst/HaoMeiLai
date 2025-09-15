<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../iniciodesesión.php');
    exit();
}
require_once '../../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];
    if ($accion === 'agregar') {
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        mysqli_query($conn, "INSERT INTO almacen (producto, precio, stock) VALUES ('$producto', $precio, $stock)");
    } elseif ($accion === 'editar') {
        $id = $_POST['id'];
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        mysqli_query($conn, "UPDATE almacen SET producto='$producto', precio=$precio, stock=$stock WHERE id=$id");
    } elseif ($accion === 'eliminar') {
        $id = $_POST['id'];
        mysqli_query($conn, "DELETE FROM almacen WHERE id=$id");
    }
}
header('Location: dashboard.php');
exit();
