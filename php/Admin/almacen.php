<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Almacén de Productos | Hao Mei Lai</title>
    <link rel="stylesheet" href="../../css/Admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --rojo: #d62828;
            --rojo-oscuro: #b3000f;
            --dorado: #f1d48f; /* dorado suave */
            --dorado-oscuro: #e6b800; /* dorado secundario */
            --beige: #f5e6c8; /* beige cálido sidebar */
            --gris-claro: #f7f7f7;
            --gris-oscuro: #333333;
            --jade: #4caf93;
            --blanco: #fff;
        }
        body {
            background: var(--blanco);
            color: var(--gris-oscuro);
            font-family: 'Calibri', Arial, sans-serif;
            margin: 0;
        }
        .almacen-container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            background: var(--beige);
            width: 260px;
            padding: 32px 0 0 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 2px 0 16px rgba(0,0,0,0.08);
            border-right: 2px solid var(--gris-claro);
        }
        .sidebar .logo {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 40px;
            margin-left: 18px;
        }
        .sidebar .logo img {
            height: 64px;
            width: 64px;
            border-radius: 50%;
            border: 3px solid var(--rojo);
            background: var(--blanco);
            box-shadow: 0 2px 8px rgba(225,6,19,0.12);
        }
        .sidebar .logo span {
            font-size: 2rem;
            font-weight: bold;
            color: var(--rojo);
            letter-spacing: 2px;
            text-shadow: 1px 1px 8px var(--dorado);
        }
        .sidebar nav {
            width: 100%;
        }
        .sidebar nav a {
            display: flex;
            align-items: center;
            gap: 14px;
            color: var(--gris-oscuro);
            text-decoration: none;
            font-size: 1.08rem;
            padding: 14px 36px;
            border-radius: 10px 0 0 10px;
            margin-bottom: 10px;
            transition: background 0.2s, color 0.2s;
            font-weight: 500;
            position: relative;
        }
        .sidebar nav a.active, .sidebar nav a:hover {
            background: var(--blanco);
            color: var(--rojo);
            box-shadow: 2px 4px 16px rgba(214,40,40,0.10);
        }
        .main-content {
            flex: 1;
            padding: 48px 60px;
            background: linear-gradient(135deg, var(--blanco) 70%, var(--beige) 100%);
            min-height: 100vh;
        }
        .almacen-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 38px;
        }
        .almacen-header h1 {
            color: var(--rojo);
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0;
            letter-spacing: 2px;
            text-shadow: 1px 1px 8px var(--dorado);
        }
        .search-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--blanco);
            border-radius: 24px;
            padding: 10px 22px;
            border: 1px solid var(--dorado);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .search-bar input {
            border: none;
            background: transparent;
            font-size: 1.08rem;
            outline: none;
            color: var(--gris-oscuro);
            width: 140px;
        }
        .search-bar .icon {
            font-size: 1.2rem;
            color: var(--dorado-oscuro);
        }
        .user-icon {
            background: var(--blanco);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: var(--rojo);
            margin-left: 22px;
            border: 2px solid var(--dorado);
            box-shadow: 0 2px 8px rgba(214,40,40,0.10);
        }
        .almacen-title {
            font-size: 1.35rem;
            color: var(--gris-oscuro);
            font-weight: bold;
            margin-bottom: 28px;
            letter-spacing: 1px;
            text-shadow: 1px 1px 6px var(--blanco);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .add-product-btn {
            background: var(--rojo);
            color: var(--blanco);
            border: 2px solid var(--dorado);
            border-radius: 8px;
            padding: 10px 28px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px #1112;
        }
        .add-product-btn:hover {
            background: var(--dorado-oscuro);
            color: var(--gris-oscuro);
            border: 2px solid var(--rojo);
        }
        .products-list {
            background: var(--blanco);
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 32px 24px;
            margin-top: 18px;
            overflow-x: auto;
            border: 2px solid var(--dorado);
        }
        .products-list table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 1.08rem;
        }
        .products-list th, .products-list td {
            padding: 16px 20px;
            text-align: left;
            border-right: 1.5px solid #f1d48f;
        }
        .products-list th {
            background: var(--dorado);
            color: var(--gris-oscuro);
            font-weight: bold;
            border-bottom: 2.5px solid #e6b800;
            font-size: 1.08rem;
            letter-spacing: 1px;
        }
        .products-list td {
            color: var(--gris-oscuro);
            font-size: 1.05rem;
            border-bottom: 1.5px solid #f5e6c8;
        }
        .products-list tr {
            transition: background 0.2s;
        }
        .products-list tr:nth-child(even) {
            background: #f7f7f7;
        }
        .products-list tr:nth-child(odd) {
            background: #fff;
        }
        .products-list tr:hover {
            background: #fffbe6;
            box-shadow: 0 2px 12px rgba(214,40,40,0.08);
        }
        .view-btn {
            background: var(--rojo);
            color: var(--blanco);
            border: none;
            border-radius: 8px;
            padding: 7px 22px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(214,40,40,0.10);
        }
        .view-btn:hover {
            background: var(--dorado-oscuro);
            color: var(--gris-oscuro);
            border: 1px solid var(--rojo);
        }
        /* Animación de entrada */
        .products-list, .almacen-header, .almacen-title {
            animation: fadeInUp 0.7s;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px);}
            to { opacity: 1; transform: translateY(0);}
        }
        /* Scrollbar personalizado */
        ::-webkit-scrollbar {
            width: 8px;
            background: var(--beige);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--rojo);
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="almacen-container">
    <aside class="sidebar">
        <div class="logo">
            <img src="../../imagenes/logo comida.png" alt="Logo Hao Mei Lai">
            <span>HAO MEI LAI</span>
        </div>
        <nav>
            <a href="indexadmin.php"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            <a href="almacen.php" class="active"><i class="fa-solid fa-box"></i> Productos</a>
            <a href="trabajadores.php"><i class="fa-solid fa-users"></i> Trabajadores</a>
            <a href="../iniciodesesión.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
        </nav>
    </aside>
    <main class="main-content">
        <div class="almacen-header">
            <h1><i class="fa-solid fa-box-open" style="margin-right:10px;"></i>Almacén de Productos</h1>
            <div style="display:flex; align-items:center;">
                <div class="search-bar">
                    <input type="text" placeholder="Buscar producto...">
                    <span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
                <div class="user-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="almacen-title">
            <span>Lista de Productos</span>
            <button class="add-product-btn"><i class="fa-solid fa-plus"></i> Agregar Producto</button>
        </div>
        <div class="products-list">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Calorías</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Spring Rolls</td><td>150 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Dumplings</td><td>120 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Fried Rice</td><td>200 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Soy Sauce</td><td>10 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Sweet and Sour Pork</td><td>320 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Kung Pao Chicken</td><td>280 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Egg Drop Soup</td><td>90 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Hot and Sour Soup</td><td>110 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Wonton Soup</td><td>130 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Chow Mein</td><td>220 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Lo Mein</td><td>210 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Mapo Tofu</td><td>180 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Char Siu (BBQ Pork)</td><td>250 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Peking Duck</td><td>340 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Steamed Buns</td><td>160 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Sesame Chicken</td><td>290 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>General Tso's Chicken</td><td>310 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Beef with Broccoli</td><td>230 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Orange Chicken</td><td>300 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Egg Fried Rice</td><td>210 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Vegetable Stir Fry</td><td>120 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Crab Rangoon</td><td>180 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Chicken Satay</td><td>170 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                    <tr><td>Fortune Cookies</td><td>60 kcal</td><td><button class="view-btn"><i class="fa-solid fa-eye"></i> Ver</button></td></tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>