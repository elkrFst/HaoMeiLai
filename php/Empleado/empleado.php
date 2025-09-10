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
    /* Estilo para la lupa en el buscador */
    .search-container {
      position: relative;
      display: flex;
      justify-content: center;
      margin-bottom: 16px;
    }
    
    .search-container input {
      padding: 8px 35px 8px 12px;
      width: 300px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    
    .search-icon {
      position: absolute;
      right: calc(50% - 150px + 10px);
      top: 50%;
      transform: translateY(-50%);
      pointer-events: none;
    }
  </style>
</head>
<body>
  <!-- HEADER -->
  <header style="padding: 8px 16px; background: #fff; display: flex; align-items: center; justify-content: center; position: relative; flex-wrap: wrap; min-height: 70px;">
    <!-- LOGO Y USUARIO (MOVIDO A LA IZQUIERDA) -->
    <div style="display: flex; align-items: center; position: absolute; left: 16px;">
      <img src="../../imagenes/logo comida.png" alt="Logo" style="height: 40px;">
      <div class="user" style="margin-left: 12px; font-size: 1em;">JUAN 👤</div>
    </div>
    
    <!-- CUADRITOS DE CATEGORÍA SIEMPRE CENTRADOS -->
    <div id="categorias-cuadros" style="
      display: flex; 
      gap: 12px; 
      position: absolute; 
      left: 50%; 
      transform: translateX(-50%);
      top: 50%; 
      z-index: 2;
      background: transparent;
    ">
      <button class="categoria-cuadro" data-categoria="Bebidas" style="padding:8px 18px; border-radius:10px; border:1px solid #e53935; background:#fff; cursor:pointer; font-size:1em;">🍹 Bebidas</button>
      <button class="categoria-cuadro" data-categoria="Fideos" style="padding:8px 18px; border-radius:10px; border:1px solid #e53935; background:#fff; cursor:pointer; font-size:1em;">🍜 Fideos</button>
      <button class="categoria-cuadro" data-categoria="Platillos" style="padding:8px 18px; border-radius:10px; border:1px solid #e53935; background:#fff; cursor:pointer; font-size:1em;">🍣 Platillos</button>
      <button class="categoria-cuadro" data-categoria="Postres" style="padding:8px 18px; border-radius:10px; border:1px solid #e53935; background:#fff; cursor:pointer; font-size:1em;">🍰 Postres</button>
    </div>
    
    <!-- BOTÓN VER TODO -->
    <div id="ver-todo" style="margin-left:auto;">
      <button onclick="renderMenu()" style="padding:6px 16px; background:#e53935; color:#fff; border:none; border-radius:6px; cursor:pointer;">
        👀 Ver todo
      </button>
    </div>
  </header>

  <!-- BUSCADOR CON LUPITA -->
  <div class="search-container">
    <input type="text" id="buscador" placeholder="Buscar en el menú...">
    <div class="search-icon">🔍</div>
  </div>

  <!-- LAYOUT -->
  <main style="padding-bottom: 70px;">
    <!-- MENÚ DE PRODUCTOS -->
    <section class="menu" id="menu-productos">
      <div class="card">
        <img src="../../imagenes/plato1.jpeg" alt="Cerdo agridulce">
        <h3>Cerdo Agridulce</h3>
        <p>Sabor agridulce con verduras y carne.</p>
        <button onclick="agregarAlCarrito('Cerdo Agridulce', 50)">Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/plato2.jpeg" alt="Pollo Kung Pao">
        <h3>Pollo Kung Pao</h3>
        <p>Pollo con cacahuates y salsa picante.</p>
        <button onclick="agregarAlCarrito('Pollo Kung Pao', 55)">Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/plato3.jpeg" alt="Chow Mein">
        <h3>Chow Mein</h3>
        <p>Fideos fritos con verduras y pollo.</p>
        <button onclick="agregarAlCarrito('Chow Mein', 60)">Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/comida 5.jpg" alt="Dumplings">
        <h3>Dumplings</h3>
        <p>Dumplings al vapor rellenos de carne y verduras.</p>
        <button onclick="agregarAlCarrito('Dumplings', 45)">Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/comida6.jpeg" alt="Sopa Wantán">
        <h3>Sopa Wantán</h3>
        <p>Sopa caliente con wantanes y verduras.</p>
        <button onclick="agregarAlCarrito('Sopa Wantán', 35)">Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/comida7.jpeg" alt="Arroz Frito">
        <h3>Arroz Frito</h3>
        <p>Arroz salteado con huevo, verduras y pollo.</p>
        <button onclick="agregarAlCarrito('Arroz Frito', 40)">Agregar</button>
      </div>
      <div class="card">  
        <img src="../../imagenes/comida8.jpeg" alt="Pato Pekín">
        <h3>Pato Pekín</h3>
        <p>Pato crujiente servido con crepas y salsa hoisin.</p>
        <button onclick="agregarAlCarrito('Pato Pekín', 80)">Agregar</button>
      </div>
      <div class="card">    
        <img src="../../imagenes/comida9.jpeg" alt="Tofu Mapo">
        <h3>Tofu Mapo</h3>
        <p>Tofu en salsa picante con carne molida.</p>
        <button onclick="agregarAlCarrito('Tofu Mapo', 50)">Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/comida10.jpeg" alt="Chop suey">
        <h3>Chop suey</h3>
        <p>Trozos de carne con vegetales y brotes de judía Muing.</p>
        <button onclick="agregarAlCarrito('Chop suey', 55)">Agregar</button>
      </div>
      <div class="card">  
        <img src="../../imagenes/comida11.jpeg" alt="Wonton soup">
        <h3>Wonton soup</h3>
        <p>Saquitos de harina rellenos de cerdo o camarón con verduras.</p>
        <button onclick="agregarAlCarrito('Wonton soup', 30)">Agregar</button>
      </div>
      <div class="card">  
        <img src="../../imagenes/comida12.jpeg" alt="CHAR SIU">
        <h3>CHAR SIU</h3>
        <p>Tofu rojo fermentado, miel y arroz o fideos, o como relleno de bollos al vapor.</p>
        <button onclick="agregarAlCarrito('CHAR SIU', 70)">Agregar</button>
      </div>
      <div class="card">    
        <img src="../../imagenes/comida13.jpeg" alt="SIU MAI">
        <h3>SIU MAI</h3>
        <p>Dumpling abierto al estilo cantones, con una envoltura de masa de wonton con un relleno de carne de cerdo y pollo, camarón.</p>
        <button onclick="agregarAlCarrito('SIU MAI', 45)">Agregar</button>    
      </div>
      <div class="card">
        <img src="../../imagenes/bebida.jpeg" alt="Baijiu">
        <h3>Baijiu</h3>
        <p>Licor nacional, destilado de grano de color claro, principalmente de sorgo, pero también de cereales como arroz, trigo y maíz.</p>
        <button onclick="agregarAlCarrito('Baijiu', 25)">Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/bebida1.jpeg" alt="Vino Osmanthus">
        <h3>Vino Osmanthus</h3>
        <p>Bebida alcohólica tradicional china elaborada con flores dulces de osmanto.</p>
        <button onclick="agregarAlCarrito('Vino Osmanthus', 30)">Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/bebida2.jpeg" alt="Té de jazmín">
        <h3>Té de jazmín</h3>
        <p>Té verde perfumado con flores de jazmín.</p>
        <button onclick="agregarAlCarrito('Té de jazmín', 20)">Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/bebida3.jpg" alt="Té Pu-erh">
        <h3>Té Pu-erh</h3>
        <p>Té fermentado originario de la provincia de Yunnan.</p>
        <button onclick="agregarAlCarrito('Té Pu-erh', 25)">Agregar</button>
      </div>
      <!-- ...otros productos... -->
       <div class="card">
        <img src="../../imagenes/postre.jpeg" alt="nánguā bǐng">
        <h3>nánguā bǐng</h3>
        <p>pequeños pasteles fritos consisten en pasta de calabaza, azúcar y harina de arroz glutinoso.</p>
        <button onclick="agregarAlCarrito('Chop suey', 55)">Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/postre1.jpeg" alt="Tángyuán">
        <h3>Tángyuán</h3>
        <p>Bolas de arroz glutinoso rellenas de pasta.</p>
        <button onclick="agregarAlCarrito('Tángyuán', 30)">Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/postre2.jpeg" alt="Bāozi">
        <h3>Bāozi</h3>
        <p>Panecillos al vapor rellenos de carne o verduras.</p>
        <button onclick="agregarAlCarrito('Bāozi', 35)">Agregar</button>  
      </div>
      <div class="card">
        <img src="../../imagenes/postre3.jpeg" alt="Jiānbing">
        <h3>Jiānbing</h3>
        <p>Crepe chino relleno de huevo, cebollín, cilantro y salsas.</p>
        <button onclick="agregarAlCarrito('Jiānbing', 40)">Agregar</button>
      </div>
    </section>

    <!-- CARRITO -->
    <aside class="carrito">
      <h2>Tu Pedido</h2>
      <div id="carrito-items"></div>
      <div class="total" id="carrito-total">TOTAL: $0.00</div>
      <div class="acciones">
        <button class="cancelar" id="btn-cancelar">Cancelar</button>
        <button class="aceptar">Aceptar</button>
      </div>
    </aside>
  </main>

  <script>
  const productos = [
    {nombre: "Cerdo Agridulce", precio: 50, categoria: "Platillos", img: "../../imagenes/plato1.jpeg", desc: "Sabor agridulce con verduras y carne."},
    {nombre: "Pollo Kung Pao", precio: 55, categoria: "Platillos", img: "../../imagenes/plato2.jpeg", desc: "Pollo con cacahuates y salsa picante."},
    {nombre: "Chow Mein", precio: 60, categoria: "Fideos", img: "../../imagenes/plato3.jpeg", desc: "Fideos fritos con verduras y pollo."},
    {nombre: "Dumplings", precio: 45, categoria: "Dumplings", img: "../../imagenes/comida 5.jpg", desc: "Dumplings al vapor rellenos de carne y verduras."},
    {nombre: "Sopa Wantán", precio: 35, categoria: "Sopa", img: "../../imagenes/comida6.jpeg", desc: "Sopa caliente con wantanes y verduras."},
    {nombre: "Arroz Frito", precio: 40, categoria: "Fideos", img: "../../imagenes/comida7.jpeg", desc: "Arroz salteado con huevo, verduras y pollo."},
    {nombre: "Pato Pekín", precio: 80, categoria: "Platillos", img: "../../imagenes/comida8.jpeg", desc: "Pato crujiente servido con crepas y salsa hoisin."},
    {nombre: "Tofu Mapo", precio: 50, categoria: "Platillos", img: "../../imagenes/comida9.jpeg", desc: "Tofu en salsa picante con carne molida."},
    {nombre: "Chop suey", precio: 55, categoria: "Platillos", img: "../../imagenes/comida10.jpeg", desc: "Trozos de carne con vegetales y brotes de judía Muing."},
    {nombre: "Wonton soup", precio: 30, categoria: "Sopa", img: "../../imagenes/comida11.jpeg", desc: "Saquitos de harina rellenos de cerdo o camarón con verduras."},
    {nombre: "CHAR SIU", precio: 70, categoria: "Platillos", img: "../../imagenes/comida12.jpeg", desc: "Tofu rojo fermentado, miel y arroz o fideos, o como relleno de bollos al vapor."},
    {nombre: "SIU MAI", precio: 45, categoria: "Dumplings", img: "../../imagenes/comida13.jpeg", desc: "Dumpling abierto al estilo cantones, con una envoltura de masa de wonton con un relleno de carne de cerdo y pollo, camarón."},
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

  // Renderiza el menú (todas, filtradas o por búsqueda)
  function renderMenu(categoria = null, busqueda = '') {
    const menu = document.getElementById('menu-productos');
    const verTodo = document.getElementById('ver-todo');
    menu.innerHTML = '';
    let filtrados = productos;

    if (categoria) {
      filtrados = filtrados.filter(p => p.categoria.toLowerCase() === categoria.toLowerCase());
    }
    if (busqueda) {
      filtrados = filtrados.filter(p => 
        p.nombre.toLowerCase().includes(busqueda.toLowerCase()) ||
        p.desc.toLowerCase().includes(busqueda.toLowerCase())
      );
    }

    filtrados.forEach((p, i) => {
      menu.innerHTML += `
        <div class="card">
          <img src="${p.img}" alt="${p.nombre}">
          <h3>${p.nombre}</h3>
          <p>${p.desc}</p>
          <button onclick="agregarAlCarrito('${p.nombre}', ${p.precio})">🛒 Agregar</button>
        </div>
      `;
    });
    // Mostrar el botón "Ver todo" solo si hay filtro
    verTodo.style.display = categoria ? 'block' : 'none';
  }

  function renderCarrito() {
    const carritoItems = document.getElementById('carrito-items');
    const carritoTotal = document.getElementById('carrito-total');
    carritoItems.innerHTML = '';
    let total = 0;
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
          <button onclick="eliminarItem(${idx})" style="margin-left:8px;background:#e53935;color:#fff;border:none;border-radius:50%;width:24px;height:24px;cursor:pointer;">✖</button>
        </div>
      `;
    });
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

  // Cuadritos de categoría arriba en el header
  document.querySelectorAll('.categoria-cuadro').forEach(btn => {
    btn.addEventListener('click', function() {
      const categoria = btn.getAttribute('data-categoria');
      renderMenu(categoria, document.getElementById('buscador').value);
    });
  });

  // Buscador
  document.getElementById('buscador').addEventListener('input', function() {
    renderMenu(null, this.value);
  });

  document.getElementById('btn-cancelar').onclick = function() {
    carrito = [];
    renderCarrito();
  };

  // Inicializa mostrando todo el menú
  renderMenu();
  renderCarrito();
  </script>
</body>
</html>