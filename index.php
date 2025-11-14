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
    /* * Estilos del Modo Oscuro
     * Se aplican cuando la clase 'dark-mode' está en el <body>
     */
    body.dark-mode {
        background-color: #121212; /* Fondo principal oscuro */
        color: #e0e0e0; /* Texto claro por defecto */
    }
    body.dark-mode .header {
        background-color: #1f1f1f; /* Header oscuro */
        border-bottom: 1px solid #333;
    }
    body.dark-mode .nav-menu a {
        color: #e0e0e0; /* Enlaces del menú claros */
    }
    body.dark-mode .nav-menu a.active {
        border-bottom: 2px solid #ffd700; /* Resalta el activo */
    }
    body.dark-mode .site-name, body.dark-mode .user-name {
        color: #ffd700; /* Elementos destacados en amarillo */
    }
    body.dark-mode h2 {
        color: #ffd700 !important; /* Títulos de sección en amarillo */
    }
    body.dark-mode .bienvenida-hero .bienvenida-overlay {
        background: rgba(0, 0, 0, 0.6); /* Overlay más oscuro en el hero */
    }
    body.dark-mode .icon-btn-menu {
        background: #2c2c2c; /* Botones de categoría oscuros */
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.4), 0 1.5px 8px rgba(0, 0, 0, 0.3);
    }
    body.dark-mode .icon-btn-menu span {
        color: #ccc !important; /* Texto de los botones más claro */
    }
    body.dark-mode .menu-card-top {
        background: #2c2c2c; /* Tarjetas de Top 3 oscuras */
        border: 2.5px solid #ffd700; /* Borde en amarillo */
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.4), 0 1.5px 8px rgba(0, 0, 0, 0.3);
    }
    body.dark-mode .menu-card-top h3 {
        color: #ffd700; /* Título de la tarjeta en amarillo */
    }
    body.dark-mode .menu-card-body p {
        color: #e0e0e0; /* Texto de la tarjeta claro */
    }
    body.dark-mode .dashboard-menu {
        background: #2c2c2c; /* Menú desplegable oscuro */
        border: 2px solid #ffd700;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.4);
    }
    body.dark-mode .dashboard-menu a,
    body.dark-mode .dashboard-menu button {
        color: #e0e0e0; /* Enlaces del menú claros */
    }
    body.dark-mode .dashboard-menu a:hover,
    body.dark-mode .dashboard-menu button:hover {
        background: #ffd700;
        color: #121212; /* Texto oscuro al pasar el mouse */
    }
    body.dark-mode .footer {
        background-color: #1f1f1f;
        color: #e0e0e0;
    }
    body.dark-mode .footer a {
        color: #9c9c9c;
    }
    body.dark-mode .footer a:hover {
        color: #ffd700;
    }
    body.dark-mode .footer-bottom span {
        color: #9c9c9c;
    }
    </style>
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
    
    /* Estilo adicional para el nuevo botón de modo (para que parezca un enlace/opción de menú) */
    .dashboard-menu button {
        display: block;
        width: calc(100% - 20px); /* Ajusta el ancho al padding del menú */
        padding: 12px 24px;
        color: #b30000;
        text-decoration: none;
        font-family: 'Montserrat', 'Roboto', Arial, sans-serif;
        font-size: 1.08em;
        border-radius: 8px;
        margin: 2px 10px;
        transition: background 0.2s, color 0.2s;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
    }
    .dashboard-menu button:hover {
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
                    <li><a href="inicio" class="active">Inicio</a></li>
                    <li><a href="menu">Menú</a></li>
                    <li><a href="about">Contacto</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-right">
            <div class="dashboard">
                <div class="dashboard">
                <?php if (!empty($_SESSION['usuario'])): ?>
                    <span class="user-name"><?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                <?php endif; ?>
                <style>
                .dashboard {
                    /* Asegura que los elementos se alineen uno al lado del otro */
                    display: flex;
                    align-items: center;
                    gap: 12px; /* Espacio entre el nombre y el ícono */
                }
                .user-name {
                    color: #22222; /* Color principal de tu restaurante */
                    font-size: 1.1em;
                    font-weight: 600;
                    white-space: nowrap; /* Evita que el nombre se corte */
                }
                
                /* Modificar el header-right para que se alinee */
                .header-right {
                    display: flex;
                    align-items: center;
                }
                </style>
                <div class="dashboard-icon" tabindex="0" onclick="toggleDashboardMenu()" onblur="hideDashboardMenu()">
                    <!-- Ícono de menú hamburguesa -->
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                        <rect x="4" y="7" width="16" height="2" rx="1" fill="#b30000"/>
                        <rect x="4" y="11" width="16" height="2" rx="1" fill="#b30000"/>
                        <rect x="4" y="15" width="16" height="2" rx="1" fill="#b30000"/>
                    </svg>
                </div>
                <div class="dashboard-menu" id="dashboardMenu">
                    <a href="#pedidos">Mis pedidos</a>
                    
                    <button id="darkModeToggle" onclick="toggleDarkMode()">Claro / Oscuro</button>
                    
                    <?php
                    // La nueva condición verifica si la sesión está vacía O si el rol es 'invitado'
                    if (empty($_SESSION['usuario']) || (isset($_SESSION['rol']) && $_SESSION['rol'] === 'invitado')):
                    ?>
                        <a href="login">Iniciar sesión</a>
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
                <h2>Hao Mei Lai <span>Te da la bienvenida</span>!</h2>
                <p>Disfruta de la <b>auténtica experiencia culinaria china</b> en un ambiente inigualable.</p>
            </div>
        </section>
        <section class="menu-section">
            <h2 style="text-align:center; color: #b30000; margin-top:32px;">Explora por categoría</h2>
            <div class="menu-categorias" style="display:flex;justify-content:center;gap:38px;margin-bottom:32px;flex-wrap:wrap;">
            <button class="icon-btn-menu" title="Entrantes" data-categoria="Entrantes">
                <!-- Icono Entrantes (plato) -->
                <svg width="36" height="36" viewBox="0 0 32 32" fill="none">
                <ellipse cx="16" cy="22" rx="12" ry="5" fill="#ffe5b4"/>
                <ellipse cx="16" cy="22" rx="10" ry="3.5" fill="#fff"/>
                <rect x="12" y="10" width="8" height="8" rx="4" fill="#ffd700"/>
                <ellipse cx="16" cy="14" rx="4" ry="2" fill="#ffe5b4"/>
                </svg>
                <span style="font-size:1.18em;color:#666;">Entrantes</span>
            </button>
            <button class="icon-btn-menu" title="Sopas" data-categoria="Sopas">
                <!-- Icono Sopas (tazón con cuchara) -->
                <svg width="36" height="36" viewBox="0 0 32 32" fill="none">
                <ellipse cx="16" cy="22" rx="10" ry="4" fill="#ffe5b4"/>
                <ellipse cx="16" cy="22" rx="8" ry="2.5" fill="#fff"/>
                <rect x="22" y="10" width="2" height="8" rx="1" fill="#b3b3b3" transform="rotate(30 22 10)"/>
                <ellipse cx="16" cy="16" rx="7" ry="4" fill="#ffd700"/>
                </svg>
                <span style="font-size:1.18em;color:#666;">Sopas</span>
            </button>
            <button class="icon-btn-menu" title="Principales" data-categoria="Principales">
                <!-- Icono Principales (palillos y plato) -->
                <svg width="36" height="36" viewBox="0 0 32 32" fill="none">
                <ellipse cx="16" cy="22" rx="11" ry="4.5" fill="#ffe5b4"/>
                <ellipse cx="16" cy="22" rx="9" ry="2.8" fill="#fff"/>
                <rect x="10" y="8" width="2" height="14" rx="1" fill="#b30000" transform="rotate(15 10 8)"/>
                <rect x="20" y="8" width="2" height="14" rx="1" fill="#ffd700" transform="rotate(-15 20 8)"/>
                <ellipse cx="16" cy="16" rx="5" ry="2.5" fill="#ffd700"/>
                </svg>
                <span style="font-size:1.18em;color:#666;">Principales</span>
            </button>
            <button class="icon-btn-menu" title="Vegetarianos" data-categoria="Vegetarianos">
                <!-- Icono Vegetarianos (hoja) -->
                <svg width="36" height="36" viewBox="0 0 32 32" fill="none">
                <path d="M16 28c-6-6-8-14-8-18 0-2 2-4 4-4 2 0 4 2 4 4 0-2 2-4 4-4 2 0 4 2 4 4 0 4-2 12-8 18z" fill="#7ed957"/>
                <path d="M16 28V10" stroke="#388e3c" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <span style="font-size:1.18em;color:#666;">Vegetarianos</span>
            </button>
            <button class="icon-btn-menu" title="Bebidas" data-categoria="Bebidas">
                <!-- Icono Bebidas (vaso con popote) -->
                <svg width="36" height="36" viewBox="0 0 32 32" fill="none">
                <rect x="12" y="12" width="8" height="12" rx="3" fill="#b3e0ff"/>
                <rect x="15" y="6" width="2" height="8" rx="1" fill="#00bcd4"/>
                <rect x="14" y="6" width="4" height="2" rx="1" fill="#ffd700"/>
                <rect x="13" y="24" width="6" height="2" rx="1" fill="#fff"/>
                </svg>
                <span style="font-size:1.18em;color:#666;">Bebidas</span>
            </button>
            </div>
        </section>
            <h2 style="text-align:center; color: #b30000; margin-top:18px;">Top 3 más comprados</h2>
            <div class="menu-top3" style="display:flex;justify-content:center;gap:38px;flex-wrap:wrap;">
                <div class="menu-card-top">
                    <img src="php/menu2/imagenes_productos/chow_mein.jpg" alt="Chow Mein" style="width:100%;height:160px;object-fit:cover;border-radius:18px 18px 0 0;">
                    <div class="menu-card-body">
                        <h3>Chow Mein</h3>
                        <p>Fideos salteados con verduras y salsa especial. ¡El más pedido!</p>
                    </div>
                </div>
                <div class="menu-card-top">
                    <img src="php/menu2/imagenes_productos/rollos_primavera.jpg" alt="Rollos Primavera" style="width:100%;height:160px;object-fit:cover;border-radius:18px 18px 0 0;">
                    <div class="menu-card-body">
                        <h3>Rollos Primavera</h3>
                        <p>Crujientes rollos rellenos de vegetales frescos. ¡Clásico favorito!</p>
                    </div>
                </div>
                <div class="menu-card-top">
                    <img src="php/menu2/imagenes_productos/pollo_gongbao.jpg" alt="Pollo Gongbao" style="width:100%;height:160px;object-fit:cover;border-radius:18px 18px 0 0;">
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
    
    // NUEVA FUNCIÓN PARA MODO CLARO/OSCURO
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        // Opcional: puedes guardar la preferencia del usuario aquí con localStorage.
        // Ejemplo: localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
        localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
    }

    // Redirección al menú2 con la categoría seleccionada
    document.querySelectorAll('.icon-btn-menu').forEach(btn => {
        btn.addEventListener('click', function() {
            const categoria = btn.getAttribute('data-categoria');
            if (categoria) {
                window.location.href = 'php/menu2/menu2.php?categoria=' + encodeURIComponent(categoria);
            }
        });
    });
    
    document.addEventListener('DOMContentLoaded', (event) => {
        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
        }
    });
    </script>
</body>
</html>
