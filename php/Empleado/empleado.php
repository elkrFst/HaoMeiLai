<?php
// inicio.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Menú Restaurante</title>
  <link rel="stylesheet" href="../../css/Empleado.css"> <!-- enlazado -->
</head>
<body>
  <!-- HEADER -->
  <header>
    <img src="../../imagenes/logo comida.png" alt="Logo">
    <div class="user">JUAN 👤</div>
  </header>

  <!-- LAYOUT -->
  <main>
    <!-- MENÚ DE PRODUCTOS -->
    <section class="menu">
      <div class="card">
        <img src="../../imagenes/plato1.jpeg" alt="Cerdo agridulce">
        <h3>Cerdo Agridulce</h3>
        <p>Sabor agridulce con verduras y carne.</p>
        <button>Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/plato2.jpeg" alt="Pollo Kung Pao">
        <h3>Pollo Kung Pao</h3>
        <p>Pollo con cacahuates y salsa picante.</p>
        <button>Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/plato3.jpeg" alt="Chow Mein">
        <h3>Chow Mein</h3>
        <p>Fideos fritos con verduras y pollo.</p>
        <button>Agregar</button>
      </div>
      <div class="card">
        <img src="../../imagenes/comida 5.jpg" alt="Dumplings">
        <h3>Dumplings</h3>
        <p>Dumplings al vapor rellenos de carne y verduras.</p>
        <button>Agregar</button>
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

  <!-- FOOTER -->
  <footer>
    <div class="footer-item" data-nombre="Bebidas" data-precio="25">🍹 Bebidas</div>
    <div class="footer-item" data-nombre="Fideos" data-precio="40">🍜 Fideos</div>
    <div class="footer-item" data-nombre="Sushi" data-precio="45">🍣 Sushi</div>
    <div class="footer-item" data-nombre="Postres" data-precio="30">🍰 Postres</div>
  </footer>
  <script>
    // Productos del menú
    const productos = [
      {nombre: "Cerdo Agridulce", precio: 50},
      {nombre: "Pollo Kung Pao", precio: 55},
      {nombre: "Chow Mein", precio: 60},
      {nombre: "Dumplings", precio: 45}
    ];

    // Carrito
    let carrito = [];

    // Actualiza el carrito en pantalla
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

    // Cambia la cantidad de un producto
    window.cambiarCantidad = function(idx, cambio) {
      carrito[idx].cantidad += cambio;
      if (carrito[idx].cantidad < 1) carrito[idx].cantidad = 1;
      renderCarrito();
    }

    // Elimina un producto del carrito
    window.eliminarItem = function(idx) {
      carrito.splice(idx, 1);
      renderCarrito();
    }

    // Agrega producto al carrito
    function agregarAlCarrito(nombre, precio) {
      const idx = carrito.findIndex(item => item.nombre === nombre);
      if (idx > -1) {
        carrito[idx].cantidad += 1;
      } else {
        carrito.push({nombre, precio, cantidad: 1});
      }
      renderCarrito();
    }

    // Botones del menú
    document.querySelectorAll('.menu .card button').forEach((btn, i) => {
      btn.addEventListener('click', () => {
        agregarAlCarrito(productos[i].nombre, productos[i].precio);
      });
    });

    // Botón cancelar
    document.getElementById('btn-cancelar').onclick = function() {
      carrito = [];
      renderCarrito();
    };

    // Inicializa el carrito vacío
    renderCarrito();
  </script>
</body>
</html>
