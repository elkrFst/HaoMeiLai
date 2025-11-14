<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros | Hao Mei Lai</title>
    <style>
        body {
            margin: 0;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
        }

        /* Header styles matching index */
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

        .header-center {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative; 
            left: -80px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-left: 38px;
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

        /* Dashboard styles - improved icon size and menu styling */
        .dashboard {
            position: relative;
            margin-left: 18px;
        }

        .dashboard-icon {
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            width: 48px;
            height: 48px;
            justify-content: center;
            border: 1px solid transparent;
        }

        .dashboard-icon:focus {
            outline: none;
            background: #ffd7d7;
            border-color: #b30000;
            transform: scale(1.05);
        }

        .dashboard-icon svg {
            display: block;
            transition: all 0.3s ease;
            width: 28px;
            height: 28px;
        }

        .dashboard-icon:hover {
            background: #ffd7d7;
            transform: scale(1.08);
            box-shadow: 0 4px 12px rgba(179, 0, 0, 0.15);
        }

        .dashboard-icon:hover svg {
            filter: drop-shadow(0 0 6px #b30000);
            transform: rotate(5deg);
        }

        .dashboard-icon:active {
            transform: scale(0.98);
        }

        .dashboard-menu {
            position: absolute;
            top: 55px;
            right: 0;
            min-width: 180px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            display: none;
            flex-direction: column;
            z-index: 100;
            overflow: hidden;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .dashboard-menu.show {
            display: flex !important;
            opacity: 1;
            transform: translateY(0);
        }

        .dashboard-menu::before {
            content: '';
            position: absolute;
            top: -6px;
            right: 20px;
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid #fff;
            z-index: 101;
        }

        .dashboard-menu a {
            padding: 15px 20px;
            color: #333;
            text-decoration: none;
            font-size: 1.05em;
            font-weight: 500;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dashboard-menu a:last-child {
            border-bottom: none;
        }

        .dashboard-menu a:hover {
            background: linear-gradient(135deg, #ffd7d7 0%, #ffebeb 100%);
            color: #b30000;
            padding-left: 25px;
            transform: translateX(5px);
        }

        .dashboard-menu a:first-child:hover {
            border-radius: 12px 12px 0 0;
        }

        .dashboard-menu a:last-child:hover {
            border-radius: 0 0 12px 12px;
        }

        /* About page content with black, red, white theme */
        .about-container {
            max-width: 1100px;
            margin: 48px auto 32px auto;
            background: linear-gradient(145deg, #ffffff 0%, #f5f5f5 100%);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(179, 0, 0, 0.3);
            padding: 3rem 3rem 2.5rem 3rem;
            border: 3px solid #dc2626;
            position: relative;
            overflow: hidden;
        }

        .about-container::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(179, 0, 0, 0.1) 0%, transparent 70%);
            z-index: 0;
        }

        .about-container > * {
            position: relative;
            z-index: 1;
        }

        .about-header {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 3rem;
            padding: 2rem;
            background: linear-gradient(135deg, #000000 0%, #dc2626 100%);
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
        }

        .about-header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid #ffffff;
            background: #fff;
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
        }

        .about-header h1 {
            font-size: 3rem;
            color: #ffffff;
            font-weight: bold;
            margin: 0;
            letter-spacing: 3px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .about-section {
            margin-bottom: 2.5rem;
            padding: 1.5rem;
            background: #ffffff;
            border-radius: 12px;
            border-left: 5px solid #dc2626;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .about-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(220, 38, 38, 0.2);
        }

        .about-section h2 {
            color: #000000;
            font-size: 1.6rem;
            margin-bottom: 1rem;
            font-weight: bold;
            border-bottom: 2px solid #dc2626;
            padding-bottom: 0.5rem;
        }

        .about-section p {
            color: #333333;
            font-size: 1.1rem;
            line-height: 1.7;
            margin: 0 0 0.8rem 0;
        }

        .about-contact {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            border-radius: 15px;
            padding: 2rem;
            color: #ffffff;
            font-size: 1.1rem;
            margin-top: 2.5rem;
            box-shadow: 0 4px 16px rgba(220, 38, 38, 0.4);
            border: 2px solid #ffffff;
        }

        .about-contact b {
            font-size: 1.3rem;
            display: block;
            margin-bottom: 1rem;
        }

        .about-contact a {
            color: #ffffff;
            text-decoration: underline;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .about-contact a:hover {
            color: #ffd7d7;
        }

        /* Team section */
        .team-section {
            margin-top: 3rem;
            padding: 2rem;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            border-radius: 15px;
            border: 2px solid #dc2626;
        }

        .team-section h2 {
            color: #ffffff !important;
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid #dc2626 !important;
        }

        .equipo-lista {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .equipo-card {
            background: linear-gradient(145deg, #ffffff 0%, #f9f9f9 100%);
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(220, 38, 38, 0.2);
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid #dc2626;
            transition: all 0.3s ease;
        }

        .equipo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(220, 38, 38, 0.4);
            border-color: #000000;
        }

        .equipo-card img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #dc2626;
            margin-bottom: 1.2rem;
            background: #fff;
            transition: transform 0.3s ease;
        }

        .equipo-card:hover img {
            transform: scale(1.1);
            border-color: #000000;
        }

        .equipo-card .nombre {
            font-size: 1.2rem;
            font-weight: bold;
            color: #000000;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .equipo-card .puesto {
            font-size: 1.05rem;
            color: #dc2626;
            margin-bottom: 0.8rem;
            font-weight: 600;
        }

        .equipo-card .descripcion {
            font-size: 1rem;
            color: #444444;
            text-align: center;
            line-height: 1.5;
        }

        /* Responsive design */
        @media (max-width: 900px) {
            .header {
                flex-direction: column;
                align-items: stretch;
                padding: 0 2vw;
                min-height: unset;
            }
            .header-left, .header-center, .header-right {
                flex-direction: row;
                align-items: center;
                width: 100%;
                justify-content: flex-start;
            }
            .header-left {
                gap: 10px;
                margin-bottom: 10px;
            }
            .header-center {
                margin-bottom: 10px;
                justify-content: flex-start;
                left: 0;
            }
            .header-right {
                margin-left: 0;
                gap: 10px;
                justify-content: flex-end;
            }
            .about-container { 
                padding: 2rem 1.5rem; 
                margin: 20px;
            }
            .about-header { 
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            .about-header h1 { 
                font-size: 2rem; 
            }
            .equipo-lista {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .header {
                flex-direction: column;
                align-items: stretch;
                padding: 0 2vw;
            }
            .header-left, .header-center, .header-right {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
            }
            .nav-menu {
                flex-direction: column;
                gap: 8px;
                width: 100%;
            }
            .dashboard {
                width: 100%;
                margin: 10px 0 0 0;
                display: flex;
                justify-content: flex-start;
            }
            .dashboard-menu {
                position: static !important;
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.08);
                margin-top: 8px;
                width: 100%;
                min-width: unset;
                z-index: 100;
                display: none;
                flex-direction: column;
                transform: none;
                opacity: 1;
            }
            .dashboard-menu::before {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Header matching index page -->
    <header class="header">
        <div class="header-left">
            <img src="/imagenes/logo comida.png" alt="Logo" class="logo">
            <div class="brand">
                <h1 class="site-name">HAO MEI LAI</h1>
                <p class="site-desc">Auténtica Comida China</p>
            </div>
        </div>

        <div class="header-center">
            <nav>
                <ul class="nav-menu">
                    <li><a href="/inicio">Inicio</a></li>
                    <li><a href="/menu">Menú</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- About content with new design -->
    <div class="about-container">
        <div class="about-header">
            <img src="/imagenes/logo comida.png" alt="Logo Hao Mei Lai">
            <h1>Sobre Hao Mei Lai</h1>
        </div>

        <div class="about-section">
            <h2>Presentación</h2>
            <p>Bienvenidos a Hao Mei Lai, el lugar donde la auténtica comida china cobra vida en cada plato. Nuestro restaurante fusiona tradición, calidad y pasión para ofrecerte una experiencia culinaria única que despierta todos tus sentidos.</p>
        </div>

        <div class="about-section">
            <h2>Nuestra Historia</h2>
            <p>Fundado en 2021, Hao Mei Lai nació del sueño de compartir la riqueza gastronómica de China con México. Desde nuestros inicios, nos hemos enfocado en ingredientes frescos y recetas originales, logrando el equilibrio perfecto entre sabor y cultura. Cada plato cuenta una historia de tradición y excelencia.</p>
        </div>

        <div class="about-section">
            <h2>Misión</h2>
            <p>Brindar a nuestros clientes una experiencia auténtica, cálida y deliciosa, donde cada visita sea un viaje a la cultura oriental. Nos comprometemos a servir comida de la más alta calidad en un ambiente familiar y acogedor.</p>
        </div>

        <div class="about-section">
            <h2>Visión</h2>
            <p>Ser el restaurante chino preferido en la región, reconocido por nuestra calidad excepcional, servicio impecable y ambiente familiar. Aspiramos a ser el referente de la gastronomía china auténtica.</p>
        </div>

        <div class="about-contact">
            <b>Información de Contacto</b>
            Correo: <a href="mailto:contacto@haomeilai.com">contacto@haomeilai.com</a><br>
            Teléfono: <a href="tel:555-123-4567">555-123-4567</a><br>
            Dirección: Av. Sabor Oriental #123, CDMX
        </div>

        <div class="team-section">
            <h2>Nuestro Equipo de Desarrollo</h2>
            <div class="equipo-lista">
                <div class="equipo-card">
                    <img src="/php/AboutUs/kristopher alexander.jpg" alt="Kristopher Alexander Guzman">
                    <div class="nombre">Kristopher Alexander Guzman</div>
                    <div class="puesto">Desarrollador Web</div>
                    <div class="descripcion">Encargado de la estructura y funcionalidad principal del sistema Hao Mei Lai, creando una experiencia digital excepcional.</div>
                </div>
                <div class="equipo-card">
                    <img src="/php/AboutUs/Alan amador.jpg" alt="Alan Amador Alcaraz Malta">
                    <div class="nombre">Alan Amador Alcaraz Malta</div>
                    <div class="puesto">Diseñador UI/UX</div>
                    <div class="descripcion">Responsable de la experiencia visual y de usuario, aportando creatividad y funcionalidad al proyecto con diseños innovadores.</div>
                </div>
                <div class="equipo-card">
                    <img src="/php/AboutUs/Angel rafael.jpg" alt="Angel Rafael Friedman Mariz Cortes">
                    <div class="nombre">Angel Rafael Friedman Mariz Cortes</div>
                    <div class="puesto">Backend & Seguridad</div>
                    <div class="descripcion">Encargado de la lógica de servidor y la protección de datos en el sistema, garantizando seguridad y rendimiento óptimo.</div>
                </div>
                <div class="equipo-card">
                    <img src="/php/AboutUs/Juan Miguel.jpg" alt="Juan Miguel Angel Rincon Hernandez">
                    <div class="nombre">Juan Miguel Angel Rincon Hernandez</div>
                    <div class="puesto">Soporte Técnico</div>
                    <div class="descripcion">Apoya en la resolución de problemas y mantenimiento del sistema Hao Mei Lai, asegurando un funcionamiento continuo.</div>
                </div>
                <div class="equipo-card">
                    <img src="/php/AboutUs/Maximo alessandro.jpg" alt="Maximo Alessandro Villa Rivera">
                    <div class="nombre">Maximo Alessandro Villa Rivera</div>
                    <div class="puesto">Analista de Datos</div>
                    <div class="descripcion">Encargado de la gestión y análisis de la información para la mejora continua del restaurante y optimización de procesos.</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDashboardMenu() {
            var menu = document.getElementById('dashboardMenu');
            menu.classList.toggle('show');
        }

        function hideDashboardMenu() {
            setTimeout(function() {
                var menu = document.getElementById('dashboardMenu');
                menu.classList.remove('show');
            }, 200);
        }

        // Cerrar menú al hacer clic fuera
        document.addEventListener('click', function(event) {
            var dashboard = document.querySelector('.dashboard');
            var menu = document.getElementById('dashboardMenu');
            
            if (!dashboard.contains(event.target)) {
                menu.classList.remove('show');
            }
        });
    </script>
</body>
</html>