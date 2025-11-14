<?php
// guardar_pedido.php
session_start();

header('Content-Type: application/json');

// Credenciales de conexión (obtenidas de menu2 (2).php)
$host = "srv562.hstgr.io";
$user = "u162512390_Admin";
$pass = "biuqkb>O3";
$db = "u162512390_HaoMeiLai";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Error de conexión a la base de datos."]);
    exit();
}

// 1. Verificación de sesión y datos
$cliente_id = $_SESSION['cliente_id'] ?? null; // AHORA ESTO TENDRÁ UN VALOR
$nombre_cliente = $_SESSION['nombre'] ?? 'Cliente Desconocido'; // NOTA: Cambié 'usuario' por 'nombre' en el login para que esta línea sea válida, si usa 'usuario' en el login, debería usar $_SESSION['usuario'] aquí.

if (strtolower($_SESSION['rol'] ?? '') !== 'usuario' || !$cliente_id) { // ESTA VALIDACIÓN PASARÁ
    echo json_encode(["success" => false, "message" => "Acceso denegado o sesión de usuario no válida."]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['carrito_data']) || empty($_POST['carrito_data'])) {
    echo json_encode(["success" => false, "message" => "Datos de carrito no recibidos."]);
    exit();
}

$carrito = json_decode($_POST['carrito_data'], true);
$total_pedido = 0;
foreach ($carrito as $item) {
    // Es crucial que el campo 'precio_raw' esté en el carrito enviado desde JS
    $total_pedido += $item['precio_raw'] * $item['cantidad'];
}

// 2. Generar el código de 8 dígitos
function generarCodigoPedido($conn) {
    do {
        // Genera un número aleatorio de 8 dígitos y lo rellena con ceros a la izquierda si es necesario
        $codigo = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        $stmt_check = $conn->prepare("SELECT id FROM pedidos WHERE id = ?");
        $stmt_check->bind_param("s", $codigo);
        $stmt_check->execute();
        $stmt_check->store_result();
        $is_duplicate = $stmt_check->num_rows > 0;
        $stmt_check->close();
    } while ($is_duplicate);
    return $codigo;
}

$codigo_pedido = generarCodigoPedido($conn);

$conn->begin_transaction();
try {
    // 3. Insertar en la tabla `pedidos`
    $stmt_pedido = $conn->prepare("INSERT INTO pedidos (id, cliente_id, total, estado) VALUES (?, ?, ?, 'Pendiente')");
    $stmt_pedido->bind_param("sid", $codigo_pedido, $cliente_id, $total_pedido);
    $stmt_pedido->execute();
    $stmt_pedido->close();

    // 4. Insertar en la tabla `detalle_pedido`
    $stmt_detalle = $conn->prepare("INSERT INTO detalle_pedido (pedido_id, producto_id, cantidad, precio_unidad) VALUES (?, ?, ?, ?)");
    
    foreach ($carrito as $item) {
        // Validación de Stock (opcional, pero recomendada)
        $stmt_stock = $conn->prepare("SELECT stock FROM almacen WHERE id = ?");
        $stmt_stock->bind_param("i", $item['id']);
        $stmt_stock->execute();
        $result_stock = $stmt_stock->get_result();
        $producto_stock = $result_stock->fetch_assoc();
        $stmt_stock->close();

        if ($producto_stock['stock'] < $item['cantidad']) {
            throw new Exception("Stock insuficiente para " . $item['nombre']);
        }
        
        $stmt_detalle->bind_param("siid", 
            $codigo_pedido, 
            $item['id'], 
            $item['cantidad'], 
            $item['precio_raw']
        );
        $stmt_detalle->execute();
    }
    $stmt_detalle->close();

    $conn->commit();

    // 5. Devolver éxito
    echo json_encode([
        "success" => true,
        "message" => "Pedido guardado con éxito.",
        "codigo" => $codigo_pedido,
        "nombre_usuario" => $nombre_cliente,
        "fecha" => date('Y-m-d H:i:s'),
        "total" => number_format($total_pedido, 2),
        "carrito" => $carrito
    ]);

} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Error al guardar el pedido: " . $e->getMessage()]);
}

$conn->close();
?>