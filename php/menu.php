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
        <h2 style="text-align:center; color:#b30000;">Nuestro Menú</h2>
        <div class="menu-categorias">
            <div class="categoria">
                <!-- Arroz (Bowl de arroz con palillos) -->
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <ellipse cx="24" cy="36" rx="14" ry="7" fill="#f5e1a4"/>
                    <ellipse cx="24" cy="30" rx="12" ry="6" fill="#fff"/>
                    <ellipse cx="24" cy="28" rx="10" ry="5" fill="#f5e1a4"/>
                    <ellipse cx="24" cy="26" rx="8" ry="4" fill="#fff"/>
                    <!-- Palillos -->
                    <rect x="18" y="10" width="2" height="14" rx="1" fill="#b30000"/>
                    <rect x="28" y="8" width="2" height="16" rx="1" fill="#b30000"/>
                </svg>
                <span>Arroz</span>
            </div>
            <div class="categoria">
                <!-- Fideos (Bowl con fideos y palillos) -->
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <ellipse cx="24" cy="36" rx="14" ry="7" fill="#f5e1a4"/>
                    <ellipse cx="24" cy="30" rx="12" ry="6" fill="#fff"/>
                    <ellipse cx="24" cy="28" rx="10" ry="5" fill="#ffe082"/>
                    <ellipse cx="24" cy="26" rx="8" ry="4" fill="#fffde7"/>
                    <!-- Fideos -->
                    <path d="M18 28 Q24 34 30 28" stroke="#e2b76a" stroke-width="2" fill="none"/>
                    <path d="M20 30 Q24 32 28 30" stroke="#e2b76a" stroke-width="2" fill="none"/>
                    <!-- Palillos -->
                    <rect x="20" y="10" width="2" height="14" rx="1" fill="#b30000"/>
                    <rect x="26" y="8" width="2" height="16" rx="1" fill="#b30000"/>
                </svg>
                <span>Fideos</span>
            </div>
            <div class="categoria">
                <!-- Rollos Primavera (rollo partido y relleno verde) -->
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <rect x="14" y="28" width="20" height="6" rx="3" fill="#ffe082" stroke="#e2b76a" stroke-width="2"/>
                    <ellipse cx="24" cy="31" rx="4" ry="2" fill="#7ad0a2"/>
                    <rect x="18" y="32" width="12" height="4" rx="2" fill="#e2b76a"/>
                    <!-- Relleno -->
                    <ellipse cx="24" cy="29" rx="2" ry="1" fill="#fff"/>
                </svg>
                <span>Rollos</span>
            </div>
            <div class="categoria">
                <!-- Bebidas (vaso con popote y burbujas) -->
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <rect x="18" y="14" width="12" height="20" rx="6" fill="#90caf9"/>
                    <rect x="20" y="18" width="8" height="12" rx="4" fill="#42a5f5"/>
                    <ellipse cx="24" cy="34" rx="8" ry="3" fill="#fff" stroke="#42a5f5" stroke-width="1.5"/>
                    <!-- Popote -->
                    <rect x="24" y="8" width="2" height="10" rx="1" fill="#b30000"/>
                    <!-- Burbujas -->
                    <circle cx="24" cy="28" r="1" fill="#fff"/>
                    <circle cx="26" cy="30" r="1" fill="#fff"/>
                    <circle cx="22" cy="30" r="1" fill="#fff"/>
                </svg>
                <span>Bebidas</span>
            </div>
            <div class="categoria">
                <!-- Postres (galleta de la fortuna con papelito) -->
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <ellipse cx="24" cy="34" rx="14" ry="7" fill="#ffe082"/>
                    <ellipse cx="24" cy="28" rx="10" ry="6" fill="#fffde7"/>
                    <ellipse cx="24" cy="24" rx="8" ry="5" fill="#ffe082"/>
                    <ellipse cx="24" cy="24" rx="6" ry="3" fill="#fffde7"/>
                    <!-- Galleta rota -->
                    <path d="M20 24 Q24 28 28 24" stroke="#e2b76a" stroke-width="2" fill="none"/>
                    <rect x="22" y="22" width="4" height="2" rx="1" fill="#e2b76a"/>
                    <!-- Papelito -->
                    <rect x="25" y="20" width="6" height="1" rx="0.5" fill="#fff"/>
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