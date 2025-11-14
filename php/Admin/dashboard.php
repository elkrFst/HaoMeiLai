<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Deshabilitar el caché del navegador para esta página
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Verificar si la sesión no está activa o si el rol no es 'admin'
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    // Si no está logueado o no es admin, redirigir al login
    header("Location: /login");
    exit();
}

require_once '../../conexion.php';

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .seleccionable {
        cursor: pointer;
        border: 2px dashed red;
        }
        
        .seleccionada {
            background-color: rgba(255,0,0,0.1);
        }

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

    /* ======= ESTILOS MEJORADOS PARA TRABAJADORES ======= */
    .empleado-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .empleado-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.2) !important;
    }
    
    .empleado-card .card {
        overflow: hidden;
        height: 100%;
        position: relative;
    }
    
    .empleado-card img.empleado-foto { /* Usamos el selector de la clase 'empleado-foto' */
        border-radius: 50%;
        width: 110px;
        height: 110px;
        object-fit: cover;
        /* Ajustes clave para centrar y que fluya */
        display: block; /* Asegura que sea un elemento de bloque */
        margin: 18px auto 0 auto; /* Centra horizontalmente y añade margen superior */
        /* El resto de tus estilos */
        border: 4px solid #f6c453;
        background: #fff;
        box-shadow: 0 2px 8px rgba(163,61,61,0.10);
    }
    
    .empleado-foto:hover {
        transform: scale(1.05);
    }
    
    .empleado-info {
        padding: 15px;
        text-align: left;
    }
    
    .empleado-info h5 {
        color: #7b2c2c;
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 1.2rem;
    }
    
    .empleado-info .numero-trabajador {
        background: #7b2c2c;
        color: white;
        padding: 3px 8px;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: bold;
        display: inline-block;
        margin-bottom: 8px;
    }
    
    .empleado-info .descripcion {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.4;
        margin-bottom: 0;
    }
    
    .empleado-actions {
        position: absolute;
        bottom: 10px;
        right: 10px;
        display: flex;
        gap: 5px;
    }
    
    .btn-action {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        opacity: 0.9;
        transition: opacity 0.3s ease;
    }
    
    .btn-action:hover {
        opacity: 1;
    }
    
    /* Mejoras al modal */
    .modal-header {
        background-color: #7b2c2c;
        color: white;
        border-radius: 15px 15px 0 0;
    }
    
    .modal-content {
        border-radius: 15px;
        border: none;
        overflow: hidden;
    }
    
    .form-control:focus {
        border-color: #7b2c2c;
        box-shadow: 0 0 0 0.2rem rgba(123, 44, 44, 0.25);
    }
    
    .empleado-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .empleado-stats {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .stat-badge {
        background: #f8f9fa;
        padding: 8px 15px;
        border-radius: 20px;
        border-left: 4px solid #7b2c2c;
        font-size: 0.9rem;
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
                    <a class="nav-link" href="/cerrarsesion.php">Cerrar Sesión</a>
                </li>
            </ul>
        </nav>
        <main class="col-md-10 content">
            <!-- Dashboard -->
            <div id="dashboardSection">
                <h2>Dashboard Administrador</h2>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card text-center" onclick="location.href='/php/Admin/detalle_ventas.php'">
                            <div class="card-body">
                                <h5 class="card-title">Ventas</h5>
                                <p class="card-text fs-2"><?php echo $ventas; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center" onclick="location.href='/php/Admin/detalle_pedidos.php'">
                            <div class="card-body">
                                <h5 class="card-title">Pedidos</h5>
                                <p class="card-text fs-2"><?php echo $pedidos; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center" onclick="location.href='/php/Admin/detalle_clientes.php'">
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

            <!-- Trabajadores Mejorado -->
            <div id="trabajadoresSection" class="hide">
                <div class="empleado-header">
                    <h4><i class="fas fa-users me-2"></i>Gestión de Trabajadores</h4>
                    <div class="empleado-stats">
                        <?php 
                        $total_empleados = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM empleados"))[0];
                        ?>
                        <div class="stat-badge">
                            <i class="fas fa-user-tie me-1"></i>
                            Total: <?php echo $total_empleados; ?> empleados
                        </div>
                    </div>
                </div>
                
                <div style="text-align: right; margin-bottom: 25px;">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarEmpleado" id="btnAgregarEmpleado">
                        <i class="fas fa-user-plus me-2"></i>Agregar empleado
                    </button>
                    <button class="btn btn-secondary d-none" id="btnCancelarEliminar">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button class="btn btn-danger" id="btnEliminarEmpleado">
                        <i class="fas fa-user-minus me-2"></i>Eliminar empleado
                    </button>
                </div>

                <?php
                    $empleados = mysqli_query($conn, "SELECT * FROM empleados");
                ?>

                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                <?php while($emp = mysqli_fetch_assoc($empleados)): ?>
                    <div class="col empleado-card">
                        <div class="card h-100">
                            <!-- Foto clickeable -->
                            <div style="position: relative;">
                                <img src="../../trabajadores/<?php echo $emp['foto']; ?>" 
                                     class="empleado-foto"
                                     alt="Foto de <?php echo $emp['nombre']; ?>"
                                     onclick="abrirModalEmpleado(
                                         <?php echo $emp['id']; ?>, 
                                         '<?php echo htmlspecialchars($emp['nombre'], ENT_QUOTES); ?>', 
                                         '<?php echo $emp['numero_trabajador']; ?>', 
                                         '<?php echo htmlspecialchars($emp['contraseña'], ENT_QUOTES); ?>', 
                                         '<?php echo htmlspecialchars($emp['descripcion'], ENT_QUOTES); ?>', 
                                         '<?php echo $emp['foto']; ?>')">
                            </div>
                            
                            <!-- Información del empleado -->
                            <div class="empleado-info"
                                 data-id="<?php echo $emp['id']; ?>"
                                 data-nombre="<?php echo htmlspecialchars($emp['nombre'], ENT_QUOTES); ?>"
                                 data-numero="<?php echo $emp['numero_trabajador']; ?>"
                                 data-password="<?php echo htmlspecialchars($emp['contraseña'], ENT_QUOTES); ?>"
                                 data-descripcion="<?php echo htmlspecialchars($emp['descripcion'], ENT_QUOTES); ?>"
                                 data-foto="<?php echo $emp['foto']; ?>">
                                
                                <h5 class="card-title"><?php echo $emp['nombre']; ?></h5>
                                <span class="numero-trabajador">
                                    <i class="fas fa-id-badge me-1"></i>N° <?php echo $emp['numero_trabajador']; ?>
                                </span>
                                <p class="descripcion"><?php echo $emp['descripcion'] ? $emp['descripcion'] : 'Sin descripción disponible'; ?></p>
                            </div>
                            
                            <!-- Botones de acción -->
                            <div class="empleado-actions">
                                <button class="btn btn-primary btn-action" 
                                        onclick="abrirModalEmpleado(
                                            <?php echo $emp['id']; ?>, 
                                            '<?php echo htmlspecialchars($emp['nombre'], ENT_QUOTES); ?>', 
                                            '<?php echo $emp['numero_trabajador']; ?>', 
                                            '<?php echo htmlspecialchars($emp['contraseña'], ENT_QUOTES); ?>', 
                                            '<?php echo htmlspecialchars($emp['descripcion'], ENT_QUOTES); ?>', 
                                            '<?php echo $emp['foto']; ?>')"
                                        title="Editar empleado">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                            
                            <!-- Formulario de eliminación oculto -->
                            <form method="POST" action="/php/Admin/empleado_accion.php" class="delete-form hide" style="position: absolute; top: 10px; right: 10px;">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="hidden" name="id" value="<?php echo $emp['id']; ?>">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
                
                <!-- Modal Eliminar Empleado -->
                <div class="modal fade" id="modalEliminarEmpleado" tabindex="-1">
                  <div class="modal-dialog">
                    <form class="modal-content" method="POST" action="/php/Admin/empleado_accion.php">
                      <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Eliminar Empleado</h5>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="accion" value="eliminar">
                        <input type="hidden" name="id" id="deleteEmpId">
                        <div class="text-center">
                            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem; margin-bottom: 15px;"></i>
                            <p class="fs-5">¿Estás seguro que deseas eliminar este empleado?</p>
                            <p class="text-muted">Esta acción no se puede deshacer.</p>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>Eliminar
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
                
                <!-- Modal para Editar Empleado -->
                <div class="modal fade" id="modalEmpleado" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <form class="modal-content" method="POST" action="/php/Admin/empleado_accion.php" enctype="multipart/form-data">
                      <div class="modal-body">
                        <input type="hidden" name="accion" value="editar">
                        <input type="hidden" name="id" id="empId">
                        
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Foto actual</label>
                                    <div>
                                        <img id="empFotoPreview" src="" alt="Foto actual" 
                                             style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px; border: 3px solid #7b2c2c;">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Cambiar foto</label>
                                    <input type="file" name="foto" id="empFoto" class="form-control" accept="image/*" onchange="previewImage(this, 'empFotoPreview')">
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user me-2"></i>Nombre completo
                                    </label>
                                    <input type="text" name="nombre" id="empNombre" class="form-control" required>
                                </div>
                        
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-id-badge me-2"></i>Número de trabajador
                                    </label>
                                    <input type="text" name="numero_trabajador" id="empNumero" class="form-control" required pattern="[0-9]{5}">
                                    <span id="empNumeroError" class="text-danger"></span>
                                </div>
                        
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-lock me-2"></i>Contraseña
                                    </label>
                                    <div class="input-group">
                                        <input type="password" name="contraseña" id="empPassword" class="form-control" required>
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                        
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-comment me-2"></i>Descripción / Puesto
                                    </label>
                                    <textarea name="descripcion" id="empDescripcion" class="form-control" rows="3" 
                                              placeholder="Ej: Mesero con 2 años de experiencia..."></textarea>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Guardar cambios
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
                        
                <!-- Modal Agregar Empleado -->
                <div class="modal fade" id="modalAgregarEmpleado" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <form class="modal-content" method="POST" action="/php/Admin/empleado_accion.php" enctype="multipart/form-data">
                      <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Agregar Nuevo Empleado</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="accion" value="agregar">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Vista previa</label>
                                    <div>
                                        <img id="newEmpFotoPreview" src="../../trabajadores/default-user.png" alt="Vista previa" 
                                             style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px; border: 3px solid #7b2c2c;">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Foto del empleado *</label>
                                    <input type="file" name="foto" class="form-control" accept="image/*" required onchange="previewImage(this, 'newEmpFotoPreview')">
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user me-2"></i>Nombre completo *
                                    </label>
                                    <input type="text" name="nombre" class="form-control" required placeholder="Ej: Juan Pérez García">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-id-badge me-2"></i>Número de trabajador *
                                    </label>
                                    <input type="text" name="numero_trabajador" id="newEmpNumero" class="form-control" required pattern="[0-9]{5}" placeholder="Ej: 12345">
                                    <span id="newEmpNumeroError" class="text-danger"></span>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-lock me-2"></i>Contraseña *
                                    </label>
                                    <div class="input-group">
                                        <input type="password" name="contraseña" id="newEmpPassword" class="form-control" required>
                                        <button type="button" class="btn btn-outline-secondary" onclick="toggleNewPassword()">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-comment me-2"></i>Descripción / Puesto
                                    </label>
                                    <textarea name="descripcion" class="form-control" rows="3" 
                                              placeholder="Describe el puesto o responsabilidades del empleado..."></textarea>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-user-plus me-2"></i>Agregar empleado
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
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
    <form class="modal-content" method="POST" action="/php/Admin/producto_accion.php" enctype="multipart/form-data">
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
    <form class="modal-content" method="POST" action="/php/Admin/producto_accion.php" enctype="multipart/form-data">
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
    <form class="modal-content" method="POST" action="/php/Admin/producto_accion.php">
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
    window.history.pushState({}, '', url);
    location.reload();
}

