<?php
$site_name = "Hao Mei Lai";
$site_desc = "Auténtica Comida China";
$logo_url = "../imagenes/logo comida.png";
$menu = [
    [
        "img" => "../imagenes/comida 1.jpg",
        "nombre" => "BING BURRITO",
        "desc" => "1 Guarnición (142 gr) + 1 Especialidad (155 gr)."
    ],
    [
        "img" => "../imagenes/comida 2.jpg",
        "nombre" => "BOWL",
        "desc" => "1 Guarnición (312 g) y 1 Especialidad (155 g)."
    ],
    [
        "img" => "../imagenes/comida 3.jpg",
        "nombre" => "PLATO",
        "desc" => "1 Guarnición (312 g) y 2 Especialidades (155 g c/u)."
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú - Hao Mei Lai</title>
    <link rel="stylesheet" href="../css/menu.css">
   
</head>
<body>
    <main>
        <h2 style="text-align:center; color: #b30000;">Nuestro Menú</h2>
        <div class="menu-categorias">
            <div class="categoria">
                <!-- Arroz (bowl blanco con arroz redondeado y granos) -->
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <!-- Bowl -->
                    <ellipse cx="24" cy="38" rx="14" ry="7" fill="#F5F5F5" stroke="#BDBDBD" stroke-width="2"/>
                    <!-- Arroz montañita -->
                    <ellipse cx="24" cy="32" rx="10" ry="5" fill="#FFFDE7" stroke="#FFF9C4" stroke-width="1"/>
                    <!-- Granos de arroz -->
                    <ellipse cx="20" cy="30" rx="1.2" ry="0.7" fill="#FFF"/>
                    <ellipse cx="24" cy="31" rx="1.2" ry="0.7" fill="#FFF"/>
                    <ellipse cx="28" cy="30" rx="1.2" ry="0.7" fill="#FFF"/>
                    <ellipse cx="22" cy="33" rx="0.8" ry="0.5" fill="#FFF"/>
                    <ellipse cx="26" cy="33" rx="0.8" ry="0.5" fill="#FFF"/>
                    <!-- Brillo -->
                    <ellipse cx="30" cy="34" rx="1" ry="0.5" fill="#FFFDE7"/>
                </svg>
                <span>Arroz</span>
            </div>
            <div class="categoria">
                <!-- Fideos (Bowl con fideos y palillos, estilo cartoon) -->
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <ellipse cx="24" cy="38" rx="16" ry="8" fill="#FFA726"/>
                    <ellipse cx="24" cy="32" rx="13" ry="6" fill="#FFF3E0"/>
                    <ellipse cx="24" cy="29" rx="10" ry="4" fill="#FFD54F"/>
                    <ellipse cx="24" cy="27" rx="7" ry="3" fill="#FFF"/>
                    <!-- Fideos -->
                    <path d="M18 28 Q24 36 30 28" stroke="#FFB300" stroke-width="2.5" fill="none"/>
                    <path d="M20 30 Q24 33 28 30" stroke="#FFB300" stroke-width="2.5" fill="none"/>
                    <!-- Palillos -->
                    <rect x="20" y="10" width="3" height="18" rx="1.5" fill="#8D5524"/>
                    <rect x="26" y="8" width="3" height="20" rx="1.5" fill="#8D5524"/>
                </svg>
                <span>Fideos</span>
            </div>
            <div class="categoria">
                <!-- Rollos Primavera (rollo partido, relleno verde y dorado, estilo cartoon) -->
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <rect x="12" y="28" width="24" height="8" rx="4" fill="#FFD54F" stroke="#FFA000" stroke-width="2"/>
                    <ellipse cx="24" cy="32" rx="5" ry="2.5" fill="#81C784"/>
                    <rect x="18" y="34" width="12" height="4" rx="2" fill="#FFA000"/>
                    <!-- Relleno -->
                    <ellipse cx="24" cy="30" rx="2.5" ry="1.2" fill="#FFF"/>
                    <!-- Brillo -->
                    <ellipse cx="30" cy="30" rx="1" ry="0.5" fill="#FFFDE7"/>
                </svg>
                <span>Rollos</span>
            </div>
            <div class="categoria">
                <!-- Bebidas (vaso con popote y burbujas, estilo cartoon) -->
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <rect x="16" y="14" width="16" height="22" rx="8" fill="#29B6F6" stroke="#0288D1" stroke-width="2"/>
                    <rect x="20" y="18" width="8" height="14" rx="4" fill="#4FC3F7"/>
                    <ellipse cx="24" cy="36" rx="8" ry="3" fill="#FFF" stroke="#0288D1" stroke-width="1.5"/>
                    <!-- Popote -->
                    <rect x="24" y="8" width="2" height="10" rx="1" fill="#FF5252"/>
                    <!-- Burbujas -->
                    <circle cx="24" cy="30" r="1.2" fill="#FFF"/>
                    <circle cx="27" cy="32" r="1.2" fill="#FFF"/>
                    <circle cx="21" cy="32" r="1.2" fill="#FFF"/>
                </svg>
                <span>Bebidas</span>
            </div>
            <div class="categoria">
                <!-- Postres (galleta de la fortuna con papelito, estilo cartoon) -->
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <ellipse cx="24" cy="36" rx="14" ry="7" fill="#FFECB3"/>
                    <ellipse cx="24" cy="30" rx="10" ry="5" fill="#FFFDE7"/>
                    <ellipse cx="24" cy="26" rx="8" ry="4" fill="#FFD54F"/>
                    <ellipse cx="24" cy="26" rx="6" ry="2.5" fill="#FFFDE7"/>
                    <!-- Galleta rota -->
                    <path d="M20 26 Q24 32 28 26" stroke="#FFA000" stroke-width="2" fill="none"/>
                    <rect x="22" y="24" width="4" height="2" rx="1" fill="#FFA000"/>
                    <!-- Papelito -->
                    <rect x="25" y="22" width="6" height="1.2" rx="0.6" fill="#FFF"/>
                    <!-- Brillo -->
                    <ellipse cx="28" cy="28" rx="1" ry="0.5" fill="#FFFDE7"/>
                </svg>
                <span>Postres</span>
            </div>
        </div>
        <div class="menu-container">
            <?php foreach($menu as $item): ?>
                <div class="menu-card">
                    <img src="<?php echo htmlspecialchars($item['img']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>">
                    <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
                    <p><?php echo htmlspecialchars($item['desc']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>

<style>
    body {
            background: url('../imagenes/fondo-fuego.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .menu-categorias {
            max-width: 700px;
            margin: 40px auto 0 auto;
            display: flex;
            justify-content: center;
            gap: 48px;
            padding: 20px 0;
        }
        .categoria {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
            text-align: center;
            padding: 24px 18px 16px 18px;
            transition: transform 0.2s;
            width: 160px;
        }
        .categoria:hover {
            transform: translateY(-6px) scale(1.04);
            border: 2.5px solid #0ba5ddff;
        }
        .categoria img {
            width: 72px;
            height: 72px;
            object-fit: contain;
            margin-bottom: 10px;
        }
        .categoria span {
            display: block;
            margin-top: 6px;
            font-weight: bold;
            color: #b30000;
            font-size: 1.15em;
            letter-spacing: 1px;
        }
        .menu-container {
            max-width: 1200px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 32px;
            padding: 20px;
        }
        .menu-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
            text-align: center;
            padding: 32px 16px 24px 16px;
            transition: box-shadow 0.2s;
            border: 2px solid transparent;
        }
        .menu-card:hover {
            border-color: #b30000ff;
        }
        .menu-card img {
            width: 180px;
            height: 120px;
            object-fit: contain;
            margin-bottom: 18px;
        }
        .menu-card h3 {
            margin: 0 0 10px 0;
            font-size: 1.3em;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .menu-card p {
            margin: 0;
            color: #444;
            font-size: 1em;
        }
        /* Responsividad para menú de categorías */
@media (max-width: 1100px) {
    .menu-categorias {
        gap: 24px;
        flex-wrap: wrap;
        justify-content: center;
    }
    .categoria {
        width: 140px;
        margin-bottom: 18px;
    }
}
@media (max-width: 700px) {
    .menu-categorias {
        flex-direction: column;
        align-items: center;
        gap: 18px;
    }
    .categoria {
        width: 90vw;
        max-width: 320px;
    }
    .menu-container {
        grid-template-columns: 1fr;
        gap: 18px;
    }
}
</style>