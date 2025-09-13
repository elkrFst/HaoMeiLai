<?php
// inicio.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Menú Restaurante</title>
  <link rel="stylesheet" href="../../css/Empleado.css"> <!-- enlazado -->
  <style>
    /* Reset y estilos base */
    * {
      box-sizing: border-box;
    }
    
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }
    
    /* Header reorganizado */
    header {
      background: #fff;
      border-bottom: 1px solid #ddd;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .header-top {
      padding: 12px 16px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      min-height: 60px;
    }
    
    .logo-user {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    
    .logo-user img {
      height: 40px;
    }
    
    .user {
      font-size: 1em;
      font-weight: bold;
      color: #333;
    }
    
    .ver-todo-btn {
      padding: 8px 16px;
      background: #e53935;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 0.9em;
      transition: background 0.3s ease;
    }
    
    .ver-todo-btn:hover {
      background: #d32f2f;
    }
    
    .header-bottom {
      padding: 12px 16px;
      background: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
      gap: 16px;
    }
    
    /* Categorías */
    .categorias-container {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      justify-content: center;
    }
    
    .categoria-cuadro {
      padding: 8px 16px;
      border-radius: 20px;
      border: 2px solid #e53935;
      background: #fff;
      cursor: pointer;
      font-size: 0.9em;
      transition: all 0.3s ease;
      white-space: nowrap;
      color: #333;
    }
    
    .categoria-cuadro:hover,
    .categoria-cuadro.activa {
      background: #e53935;
      color: #fff;
      transform: translateY(-2px);
    }
    
    /* Buscador */
    .search-container {
      position: relative;
      margin-left: auto;
    }
    
    .search-container input {
      padding: 8px 35px 8px 12px;
      width: 250px;
      border-radius: 20px;
      border: 2px solid #e53935;
      background: #fff;
      outline: none;
      transition: all 0.3s ease;
    }
    
    .search-container input:focus {
      width: 300px;
      box-shadow: 0 0 8px rgba(229, 57, 53, 0.3);
    }
    
    .search-icon {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      pointer-events: none;
      font-size: 1.1em;
    }
    
    /* Layout principal */
    main {
      display: flex;
      transition: all 0.3s ease;
      position: relative;
      padding: 20px 0;
    }
    
    .menu {
      flex: 1;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px;
      padding: 0 20px;
      transition: all 0.3s ease;
    }
    
    /* Tarjetas de productos */
    .card {
      background: #fff;
      border-radius: 12px;
      padding: 16px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: 1px solid #eee;
    }
    
    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 12px;
    }
    
    .card h3 {
      margin: 0 0 8px 0;
      color: #333;
      font-size: 1.2em;
    }
    
    .card p {
      margin: 0 0 12px 0;
      color: #666;
      font-size: 0.9em;
      line-height: 1.4;
    }
    
    .card button {
      width: 100%;
      padding: 10px;
      background: #e53935;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 0.9em;
      font-weight: bold;
      transition: background 0.3s ease;
    }
    
    .card button:hover {
      background: #d32f2f;
    }
    
    /* Carrito */
    .carrito {
      width: 0;
      overflow: hidden;
      opacity: 0;
      transition: all 0.3s ease;
      background: #f9f9f9;
      padding: 0;
      border-left: none;
    }
    
    .carrito.visible {
      width: 320px;
      opacity: 1;
      padding: 20px;
      border-left: 1px solid #ddd;
    }
    
    .carrito h2 {
      margin: 0 0 20px 0;
      color: #333;
      text-align: center;
    }
    
    .carrito .item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 0;
      border-bottom: 1px solid #eee;
      gap: 8px;
      font-size: 0.9em;
    }
    
    .carrito .btns {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .carrito .btns button {
      width: 24px;
      height: 24px;
      border: none;
      background: #e53935;
      color: #fff;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .total {
      font-weight: bold;
      font-size: 1.1em;
      text-align: center;
      margin: 20px 0;
      padding: 10px;
      background: #fff;
      border-radius: 6px;
    }
    
    .acciones {
      display: flex;
      gap: 10px;
    }
    
    .acciones button {
      flex: 1;
      padding: 10px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }
    
    .cancelar {
      background: #f44336;
      color: #fff;
    }
    
    .aceptar {
      background: #4caf50;
      color: #fff;
    }
    
    /* Responsive */
    @media (max-width: 968px) {
      .header-bottom {
        flex-direction: column;
        gap: 12px;
      }
      
      .search-container {
        margin-left: 0;
      }
      
      .search-container input {
        width: 280px;
      }
      
      .search-container input:focus {
        width: 320px;
      }
    }
    
    @media (max-width: 768px) {
      .header-top {
        flex-direction: column;
        gap: 12px;
        text-align: center;
      }
      
      .categorias-container {
        justify-content: center;
      }
      
      .categoria-cuadro {
        font-size: 0.8em;
        padding: 6px 12px;
      }
      
      .menu {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        padding: 0 10px;
        gap: 15px;
      }
      
      .carrito.visible {
        position: fixed;
        right: 0;
        top: 0;
        bottom: 0;
        z-index: 1000;
        box-shadow: -2px 0 10px rgba(0,0,0,0.1);
        width: 280px;
      }
      
      .search-container input {
        width: 240px;
      }
      
      .search-container input:focus {
        width: 260px;
      }
    }
    
    @media (max-width: 480px) {
      .categorias-container {
        gap: 8px;
      }
      
      .categoria-cuadro {
        font-size: 0.75em;
        padding: 5px 10px;
      }
      
      .menu {
        grid-template-columns: 1fr;
      }
      
      .search-container input {
        width: 200px;
      }
    }
  </style>
</head>
<body>
  <!-- HEADER REORGANIZADO -->
  <header>
    <!-- Fila superior: Logo, Usuario y Ver Todo -->
    <div class="header-top">
      <div class="logo-user">
        <img src="../../imagenes/logo comida.png" alt="Logo">
        <div class="user">JUAN 👤</div>
      </div>
      
      <button class="ver-todo-btn" onclick="renderMenu()" id="ver-todo" style="display: none;">
        👀 Ver todo
      </button>
    </div>
    
    <!-- Fila inferior: Categorías y Buscador -->
    <div class="header-bottom">
      <div class="categorias-container">
        <button class="categoria-cuadro" data-categoria="Bebidas">🍹 Bebidas</button>
        <button class="categoria-cuadro" data-categoria="Fideos">🍜 Fideos</button>
        <button class="categoria-cuadro" data-categoria="Platillos">🍣 Platillos</button>
        <button class="categoria-cuadro" data-categoria="Postres">🍰 Postres</button>
      </div>
      
      <div class="search-container">
        <input type="text" id="buscador" placeholder="Buscar en el menú...">
        <div class="search-icon">🔍</div>
      </div>
    </div>
  </header>

  <!-- LAYOUT PRINCIPAL -->
  <main>
    <!-- MENÚ DE PRODUCTOS -->
    <section class="menu" id="menu-productos">
      <!-- Los productos se cargarán dinámicamente -->
    </section>

    <!-- CARRITO -->
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
  const productos = [
    {nombre: "Cerdo Agridulce", precio: 50, categoria: "Platillos", img: "../../imagenes/plato1.jpeg", desc: "Sabor agridulce con verduras y carne."},
    {nombre: "Pollo Kung Pao", precio: 55, categoria: "Platillos", img: "../../imagenes/plato2.jpeg", desc: "Pollo con cacahuates y salsa picante."},
    {nombre: "Chow Mein", precio: 60, categoria: "Fideos", img: "../../imagenes/plato3.jpeg", desc: "Fideos fritos con verduras y pollo."},
    {nombre: "Dumplings", precio: 45, categoria: "Platillos", img: "../../imagenes/comida 5.jpg", desc: "Dumplings al vapor rellenos de carne y verduras."},
    {nombre: "Sopa Wantán", precio: 35, categoria: "Platillos", img: "../../imagenes/comida6.jpeg", desc: "Sopa caliente con wantanes y verduras."},
    {nombre: "Arroz Frito", precio: 40, categoria: "Fideos", img: "../../imagenes/comida7.jpeg", desc: "Arroz salteado con huevo, verduras y pollo."},
    {nombre: "Pato Pekín", precio: 80, categoria: "Platillos", img: "../../imagenes/comida8.jpeg", desc: "Pato crujiente servido con crepas y salsa hoisin."},
    {nombre: "Tofu Mapo", precio: 50, categoria: "Platillos", img: "../../imagenes/comida9.jpeg", desc: "Tofu en salsa picante con carne molida."},
    {nombre: "Chop suey", precio: 55, categoria: "Platillos", img: "../../imagenes/comida10.jpeg", desc: "Trozos de carne con vegetales y brotes de judía Muing."},
    {nombre: "Wonton soup", precio: 30, categoria: "Platillos", img: "../../imagenes/comida11.jpeg", desc: "Saquitos de harina rellenos de cerdo o camarón con verduras."},
    {nombre: "CHAR SIU", precio: 70, categoria: "Platillos", img: "../../imagenes/comida12.jpeg", desc: "Tofu rojo fermentado, miel y arroz o fideos, o como relleno de bollos al vapor."},
    {nombre: "SIU MAI", precio: 45, categoria: "Platillos", img: "../../imagenes/comida13.jpeg", desc: "Dumpling abierto al estilo cantones, con una envoltura de masa de wonton con un relleno de carne de cerdo y pollo, camarón."},
    {nombre: "Baijiu", precio: 25, categoria: "Bebidas", img: "../../imagenes/bebida.jpeg", desc: "Licor nacional, destilado de grano de color claro, principalmente de sorgo, pero también de cereales como arroz, trigo y maíz."},
    {nombre: "Vino Osmanthus", precio: 30, categoria: "Bebidas", img: "../../imagenes/bebida1.jpeg", desc: "Bebida alcohólica tradicional china elaborada con flores dulces de osmanto."},
    {nombre: "Té de jazmín", precio: 20, categoria: "Bebidas", img: "../../imagenes/bebida2.jpeg", desc: "Té verde perfumado con flores de jazmín."},
    {nombre: "Té Pu-erh", precio: 25, categoria: "Bebidas", img: "../../imagenes/bebida3.jpg", desc: "Té fermentado originario de la provincia de Yunnan."},
    {nombre: "nánguā bǐng", precio: 30, categoria: "Postres", img: "../../imagenes/postre.jpeg", desc: "pequeños pasteles fritos consisten en pasta de calabaza, azúcar y harina de arroz glutinoso."},
    {nombre: "Tángyuán", precio: 30, categoria: "Postres", img: "../../imagenes/postre1.jpeg", desc: "Bolas de arroz glutinoso rellenas de pasta."},
    {nombre: "Bāozi", precio: 35, categoria: "Postres", img: "../../imagenes/postre2.jpeg", desc: "Panecillos al vapor rellenos de carne o verduras."},
    {nombre: "Jiānbing", precio: 40, categoria: "Postres", img: "../../imagenes/postre3.jpeg", desc: "Crepe chino relleno de huevo, cebollín, cilantro y salsas."}
  ];

  let carrito = [];
  let categoriaActiva = null;

  // Función para mostrar/ocultar el carrito
  function toggleCarrito(mostrar) {
    const carritoSidebar = document.getElementById('carrito-sidebar');
    if (mostrar) {
      carritoSidebar.classList.add('visible');
    } else {
      carritoSidebar.classList.remove('visible');
    }
  }

  // Renderiza el menú (todas, filtradas o por búsqueda)
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
        p.nombre.toLowerCase().includes(busqueda.toLowerCase()) ||
        p.desc.toLowerCase().includes(busqueda.toLowerCase())
      );
    }

    // Actualizar estado visual de las categorías
    document.querySelectorAll('.categoria-cuadro').forEach(btn => {
      const btnCategoria = btn.getAttribute('data-categoria');
      if (categoriaActiva && btnCategoria.toLowerCase() === categoriaActiva.toLowerCase()) {
        btn.classList.add('activa');
      } else {
        btn.classList.remove('activa');
      }
    });

    if (filtrados.length === 0) {
      menu.innerHTML = '<div class="no-resultados">No se encontraron productos que coincidan con tu búsqueda.</div>';
    } else {
      filtrados.forEach((p, i) => {
        menu.innerHTML += 
          `<div class="card">
            <img src="${p.img}" alt="${p.nombre}">
            <h3>${p.nombre}</h3>
            <p>${p.desc}</p>
            <button onclick="agregarAlCarrito('${p.nombre}', ${p.precio})">🛒 Agregar - $${p.precio}</button>
          </div>`;
      });
    }
    
    // Mostrar el botón "Ver todo" solo si hay filtro activo
    verTodo.style.display = (categoria || busqueda) ? 'block' : 'none';
  }

  function renderCarrito() {
    const carritoItems = document.getElementById('carrito-items');
    const carritoTotal = document.getElementById('carrito-total');
    carritoItems.innerHTML = '';
    let total = 0;
    
    // Mostrar el carrito solo si hay items
    if (carrito.length > 0) {
      toggleCarrito(true);
      
      carrito.forEach((item, idx) => {
        total += item.precio * item.cantidad;
        carritoItems.innerHTML += 
          `<div class="item">
            <span>${item.nombre}</span>
            <div class="btns">
              <button onclick="cambiarCantidad(${idx}, -1)">-</button>
              <span>${item.cantidad}</span>
              <button onclick="cambiarCantidad(${idx}, 1)">+</button>
            </div>
            <span>$${item.precio * item.cantidad}</span>
            <button onclick="eliminarItem(${idx})" style="margin-left:8px;background:#e53935;color:#fff;border:none;border-radius:50%;width:24px;height:24px;cursor:pointer;">✖</button>
          </div>`;
      });
    } else {
      toggleCarrito(false);
    }
    
    carritoTotal.textContent = `TOTAL: $${total.toFixed(2)}`;
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

  window.agregarAlCarrito = function(nombre, precio) {
    const idx = carrito.findIndex(item => item.nombre === nombre);
    if (idx > -1) {
      carrito[idx].cantidad += 1;
    } else {
      carrito.push({nombre, precio, cantidad: 1});
    }
    renderCarrito();
  }

  // Event listeners para categorías
  document.querySelectorAll('.categoria-cuadro').forEach(btn => {
    btn.addEventListener('click', function() {
      const categoria = btn.getAttribute('data-categoria');
      // Limpiar búsqueda al seleccionar categoría
      document.getElementById('buscador').value = '';
      renderMenu(categoria, '');
    });
  });

  // Buscador
  document.getElementById('buscador').addEventListener('input', function() {
    // Limpiar filtros de categoría al buscar
    document.querySelectorAll('.categoria-cuadro').forEach(b => {
      b.classList.remove('activa');
    });
    categoriaActiva = null;
    renderMenu(null, this.value);
  });

  document.getElementById('btn-cancelar').onclick = function() {
    carrito = [];
    renderCarrito();
  };

  // FUNCIÓN PARA PROCESAR PAGO
  function procesarPago() {
    if (carrito.length === 0) {
      alert('Por favor, agrega al menos un producto al carrito.');
      return;
    }
    
    // Convertir carrito a JSON y enviar por formulario
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'pago.php';
    
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'carrito';
    input.value = JSON.stringify(carrito);
    form.appendChild(input);
    
    document.body.appendChild(form);
    form.submit();
  }

  // Inicializar la aplicación
  renderMenu();
  renderCarrito();
  </script>
</body>
</html>