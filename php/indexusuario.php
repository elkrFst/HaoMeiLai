<?php
// PHP para el header del restaurante
$site_name = "Hao Mei Lai"; // Nombre del restaurante
$site_desc = "Auténtica Comida China"; // Descripción del restaurante
$logo_url = "../imagenes/logo comida.png"; // Icono de un dragón, un enlace externo.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($site_name); ?> - Comida China</title>
    <style>
        body {
            margin: 0;
            background: #fff;
        }
        .header {
            background: #fff;
            color: #222;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 80px;
            border-bottom: 2px solid #eee;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 28px;
        }
        .logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid #b30000;
            background: #fff;
            object-fit: cover;
            margin-right: 10px;
        }
        .brand {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .site-name {
            margin: 0;
            font-size: 1.45em;
            font-family: 'Times New Roman', serif;
            color: #b30000;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .site-desc {
            margin: 0;
            font-size: 1em;
            color: #666;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .header-center {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        nav {
            display: flex;
            align-items: center;
        }
        .nav-menu {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 38px;
        }
        .nav-menu a {
            color: #222;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.08em;
            letter-spacing: 0.5px;
            padding: 8px 10px;
            border-radius: 6px;
            transition: background 0.2s, color 0.2s;
            background: none;
        }
        
        .nav-menu a:hover {
            color: #b30000;
            background: #ffd7d7;
        }
        .cart-btn {
            display: flex;
            align-items: center;
            background: #e60000;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 8px 22px;
            font-size: 1.08em;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
            gap: 8px;
            margin-left: 38px;
        }
        .cart-btn:hover {
            background: #b30000;
        }
        .cart-btn svg {
            width: 22px;
            height: 22px;
            fill: #fff;
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-left: 38px;
        }
        .dashboard {
            position: relative;
            margin-left: 18px;
        }
        .dashboard-icon {
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: background 0.2s;
            display: flex;
            align-items: center;
        }
        .dashboard-icon:focus {
            outline: none;
            background: #ffd7d7;
        }
        .dashboard-icon svg {
            display: block;
            transition: filter 0.2s;
        }
        .dashboard-icon:hover svg {
            filter: drop-shadow(0 0 4px #b30000);
        }
        .dashboard-menu {
            position: absolute;
            top: 38px;
            right: 0;
            min-width: 160px;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
            display: none;
            flex-direction: column;
            z-index: 100;
        }
        .dashboard-menu a {
            padding: 12px 18px;
            color: #b30000;
            text-decoration: none;
            font-size: 1em;
            border-bottom: 1px solid #f3f3f3;
            transition: background 0.2s, color 0.2s;
        }
        .dashboard-menu a:last-child {
            border-bottom: none;
        }
        .dashboard-menu a:hover {
            background: #ffd7d7;
            color: #222;
        }
        @media (max-width: 900px) {
            .header {
                flex-direction: column;
                align-items: stretch;
                padding: 10px;
            }
            .header-center {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            nav {
                justify-content: flex-start;
                margin-top: 10px;
            }
            .header-right {
                margin-top: 10px;
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="header-left">
            <img src="<?php echo htmlspecialchars($logo_url); ?>" alt="Logo de Hao Mei Lai" class="logo">
            <div class="brand">
                <span class="site-name"><?php echo htmlspecialchars($site_name); ?></span>
                <span class="site-desc"><?php echo htmlspecialchars($site_desc); ?></span>
            </div>
        </div>
        <div class="header-center">
            <nav>
                <ul class="nav-menu">
                    <li><a href="#" class="active">Inicio</a></li>
                    <li><a href="#menu">Menú</a></li>
                    <li><a href="#reservas">Reservas</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-right">
            <button class="cart-btn">
                <svg viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.16 16h9.45c.75 0 1.41-.41 1.75-1.03l3.24-5.88a1 1 0 0 0-.87-1.47H6.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 19.37 5.48 21 7 21h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.24-5.88a1 1 0 0 0-.87-1.47H6.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 19.37 5.48 21 7 21h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63z"/></svg>
                Ordenar
            </button>
            <div class="dashboard">
                <div class="dashboard-icon" tabindex="0" onclick="toggleDashboardMenu()" onblur="hideDashboardMenu()">
                    <!-- Ícono de menú hamburguesa -->
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                        <rect x="4" y="7" width="16" height="2" rx="1" fill="#b30000"/>
                        <rect x="4" y="11" width="16" height="2" rx="1" fill="#b30000"/>
                        <rect x="4" y="15" width="16" height="2" rx="1" fill="#b30000"/>
                    </svg>
                </div>
                <div class="dashboard-menu" id="dashboardMenu">
                    <a href="#perfil">Perfil</a>
                    <a href="#pedidos">Mis pedidos</a>
                    <a href="#configuracion">Configuración</a>
                    <a href="#ayuda">Ayuda</a>
                    <a href="#logout">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </header>

    <main style="padding: 20px;">
        <h2>Bienvenidos a Hao Mei Lai</h2>
        <p>Disfruta de la auténtica experiencia culinaria china en un ambiente inigualable.</p>
    </main>

    <script>
        // Dashboard desplegable
        function toggleDashboardMenu() {
            var menu = document.getElementById('dashboardMenu');
            menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'flex' : 'none';
        }
        function hideDashboardMenu() {
            setTimeout(function() {
                document.getElementById('dashboardMenu').style.display = 'none';
            }, 150);
        }
        // Cierra el menú si se hace clic fuera
        document.addEventListener('click', function(e) {
            var menu = document.getElementById('dashboardMenu');
            var icon = document.querySelector('.dashboard-icon');
            if (!icon.contains(e.target) && !menu.contains(e.target)) {
                menu.style.display = 'none';
            }
        });
    </script>

</body>
</html>