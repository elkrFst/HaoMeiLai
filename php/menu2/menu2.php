<?php
// menu2.php
session_start(); 

// Conexión a la base de datos
$host = "srv562.hstgr.io";
$user = "u162512390_Admin";
$pass = "biuqkb>O3";
$db = "u162512390_HaoMeiLai";

$conn = new mysqli($host, $user, $pass, $db);

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
        // Lógica de categorización y tags (Sin cambios)
        $categoria = "Principales"; 
        
        if (stripos($row['producto'], 'sopa') !== false) {
            $categoria = "Sopas";
        } elseif (stripos($row['producto'], 'rollo') !== false || 
                 stripos($row['producto'], 'wantan') !== false ||
                 stripos($row['producto'], 'dumpling') !== false ||
                 stripos($row['producto'], 'pan') !== false ||
                 stripos($row['producto'], 'ensalada') !== false) {
            $categoria = "Entrantes";
        } elseif (stripos($row['producto'], 'bebida') !== false ||
                 stripos($row['producto'], 'refresco') !== false ||
                 stripos($row['producto'], 'jugo') !== false) {
            $categoria = "Bebidas";
        } elseif (stripos($row['producto'], 'tofu') !== false && 
                 stripos($row['producto'], 'verdura') !== false) {
            $categoria = "Vegetarianos";
        }
        
        $tags = array();
        if (stripos($row['producto'], 'picante') !== false) {
            $tags[] = "Picante";
        }
        if (stripos($row['producto'], 'vegetal') !== false || 
            stripos($row['producto'], 'verdura') !== false) {
            $is_vegetariano = true;
            $exclusiones = ['pollo', 'carne', 'cerdo', 'res', 'camarón'];
            foreach ($exclusiones as $exc) {
                if (stripos($row['producto'], $exc) !== false) {
                    $is_vegetariano = false;
                    break;
                }
            }
            if ($is_vegetariano) {
                $tags[] = "Vegetariano";
            }
        }
        
        $imagen = !empty($row['imagen']) ? $row['imagen'] : "default.jpg";
        
        $tiempo = "15-20 min";
        if (stripos($row['producto'], 'sopa') !== false) {
            $tiempo = "20-25 min";
        } elseif (stripos($row['producto'], 'asado') !== false || stripos($row['producto'], 'horno') !== false) {
            $tiempo = "30-40 min";
        }
        
        $descripcion = "Delicioso " . strtolower($row['producto']) . " preparado con ingredientes frescos y técnicas tradicionales.";
        
        $productos[] = array(
            "id" => $row['id'],
            "nombre" => $row['producto'],
            "descripcion" => $descripcion,
            "precio" => number_format($row['precio'], 2), 
            "precio_raw" => $row['precio'],
            "tiempo" => $tiempo,
            "imagen" => $imagen,
            "tags" => $tags,
            "categoria" => $categoria,
            "stock" => $row['stock']
        );
    }
}

$conn->close();

function generar_etiquetas($tags) {
    if (empty($tags)) return '';
    $html = '';
    foreach ($tags as $tag) {
        $clase_extra = (strtolower($tag) === 'picante') ? ' picante' : '';
        $html .= '<span class="item-tag' . $clase_extra . '">' . htmlspecialchars($tag) . '</span>';
    }
    return $html;
}

$categoria_seleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : 'all';

