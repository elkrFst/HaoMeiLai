<?php
// filepath: c:\xampp\htdocs\HaoMeiLai\php\menu2\carrito.php
session_start();

// Eliminar producto del carrito
if (isset($_GET['eliminar'])) {
    $indice = intval($_GET['eliminar']);
    if (isset($_SESSION['carrito'][$indice])) {
        array_splice($_SESSION['carrito'], $indice, 1);
    }
    header("Location: carrito.php");
    exit();
}

// Verifica si hay productos en el carrito
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras - Hao Mei Lai</title>
    <link rel="stylesheet" href="menu2.css">
</head>
<body>
    <h2>Carrito de Compras</h2>
    <?php if (empty($carrito)): ?>
        <p>No hay alimentos seleccionados.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrito as $i => $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['producto']); ?></td>
                        <td>$<?php echo number_format($item['precio'], 2); ?></td>
                        <td><?php echo intval($item['cantidad']); ?></td>
                        <td>
                            <a href="carrito.php?eliminar=<?php echo $i; ?>">Quitar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <a href="menu2.php">Volver al menú</a>
</body>
</html>