window.onload = function() {
    // Verificar si venimos de una acción de empleado
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('empleado_action') || window.location.hash === '#trabajadores') {
        showSection('trabajadores');
    } else if (window.location.search.includes('page=')) {
        showSection('almacen');
    } else {
        showSection('dashboard');
    }
}

// Función mejorada para abrir modal de empleado
function abrirModalEmpleado(id, nombre, numero, password, descripcion, foto) {
    document.getElementById('empId').value = id;
    document.getElementById('empNombre').value = nombre;
    document.getElementById('empNumero').value = numero;
    document.getElementById('empPassword').value = password;
    document.getElementById('empDescripcion').value = descripcion;
    document.getElementById('empFotoPreview').src = "../../trabajadores/" + foto;

    // Limpia cualquier error anterior al abrir el modal
    document.getElementById('empNumeroError').textContent = '';
    document.getElementById('empNumero').classList.remove('is-invalid');

    var modal = new bootstrap.Modal(document.getElementById('modalEmpleado'));
    modal.show();
}

// Función para preview de imagen
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function toggleNewPassword() {
    const passInput = document.getElementById('newEmpPassword');
    const icon = passInput.parentElement.querySelector('i');
    
    if (passInput.type === 'password') {
        passInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const btnAgregar = document.getElementById("btnAgregarEmpleado");
    const btnCancelar = document.getElementById("btnCancelarEliminar");
    const btnEliminar = document.getElementById("btnEliminarEmpleado");
    const tarjetas = document.querySelectorAll(".empleado-card"); 

    let modoEliminar = false;

    // Toggle password visibility para editar
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passInput = document.getElementById('empPassword');
        const icon = this.querySelector('i');
        
        if (passInput.type === 'password') {
            passInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    btnEliminar.addEventListener("click", function() {
        modoEliminar = true;

        btnAgregar.classList.add("d-none");
        btnEliminar.classList.add("d-none");
        btnCancelar.classList.remove("d-none");

        tarjetas.forEach(card => {
            card.classList.add("seleccionable");
            card.addEventListener("click", seleccionarTarjeta);
        });
    });

    btnCancelar.addEventListener("click", function() {
        modoEliminar = false;

        btnAgregar.classList.remove("d-none");
        btnEliminar.classList.remove("d-none");
        btnCancelar.classList.add("d-none");

        tarjetas.forEach(card => {
            card.classList.remove("seleccionable");
            card.classList.remove("seleccionada");
            card.removeEventListener("click", seleccionarTarjeta);
        });
    });

    function seleccionarTarjeta(e) {
        // Solo actuar si estamos en modo eliminar y no se hizo clic en la foto
        if (!modoEliminar || e.target.classList.contains('empleado-foto')) return;
        
        const card = e.currentTarget;
        card.classList.toggle("seleccionada");

        if (card.classList.contains("seleccionada")) {
            const id = card.querySelector(".empleado-info").dataset.id;
            document.getElementById('deleteEmpId').value = id;
            var modal = new bootstrap.Modal(document.getElementById('modalEliminarEmpleado'));
            modal.show();
            
            // Remover selección después de mostrar modal
            card.classList.remove("seleccionada");
        }
    }

    // Función central que valida y muestra el mensaje
    function validarNumero(inputId, errorId) {
        const input = document.getElementById(inputId);
        const errorSpan = document.getElementById(errorId);
        const numero = input.value.trim();
        let esValido = true;
        let errores = [];

        // Limpiar estilos y mensajes previos
        errorSpan.textContent = '';
        input.classList.remove('is-invalid');

        // 1. Validar que solo contenga dígitos (no letras, ni caracteres especiales)
        if (!/^\d+$/.test(numero)) {
            errores.push('Solo se permiten dígitos (0-9).');
            esValido = false;
        }

        // 2. Validar que la longitud sea exactamente 5
        if (numero.length !== 5) {
            errores.push('Debe tener exactamente 5 dígitos.');
            esValido = false;
        }

        if (!esValido) {
            // Unir y mostrar el mensaje final
            errorSpan.innerHTML = `⚠️ El número de trabajador es incorrecto:<br>- ${errores.join('<br>- ')}`;
            input.classList.add('is-invalid');
        }

        return esValido;
    }

    // Event listener para el formulario de editar empleado
    document.getElementById('modalEmpleado').querySelector('form').addEventListener('submit', function(event) {
        // Asegúrate de validar antes de enviar
        if (!validarNumero('empNumero', 'empNumeroError')) {
            event.preventDefault(); // Evita que se envíe el formulario si hay un error
        }
    });

    // Event listener para el formulario de agregar empleado
    document.getElementById('modalAgregarEmpleado').querySelector('form').addEventListener('submit', function(event) {
        // Asegúrate de validar antes de enviar
        if (!validarNumero('newEmpNumero', 'newEmpNumeroError')) {
            event.preventDefault(); // Evita que se envíe el formulario si hay un error
        }
    });

    // Adicional: Opcionalmente, puedes validar en tiempo real mientras el usuario escribe
    document.getElementById('empNumero').addEventListener('input', () => validarNumero('empNumero', 'empNumeroError'));
    document.getElementById('newEmpNumero').addEventListener('input', () => validarNumero('newEmpNumero', 'newEmpNumeroError'));
});
</script>
</body>
</html>