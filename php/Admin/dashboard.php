<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../../iniciodesesion.php');
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
        body {
            background: linear-gradient(135deg, #fbeee6 0%, #f6e7d8 100%) !important;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #7b2c2c 60%, #a33d3d 100%) !important;
            color: #fff;
            box-shadow: 2px 0 10px rgba(0,0,0,0.04);
        }
        .sidebar .logo {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    width: 100%;
}
.sidebar .logo h2 {
    width: 100%;
    text-align: center;
}
        .sidebar .logo img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 4px solid #fff;
            background: #fff;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .sidebar .logo h2 {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #fff;
            margin-top: 8px;
        }
        .sidebar .nav-link {
            color: #fff !important;
            font-weight: 500;
            margin: 8px 0;
            border-radius: 10px;
            transition: background 0.2s, color 0.2s;
            font-size: 1.08em;
            padding: 10px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar .nav-link i {
            font-size: 1.2em;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #fff2e6 !important;
            color: #a33d3d !important;
        }
        .content {
            padding: 2.5rem 2rem;
        }
        .card {
            border: none !important;
            border-radius: 18px !important;
            box-shadow: 0 4px 16px rgba(163,61,61,0.08);
            text-align: center;
            padding: 28px 18px;
            transition: transform 0.15s;
            background: #fff;
        }
        .card:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 8px 24px rgba(163,61,61,0.13);
        }
        .card-title {
            color: #a33d3d;
            font-weight: 600;
            font-size: 1.1em;
        }
        .card-text {
            font-size: 2.2em;
            font-weight: bold;
            color: #333;
        }
        .card .icon {
            font-size: 2.5em;
            color: #f6c453;
            margin-bottom: 10px;
        }
        .btn-primary, .btn-success, .btn-danger, .btn-secondary {
            border-radius: 8px !important;
            font-weight: 500;
            transition: box-shadow 0.2s;
        }
        .btn-primary:hover, .btn-success:hover, .btn-danger:hover, .btn-secondary:hover {
            box-shadow: 0 2px 8px rgba(163,61,61,0.13);
        }
        .table {
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            margin-top: 10px;
        }
        .table thead {
            background: #a33d3d;
            color: #fff;
            font-size: 1.05em;
        }
        .table tbody tr:nth-child(even) {
            background: #fbeee6;
        }
        .table tbody tr:hover {
            background: #f6c45344;
        }
        .pagination .page-item.active .page-link {
            background: #a33d3d;
            border-color: #a33d3d;
        }
        .pagination .page-link {
            color: #a33d3d;
        }
        .empleado-card .card {
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(163,61,61,0.07);
            transition: transform 0.15s, box-shadow 0.15s;
            background: #fff;
            margin-bottom: 18px;
        }
        .empleado-card .card:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 24px rgba(163,61,61,0.13);
        }
        .empleado-card img.card-img-top {
            border-radius: 50%;
            width: 110px;
            height: 110px;
            object-fit: cover;
            margin: 18px auto 0 auto;
            border: 4px solid #f6c453;
            background: #fff;
            box-shadow: 0 2px 8px rgba(163,61,61,0.10);
        }
        .empleado-card .card-title {
            color: #a33d3d;
            font-size: 1.15em;
            font-weight: bold;
            margin-top: 12px;
        }
        .empleado-card .card-text {
            color: #555;
            font-size: 1em;
        }
        .hide { display: none !important; }
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
                    <a class="nav-link" href="../../iniciodesesion.php">Cerrar Sesión</a>
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
                                <button class="btn btn-primary btn-sm" onclick="editarProducto(<?php echo $row['id']; ?>, '<?php echo $row['producto']; ?>', <?php echo $row['precio']; ?>, <?php echo $row['stock']; ?>, '<?php echo $row['categoria']; ?>')"> Editar </button>
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
    <div style="text-align: right; margin-bottom: 15px;">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarEmpleado" id="btnAgregarEmpleado">Agregar Empleado</button>
        <button class="btn btn-danger" id="btnEliminarEmpleado">Eliminar Empleado</button>
        <button class="btn btn-secondary hide" id="btnRegresar">Regresar</button>
    </div>


    <?php
        $empleados = mysqli_query($conn, "SELECT * FROM empleados");
    ?>

    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php while($emp = mysqli_fetch_assoc($empleados)): ?>
        <div class="col empleado-card">
        <div class="card h-100" style="position: relative;">
            <img src="../../trabajadores/<?php echo $emp['foto']; ?>" class="card-img-top" style="height:150px; object-fit:cover;">
            <div class="card-body empleado-info"
     data-id="<?php echo $emp['id']; ?>"
     data-nombre="<?php echo htmlspecialchars($emp['nombre'], ENT_QUOTES); ?>"
     data-numero="<?php echo $emp['numero_trabajador']; ?>"
     data-password="<?php echo htmlspecialchars($emp['contraseña'], ENT_QUOTES); ?>"
     data-descripcion="<?php echo htmlspecialchars($emp['descripcion'], ENT_QUOTES); ?>"
     data-foto="<?php echo $emp['foto']; ?>">
                <h5 class="card-title"><?php echo $emp['nombre']; ?></h5>
                <p class="card-text">N° Trabajador: <?php echo $emp['numero_trabajador']; ?></p>
                <p class="card-text"><?php echo $emp['descripcion']; ?></p>
            </div>
            <!-- Botón Eliminar oculto -->
            <form method="POST" action="empleado_accion.php" class="delete-form hide" style="position: absolute; top: 10px; right: 10px;">
                <input type="hidden" name="accion" value="eliminar">
                <input type="hidden" name="id" value="<?php echo $emp['id']; ?>">
                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
    <?php endwhile; ?>
        </div>
        <!-- Modal Eliminar Empleado -->
        <div class="modal fade" id="modalEliminarEmpleado" tabindex="-1">
          <div class="modal-dialog">
            <form class="modal-content" method="POST" action="empleado_accion.php">
              <div class="modal-header">
                <h5 class="modal-title">Eliminar Empleado</h5>
              </div>
              <div class="modal-body">
                <input type="hidden" name="accion" value="eliminar">
                <input type="hidden" name="id" id="deleteEmpId">
                <p>¿Seguro que deseas eliminar este empleado?</p>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              </div>
            </form>
          </div>
        </div>
        
        <!-- Modal para Editar Empleado -->
        <div class="modal fade" id="modalEmpleado" tabindex="-1">
          <div class="modal-dialog">
            <form class="modal-content" method="POST" action="empleado_accion.php" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title">Editar Empleado</h5>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" id="empId">
        
                <div class="mb-2">
                    <label>Nombre</label>
                    <input type="text" name="nombre" id="empNombre" class="form-control" required>
                </div>
        
                <div class="mb-2">
                    <label>N° Trabajador</label>
                    <input type="text" name="numero_trabajador" id="empNumero" class="form-control" required>
                </div>
        
                <div class="mb-2">
                    <label>Contraseña</label>
                    <div class="input-group">
                        <input type="password" name="contraseña" id="empPassword" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">👁️</button>
                    </div>
                </div>
        
                <div class="mb-2">
                    <label>Descripción</label>
                    <textarea name="descripcion" id="empDescripcion" class="form-control"></textarea>
                </div>
        
                <div class="mb-2">
                    <label>Foto actual</label><br>
                    <img id="empFotoPreview" src="" alt="Foto actual" style="max-width: 100px; margin-bottom:10px;">
                </div>
        
                <div class="mb-2">
                    <label>Foto nueva (opcional)</label>
                    <input type="file" name="foto" id="empFoto" class="form-control" accept="image/*">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              </div>
            </form>
          </div>
        </div>
                    
