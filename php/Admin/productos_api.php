<?php
// productos_api.php
header('Content-Type: application/json');
require_once '../../conexion.php';
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $sql = "SELECT * FROM productos ORDER BY id ASC";
        $result = $conn->query($sql);
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
        echo json_encode($productos);
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $nombre = $conn->real_escape_string($data['nombre']);
        $categoria = $conn->real_escape_string($data['categoria']);
        $stock = intval($data['stock']);
        $precio = floatval($data['precio']);
        $sql = "INSERT INTO productos (nombre, categoria, stock, precio) VALUES ('$nombre', '$categoria', $stock, $precio)";
        $ok = $conn->query($sql);
        echo json_encode(['success' => $ok]);
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = intval($data['id']);
        $nombre = $conn->real_escape_string($data['nombre']);
        $categoria = $conn->real_escape_string($data['categoria']);
        $stock = intval($data['stock']);
        $precio = floatval($data['precio']);
        $sql = "UPDATE productos SET nombre='$nombre', categoria='$categoria', stock=$stock, precio=$precio WHERE id=$id";
        $ok = $conn->query($sql);
        echo json_encode(['success' => $ok]);
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = intval($data['id']);
        $sql = "DELETE FROM productos WHERE id=$id";
        $ok = $conn->query($sql);
        echo json_encode(['success' => $ok]);
        break;
}
$conn->close();
?>
