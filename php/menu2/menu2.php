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
        // Lógica de categorización y tags
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
    
    <style>
    /* * Estilos del Modo Oscuro
     * Se aplican cuando la clase 'dark-mode' está en el <body>
     */
    :root {
        --dark-bg: #1f1f1f;
        --dark-surface: #2c2c2c;
        --dark-text: #e0e0e0;
        --dark-light-text: #b0b0b0;
        --dark-card-border: #ffd700; /* Borde amarillo para resaltar */
    }

    body.dark-mode {
        background-color: var(--dark-bg);
        color: var(--dark-text);
    }
    body.dark-mode .header-main {
        background-color: var(--dark-surface);
        border-bottom: 2px solid var(--dark-card-border);
    }
    body.dark-mode .header-main a {
        color: var(--dark-text);
    }
    body.dark-mode .header-title-group .header-title {
        color: var(--dark-card-border);
    }
    body.dark-mode .search-container input {
        background-color: #383838;
        color: var(--dark-text);
        border: 1px solid #555;
    }
    body.dark-mode .search-container input::placeholder {
        color: var(--dark-light-text);
    }
    body.dark-mode .categories {
        background-color: var(--dark-surface);
        border-bottom: 1px solid #444;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.4);
    }
    body.dark-mode .category-item {
        color: var(--dark-light-text);
    }
    body.dark-mode .category-item:hover,
    body.dark-mode .category-item.active {
        color: var(--dark-card-border);
        background-color: #383838;
    }
    body.dark-mode .menu-item {
        background-color: var(--dark-surface);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    }
    body.dark-mode .item-name {
        color: var(--dark-text);
    }
    body.dark-mode .item-price {
        color: var(--dark-card-border); /* Precio en amarillo */
    }
    body.dark-mode .add-to-cart-btn {
        background-color: #7b2c2c; /* Un rojo más apagado */
        color: var(--dark-text);
    }
    body.dark-mode .add-to-cart-btn:hover {
        background-color: #923434;
    }
    body.dark-mode .item-tag {
        background-color: #383838;
        color: var(--dark-light-text);
        border: 1px solid #555;
    }
    body.dark-mode .item-tag.picante {
        background-color: #4b1414;
        color: #ff9999;
    }
    /* Estilos para el Carrito Sidebar en modo oscuro */
    body.dark-mode .carrito-sidebar {
        background-color: var(--dark-surface);
        box-shadow: -4px 0 15px rgba(0, 0, 0, 0.6);
    }
    body.dark-mode .header-carrito {
        border-bottom-color: var(--dark-card-border);
    }
    body.dark-mode .header-carrito h2 {
        color: var(--dark-text);
    }
    body.dark-mode .cerrar-carrito {
        color: var(--dark-light-text);
    }
    body.dark-mode .cerrar-carrito:hover {
        color: var(--dark-card-border);
    }
    body.dark-mode .item {
        border-bottom-color: #444;
    }
    body.dark-mode .item > span:first-child {
        color: var(--dark-text);
    }
    body.dark-mode .item .btns button {
        background: #383838;
        color: var(--dark-text);
    }
    body.dark-mode .item button:last-child {
        background-color: #663636;
        color: var(--dark-text);
    }
    body.dark-mode .total {
        color: var(--dark-card-border);
    }
    body.dark-mode .acciones .cancelar {
        background-color: #5a2e2e;
        color: var(--dark-text);
    }
    body.dark-mode .acciones .aceptar {
        background-color: var(--dark-card-border);
        color: #1f1f1f;
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
        <div class="category-item" id="darkModeToggle" onclick="toggleDarkMode()" style="font-weight: bold;">
            <i class="fas fa-sun" id="modeIcon"></i> Claro / Oscuro
        </div>
        
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
                        onclick="agregarAlCarrito('<?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($producto['precio_raw'], ENT_QUOTES); ?>')"
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
        <button class="aceptar" onclick="generarPedido()">Comprar/Pedir</button>
      </div>
    </aside>

    <div class="modal-overlay" id="login-modal">
        <div class="modal-content">
            <h3>Acceso Restringido</h3>
            <p>Necesitas iniciar sesión o registrarte con una cuenta de **Usuario** para poder agregar productos y realizar un pedido.</p>
            <a href="/login">Iniciar Sesión / Registrarse</a>
        </div>
    </div>

    <div id="recibo-modal" class="modal-overlay" style="display: none;">
      <div class="modal-content">
          <span class="cerrar-carrito" onclick="cerrarReciboModal()" style="position: absolute; top: 10px; right: 15px; font-size: 2em; cursor: pointer;">&times;</span>
          <h2>✅ Pedido Creado</h2>
          <p>Tu pedido ha sido registrado. Preséntate en caja con tu código.</p>

            <div style="background: #fffaf0; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px dashed #7b2c2c; text-align: left;">
                <p><strong>Cliente:</strong> <span id="recibo-nombre"></span></p>
                <p><strong>Fecha:</strong> <span id="recibo-fecha"></span></p>
                <hr style="margin: 10px 0;">
                <h3 style="text-align: center;">CÓDIGO: <strong id="recibo-codigo" style="color: #7b2c2c; font-size: 1.8em;"></strong></h3>
                <hr style="margin: 10px 0;">
                <div id="recibo-items" style="font-size: 0.9em;"></div>
                <p style="font-weight: bold; font-size: 1.2em; text-align: right; margin-top: 10px;">Total: <span id="recibo-total" style="color: #7b2c2c;"></span></p>
            </div>

            <button id="btn-descargar-recibo" class="acciones aceptar" style="width: 100%; margin-top: 15px; background-color: #3f51b5;">
                <i class="fa fa-download"></i> Descargar Recibo
            </button>
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

        function generarPedido() {
            if (carrito.length === 0) {
                alert('El carrito está vacío. Agrega productos para realizar el pedido.');
                return;
            }

            document.querySelector('.acciones .aceptar').disabled = true;

            const carritoData = JSON.stringify(carrito);

            // Enviar por AJAX
            fetch('php/menu2/guardar_pedido.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `carrito_data=${encodeURIComponent(carritoData)}`
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la red o servidor');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    mostrarReciboModal(data.codigo, data.nombre_usuario, data.fecha, data.total, data.carrito);

                    // Limpiar el carrito local y la UI
                    carrito = [];
                    renderCarrito();
                    document.querySelector('.carrito-sidebar').classList.remove('visible');

                } else {
                    alert('Error al generar el pedido: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al procesar el pedido. Intenta nuevamente.');
            })
            .finally(() => {
                document.querySelector('.acciones .aceptar').disabled = false;
            });
        }

        // Nueva función para mostrar el recibo modal
        function mostrarReciboModal(codigo, nombre, fecha, total, items) {
            const modal = document.getElementById('recibo-modal');

            document.getElementById('recibo-codigo').textContent = codigo;
            document.getElementById('recibo-nombre').textContent = nombre;
            document.getElementById('recibo-fecha').textContent = fecha;
            document.getElementById('recibo-total').textContent = `$${total}`;

            const itemsContainer = document.getElementById('recibo-items');
            itemsContainer.innerHTML = '';
            items.forEach(item => {
                const itemElement = document.createElement('p');
                // Usa item.precio_raw para el cálculo del subtotal
                itemElement.innerHTML = `${item.cantidad} x ${item.nombre} - $${(item.cantidad * item.precio_raw).toFixed(2)}`;
                itemsContainer.appendChild(itemElement);
            });

            document.getElementById('btn-descargar-recibo').onclick = () => descargarRecibo(codigo, nombre, fecha, total, items);

            modal.style.display = 'flex';
        }

        function cerrarReciboModal() {
            document.getElementById('recibo-modal').style.display = 'none';
        }

        // Función para descargar el recibo
        function descargarRecibo(codigo, nombre, fecha, total, items) {
            let contenido = `--- Recibo de Pedido HAO MEI LAI ---\n`;
            contenido += `Código de Pedido: ${codigo}\n`;
            contenido += `Cliente: ${nombre}\n`;
            contenido += `Fecha: ${fecha}\n`;
            contenido += `------------------------------------\n`;
            contenido += `Productos:\n`;
            items.forEach(item => {
                contenido += `${item.cantidad} x ${item.nombre} ($${item.precio_raw}) = $${(item.cantidad * item.precio_raw).toFixed(2)}\n`;
            });
            contenido += `------------------------------------\n`;
            contenido += `Total a Pagar: $${total}\n`;
            contenido += `Estado: Pendiente de Pago (Use este código para pagar en caja)\n`;
            contenido += `------------------------------------\n`;

            const blob = new Blob([contenido], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `Recibo_Pedido_${codigo}.txt`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

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
                    // Usamos item.precio, que es el precio_raw
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
        
        // --- NUEVA FUNCIÓN PARA MODO CLARO/OSCURO ---
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            const isDarkMode = document.body.classList.contains('dark-mode');
            const icon = document.getElementById('modeIcon');
            
            // Alternar icono: Sol (claro) <-> Luna (oscuro)
            if (icon) {
                icon.classList.remove(isDarkMode ? 'fa-sun' : 'fa-moon');
                icon.classList.add(isDarkMode ? 'fa-moon' : 'fa-sun');
            }
            
            localStorage.setItem('darkModeMenu', isDarkMode);
        }

        // --- Inicialización y Manejadores de Eventos ---

        document.addEventListener('DOMContentLoaded', function() {
            // Cargar la preferencia del modo oscuro al inicio
            if (localStorage.getItem('darkModeMenu') === 'true') {
                document.body.classList.add('dark-mode');
                const icon = document.getElementById('modeIcon');
                if (icon) {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                }
            }
            
            
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

            // 2. Botones de "Agregar" (Ya se manejan con el onclick en el PHP)
            // Ya no es necesario el forEach aquí, ya que el PHP inyecta el 'onclick' directamente
            /*
            document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const nombre = this.getAttribute('data-nombre');
                    const precio = this.getAttribute('data-precio');
                    agregarAlCarrito(nombre, precio);
                });
            });
            */


            // 3. Botón Vaciar Carrito
            document.getElementById('btn-cancelar').onclick = function() {
                if (confirm('¿Estás seguro de que deseas vaciar el carrito?')) {
                    carrito = [];
                    renderCarrito();
                }
            };

            // 4. Botón Pagar (Lógica de ejemplo - EL onclick="generarPedido()" está en el HTML)
            // No se necesita aquí

            // 5. Cerrar modal al hacer click fuera
            loginModal.addEventListener('click', function(e) {
                if (e.target === loginModal) {
                    loginModal.style.display = 'none';
                }
            });

             // 6. Lógica de Filtrado y Búsqueda (CORREGIDO)
            const searchInput = document.getElementById('search-input');
            // FIX: Seleccionar solo los elementos que son categorías (tienen data-category)
            const selectableCategoryItems = document.querySelectorAll('.category-item[data-category]'); 
            const allCategoryItemsInNav = document.querySelectorAll('.category-item'); // Para remover 'active' de todos
            const menuItems = document.querySelectorAll('.menu-item');
            const categoriaSeleccionada = "<?php echo htmlspecialchars($categoria_seleccionada); ?>";

            let categoriaInicial = categoriaSeleccionada && categoriaSeleccionada !== '' ? categoriaSeleccionada : 'all';
            let categoriaEncontrada = false;

            // Lógica de filtrado inicial (usando solo categorías seleccionables)
            selectableCategoryItems.forEach(item => {
                if (item.getAttribute('data-category') === categoriaInicial) {
                    item.classList.add('active');
                    categoriaEncontrada = true;
                } else {
                    item.classList.remove('active');
                }
            });

            // Si no se encontró la categoría inicial o si la URL no la trae, se activa "Todos"
            if (!categoriaEncontrada) {
                selectableCategoryItems.forEach(item => {
                    if (item.getAttribute('data-category') === 'all') {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
                categoriaInicial = 'all';
            }

            // Mostrar los elementos iniciales
            menuItems.forEach(menuItem => {
                if (categoriaInicial === 'all' || menuItem.getAttribute('data-category') === categoriaInicial) {
                    menuItem.style.display = 'flex';
                } else {
                    menuItem.style.display = 'none';
                }
            });

            // Agregar listener de click (usando solo categorías seleccionables)
            selectableCategoryItems.forEach(item => {
                item.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    searchInput.value = '';

                    // Remover 'active' de TODOS los botones en el nav (incluyendo el de modo oscuro si lo tuviera)
                    allCategoryItemsInNav.forEach(i => i.classList.remove('active'));
                    this.classList.add('active'); // Activar solo la categoría clicada

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
                // Al buscar, remover la clase 'active' de todos (incluye el botón de modo oscuro)
                allCategoryItemsInNav.forEach(i => i.classList.remove('active')); 

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