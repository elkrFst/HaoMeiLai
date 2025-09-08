<?php
require_once '../../conexion.php';
header('Content-Type: application/json');
$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    echo json_encode([]);
    exit;
}
$action = $_GET['action'] ?? '';
if ($action == 'list') {
    $res = $mysqli->query('SELECT * FROM productos ORDER BY id ASC');
    $productos = [];
    while ($row = $res->fetch_assoc()) {
        $productos[] = $row;
    }
    echo json_encode($productos);
} elseif ($action == 'add') {
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $stmt = $mysqli->prepare('INSERT INTO productos (producto, precio, stock) VALUES (?, ?, ?)');
    $stmt->bind_param('sdi', $producto, $precio, $stock);
    $ok = $stmt->execute();
    echo json_encode(['success' => $ok]);
} elseif ($action == 'edit') {
    $id = $_POST['id'];
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $stmt = $mysqli->prepare('UPDATE productos SET producto=?, precio=?, stock=? WHERE id=?');
    $stmt->bind_param('sdii', $producto, $precio, $stock, $id);
    $ok = $stmt->execute();
    echo json_encode(['success' => $ok]);
} elseif ($action == 'delete') {
    $id = $_GET['id'];
    $stmt = $mysqli->prepare('DELETE FROM productos WHERE id=?');
    $stmt->bind_param('i', $id);
    $ok = $stmt->execute();
    echo json_encode(['success' => $ok]);
} else {
    echo json_encode([]);
}
