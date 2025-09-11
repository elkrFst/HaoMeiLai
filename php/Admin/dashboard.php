<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../iniciodesesión.php');
    exit();
}
require_once '../../conexion.php'; // Asume que tienes un archivo de conexión

// Obtener datos para tarjetas
$ventas = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM ventas"))[0];
$pedidos = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM pedidos"))[0];
$clientes = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM clientes WHERE atendido=1"))[0];

// Paginación productos
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 8;
$offset = ($page - 1) * $limit;
$total = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM almacen"))[0];
$pages = ceil($total / $limit);
$productos = mysqli_query($conn, "SELECT * FROM almacen LIMIT $offset, $limit");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: #fff;
        }
        .sidebar .nav-link {
            color: #fff;
        }
        .sidebar .nav-link.active {
            background: #495057;
        }
        .content {
            padding: 2rem;
        }
        .hide { display: none; }
    </style>
    <style>
    /* ======= ESTILO DASHBOARD CHINO ======= */

    body {
        background-color: #f6e7d8 !important;
        font-family: Arial, sans-serif;
    }

    /* Sidebar */
    .sidebar {
        background-color: #7b2c2c !important;
        padding-top: 20px;
        color: #fff;
    }
    .sidebar .nav-link {
        color: #fff !important;
        font-weight: bold;
        margin: 5px 0;
        border-radius: 8px;
        transition: background 0.3s;
    }
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background-color: #a33d3d !important;
    }
    .sidebar .logo {
        text-align: center;
        margin-bottom: 30px;
    }
    .sidebar .logo img {
        width: 80px;
        margin-bottom: 10px;
    }
    .sidebar .logo h2 {
        font-size: 18px;
        margin: 0;
        color: #fff;
    }

    /* Contenido principal */
    .content h1 {
        color: #7b2c2c;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Tarjetas */
    .card {
        border: none !important;
        border-radius: 15px !important;
        box-shadow: 0 4px 6px rgba(0,0,0,0.15);
        text-align: center;
        padding: 20px;
    }
    .card h3 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #7b2c2c;
    }
    .card p {
        font-size: 26px;
        font-weight: bold;
        color: #333;
    }

    /* Botones */
    .btn-primary {
        background-color: #a33d3d !important;
        border: none !important;
        border-radius: 10px;
    }
    .btn-primary:hover {
        background-color: #7b2c2c !important;
    }

    /* Tablas */
    table {
        border-radius: 10px;
        overflow: hidden;
    }
    thead {
        background-color: #7b2c2c;
        color: white;
    }
    tbody tr:hover {
        background-color: #f6c453;
    }

    /* Gráficas */
    .chart-box {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-top: 20px;
    }
