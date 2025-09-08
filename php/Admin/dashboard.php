<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../iniciodesesión.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Hao Mei Lai</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
    <script src="../../js/dashboard.js" defer></script>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="../../imagenes/logo comida.png" alt="Logo">
            <h2>Hao Mei Lai</h2>
        </div>
        <ul class="menu">
            <li onclick="showSection('dashboard')">Dashboard</li>
            <li onclick="showSection('productos')">Productos</li>
            <li onclick="showSection('trabajadores')">Trabajadores</li>
            <li><a href="logout.php">Cerrar sesión</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div id="dashboard-section" class="section active">
            <h1>Dashboard</h1>
            <div class="cards">
                <div class="card" onclick="showDetail('ventas')">
                    <h3>Ventas hoy</h3>
                    <p id="ventas-hoy">0</p>
                </div>
                <div class="card" onclick="showDetail('pedidos')">
                    <h3>Pedidos hoy</h3>
                    <p id="pedidos-hoy">0</p>
                </div>
                <div class="card" onclick="showDetail('clientes')">
                    <h3>Clientes atendidos</h3>
                    <p id="clientes-hoy">0</p>
                </div>
            </div>
        </div>
        <div id="productos-section" class="section">
            <h1>Productos</h1>
            <div id="productos-table-container"></div>
            <button onclick="showAddProducto()">Agregar producto</button>
            <div id="add-producto-form" style="display:none;"></div>
        </div>
        <div id="trabajadores-section" class="section">
            <h1>Trabajadores</h1>
            <p>Próximamente...</p>
        </div>
        <div id="detalle-section" class="section">
            <button onclick="showSection('dashboard')">Regresar al Dashboard</button>
            <div id="detalle-content"></div>
        </div>
    </div>
</body>
</html>