$rol_actual = $_SESSION['rol'] ?? 'invitado'; 
$puede_comprar = (strtolower($rol_actual) === 'usuario'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Completo - Hao Mei Lai</title>
    <link rel="stylesheet" href="/php/menu2/menu2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        .cart-btn { position: relative; }
        .cart-notification {
            position: absolute;
            top: 5px;
            right: -5px;
            width: 10px;
            height: 10px;
            background-color: var(--primary-red);
            border-radius: 50%;
            display: none; 
        }

        /* --- Estilos de la barra lateral (Corregido el ancho) --- */
        .carrito-sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 90%; 
            max-width: 380px; 
            height: 100%;
            background-color: #fff;
            box-shadow: -4px 0 15px rgba(0, 0, 0, 0.2);
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            z-index: 2000;
            display: flex;
            flex-direction: column;
            padding: 20px;
            box-sizing: border-box; 
        }

        .carrito-sidebar.visible {
            transform: translateX(0);
        }

        /* --- NUEVOS ESTILOS PARA EL BOTÓN CERRAR --- */
        .header-carrito {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--primary-red);
            padding-bottom: 10px;
            margin-bottom: 20px;
            flex-shrink: 0;
        }

        .header-carrito h2 {
            margin: 0; 
            border-bottom: none;
        }
        
        .cerrar-carrito {
            background: none;
            border: none;
            color: var(--text-color);
            font-size: 1.5em;
            cursor: pointer;
            padding: 5px;
            transition: color 0.2s;
        }
        
        .cerrar-carrito:hover {
            color: var(--primary-red);
        }
        /* --- FIN NUEVOS ESTILOS --- */


        #carrito-items {
            flex-grow: 1;
            overflow-y: auto; 
            margin-bottom: 20px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid var(--light-grey);
            font-size: 14px;
        }
        
        .item > span:first-child { flex-grow: 1; font-weight: 600; }

        .item .btns { display: flex; align-items: center; gap: 5px; margin: 0 10px; }
        
        .item .btns button {
            background: var(--light-grey);
            border: none;
            padding: 4px 8px;
            cursor: pointer;
            border-radius: 4px;
        }
        
        .item button:last-child { 
            background-color: #fdd8d6;
            color: var(--dark-red);
            padding: 4px 6px;
        }

        .total {
            font-size: 1.5em;
            font-weight: bold;
            color: var(--primary-red);
            text-align: right;
            margin-bottom: 20px;
            flex-shrink: 0;
        }

        .acciones {
            display: flex;
            gap: 10px;
            flex-shrink: 0; 
        }
        
        .acciones button {
            flex-grow: 1;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .acciones .cancelar {
            background-color: #ffdddd;
            color: var(--dark-red);
        }
        
        .acciones .aceptar {
            background-color: var(--primary-red);
            color: #fff;
        }
        
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 3000;
        }

        .modal-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            max-width: 400px;
        }

        /* --- CORRECCIÓN: AJUSTE DEL MAIN PARA DESPLAZARLO CON TRANSFORM (mantiene las 4 columnas) --- */
        .menu-container {
            transition: transform 0.3s ease-in-out; 
        }

        .menu-shift { 
            --sidebar-width: 200px; 
            transform: translateX(calc(-1 * var(--sidebar-width)));
        }
        
        /* En móviles, no lo movemos */
        @media (max-width: 768px) {
            .menu-shift {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>

    <header class="header-main">
        <a href="/inicio" class="header-link back-btn"><i class="fas fa-arrow-left"></i> Volver</a>
        <div class="header-title-group">
            <span class="header-subtitle">Menú Completo</span>
            <h1 class="header-title">Hao Mei Lai</h1>
        </div>
        <a href="#" id="cart-toggle-btn" class="header-link cart-btn">
            <i class="fas fa-shopping-cart"></i> Carrito
            <span class="cart-notification" id="cart-dot"></span>
        </a>
    </header>

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
                <img src="/php/menu2/imagenes_productos/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Imagen de <?php echo htmlspecialchars($producto['nombre']); ?>" class="item-image">
                <?php echo generar_etiquetas($producto['tags']); ?>
            </div>
            <div class="item-content">
                <div class="item-header">
                    <h2 class="item-name"><?php echo htmlspecialchars($producto['nombre']); ?></h2>
                    <span class="item-price">$<?php echo htmlspecialchars($producto['precio']); ?></span>
                </div>
                <p class="item-description"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                <div class="item-footer">
                    <span class="item-time"><i class="fas fa-clock"></i> <?php echo htmlspecialchars($producto['tiempo']); ?></span>
                    
                    <button 
                        class="add-to-cart-btn" 
                        <?php echo $producto['stock'] <= 0 ? 'disabled' : ''; ?>
                        data-nombre="<?php echo htmlspecialchars($producto['nombre']); ?>"
                        data-precio="<?php echo htmlspecialchars($producto['precio_raw']); ?>"
                    >
                        <i class="fas fa-cart-plus"></i> Agregar
                    </button>
                    
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </main>

    <aside class="carrito-sidebar" id="carrito-sidebar">
      <div class="header-carrito">
          <h2>Tu Pedido</h2>
          <button class="cerrar-carrito" id="btn-cerrar-carrito"><i class="fas fa-times"></i></button>
      </div>
      <div id="carrito-items"></div>
      <div class="total" id="carrito-total">TOTAL: $0.00</div>
      <div class="acciones">
        <button class="cancelar" id="btn-cancelar">Vaciar Carrito</button>
        <button class="aceptar" id="btn-pagar">Proceder al Pago</button>
      </div>
    </aside>

    <div class="modal-overlay" id="login-modal">
        <div class="modal-content">
            <h3>Acceso Restringido</h3>
            <p>Necesitas iniciar sesión o registrarte con una cuenta de **Usuario** para poder agregar productos y realizar un pedido.</p>
            <a href="/login">Iniciar Sesión / Registrarse</a>
        </div>
    </div>


    <script>
        // Variables de PHP en JavaScript
        const puedeComprar = <?php echo $puede_comprar ? 'true' : 'false'; ?>; 
        
        // Variables del Carrito
        let carrito = [];
        
        // Elementos del DOM
        const carritoSidebar = document.getElementById('carrito-sidebar');
        const cartDot = document.getElementById('cart-dot');
        const loginModal = document.getElementById('login-modal');
        const menuContainer = document.getElementById('menu-container'); 

        // --- Funciones del Carrito ---

        function toggleCarrito(mostrar) {
            carritoSidebar.classList.toggle('visible', mostrar);
            menuContainer.classList.toggle('menu-shift', mostrar); 
        }

        function renderCarrito() {
            const carritoItems = document.getElementById('carrito-items');
            const carritoTotal = document.getElementById('carrito-total');
            carritoItems.innerHTML = '';
            let total = 0;

            if (carrito.length > 0) {
                cartDot.style.display = 'block'; 
                
                carrito.forEach((item, idx) => {
                    const precio = parseFloat(item.precio); 
                    const subtotal = precio * item.cantidad;
                    total += subtotal;
                    
                    carritoItems.innerHTML += `
                        <div class="item">
                            <span>${item.nombre}</span>
                            <div class="btns">
                                <button onclick="cambiarCantidad(${idx}, -1)">-</button>
                                <span>${item.cantidad}</span>
                                <button onclick="cambiarCantidad(${idx}, 1)">+</button>
                            </div>
                            <span>$${subtotal.toFixed(2)}</span>
                            <button onclick="eliminarItem(${idx})">✖</button>
                        </div>
                    `;
                });
            } else {
                cartDot.style.display = 'none'; 
                toggleCarrito(false); 
            }

            carritoTotal.textContent = `TOTAL: $${total.toFixed(2)}`;
        }

        window.agregarAlCarrito = function(nombre, precio) {
            if (!puedeComprar) {
                loginModal.style.display = 'flex';
                return;
            }
            
            const idx = carrito.findIndex(item => item.nombre === nombre);
            if (idx > -1) carrito[idx].cantidad += 1;
            else carrito.push({nombre, precio: precio, cantidad: 1}); 
            
            renderCarrito();
        }

        window.cambiarCantidad = function(idx, cambio) {
            carrito[idx].cantidad += cambio;
            if (carrito[idx].cantidad < 1) carrito[idx].cantidad = 1;
            renderCarrito();
        }

        window.eliminarItem = function(idx) {
            carrito.splice(idx, 1);
            renderCarrito();
        }

        // --- Inicialización y Manejadores de Eventos ---

        document.addEventListener('DOMContentLoaded', function() {
            renderCarrito();
            
            // 0. NUEVO: Botón para cerrar el carrito dentro del sidebar
            document.getElementById('btn-cerrar-carrito').addEventListener('click', function() {
                toggleCarrito(false);
            });
            
            // 1. Botón para abrir/cerrar el carrito (El del header)
            document.getElementById('cart-toggle-btn').addEventListener('click', function(e) {
                e.preventDefault();
                if (!puedeComprar) {
                    loginModal.style.display = 'flex';
                    return;
                }
                
                if (carrito.length > 0 || carritoSidebar.classList.contains('visible')) {
                    toggleCarrito(!carritoSidebar.classList.contains('visible'));
                } else {
                    alert('El carrito está vacío. Agrega un producto primero.');
                }
            });
            
            // 2. Botones de "Agregar"
            document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const nombre = this.getAttribute('data-nombre');
                    const precio = this.getAttribute('data-precio');
                    agregarAlCarrito(nombre, precio);
                });
            });

            // 3. Botón Vaciar Carrito
            document.getElementById('btn-cancelar').onclick = function() {
                if (confirm('¿Estás seguro de que deseas vaciar el carrito?')) {
                    carrito = [];
                    renderCarrito();
                }
            };
            
            // 4. Botón Pagar (Lógica de ejemplo)
            document.getElementById('btn-pagar').onclick = function() {
                if (carrito.length === 0) {
                    alert('Agrega al menos un producto para pagar.');
                    return;
                }
                alert('¡Felicidades! Se inicia el proceso de pago. Total: ' + document.getElementById('carrito-total').textContent);
                carrito = [];
                renderCarrito();
            };

            // 5. Cerrar modal al hacer click fuera
            loginModal.addEventListener('click', function(e) {
                if (e.target === loginModal) {
                    loginModal.style.display = 'none';
                }
            });
            
            // 6. Lógica de Filtrado y Búsqueda (sin cambios)
            const searchInput = document.getElementById('search-input');
            const categoryItems = document.querySelectorAll('.category-item');
            const menuItems = document.querySelectorAll('.menu-item');
            const categoriaSeleccionada = "<?php echo htmlspecialchars($categoria_seleccionada); ?>";

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
            
            menuItems.forEach(menuItem => {
                if (categoriaInicial === 'all' || menuItem.getAttribute('data-category') === categoriaInicial) {
                    menuItem.style.display = 'flex'; 
                } else {
                    menuItem.style.display = 'none';
                }
            });

            categoryItems.forEach(item => {
                item.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    searchInput.value = ''; 
                    
                    categoryItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    
                    menuItems.forEach(menuItem => {
                        if (category === 'all' || menuItem.getAttribute('data-category') === category) {
                            menuItem.style.display = 'flex';
                        } else {
                            menuItem.style.display = 'none';
                        }
                    });
                });
            });
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                categoryItems.forEach(i => i.classList.remove('active')); 
                
                menuItems.forEach(item => {
                    const itemName = item.querySelector('.item-name').textContent.toLowerCase();
                    const itemDesc = item.querySelector('.item-description').textContent.toLowerCase();
                    
                    if (itemName.includes(searchTerm) || itemDesc.includes(searchTerm)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
            
            menuItems.forEach(item => {
                if (item.style.display === 'block') { 
                    item.style.display = 'flex';
                }
            });
        });
    </script>

</body>
</html>