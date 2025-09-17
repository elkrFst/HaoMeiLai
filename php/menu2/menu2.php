<?php
session_start();

// Procesar "Agregar al carrito"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto'])) {
    $nuevo = [
        'producto' => $_POST['producto'],
        'precio' => floatval($_POST['precio']),
        'cantidad' => intval($_POST['cantidad'])
    ];
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    // Si el producto ya está en el carrito, suma la cantidad
    $encontrado = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['producto'] === $nuevo['producto']) {
            $item['cantidad'] += $nuevo['cantidad'];
            $encontrado = true;
            break;
        }
    }
    if (!$encontrado) {
        $_SESSION['carrito'][] = $nuevo;
    }
    // Redirige para evitar reenvío de formulario
    header("Location: menu2.php");
    exit();
}

// menu2.php
// Conexión a la base de datos
$servername = "127.0.0.1";
$username = "root"; // Cambia si es necesario
$password = ""; // Cambia si es necesario
$dbname = "hao_mei_lai";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener productos del almacén
$sql = "SELECT id, producto, precio, stock, imagen FROM almacen";
$result = $conn->query($sql);

// Array para almacenar los productos
$productos = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Determinar categoría basada en el nombre del producto
        $categoria = "Principales"; // Categoría por defecto
        
        if (stripos($row['producto'], 'sopa') !== false) {
            $categoria = "Sopas";
        } elseif (stripos($row['producto'], 'rollo') !== false || 
                 stripos($row['producto'], 'wantan') !== false ||
                 stripos($row['producto'], 'dumpling') !== false) {
            $categoria = "Entrantes";
        } elseif (stripos($row['producto'], 'pan') !== false) {
            $categoria = "Entrantes";
        } elseif (stripos($row['producto'], 'ensalada') !== false) {
            $categoria = "Entrantes";
        } elseif (stripos($row['producto'], 'bebida') !== false ||
                 stripos($row['producto'], 'refresco') !== false ||
                 stripos($row['producto'], 'jugo') !== false) {
            $categoria = "Bebidas";
        } elseif (stripos($row['producto'], 'tofu') !== false && 
                 stripos($row['producto'], 'verdura') !== false) {
            $categoria = "Vegetarianos";
        }
        
        // Determinar etiquetas
        $tags = array();
        if (stripos($row['producto'], 'picante') !== false) {
            $tags[] = "Picante";
        }
        if (stripos($row['producto'], 'vegetal') !== false || 
            stripos($row['producto'], 'verdura') !== false && 
            stripos($row['producto'], 'pollo') === false && 
            stripos($row['producto'], 'carne') === false && 
            stripos($row['producto'], 'cerdo') === false && 
            stripos($row['producto'], 'res') === false && 
            stripos($row['producto'], 'camarón') === false) {
            $tags[] = "Vegetariano";
        }
        
        // Usar la imagen de la base de datos
        $imagen = !empty($row['imagen']) ? $row['imagen'] : "default.jpg";
        
        // Determinar tiempo de preparación estimado
        $tiempo = "15-20 min";
        if (stripos($row['producto'], 'sopa') !== false) {
            $tiempo = "20-25 min";
        } elseif (stripos($row['producto'], 'asado') !== false || stripos($row['producto'], 'horno') !== false) {
            $tiempo = "30-40 min";
        }
        
        // Generar descripción basada en el producto
        $descripcion = "Delicioso " . strtolower($row['producto']) . " preparado con ingredientes frescos y técnicas tradicionales.";
        
        // Agregar producto al array
        $productos[] = array(
            "id" => $row['id'],
            "nombre" => $row['producto'],
            "descripcion" => $descripcion,
            "precio" => "$" . number_format($row['precio'], 2),
            "precio_num" => $row['precio'],
            "tiempo" => $tiempo,
            "imagen" => $imagen,
            "rating" => "4." . rand(5, 9), // Rating aleatorio entre 4.5 y 4.9
            "tags" => $tags,
            "categoria" => $categoria,
            "stock" => $row['stock']
        );
    }
}

