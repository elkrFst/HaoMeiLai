<?php
session_start();
// PHP para el header del restaurante
$site_name = "Hao Mei Lai"; // Nombre del restaurante
$site_desc = "Auténtica Comida China"; // Descripción del restaurante
$logo_url = "imagenes/logo comida.png"; // Icono de un dragón, un enlace externo.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/User.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <style>
    .icon-btn-menu {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        background: #fff;
        border: none;
        border-radius: 16px;
        padding: 18px 16px;
        cursor: pointer;
        box-shadow: 0 4px 18px rgba(220, 0, 0, 0.10), 0 1.5px 8px rgba(0,0,0,0.08);
        transition: border 0.2s, box-shadow 0.2s;
    }
    .icon-btn-menu:hover {
        border: 2px solid #ffd700;
        box-shadow: 0 6px 24px rgba(220, 0, 0, 0.18), 0 2px 12px rgba(0,0,0,0.12);
    }
    .icon-btn-menu svg {
        margin-bottom: 4px;
    }
    .menu-card-top {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 18px rgba(220, 0, 0, 0.10), 0 1.5px 8px rgba(0,0,0,0.08);
        border: 2.5px solid #b30028;
        overflow: hidden;
        width: 260px;
        margin-bottom: 18px;
        transition: box-shadow 0.2s, border 0.2s;
    }
    .menu-card-top img {
        display: block;
    }
    .menu-card-body {
        padding: 18px 16px 14px 16px;
    }
    .menu-card-top h3 {
        color: #b30028;
        font-size: 1.18em;
        margin-bottom: 8px;
    }
    .dashboard {
        position: relative;
        display: inline-block;
    }
    .dashboard-menu {
        display: none;
        position: absolute;
        top: 48px;
        right: 0;
        min-width: 180px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.12);
        border: 2px solid #ffd700;
        z-index: 100;
        padding: 10px 0;
        transition: box-shadow 0.2s, border 0.2s;
    }
    .dashboard-menu a {
        display: block;
        padding: 12px 24px;
        color: #b30000;
        text-decoration: none;
        font-family: 'Montserrat', 'Roboto', Arial, sans-serif;
        font-size: 1.08em;
        border-radius: 8px;
        margin: 2px 10px;
        transition: background 0.2s, color 0.2s;
    }
    .dashboard-menu a:hover {
        background: #ffd700;
        color: #333;
    }
    .dashboard-icon {
        cursor: pointer;
        padding: 8px;
        border-radius: 12px;
        transition: background 0.2s;
    }
    .dashboard-icon:focus {
        outline: none;
        background: #f1d48f;
    }
    @media (max-width: 768px) {
        .menu-categorias {
            flex-direction: column;
            align-items: center;
        }
        .icon-btn-menu {
            width: 90%;
            max-width: 300px;
        }
    }
    </style>
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
                    <li><a href="index.php" class="active">Inicio</a></li>
                    <li><a href="php/menu2/menu2.php">Menú</a></li>
                    <li><a href="php/AboutUs/about.php">Contacto</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-right">
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
                    <a href="#ayuda">Ayuda</a>
                    <?php if (empty($_SESSION['usuario'])): ?>
                        <a href="iniciodesesion.php">Iniciar sesión</a>
                    <?php else: ?>
                        <a href="cerrarsesion.php">Cerrar sesión</a>
                    <?php endif; ?>
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
        <section class="menu-section">
            <h2 style="text-align:center; color: #b30000; margin-top:32px;">Explora por categoría</h2>
            <div class="menu-categorias" style="display:flex;justify-content:center;gap:38px;margin-bottom:32px;flex-wrap:wrap;">
                <button class="icon-btn-menu" title="Arroz" style="display:flex;flex-direction:column;align-items:center;gap:8px;background:#fff;border:2px solid #ffd700;border-radius:16px;padding:18px 16px;cursor:pointer;">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><ellipse cx="24" cy="38" rx="14" ry="7" fill="#F5F5F5" stroke="#BDBDBD" stroke-width="2"/><ellipse cx="24" cy="32" rx="10" ry="5" fill="#FFFDE7" stroke="#FFF9C4" stroke-width="1"/><ellipse cx="20" cy="30" rx="1.2" ry="0.7" fill="#FFF"/><ellipse cx="24" cy="31" rx="1.2" ry="0.7" fill="#FFF"/><ellipse cx="28" cy="30" rx="1.2" ry="0.7" fill="#FFF"/><ellipse cx="22" cy="33" rx="0.8" ry="0.5" fill="#FFF"/><ellipse cx="26" cy="33" rx="0.8" ry="0.5" fill="#FFF"/><ellipse cx="30" cy="34" rx="1" ry="0.5" fill="#FFFDE7"/></svg>
                    <span>Arroz</span>
                </button>
                <button class="icon-btn-menu" title="Fideos" style="display:flex;flex-direction:column;align-items:center;gap:8px;background:#fff;border:2px solid #ffd700;border-radius:16px;padding:18px 16px;cursor:pointer;">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><ellipse cx="24" cy="38" rx="16" ry="8" fill="#FFA726"/><ellipse cx="24" cy="32" rx="13" ry="6" fill="#FFF3E0"/><ellipse cx="24" cy="29" rx="10" ry="4" fill="#FFD54F"/><ellipse cx="24" cy="27" rx="7" ry="3" fill="#FFF"/><path d="M18 28 Q24 36 30 28" stroke="#FFB300" stroke-width="2.5" fill="none"/><path d="M20 30 Q24 33 28 30" stroke="#FFB300" stroke-width="2.5" fill="none"/><rect x="20" y="10" width="3" height="18" rx="1.5" fill="#8D5524"/><rect x="26" y="8" width="3" height="20" rx="1.5" fill="#8D5524"/></svg>
                    <span>Fideos</span>
                </button>
                <button class="icon-btn-menu" title="Rollos" style="display:flex;flex-direction:column;align-items:center;gap:8px;background:#fff;border:2px solid #ffd700;border-radius:16px;padding:18px 16px;cursor:pointer;">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><rect x="12" y="28" width="24" height="8" rx="4" fill="#FFD54F" stroke="#FFA000" stroke-width="2"/><ellipse cx="24" cy="32" rx="5" ry="2.5" fill="#81C784"/><rect x="18" y="34" width="12" height="4" rx="2" fill="#FFA000"/><ellipse cx="24" cy="30" rx="2.5" ry="1.2" fill="#FFF"/><ellipse cx="30" cy="30" rx="1" ry="0.5" fill="#FFFDE7"/></svg>
                    <span>Rollos</span>
                </button>
                <button class="icon-btn-menu" title="Bebidas" style="display:flex;flex-direction:column;align-items:center;gap:8px;background:#fff;border:2px solid #ffd700;border-radius:16px;padding:18px 16px;cursor:pointer;">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><rect x="16" y="14" width="16" height="22" rx="8" fill="#29B6F6" stroke="#0288D1" stroke-width="2"/><rect x="20" y="18" width="8" height="14" rx="4" fill="#4FC3F7"/><ellipse cx="24" cy="36" rx="8" ry="3" fill="#FFF" stroke="#0288D1" stroke-width="1.5"/><rect x="24" y="8" width="2" height="10" rx="1" fill="#FF5252"/><circle cx="24" cy="30" r="1.2" fill="#FFF"/><circle cx="27" cy="32" r="1.2" fill="#FFF"/><circle cx="21" cy="32" r="1.2" fill="#FFF"/></svg>
                    <span>Bebidas</span>
                </button>
                <button class="icon-btn-menu" title="Postres" style="display:flex;flex-direction:column;align-items:center;gap:8px;background:#fff;border:2px solid #ffd700;border-radius:16px;padding:18px 16px;cursor:pointer;">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><ellipse cx="24" cy="36" rx="14" ry="7" fill="#FFECB3"/><ellipse cx="24" cy="30" rx="10" ry="5" fill="#FFFDE7"/><ellipse cx="24" cy="26" rx="8" ry="4" fill="#FFD54F"/><ellipse cx="24" cy="26" rx="6" ry="2.5" fill="#FFFDE7"/><path d="M20 26 Q24 32 28 26" stroke="#FFA000" stroke-width="2" fill="none"/><rect x="22" y="24" width="4" height="2" rx="1" fill="#FFA000"/><rect x="25" y="22" width="6" height="1.2" rx="0.6" fill="#FFF"/><ellipse cx="28" cy="28" rx="1" ry="0.5" fill="#FFFDE7"/></svg>
                    <span>Postres</span>
                </button>
            </div>
            <h2 style="text-align:center; color: #b30000; margin-top:18px;">Top 3 más comprados</h2>
            <div class="menu-top3" style="display:flex;justify-content:center;gap:38px;flex-wrap:wrap;">
                <div class="menu-card-top">
                    <img src="php/menu2/imagenes2/chow_mein.jpg" alt="Chow Mein" style="width:100%;height:160px;object-fit:cover;border-radius:18px 18px 0 0;">
                    <div class="menu-card-body">
                        <h3>Chow Mein</h3>
                        <p>Fideos salteados con verduras y salsa especial. ¡El más pedido!</p>
                    </div>
                </div>
                <div class="menu-card-top">
                    <img src="php/menu2/imagenes2/rollitos_primavera.jpg" alt="Rollitos Primavera" style="width:100%;height:160px;object-fit:cover;border-radius:18px 18px 0 0;">
                    <div class="menu-card-body">
                        <h3>Rollitos Primavera</h3>
                        <p>Crujientes rollos rellenos de vegetales frescos. ¡Clásico favorito!</p>
                    </div>
                </div>
                <div class="menu-card-top">
                    <img src="php/menu2/imagenes2/pollo_gongbao.jpg" alt="Pollo Gongbao" style="width:100%;height:160px;object-fit:cover;border-radius:18px 18px 0 0;">
                    <div class="menu-card-body">
                        <h3>Pollo Gongbao</h3>
                        <p>Pollo salteado con cacahuate y salsa picante. ¡Top ventas!</p>
                    </div>
                </div>
            </div>
        </section>
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
                    <img src="imagenes/logo comida.png" alt="Logo Hao Mei Lai">
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; <?php echo date("Y"); ?> Hao Mei Lai. Todos los derechos reservados.</span>
            <span> | <a href="#">Privacidad de datos</a> | <a href="#">Términos y condiciones</a> | <a href="#">Promociones</a></span>
        </div>
    </footer>
    <script>
    // Solución para el menú desplegable del dashboard
    function toggleDashboardMenu() {
        var menu = document.getElementById('dashboardMenu');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
    }
    function hideDashboardMenu() {
        setTimeout(function() {
            var menu = document.getElementById('dashboardMenu');
            menu.style.display = 'none';
        }, 200);
    }
    </script>
</body>
</html>