</style>

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 sidebar py-4">
            <div class="logo">
                <img src="../../imagenes/logo comida.png" alt="Logo">
            <h2>HAO MEI LAI</h2>
            </div>

            <h4 class="text-center mb-4">Menú</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#" onclick="showSection('dashboard')">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showSection('almacen')">Almacén</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showSection('trabajadores')">Trabajadores</a>
                </li>
                <li class="nav-item mt-4">
                    <a class="nav-link" href="../iniciodesesión.php">Cerrar Sesión</a>
                </li>
            </ul>
        </nav>
        <main class="col-md-10 content">
            <!-- Dashboard -->
            <div id="dashboardSection">
                <h2>Dashboard Administrador</h2>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card text-center" onclick="location.href='detalle_ventas.php'">
                            <div class="card-body">
                                <h5 class="card-title">Ventas</h5>
                                <p class="card-text fs-2"><?php echo $ventas; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center" onclick="location.href='detalle_pedidos.php'">
                            <div class="card-body">
                                <h5 class="card-title">Pedidos</h5>
                                <p class="card-text fs-2"><?php echo $pedidos; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center" onclick="location.href='detalle_clientes.php'">
                            <div class="card-body">
                                <h5 class="card-title">Clientes Atendidos</h5>
                                <p class="card-text fs-2"><?php echo $clientes; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Almacén -->
            <div id="almacenSection" class="hide">
                <h4>Productos</h4>
                <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar Producto</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th><th>Producto</th><th>Precio</th><th>Stock</th><th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = mysqli_fetch_assoc($productos)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['producto']; ?></td>
                            <td><?php echo $row['precio']; ?></td>
                            <td><?php echo $row['stock']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="editarProducto(<?php echo $row['id']; ?>, '<?php echo $row['producto']; ?>', <?php echo $row['precio']; ?>, <?php echo $row['stock']; ?>)">Editar</button>
                                <button class="btn btn-danger btn-sm" onclick="eliminarProducto(<?php echo $row['id']; ?>)">Eliminar</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <?php for($i=1; $i<=$pages; $i++): ?>
                            <li class="page-item <?php if($i==$page) echo 'active'; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>" onclick="event.preventDefault(); changePage(<?php echo $i; ?>);"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
            <!-- Trabajadores -->
            <div id="trabajadoresSection" class="hide">
                <h4>Trabajadores</h4>
                <!-- ...existing code... -->
            </div>
            <!-- Seguridad -->
            <div id="seguridadSection" class="hide">
                <h4>Seguridad</h4>
                <p>Solo usuarios con rol administrador pueden acceder a esta página.</p>
            </div>
        </main>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="producto_accion.php">
      <div class="modal-header"><h5 class="modal-title">Agregar Producto</h5></div>
      <div class="modal-body">
        <input type="hidden" name="accion" value="agregar">
        <div class="mb-2">
          <label for="producto">Producto</label>
          <input type="text" name="producto" id="producto" class="form-control" required>
        </div>
        <div class="mb-2">
          <label for="precio">Precio</label>
          <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
        </div>
        <div class="mb-2">
          <label for="stock">Stock</label>
          <input type="number" name="stock" id="stock" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Guardar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="producto_accion.php">
      <div class="modal-header"><h5 class="modal-title">Editar Producto</h5></div>
      <div class="modal-body">
        <input type="hidden" name="accion" value="editar">
        <input type="hidden" name="id" id="editId">
        <div class="mb-2"><input type="text" name="producto" id="editProducto" class="form-control" required></div>
        <div class="mb-2"><input type="number" step="0.01" name="precio" id="editPrecio" class="form-control" required></div>
        <div class="mb-2"><input type="number" name="stock" id="editStock" class="form-control" required></div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="modalEliminar" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="producto_accion.php">
      <div class="modal-header"><h5 class="modal-title">Eliminar Producto</h5></div>
      <div class="modal-body">
        <input type="hidden" name="accion" value="eliminar">
        <input type="hidden" name="id" id="deleteId">
        <p>¿Seguro que deseas eliminar este producto?</p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Eliminar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function showSection(section) {
    document.getElementById('dashboardSection').classList.add('hide');
    document.getElementById('almacenSection').classList.add('hide');
    document.getElementById('trabajadoresSection').classList.add('hide');
    document.getElementById('seguridadSection').classList.add('hide');
    document.getElementById(section + 'Section').classList.remove('hide');
    // Cambia la clase activa en el menú
    document.querySelectorAll('.sidebar .nav-link').forEach(function(link){
        link.classList.remove('active');
    });
    let menuMap = {
        'dashboard': 0,
        'almacen': 1,
        'trabajadores': 2,
        'seguridad': 3
    };
    document.querySelectorAll('.sidebar .nav-link')[menuMap[section]].classList.add('active');
}
function editarProducto(id, producto, precio, stock) {
    document.getElementById('editId').value = id;
    document.getElementById('editProducto').value = producto;
    document.getElementById('editPrecio').value = precio;
    document.getElementById('editStock').value = stock;
    var modal = new bootstrap.Modal(document.getElementById('modalEditar'));
    modal.show();
}
function eliminarProducto(id) {
    document.getElementById('deleteId').value = id;
    var modal = new bootstrap.Modal(document.getElementById('modalEliminar'));
    modal.show();
}
function changePage(page) {
    window.location.href = '?page=' + page + '&section=almacen';
}
window.onload = function() {
    const params = new URLSearchParams(window.location.search);
    const section = params.get('section') || 'dashboard';
    showSection(section);
};
</script>
</body>
</html>
