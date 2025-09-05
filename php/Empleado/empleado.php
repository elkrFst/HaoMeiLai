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
      <div class="item">
        <span>Rollos</span>
        <div class="btns">
          <button>-</button>
          <span>1</span>
          <button>+</button>
        </div>
        <span>$35</span>
      </div>

      <div class="item">
        <span>Sushi</span>
        <div class="btns">
          <button>-</button>
          <span>2</span>
          <button>+</button>
        </div>
        <span>$90</span>
      </div>

      <div class="total">TOTAL: $125.00</div>

      <div class="acciones">
        <button class="cancelar">Cancelar</button>
        <button class="aceptar">Aceptar</button>
      </div>
    </aside>
  </main>

  <!-- FOOTER -->
  <footer>
    <div>🍹 Bebidas</div>
    <div>🍜 Fideos</div>
    <div>🍣 Sushi</div>
    <div>🍰 Postres</div>
  </footer>
</body>
</html>
