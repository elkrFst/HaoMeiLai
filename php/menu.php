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

    <style>
        body {
            background: url('../imagenes/fondo-fuego.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
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
            box-shadow: 0 8px 32px rgba(179,0,0,0.15);
            border-color: #b30000;
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
        .menu-categorias {
            max-width: 1200px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 16px;
            padding: 20px;
        }
        .categoria {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
            text-align: center;
            padding: 16px;
            transition: transform 0.2s;
        }
        .categoria:hover {
            transform: translateY(-4px);
        }
        .categoria img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 8px;
        }
        .categoria span {
            display: block;
            margin-top: 4px;
            font-weight: bold;
            color: #333;
        }
        @media (max-width: 700px) {
            .menu-container {
                grid-template-columns: 1fr;
            }
            .menu-categorias {
                grid-template-columns: repeat(3, 1fr);
            }
        }
    </style>
</head>
<body>
    <main>
        <h2 style="text-align:center; color:#b30000;">Nuestro Menú</h2>
        <div class="menu-container">
            <?php foreach($menu as $item): ?>
                <div class="menu-card">
                    <img src="<?php echo htmlspecialchars($item['img']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>">
                    <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
                    <p><?php echo htmlspecialchars($item['desc']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="menu-categorias">
            <div class="categoria">
                <img src="../imagenes/cat-arroz.png" alt="Arroz">
                <span>Arroz</span>
            </div>
            <div class="categoria">
                <img src="../imagenes/cat-pollo.png" alt="Pollo">
                <span>Pollo</span>
            </div>
            <div class="categoria">
                <img src="../imagenes/cat-fideos.png" alt="Fideos">
                <span>Fideos</span>
            </div>
            <div class="categoria">
                <img src="../imagenes/cat-bebidas.png" alt="Bebidas">
                <span>Bebidas</span>
            </div>
            <div class="categoria">
                <img src="../imagenes/cat-postres.png" alt="Postres">
                <span>Postres</span>
            </div>
            <div class="categoria">
                <img src="../imagenes/cat-infantil.png" alt="Infantil">
                <span>Infantil</span>
            </div>
        </div>
    </main>
</body>
</html>