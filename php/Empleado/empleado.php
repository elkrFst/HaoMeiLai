<?php
session_start();
// Evitar que el navegador use caché
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Empleado') {
    header("Location: /login");
    exit();
}

// Conexión a la base de datos
$host = "srv562.hstgr.io";
$user = "u162512390_Admin";
$pass = "biuqkb>O3";
$db = "u162512390_HaoMeiLai";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener productos del almacen (con categoría)
$sql = "SELECT id, producto, precio, stock, imagen, categoria FROM almacen";
$result = $conn->query($sql);

$productos = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $productos[] = [
            "id" => $row['id'],
            "nombre" => $row['producto'],
            "precio" => $row['precio'],
            "categoria" => $row['categoria'],
            "imagen" => !empty($row['imagen']) ? $row['imagen'] : "default.jpg",
            "stock" => $row['stock']
        ];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Menú Restaurante</title>
  <link rel="stylesheet" href="../../css/Empleado.css">
  <link rel="stylesheet" href="../../css/Empleado1.css">
</head>
<body>
  <header>
    <div class="header-container">
      <div class="logo-user">
        <img src="/imagenes/logo comida.png" alt="Logo">
        <div class="user-dropdown">
            <div class="user-toggle">
                <?php echo htmlspecialchars($_SESSION['usuario']); ?> 👤
            </div>
            <div class="dropdown-menu">
                <a href="/login">🔄 Cambiar cuenta</a>
                <a href="/break">🚪 Cerrar sesión</a>
            </div>
        </div>
      </div>

      <!--<div class="categorias-container"><button class="categoria-cuadro" data-categoria="Entrantes">🥟 Entradas</button><button class="categoria-cuadro" data-categoria="Platillos">🥢 Platillos</button><button class="categoria-cuadro" data-categoria="Fideos">🍜 Fideos</button><button class="categoria-cuadro" data-categoria="Bebidas">🍹 Bebidas</button><button class="categoria-cuadro" data-categoria="Postres">🍰 Postres</button></div>-->

      <div class="search-container">
        <input type="text" id="buscador" placeholder="Buscar en el menú...">
        <div class="search-icon">🔍</div>
      </div>

      <button class="ver-todo-btn" onclick="renderMenu()" id="ver-todo" style="display: none;">👀 Ver todo</button>
    </div>
  </header>

  <main>
    <section class="menu" id="menu-productos"></section>
    <aside class="carrito" id="carrito-sidebar">
      <h2>Tu Pedido</h2>
      <div id="carrito-items"></div>
      <div class="total" id="carrito-total">TOTAL: $0.00</div>
      <div class="acciones">
        <button class="cancelar" id="btn-cancelar">Cancelar</button>
        <button class="aceptar" onclick="procesarPago()">Aceptar</button>
      </div>
    </aside>
  </main>

  <script>
    const productos = <?php echo json_encode($productos); ?>;
    let carrito = [];
    let categoriaActiva = null;

    function toggleCarrito(mostrar) {
      const carritoSidebar = document.getElementById('carrito-sidebar');
      carritoSidebar.classList.toggle('visible', mostrar);
    }

    function renderMenu(categoria = null, busqueda = '') {
      const menu = document.getElementById('menu-productos');
      const verTodo = document.getElementById('ver-todo');
      menu.innerHTML = '';
      let filtrados = productos;

      if (categoria) {
        filtrados = filtrados.filter(p => p.categoria.toLowerCase() === categoria.toLowerCase());
        categoriaActiva = categoria;
      } else {
        categoriaActiva = null;
      }

      if (busqueda) {
        filtrados = filtrados.filter(p => 
          p.nombre.toLowerCase().includes(busqueda.toLowerCase())
        );
      }

      document.querySelectorAll('.categoria-cuadro').forEach(btn => {
        btn.classList.toggle('activa', categoriaActiva && btn.getAttribute('data-categoria').toLowerCase() === categoriaActiva.toLowerCase());
      });

      if (filtrados.length === 0) {
        menu.innerHTML = '<div class="no-resultados">No se encontraron productos.</div>';
      } else {
        filtrados.forEach(p => {
          menu.innerHTML += `
            <div class="card">
              <img src="php/menu2/imagenes_productos/${p.imagen}" alt="${p.nombre}">
              <h3>${p.nombre}</h3>
              <button onclick="agregarAlCarrito('${p.nombre}', ${p.precio})">🛒 Agregar - $${p.precio}</button>
            </div>
          `;
        });
      }

      verTodo.style.display = (categoria || busqueda) ? 'block' : 'none';
    }

    function renderCarrito() {
      const carritoItems = document.getElementById('carrito-items');
      const carritoTotal = document.getElementById('carrito-total');
      carritoItems.innerHTML = '';
      let total = 0;

      if (carrito.length > 0) {
        toggleCarrito(true);
        carrito.forEach((item, idx) => {
          total += item.precio * item.cantidad;
          carritoItems.innerHTML += `
            <div class="item">
              <span>${item.nombre}</span>
              <div class="btns">
                <button onclick="cambiarCantidad(${idx}, -1)">-</button>
                <span>${item.cantidad}</span>
                <button onclick="cambiarCantidad(${idx}, 1)">+</button>
              </div>
              <span>$${item.precio * item.cantidad}</span>
              <button onclick="eliminarItem(${idx})">✖</button>
            </div>
          `;
        });
      } else {
        toggleCarrito(false);
      }

      carritoTotal.textContent = `TOTAL: $${total.toFixed(2)}`;
    }

    window.agregarAlCarrito = function(nombre, precio) {
      const idx = carrito.findIndex(item => item.nombre === nombre);
      if (idx > -1) carrito[idx].cantidad += 1;
      else carrito.push({nombre, precio, cantidad: 1});
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

    document.querySelectorAll('.categoria-cuadro').forEach(btn => {
      btn.addEventListener('click', function() {
        document.getElementById('buscador').value = '';
        renderMenu(this.getAttribute('data-categoria'));
      });
    });

    document.getElementById('buscador').addEventListener('input', function() {
      document.querySelectorAll('.categoria-cuadro').forEach(b => b.classList.remove('activa'));
      categoriaActiva = null;
      renderMenu(null, this.value);
    });

    document.getElementById('btn-cancelar').onclick = function() {
      carrito = [];
      renderCarrito();
    };

    function procesarPago() {
      if (carrito.length === 0) {
        alert('Agrega al menos un producto.');
        return;
      }
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = 'pago';
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'carrito';
      input.value = JSON.stringify(carrito);
      form.appendChild(input);
      document.body.appendChild(form);
      form.submit();
    }

    renderMenu();
    renderCarrito();
    
    // Dropdown usuario
    document.querySelector(".user-toggle").addEventListener("click", function () {
        document.querySelector(".user-dropdown").classList.toggle("open");
    });

    // Cerrar al hacer click fuera
    document.addEventListener("click", function (e) {
      if (!document.querySelector(".user-dropdown").contains(e.target)) {
        document.querySelector(".user-dropdown").classList.remove("open");
      }
    });
  </script>
</body>
</html>