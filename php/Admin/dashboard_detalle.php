<?php
// Recibe el parámetro "card" por GET para mostrar el detalle
$card = isset($_GET['card']) ? $_GET['card'] : '';
$details = [
    'ventas' => [
        'titulo' => 'Ventas Hoy',
        'icono' => '$',
        'valor' => '$2,847',
        'descripcion' => 'Total de ventas realizadas hoy. Incluye todos los pedidos pagados y facturados.',
        'extra' => '+12% respecto a ayer',
        'color' => '#27ae60'
    ],
    'pedidos' => [
        'titulo' => 'Pedidos Hoy',
        'icono' => '&#128722;',
        'valor' => '147',
        'descripcion' => 'Cantidad de pedidos realizados hoy. Incluye pedidos en línea y en restaurante.',
        'extra' => '8 en preparación',
        'color' => '#3f51b5'
    ],
    'clientes' => [
        'titulo' => 'Clientes Atendidos',
        'icono' => '&#128101;',
        'valor' => '89',
        'descripcion' => 'Clientes que han sido atendidos hoy. Incluye calificación promedio.',
        'extra' => '⭐ 4.8 rating promedio',
        'color' => '#a259e6'
    ]
];
$info = isset($details[$card]) ? $details[$card] : false;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle - Dashboard | Hao Mei Lai</title>
    <link rel="stylesheet" href="../../css/Admin.css">
    <style>
        body { background: #f7f7f7; font-family: 'Calibri', Arial, sans-serif; }
        .detalle-container { max-width: 480px; margin: 60px auto; background: #fff; border-radius: 18px; box-shadow: 0 4px 18px rgba(220,0,0,0.10); padding: 38px 32px; text-align: center; }
        .detalle-icono { font-size: 3.5em; margin-bottom: 18px; color: <?= $info ? $info['color'] : '#b30028' ?>; }
        .detalle-titulo { font-size: 2.1em; color: #b30028; font-weight: bold; margin-bottom: 12px; }
        .detalle-valor { font-size: 2.5em; color: #222; font-weight: bold; margin-bottom: 18px; }
        .detalle-desc { font-size: 1.15em; color: #444; margin-bottom: 18px; }
        .detalle-extra { font-size: 1.08em; color: #888; margin-bottom: 18px; }
        .btn-volver { background: #b30028; color: #fff; border: none; border-radius: 8px; padding: 10px 28px; font-size: 1.08em; font-weight: 500; text-decoration: none; box-shadow: 0 2px 8px rgba(214,40,40,0.10); transition: background 0.2s; margin-top: 18px; display: inline-block; }
        .btn-volver:hover { background: #d62828; }
    </style>
</head>
<body>
    <div class="detalle-container">
        <?php if($info): ?>
            <div class="detalle-icono"><?= $info['icono'] ?></div>
            <div class="detalle-titulo"><?= htmlspecialchars($info['titulo']) ?></div>
            <div class="detalle-valor"><?= htmlspecialchars($info['valor']) ?></div>
            <div class="detalle-desc"><?= htmlspecialchars($info['descripcion']) ?></div>
            <div class="detalle-extra"><?= htmlspecialchars($info['extra']) ?></div>
            <a href="dashboard.php" class="btn-volver">← Volver al Dashboard</a>
        <?php else: ?>
            <div class="detalle-titulo">Tarjeta no encontrada</div>
            <a href="dashboard.php" class="btn-volver">← Volver al Dashboard</a>
        <?php endif; ?>
    </div>
</body>
</html>
