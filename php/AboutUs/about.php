<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sobre Nosotros | Hao Mei Lai</title>
    <link rel="stylesheet" href="../../css/Admin.css">
    <style>
        body {
            background: #f7f7f7;
            font-family: 'Montserrat', Arial, sans-serif;
            margin: 0;
        }
        .about-container {
            max-width: 900px;
            margin: 48px auto 32px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(214,40,40,0.10);
            padding: 2.5rem 2.5rem 2rem 2.5rem;
        }
        .about-header {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 2.5rem;
        }
        .about-header img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 3px solid #f1d48f;
            background: #fff;
            box-shadow: 0 2px 8px rgba(214,40,40,0.10);
        }
        .about-header h1 {
            font-size: 2.5rem;
            color: #d62828;
            font-weight: bold;
            margin: 0;
            letter-spacing: 2px;
        }
        .about-section {
            margin-bottom: 2.2rem;
        }
        .about-section h2 {
            color: #d62828;
            font-size: 1.35rem;
            margin-bottom: 0.7rem;
        }
        .about-section p {
            color: #333;
            font-size: 1.08rem;
            margin: 0 0 0.5rem 0;
        }
        .about-contact {
            background: #f1d48f;
            border-radius: 12px;
            padding: 1.2rem 1.5rem;
            color: #b3000f;
            font-size: 1.08rem;
            margin-top: 2rem;
        }
        .about-contact a {
            color: #d62828;
            text-decoration: underline;
        }
        @media (max-width: 700px) {
            .about-container { padding: 1rem 0.5rem; }
            .about-header h1 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
    <header style="width:100%; background:#fff; box-shadow:0 2px 8px rgba(214,40,40,0.07); padding:18px 0 18px 0; margin-bottom:24px;">
        <div style="width:100%; display:flex; justify-content:flex-end; align-items:center;">
        <a href="../../index.php" style="background:#d62828; color:#fff; border:none; border-radius:8px; padding:10px 28px; font-size:1.08rem; font-weight:500; text-decoration:none; box-shadow:0 2px 8px rgba(214,40,40,0.10); transition:background 0.2s; margin-right:32px;">← Volver al Inicio</a>
        </div>
    </header>
    <div class="about-container">
        <div class="about-header">
            <img src="../../imagenes/logo comida.png" alt="Logo Hao Mei Lai">
            <h1>Sobre Hao Mei Lai</h1>
        </div>
        <div class="about-section">
            <h2>Presentación</h2>
            <p>Bienvenidos a Hao Mei Lai, el lugar donde la auténtica comida china cobra vida en cada plato. Nuestro restaurante fusiona tradición, calidad y pasión para ofrecerte una experiencia culinaria única.</p>
        </div>
        <div class="about-section">
            <h2>Nuestra Historia</h2>
            <p>Fundado en 2021, Hao Mei Lai nació del sueño de compartir la riqueza gastronómica de China con México. Desde nuestros inicios, nos hemos enfocado en ingredientes frescos y recetas originales, logrando el equilibrio perfecto entre sabor y cultura.</p>
        </div>
        <div class="about-section">
            <h2>Misión</h2>
            <p>Brindar a nuestros clientes una experiencia auténtica, cálida y deliciosa, donde cada visita sea un viaje a la cultura oriental.</p>
        </div>
        <div class="about-section">
            <h2>Visión</h2>
            <p>Ser el restaurante chino preferido en la región, reconocido por nuestra calidad, servicio y ambiente familiar.</p>
        </div>
        <div class="about-contact">
            <b>Contacto:</b> <br>
            Correo: <a href="mailto:contacto@haomeilai.com">contacto@haomeilai.com</a><br>
            Teléfono: <a href="tel:555-123-4567">555-123-4567</a><br>
            Dirección: Av. Sabor Oriental #123, CDMX
        </div>
        <div class="about-section" style="margin-top:2.5rem;">
            <h2>Equipo Hao Mei Lai</h2>
            <div class="equipo-lista" style="display:flex; flex-wrap:wrap; gap:2.5rem; justify-content:center; margin-top:1.5rem;">
                <div class="equipo-card" style="background:#f7f7f7; border-radius:14px; box-shadow:0 2px 8px rgba(214,40,40,0.07); padding:1.5rem 1.2rem; width:260px; display:flex; flex-direction:column; align-items:center;">
                    <img src="kristopher alexander.jpg" alt="Kristopher Alexander Guzman" style="width:80px; height:80px; object-fit:cover; border-radius:50%; border:3px solid #f1d48f; margin-bottom:1rem; background:#fff;">
                    <div style="font-size:1.15rem; font-weight:bold; color:#d62828; margin-bottom:4px;">Kristopher Alexander Guzman</div>
                    <div style="font-size:1.02rem; color:#333; margin-bottom:6px;">Desarrollador Web</div>
                    <div style="font-size:0.98rem; color:#444; text-align:center;">Encargado de la estructura y funcionalidad principal del sistema Hao Mei Lai.</div>
                </div>
                <div class="equipo-card" style="background:#f7f7f7; border-radius:14px; box-shadow:0 2px 8px rgba(214,40,40,0.07); padding:1.5rem 1.2rem; width:260px; display:flex; flex-direction:column; align-items:center;">
                    <img src="Alan amador.jpg" alt="Alan Amador Alcaraz Malta" style="width:80px; height:80px; object-fit:cover; border-radius:50%; border:3px solid #f1d48f; margin-bottom:1rem; background:#fff;">
                    <div style="font-size:1.15rem; font-weight:bold; color:#d62828; margin-bottom:4px;">Alan Amador Alcaraz Malta</div>
                    <div style="font-size:1.02rem; color:#333; margin-bottom:6px;">Diseñador UI/UX</div>
                    <div style="font-size:0.98rem; color:#444; text-align:center;">Responsable de la experiencia visual y de usuario, aportando creatividad y funcionalidad al proyecto.</div>
                </div>
                <div class="equipo-card" style="background:#f7f7f7; border-radius:14px; box-shadow:0 2px 8px rgba(214,40,40,0.07); padding:1.5rem 1.2rem; width:260px; display:flex; flex-direction:column; align-items:center;">
                    <img src="Angel rafael.jpg" alt="Angel Rafael Friedman Mariz Cortes" style="width:80px; height:80px; object-fit:cover; border-radius:50%; border:3px solid #f1d48f; margin-bottom:1rem; background:#fff;">
                    <div style="font-size:1.15rem; font-weight:bold; color:#d62828; margin-bottom:4px;">Angel Rafael Friedman Mariz Cortes</div>
                    <div style="font-size:1.02rem; color:#333; margin-bottom:6px;">Backend & Seguridad</div>
                    <div style="font-size:0.98rem; color:#444; text-align:center;">Encargado de la lógica de servidor y la protección de datos en el sistema.</div>
                </div>
                <div class="equipo-card" style="background:#f7f7f7; border-radius:14px; box-shadow:0 2px 8px rgba(214,40,40,0.07); padding:1.5rem 1.2rem; width:260px; display:flex; flex-direction:column; align-items:center;">
                    <img src="Juan Miguel.jpg" alt="Juan Miguel Angel Rincon Hernandez" style="width:80px; height:80px; object-fit:cover; border-radius:50%; border:3px solid #f1d48f; margin-bottom:1rem; background:#fff;">
                    <div style="font-size:1.15rem; font-weight:bold; color:#d62828; margin-bottom:4px;">Juan Miguel Angel Rincon Hernandez</div>
                    <div style="font-size:1.02rem; color:#333; margin-bottom:6px;">Soporte Técnico</div>
                    <div style="font-size:0.98rem; color:#444; text-align:center;">Apoya en la resolución de problemas y mantenimiento del sistema Hao Mei Lai.</div>
                </div>
                <div class="equipo-card" style="background:#f7f7f7; border-radius:14px; box-shadow:0 2px 8px rgba(214,40,40,0.07); padding:1.5rem 1.2rem; width:260px; display:flex; flex-direction:column; align-items:center;">
                    <img src="Maximo alessandro.jpg" alt="Maximo Alessandro Villa Rivera" style="width:80px; height:80px; object-fit:cover; border-radius:50%; border:3px solid #f1d48f; margin-bottom:1rem; background:#fff;">
                    <div style="font-size:1.15rem; font-weight:bold; color:#d62828; margin-bottom:4px;">Maximo Alessandro Villa Rivera</div>
                    <div style="font-size:1.02rem; color:#333; margin-bottom:6px;">Analista de Datos</div>
                    <div style="font-size:0.98rem; color:#444; text-align:center;">Encargado de la gestión y análisis de la información para la mejora continua del restaurante.</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