<!-- Modal Agregar Empleado -->
<div class="modal fade" id="modalAgregarEmpleado" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="empleado_accion.php" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Empleado</h5>
      </div>
      <div class="modal-body">
        <div class="mb-2">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>N° Trabajador</label>
            <input type="text" name="numero_trabajador" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Contraseña</label>
            <div class="input-group">
                <input type="password" name="contraseña" id="newEmpPassword" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary" onclick="toggleNewPassword()">👁️</button>
            </div>
        </div>
        <div class="mb-2">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>
        <div class="mb-2">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Agregar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>



<script>
function abrirModalEmpleado(id, nombre, numero, password, descripcion, foto) {
    document.getElementById('empId').value = id;
    document.getElementById('empNombre').value = nombre;
    document.getElementById('empNumero').value = numero;
    document.getElementById('empPassword').value = password;
    document.getElementById('empDescripcion').value = descripcion;

    document.getElementById('empFotoPreview').src = "../../trabajadores/" + foto;

    var modal = new bootstrap.Modal(document.getElementById('modalEmpleado'));
    modal.show();
}

function toggleNewPassword() {
    const passInput = document.getElementById('newEmpPassword');
    passInput.type = passInput.type === 'password' ? 'text' : 'password';
}


document.getElementById('togglePassword').addEventListener('click', function() {
    const passInput = document.getElementById('empPassword');
    passInput.type = passInput.type === 'password' ? 'text' : 'password';
});
</script>
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
    <form class="modal-content" method="POST" action="producto_accion.php" enctype="multipart/form-data">
      <div class="modal-header"><h5 class="modal-title">Agregar Producto</h5></div>
      <div class="modal-body">
        <input type="hidden" name="accion" value="agregar">
        <div class="mb-2"><input type="text" name="producto" class="form-control" placeholder="Producto" required></div>
<div class="mb-2"><input type="number" step="0.01" name="precio" class="form-control" placeholder="Precio" required></div>
<div class="mb-2"><input type="number" name="stock" class="form-control" placeholder="Stock" required></div>
<div class="mb-2">
    <label>Categoría</label>
    <select name="categoria" class="form-control" required>
        <option value="">Selecciona categoría</option>
        <option value="Arroces">Arroces</option>
        <option value="Platos fuertes">Platos fuertes</option>
        <option value="Entrantes">Entrantes</option>
        <option value="Fideos">Fideos</option>
        <option value="Mariscos">Mariscos</option>
        <option value="Sopas">Sopas</option>
        <option value="Vegetariano">Vegetariano</option>
        <option value="Platos especiales">Platos especiales</option>
    </select>
