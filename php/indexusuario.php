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
      <link rel="stylesheet" href="../css/User.css">
       <link rel="stylesheet" href="../css/dashboard.css">
       <script src="../js/dashboard.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($site_name); ?> - Comida China</title>
    
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
                    <a href="../php/iniciodesesión.php">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </header>

    <main style="padding: 20px;">
        <h2>Bienvenidos a Hao Mei Lai</h2>
        <p>Disfruta de la auténtica experiencia culinaria china en un ambiente inigualable.</p>
    </main>
</body>
</html>