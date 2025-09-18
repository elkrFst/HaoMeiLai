<?php
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

// Obtener la categoría seleccionada desde la URL si existe
$categoria_seleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : 'all';
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
        <a href="#" class="header-link cart-btn"><i class="fas fa-shopping-cart"></i> Carrito</a>
    </header>

    <!-- Sustituir el buscador y filtros por el buscador minimalista -->
    <div class="search-container">
        <input type="text" id="search-input" placeholder="Buscar platos...">

    </div>

    <nav class="categories">
        <div class="category-item" data-category="all">Todos</div>
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

            // Obtener la categoría seleccionada desde PHP
            const categoriaSeleccionada = "<?php echo htmlspecialchars($categoria_seleccionada); ?>";

            // Activar la categoría seleccionada y filtrar al cargar
            let categoriaInicial = categoriaSeleccionada && categoriaSeleccionada !== '' ? categoriaSeleccionada : 'all';
            let categoriaEncontrada = false;
            categoryItems.forEach(item => {
                if (item.getAttribute('data-category') === categoriaInicial) {
                    item.classList.add('active');
                    categoriaEncontrada = true;
                } else {
                    item.classList.remove('active');
                }
            });
            // Si la categoría no existe, activar 'Todos'
            if (!categoriaEncontrada) {
                categoryItems.forEach(item => {
                    if (item.getAttribute('data-category') === 'all') {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
                categoriaInicial = 'all';
            }
            // Filtrar elementos al cargar
            menuItems.forEach(menuItem => {
                if (categoriaInicial === 'all' || menuItem.getAttribute('data-category') === categoriaInicial) {
                    menuItem.style.display = 'block';
                } else {
                    menuItem.style.display = 'none';
                }
            });

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
        });
    </script>

</body>
</html>