</div>
<div class="mb-2"><label for="imagen">Imagen</label><input type="file" name="imagen" id="imagen" class="form-control" accept="image/*"></div>

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
    <form class="modal-content" method="POST" action="producto_accion.php" enctype="multipart/form-data">
      <div class="modal-header"><h5 class="modal-title">Editar Producto</h5></div>
      <div class="modal-body">
        <input type="hidden" name="accion" value="editar">
        <input type="hidden" name="id" id="editId">
        <div class="mb-2"><input type="text" name="producto" id="editProducto" class="form-control" required></div>
<div class="mb-2"><input type="number" step="0.01" name="precio" id="editPrecio" class="form-control" required></div>
<div class="mb-2"><input type="number" name="stock" id="editStock" class="form-control" required></div>
<div class="mb-2">
    <label>Categoría</label>
    <select name="categoria" id="editCategoria" class="form-control" required>
        <option value="">Selecciona categoría</option>
        <option value="Arroces">Arroces</option>
        <option value="Platos fuertes">Platos fuertes</option>
        <option value="Entrantes">Entrantes</option>
        <option value="Fideos">Fideos</option>
        <option value="Mariscos">Mariscos</option>
        <option value="Sopas">Sopas</option>
        <option value="Vegetariano">Vegetariano</option>
        <option value="Platos especiales">Platos especiales</option>
    </select>
</div>
<div class="mb-2"><label for="editImagen">Imagen (opcional)</label><input type="file" name="imagen" id="editImagen" class="form-control" accept="image/*"></div>

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
function editarProducto(id, producto, precio, stock, categoria) {
    document.getElementById('editId').value = id;
    document.getElementById('editProducto').value = producto;
    document.getElementById('editPrecio').value = precio;
    document.getElementById('editStock').value = stock;
    document.getElementById('editCategoria').value = categoria;
    var modal = new bootstrap.Modal(document.getElementById('modalEditar'));
    modal.show();
}

function eliminarProducto(id) {
    document.getElementById('deleteId').value = id;
    var modal = new bootstrap.Modal(document.getElementById('modalEliminar'));
    modal.show();
}
function changePage(page) {
    const url = new URL(window.location.href);
    url.searchParams.set('page', page);
    window.history.pushState({}, '', url); // Cambia solo la URL sin recargar
    location.reload(); // recarga datos con el nuevo page
}
window.onload = function() {
    if (window.location.search.includes('page=')) {
        showSection('almacen');
    } else {
        showSection('dashboard');
    }
}
// Abre modal de eliminar empleado al hacer clic en su tarjeta
function abrirModalEliminarEmpleado(id) {
    document.getElementById('deleteEmpId').value = id;
    var modal = new bootstrap.Modal(document.getElementById('modalEliminarEmpleado'));
    modal.show();
}

// Modificar tarjetas de trabajadores para agregar botón de eliminar
document.querySelectorAll('#trabajadoresSection .card').forEach(function(card){
    var id = card.dataset.id; // toma el id desde data-id
    var botonEliminar = document.createElement('button');
    botonEliminar.className = 'btn btn-danger btn-sm mt-2';
    botonEliminar.innerText = 'Eliminar';
    botonEliminar.onclick = function(e) {
        e.stopPropagation(); // evita abrir modal de editar
        abrirModalEliminarEmpleado(id);
    };
    card.querySelector('.card-body').appendChild(botonEliminar);
});


const btnEliminarEmpleado = document.getElementById('btnEliminarEmpleado');
const btnAgregarEmpleado = document.getElementById('btnAgregarEmpleado');
const btnRegresar = document.getElementById('btnRegresar');
const deleteForms = document.querySelectorAll('.delete-form');
const empleadoCards = document.querySelectorAll('.empleado-card .card-body');

let modoEliminar = false;

btnEliminarEmpleado.addEventListener('click', () => {
    modoEliminar = true;
    // Ocultar Agregar, mostrar Regresar
    btnAgregarEmpleado.classList.add('hide');
    btnEliminarEmpleado.classList.add('hide');
    btnRegresar.classList.remove('hide');
    // Mostrar botones de eliminar
    deleteForms.forEach(f => f.classList.remove('hide'));
    // Bloquear apertura modal al dar clic en card
    empleadoCards.forEach(c => c.style.pointerEvents = "none");
});

btnRegresar.addEventListener('click', () => {
    modoEliminar = false;
    // Mostrar Agregar, ocultar Regresar
    btnAgregarEmpleado.classList.remove('hide');
    btnEliminarEmpleado.classList.remove('hide');
    btnRegresar.classList.add('hide');
    // Ocultar botones de eliminar
    deleteForms.forEach(f => f.classList.add('hide'));
    // Reactivar apertura modal
    empleadoCards.forEach(c => c.style.pointerEvents = "auto");
});
</script>
</body>
</html>
