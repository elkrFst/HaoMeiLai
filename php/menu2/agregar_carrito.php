<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto'])) {
    $nuevo = [
        'producto' => $_POST['producto'],
        'precio' => floatval($_POST['precio']),
        'cantidad' => intval($_POST['cantidad'])
    ];
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    $encontrado = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['producto'] === $nuevo['producto']) {
            $item['cantidad'] += $nuevo['cantidad'];
            $encontrado = true;
            break;
        }
    }
    if (!$encontrado) {
        $_SESSION['carrito'][] = $nuevo;
    }
    echo json_encode(['ok' => true]);
    exit();
}
echo json_encode(['ok' => false]);
exit();
?>