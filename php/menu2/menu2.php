<?php
// Función para generar las etiquetas de los platillos
function generar_etiquetas($tags) {
    if (empty($tags)) {
        return '';
    }
    $html = '';
    foreach ($tags as $tag) {
        $clase_extra = '';
        if (strtolower($tag) === 'picante') {
            $clase_extra = ' picante';
        }
        $html .= '<span class="item-tag' . $clase_extra . '">' . htmlspecialchars($tag) . '</span>';
    }
    return $html;
}

// Array de datos de los platos
$platos = [
    [
        "nombre" => "Dumplings de Cerdo",
        "descripcion" => "Deliciosos dumplings hechos a mano con relleno de cerdo y especias tradicionales, servidos al vapor.",
        "precio" => "$12.5",
        "tiempo" => "15-20 min",
        "imagen" => "dumplings.jpg",
        "rating" => "4.8",
        "tags" => []
    ],
    [
        "nombre" => "Rollitos Primavera",
        "descripcion" => "Crujientes rollitos rellenos de verduras frescas y brotes de soja, acompañados de salsa agridulce.",
        "precio" => "$8.75",
        "tiempo" => "10-15 min",
        "imagen" => "rollitos_primavera.jpg",
        "rating" => "4.6",
        "tags" => ["Vegetariano"]
    ],
    [
        "nombre" => "Wonton Frito",
        "descripcion" => "Wonton crujientes rellenos de camarón y cerdo, perfectos para compartir.",
        "precio" => "$10.25",
        "tiempo" => "12-18 min",
        "imagen" => "wonton.jpg",
        "rating" => "4.7",
        "tags" => []
    ],
    [
        "nombre" => "Sopa Wonton",
        "descripcion" => "Sopa tradicional con wonton rellenos de cerdo en caldo aromático con cebollín.",
        "precio" => "$11.5",
        "tiempo" => "20-25 min",
        "imagen" => "wonton.jpg",
        "rating" => "4.8",
        "tags" => []
    ],
    [
        "nombre" => "Sopa Agripicante",
        "descripcion" => "Sopa tradicional con tofu, hongos y huevo, con el equilibrio perfecto entre agrio y picante.",
        "precio" => "$9.75",
        "tiempo" => "15-20 min",
        "imagen" => "wonton.jpg",
        "rating" => "4.5",
        "tags" => ["Vegetariano", "Picante"]
    ],
    [
        "nombre" => "Pollo Agridulce",
        "descripcion" => "Trozos de pollo empanizado en salsa agridulce con piña, pimientos y cebolla.",
        "precio" => "$16.5",
        "tiempo" => "25-30 min",
        "imagen" => "pollo_agridulce.jpg",
        "rating" => "4.8",
        "tags" => []
    ],
    [
        "nombre" => "Cerdo Agridulce",
        "descripcion" => "Trozos de cerdo empanizado en salsa agridulce con piña, pimientos y cebolla.",
        "precio" => "$15.5",
        "tiempo" => "25-30 min",
        "imagen" => "cerdo_agridulce.jpg",
        "rating" => "4.6",
        "tags" => []
    ],
    [
        "nombre" => "Pollo Gong Bao",
        "descripcion" => "Pollo en cubos, chile seco, cacahuetes fritos, ajo, jengibre, salsa de soya y azúcar.",
        "precio" => "$14.0",
        "tiempo" => "25-30 min",
        "imagen" => "pollo_gongbao.jpg",
        "rating" => "4.7",
        "tags" => []
    ],
    [
        "nombre" => "Ma Po Tofu",
        "descripcion" => "Tofu con carne molida, color marrón-rojo, cebolla verde y polvo de pimienta picante.",
        "precio" => "$13.5",
        "tiempo" => "20-25 min",
        "imagen" => "mapo_tofu.jpg",
        "rating" => "4.7",
        "tags" => ["Picante"]
    ],
    [
        "nombre" => "Wonton",
        "descripcion" => "Wonton en su caldo, saquitos de harina rellenos de carne o camarón.",
        "precio" => "$11.5",
        "tiempo" => "15-20 min",
        "imagen" => "wonton.jpg",
        "rating" => "4.8",
        "tags" => []
    ],
    [
        "nombre" => "Chow Mein",
        "descripcion" => "Fideos fritos con carne de pollo, res, camarones o cerdo, cebolla y apio.",
        "precio" => "$12.75",
        "tiempo" => "20-25 min",
        "imagen" => "chow_mein.jpg",
        "rating" => "4.9",
        "tags" => []
    ],
    [
        "nombre" => "Rollitos Primavera",
        "descripcion" => "Rollitos rellenos de verduras o carne, sabor dulce o salado, envueltos y fritos.",
        "precio" => "$8.75",
        "tiempo" => "10-15 min",
        "imagen" => "rollitos_primavera.jpg",
        "rating" => "4.6",
        "tags" => []
    ],
    [
        "nombre" => "Chop Suey",
        "descripcion" => "Trozos de carne con vegetales como cebolla, apio, pimientos y brotes de soja.",
        "precio" => "$13.0",
        "tiempo" => "20-25 min",
        "imagen" => "chop_suey.jpg",
        "rating" => "4.7",
        "tags" => []
    ],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Completo - Hao Mei Lai</title>
    <link rel="stylesheet" href="menu2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <header class="header-main">
        <a href="../menu.php" class="header-link back-btn"><i class="fas fa-arrow-left"></i> Volver</a>
        <div class="header-title-group">
            <span class="header-subtitle">Menú Completo</span>
            <h1 class="header-title">Hao Mei Lai</h1>
        </div>
        <a href="#" class="header-link cart-btn"><i class="fas fa-shopping-cart"></i> Carrito</a>
    </header>

    <div class="search-and-filters">
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Buscar platos...">
        </div>
        <button class="filters-btn"><i class="fas fa-sliders-h"></i> Filtros</button>
    </div>

    <nav class="categories">
        <div class="category-item active">Todos</div>
        <div class="category-item">Entrantes</div>
        <div class="category-item">Sopas</div>
        <div class="category-item">Principales</div>
        <div class="category-item">Vegetarianos</div>
        <div class="category-item">Bebidas</div>
    </nav>

    <main class="menu-container">
        <?php foreach ($platos as $plato): ?>
        <div class="menu-item">
            <div class="item-image-container">
                <img src="imagenes2/<?php echo htmlspecialchars($plato['imagen']); ?>" alt="Imagen de <?php echo htmlspecialchars($plato['nombre']); ?>" class="item-image">
                <div class="item-rating">
                    <i class="fas fa-star"></i> <?php echo htmlspecialchars($plato['rating']); ?>
                </div>
                <?php echo generar_etiquetas($plato['tags']); ?>
            </div>
            <div class="item-content">
                <div class="item-header">
                    <h2 class="item-name"><?php echo htmlspecialchars($plato['nombre']); ?></h2>
                    <span class="item-price"><?php echo htmlspecialchars($plato['precio']); ?></span>
                </div>
                <p class="item-description"><?php echo htmlspecialchars($plato['descripcion']); ?></p>
                <div class="item-footer">
                    <span class="item-time"><i class="fas fa-clock"></i> <?php echo htmlspecialchars($plato['tiempo']); ?></span>
                    <button class="add-to-cart-btn"><i class="fas fa-plus"></i> Agregar</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </main>

</body>
</html>