// Cerrar conexión
$conn->close();

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
        <a href="../../index.php" class="header-link back-btn"><i class="fas fa-arrow-left"></i> Volver</a>
        <div class="header-title-group">
            <span class="header-subtitle">Menú Completo</span>
            <h1 class="header-title">Hao Mei Lai</h1>
        </div>
        <a href="../menu2/carrito.php" class="header-link cart-btn"><i class="fas fa-shopping-cart"></i> Carrito</a>
    </header>

    <div class="search-and-filters">
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" id="search-input" placeholder="Buscar platos...">
        </div>
        <button class="filters-btn"><i class="fas fa-sliders-h"></i> Filtros</button>
    </div>

    <nav class="categories">
        <div class="category-item active" data-category="all">Todos</div>
        <div class="category-item" data-category="Entrantes">Entrantes</div>
        <div class="category-item" data-category="Sopas">Sopas</div>
        <div class="category-item" data-category="Principales">Principales</div>
        <div class="category-item" data-category="Vegetarianos">Vegetarianos</div>
        <div class="category-item" data-category="Bebidas">Bebidas</div>
    </nav>

    <main class="menu-container" id="menu-container">
        <?php foreach ($productos as $producto): ?>
        <div class="menu-item <?php echo $producto['stock'] <= 0 ? 'out-of-stock' : ''; ?>" data-category="<?php echo htmlspecialchars($producto['categoria']); ?>">
            <div class="item-image-container">
                <img src="imagenes_productos/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Imagen de <?php echo htmlspecialchars($producto['nombre']); ?>" class="item-image">
                <div class="item-rating">
                    <i class="fas fa-star"></i> <?php echo htmlspecialchars($producto['rating']); ?>
                </div>
                <?php echo generar_etiquetas($producto['tags']); ?>
            </div>
            <div class="item-content">
                <div class="item-header">
                    <h2 class="item-name"><?php echo htmlspecialchars($producto['nombre']); ?></h2>
                    <span class="item-price"><?php echo htmlspecialchars($producto['precio']); ?></span>
                </div>
                <p class="item-description"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                <div class="item-footer">
                    <span class="item-time"><i class="fas fa-clock"></i> <?php echo htmlspecialchars($producto['tiempo']); ?></span>
                    <button type="button" class="add-to-cart-btn"
    data-producto="<?php echo htmlspecialchars($producto['nombre']); ?>"
    data-precio="<?php echo htmlspecialchars($producto['precio_num']); ?>"
    <?php echo $producto['stock'] <= 0 ? 'disabled' : ''; ?>>
    <i class="fas fa-plus"></i> Agregar
</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </main>

    <script>
        // Funcionalidad de búsqueda y filtrado
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const categoryItems = document.querySelectorAll('.category-item');
            const menuItems = document.querySelectorAll('.menu-item');
            
            // Filtrar por categoría
            categoryItems.forEach(item => {
                item.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    
                    // Actualizar clase activa
                    categoryItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Filtrar elementos
                    menuItems.forEach(menuItem => {
                        if (category === 'all' || menuItem.getAttribute('data-category') === category) {
                            menuItem.style.display = 'block';
                        } else {
                            menuItem.style.display = 'none';
                        }
                    });
                });
            });
            
            // Buscar productos
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                menuItems.forEach(item => {
                    const itemName = item.querySelector('.item-name').textContent.toLowerCase();
                    const itemDesc = item.querySelector('.item-description').textContent.toLowerCase();
                    
                    if (itemName.includes(searchTerm) || itemDesc.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
            
            // Agregar al carrito
            const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (!this.disabled) {
                        const item = this.closest('.menu-item');
                        const itemName = item.querySelector('.item-name').textContent;
                        const itemPrice = item.querySelector('.item-price').textContent;
                        
                       
                        // Aquí puedes agregar la lógica para agregar al carrito real
                    }
                });
            });
        });
    </script>
    <script>
document.querySelectorAll('.add-to-cart-btn').forEach(button => {
    button.addEventListener('click', function() {
        if (this.disabled) return;
        const producto = this.getAttribute('data-producto');
        const precio = this.getAttribute('data-precio');
        fetch('agregar_carrito.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `producto=${encodeURIComponent(producto)}&precio=${encodeURIComponent(precio)}&cantidad=1`
        })
        .then(res => res.json())
        .then(data => {
            // Opcional: puedes mostrar un mensaje discreto aquí si quieres
        });
    });
});
</script>

</body>
</html>