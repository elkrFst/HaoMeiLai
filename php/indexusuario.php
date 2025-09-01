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
                    <li><a href="indexusuario.php" class="active">Inicio</a></li>
                    <li><a href="menu.php">Menú</a></li>
                    <li><a href="aboutus.php">Contacto</a></li>
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
                    <a href="../php/iniciodesesión.php">iniciar sesion</a>
                </div>
            </div>
        </div>
    </header>

    <main style="padding: 0;">
        <section class="bienvenida-hero">
            <div class="bienvenida-overlay">
                <h2>¡Bienvenidos a <span>Hao Mei Lai</span>!</h2>
                <p>Disfruta de la <b>auténtica experiencia culinaria china</b> en un ambiente inigualable.</p>
            </div>
        </section>
        <?php include 'menu.php'; ?>
    </main>

    <footer class="footer">
        <div class="footer-main">
            <div class="footer-column">
                <h3>Más información sobre Hao Mei Lai</h3>
                <ul>
                    <li><a href="aboutus.php">Contáctanos</a></li>
                    <li><a href="#">Regístrate y recibe información</a></li>
                    <li><a href="#">Nuestra Promesa</a></li>
                    <li><a href="#">Hao Mei Lai en el mundo</a></li>
                    <li><a href="#">Información nutricional</a></li>
                    <li><a href="#">Facturación</a></li>
                </ul>
            </div>
            <div class="footer-column footer-social">
                <h3>Síguenos</h3>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"><img src="../imagenes/facebook.svg" alt="Facebook"></a>
                    <a href="#" aria-label="Instagram"><img src="../imagenes/instagram.svg" alt="Instagram"></a>
                    <a href="#" aria-label="Twitter"><img src="../imagenes/twitter.svg" alt="Twitter"></a>
                    <a href="#" aria-label="TikTok"><img src="../imagenes/tiktok.svg" alt="TikTok"></a>
                </div>
                <div class="footer-logo">
                    <img src="../imagenes/logo comida.png" alt="Logo Hao Mei Lai">
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; <?php echo date("Y"); ?> Hao Mei Lai. Todos los derechos reservados.</span>
            <span> | <a href="#">Privacidad de datos</a> | <a href="#">Términos y condiciones</a> | <a href="#">Promociones</a></span>
        </div>
    </footer>
</body>
</html>