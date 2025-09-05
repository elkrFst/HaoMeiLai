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
                <ul class="nav-menu">                    <li><a href="indexusuario.php" class="active">Inicio</a></li>
                    <li><a href="menu2/menu2.php">Menú</a></li>
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
                    <!-- Facebook -->
                    <a href="#" aria-label="Facebook">
                        <svg width="28" height="28" viewBox="0 0 32 32" fill="none">
                            <circle cx="16" cy="16" r="16" fill="#1877F3"/>
                            <path d="M21 16.02h-3v8h-3v-8h-2v-3h2v-1.5c0-2.07 1.02-3.5 3.5-3.5h2.5v3h-2c-.47 0-.5.18-.5.5V13h2.5l-.5 3z" fill="#fff"/>
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="#" aria-label="Instagram">
                        <svg width="28" height="28" viewBox="0 0 32 32" fill="none">
                            <radialGradient id="ig" cx="0.5" cy="0.5" r="0.8">
                                <stop offset="0%" stop-color="#fdf497"/>
                                <stop offset="45%" stop-color="#fdf497"/>
                                <stop offset="60%" stop-color="#fd5949"/>
                                <stop offset="90%" stop-color="#d6249f"/>
                                <stop offset="100%" stop-color="#285AEB"/>
                            </radialGradient>
                            <rect x="4" y="4" width="24" height="24" rx="8" fill="url(#ig)"/>
                            <circle cx="16" cy="16" r="6" fill="none" stroke="#fff" stroke-width="2"/>
                            <circle cx="22" cy="10" r="1.5" fill="#fff"/>
                        </svg>
                    </a>
                    <!-- Twitter -->
                    <a href="#" aria-label="Twitter">
                        <svg width="28" height="28" viewBox="0 0 32 32" fill="none">
                            <circle cx="16" cy="16" r="16" fill="#1DA1F2"/>
                            <path d="M24 12.3c-.5.2-1 .4-1.5.5.5-.3.9-.8 1.1-1.3-.5.3-1 .5-1.6.6-.5-.5-1.2-.8-2-.8-1.5 0-2.7 1.2-2.7 2.7 0 .2 0 .4.1.6-2.2-.1-4.1-1.2-5.4-2.8-.2.4-.3.8-.3 1.3 0 .9.5 1.7 1.2 2.2-.4 0-.8-.1-1.1-.3v.1c0 1.3.9 2.3 2.1 2.6-.2.1-.4.1-.7.1-.2 0-.3 0-.5-.1.3 1 1.3 1.7 2.4 1.7-1 .8-2.2 1.3-3.5 1.3-.2 0-.4 0-.6-.1 1.2.8 2.6 1.3 4.1 1.3 4.9 0 7.6-4 7.6-7.6v-.3c.5-.4 1-.9 1.3-1.5z" fill="#fff"/>
                        </svg>
                    </a>
                    <!-- TikTok -->
                    <a href="#" aria-label="TikTok">
                        <svg width="28" height="28" viewBox="0 0 32 32" fill="none">
                            <circle cx="16" cy="16" r="16" fill="#000"/>
                            <path d="M22.5 14.5c-1.1 0-2-.9-2-2V9.5h-2v9c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2c.2 0 .4 0 .5.1v-2.1c-.2 0-.3-.1-.5-.1-2.2 0-4 1.8-4 4s1.8 4 4 4 4-1.8 4-4v-3.5c.6.4 1.3.6 2 .6v-2z" fill="#fff"/>
                            <path d="M20.5 9.5v3c0 1.1.9 2 2 2v-2c-.6 0-1-.4-1-1v-2h-1z" fill="#25F4EE"/>
                            <path d="M18.5 9.5v9c0 1.1-.9 2-2 2v2c2.2 0 4-1.8 4-4v-9h-2z" fill="#FE2C55"/>
                        </svg>
                    </a>
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