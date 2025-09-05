
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Almacén de Comida - Panel Admin</title>
    <link rel="stylesheet" href="../../css/Admin.css">
    <style>
        .almacen-table { width:100%; border-collapse:collapse; margin-top:2em; background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.07);}
        .almacen-table th, .almacen-table td { padding:12px 10px; border-bottom:1px solid #eee; text-align:left;}
        .almacen-table th { background:#e74c3c; color:#fff;}
        .almacen-table tr:last-child td { border-bottom:none;}
        .almacen-acciones button { margin-right:6px; }
        .almacen-header { display:flex; justify-content:space-between; align-items:center; margin-top:2em;}
        .almacen-header h2 { margin:0;}
        .almacen-btn { background:#27ae60; color:#fff; border:none; border-radius:8px; padding:8px 18px; font-size:1em; cursor:pointer;}
        .almacen-btn:active { background:#219150;}
        .modal { display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.25); z-index:9999; align-items:center; justify-content:center;}
        .modal form { background:#fff; border-radius:12px; max-width:350px; width:90vw; padding:2rem; box-shadow:0 4px 24px rgba(0,0,0,0.18); display:flex; flex-direction:column; gap:1em; position:relative;}
        .modal-close { position:absolute; top:10px; right:10px; background:none; border:none; font-size:1.3em; color:#e74c3c; cursor:pointer;}
    </style>
</head>
<body>
    <header class="header-admin">
        <div class="header-left">
            <img src="../../imagenes/logo comida.png" alt="Logo Hao Mei Lai" class="logo-header">
            <div class="nombre-header-block">
                <span class="nombre-header">Hao Mei Lai</span>
                <span class="subnombre-header">comida auténtica oriental</span>
            </div>
        </div>
        <div class="header-right">
            <button class="icon-btn" title="Panel Admin" onclick="location.href='indexadmin.php'">
                <!-- Icono casa -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </button>
            <button class="icon-btn" title="Trabajadores" onclick="location.href='trabajadores.php'">
                <!-- Icono personas -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </button>
            <div class="perfil-admin">
                <div class="perfil-img"></div>
                <span class="perfil-nombre">Administrador</span>
                <button class="icon-btn" title="Salir" onclick="location.href='../iniciodesesión.php'">
                    <!-- Icono salida (logout) -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                </button>
            </div>
        </div>
    </header>
    <main style="max-width:900px;margin:0 auto;">
        <div class="almacen-header">
            <h2>Almacén de Comida</h2>
            <button class="almacen-btn" onclick="abrirModalNuevo()">+ Añadir producto</button>
        </div>
        <table class="almacen-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="almacenBody"></tbody>
        </table>
    </main>
    <!-- Modal Nuevo -->
    <div class="modal" id="modalNuevo">
        <form id="formNuevo">
            <button type="button" class="modal-close" onclick="cerrarModalNuevo()">×</button>
            <h3 style="color:#27ae60;">Nuevo Producto</h3>
            <label>Producto: <input type="text" id="nuevoNombre" required></label>
            <label>Categoría: <input type="text" id="nuevoCategoria" required></label>
            <label>Cantidad: <input type="number" id="nuevoCantidad" min="0" required></label>
            <label>Unidad: <input type="text" id="nuevoUnidad" placeholder="kg, piezas, litros..." required></label>
            <label>Descripción: <textarea id="nuevoDescripcion" rows="2"></textarea></label>
            <button type="submit" class="almacen-btn" style="background:#27ae60;">Añadir</button>
        </form>
    </div>
    <!-- Modal Editar -->
    <div class="modal" id="modalEditar">
        <form id="formEditar">
            <button type="button" class="modal-close" onclick="cerrarModalEditar()">×</button>
            <h3 style="color:#e74c3c;">Editar Producto</h3>
            <input type="hidden" id="editIndex">
            <label>Producto: <input type="text" id="editNombre" required></label>
            <label>Categoría: <input type="text" id="editCategoria" required></label>
            <label>Cantidad: <input type="number" id="editCantidad" min="0" required></label>
            <label>Unidad: <input type="text" id="editUnidad" required></label>
            <label>Descripción: <textarea id="editDescripcion" rows="2"></textarea></label>
            <button type="submit" class="almacen-btn" style="background:#e74c3c;">Guardar</button>
        </form>
    </div>
    <script>
const almacen = [
    { nombre: "Arroz", categoria: "Granos", cantidad: 25, unidad: "kg", descripcion: "Arroz jazmín para platos principales." },
    { nombre: "Pollo", categoria: "Carnes", cantidad: 12, unidad: "kg", descripcion: "Pechuga y muslo de pollo fresco." },
    { nombre: "Aceite vegetal", categoria: "Aceites", cantidad: 8, unidad: "litros", descripcion: "Aceite para freír y cocinar." },
    { nombre: "Salsa de soya", categoria: "Salsas", cantidad: 5, unidad: "litros", descripcion: "Salsa de soya oscura para cocina oriental." },
    { nombre: "Wonton", categoria: "Congelados", cantidad: 120, unidad: "piezas", descripcion: "Wonton congelado para sopas y frituras." }
];

function renderAlmacen() {
    const tbody = document.getElementById('almacenBody');
    tbody.innerHTML = almacen.map((p, i) => `
        <tr>
            <td>${p.nombre}</td>
            <td>${p.categoria}</td>
            <td style="font-weight:bold;${p.cantidad<=5?'color:#e74c3c;':''}">${p.cantidad}</td>
            <td>${p.unidad}</td>
            <td>${p.descripcion}</td>
            <td class="almacen-acciones">
                <button onclick="abrirModalEditar(${i})" style="background:#f1c40f;color:#222;border:none;border-radius:6px;padding:4px 10px;cursor:pointer;">Editar</button>
                <button onclick="eliminarProducto(${i})" style="background:#e74c3c;color:#fff;border:none;border-radius:6px;padding:4px 10px;cursor:pointer;">Eliminar</button>
            </td>
        </tr>
    `).join('');
}
renderAlmacen();

// Modal Nuevo
function abrirModalNuevo() {
    document.getElementById('formNuevo').reset();
    document.getElementById('modalNuevo').style.display = "flex";
}
function cerrarModalNuevo() {
    document.getElementById('modalNuevo').style.display = "none";
}
document.getElementById('formNuevo').onsubmit = function(e) {
    e.preventDefault();
    almacen.push({
        nombre: document.getElementById('nuevoNombre').value,
        categoria: document.getElementById('nuevoCategoria').value,
        cantidad: parseInt(document.getElementById('nuevoCantidad').value),
        unidad: document.getElementById('nuevoUnidad').value,
        descripcion: document.getElementById('nuevoDescripcion').value
    });
    renderAlmacen();
    cerrarModalNuevo();
};

// Modal Editar
function abrirModalEditar(i) {
    const p = almacen[i];
    document.getElementById('editIndex').value = i;
    document.getElementById('editNombre').value = p.nombre;
    document.getElementById('editCategoria').value = p.categoria;
    document.getElementById('editCantidad').value = p.cantidad;
    document.getElementById('editUnidad').value = p.unidad;
    document.getElementById('editDescripcion').value = p.descripcion;
    document.getElementById('modalEditar').style.display = "flex";
}
function cerrarModalEditar() {
    document.getElementById('modalEditar').style.display = "none";
}
document.getElementById('formEditar').onsubmit = function(e) {
    e.preventDefault();
    const i = document.getElementById('editIndex').value;
    almacen[i] = {
        nombre: document.getElementById('editNombre').value,
        categoria: document.getElementById('editCategoria').value,
        cantidad: parseInt(document.getElementById('editCantidad').value),
        unidad: document.getElementById('editUnidad').value,
        descripcion: document.getElementById('editDescripcion').value
    };
    renderAlmacen();
    cerrarModalEditar();
};

// Eliminar
function eliminarProducto(i) {
    if(confirm("¿Seguro que deseas eliminar este producto del almacén?")) {
        almacen.splice(i, 1);
        renderAlmacen();
    }
}
    </script>
</body>
</html>