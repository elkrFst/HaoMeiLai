<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajadores - Panel Admin</title>
    <link rel="stylesheet" href="../../css/Admin.css">
    <link rel="stylesheet" href="../../css/trabajadores.css">
     <script src="../js/trabajadores.js"></script>
    <!-- Google Fonts Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;500;400&display=swap" rel="stylesheet">
   
</head>
<body>
    <header class="header-admin">
        <div class="header-left">
            <img src="../../imagenes/logo comida.png" alt="Logo Hao Mei Lai" class="logo-header">
            <div class="nombre-header-block">
                <span class="nombre-header">Hao Mei Lai</span><br>
                <span class="subnombre-header">comida auténtica oriental</span>
            </div>
        </div>
        <div class="header-right" style="display:flex;align-items:center;gap:32px;padding-right:32px;">
            <!-- Botón regreso al panel admin -->
            <button class="icon-btn" title="Regresar al Panel Admin" onclick="location.href='indexadmin.php'" style="background:none;border:none;cursor:pointer;">
                <!-- Icono flecha regreso -->
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            </button>
            <button class="icon-btn" title="Notificaciones" style="background:none;border:none;cursor:pointer;">
                <!-- Icono campana -->
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            </button>
            <button class="icon-btn almacen-btn" title="Almacen" onclick="location.href='almacen.php'" style="background:none;border:none;cursor:pointer;">
                <!-- Icono caja (almacén) -->
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22" x2="12" y2="12"/></svg>
            </button>
            <div class="perfil-admin" style="display:flex;align-items:center;gap:10px;">
                <div class="perfil-img" style="width:40px;height:40px;background:#ddd;border-radius:50%;"></div>
                <span class="perfil-nombre" style="color:#fff;font-size:1.1em;">Administrador</span>
                <button class="icon-btn" title="Salir" onclick="location.href='../iniciodesesión.php'" style="background:none;border:none;cursor:pointer;">
                    <!-- Icono salida (logout) -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                </button>
            </div>
        </div>
    </header>
    <main>
    <section class="admin-dashboard-cards" style="display: flex; gap: 2rem; margin-top: 7rem; justify-content: center; align-items: center;">
        <div style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem 2rem; min-width: 220px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: 600; color: #333;">Trabajadores</span>
                <span style="color: #e74c3c; font-size: 1.2em;">👥</span>
            </div>
            <div style="font-size: 2em; font-weight: bold; margin: 0.5em 0; color: #222;" id="totalTrabajadores">0</div>
            <div style="color: #e74c3c; font-size: 0.95em;">Activos en el sistema</div>
        </div>
        <!-- Puedes agregar más tarjetas si lo deseas -->
    </section>
        <div class="trabajadores-lista">
            <h2>Trabajadores Actuales</h2>
            <!-- Aquí ya no va el botón de añadir trabajador -->
        </div>
        <!-- Botón fuera del contenedor que se reemplaza -->
        <button onclick="abrirModalNuevo()" style="background:#27ae60; color:#fff; border:none; border-radius:8px; padding:8px 18px; font-size:1em; margin:1.5em auto 2em auto; display:block; cursor:pointer;">+ Añadir trabajador</button>

        <!-- Modal para editar trabajador -->
        <div id="modalEditar" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.35); z-index:9999; align-items:center; justify-content:center;">
          <form id="formEditar" style="background:#fff; border-radius:12px; max-width:350px; width:90vw; padding:2rem; box-shadow:0 4px 24px rgba(0,0,0,0.18); display:flex; flex-direction:column; gap:1em; position:relative;">
            <button type="button" onclick="cerrarModal()" style="position:absolute; top:10px; right:10px; background:none; border:none; font-size:1.3em; color:#e74c3c; cursor:pointer;">×</button>
            <h3 style="margin:0 0 1em 0; color:#e74c3c;">Editar Trabajador</h3>
            <input type="hidden" id="editIndex">
            <label>Nombre: <input type="text" id="editNombre" required></label>
            <label>Puesto: <input type="text" id="editPuesto" required></label>
            <label>Teléfono: <input type="text" id="editTelefono"></label>
            <label>Correo: <input type="email" id="editCorreo"></label>
            <label>Turno: <input type="text" id="editTurno"></label>
            <label>Ingreso: <input type="date" id="editIngreso"></label>
            <label>Descripción: <textarea id="editDescripcion" rows="2"></textarea></label>
            <button type="submit" style="background:#e74c3c; color:#fff; border:none; border-radius:8px; padding:8px 0; font-size:1em; margin-top:0.5em;">Guardar Cambios</button>
          </form>
        </div>

        <!-- Modal para nuevo trabajador -->
        <div id="modalNuevo" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.35); z-index:9999; align-items:center; justify-content:center;">
          <form id="formNuevo" style="background:#fff; border-radius:12px; max-width:350px; width:90vw; padding:2rem; box-shadow:0 4px 24px rgba(0,0,0,0.18); display:flex; flex-direction:column; gap:1em; position:relative;">
            <button type="button" onclick="cerrarModalNuevo()" style="position:absolute; top:10px; right:10px; background:none; border:none; font-size:1.3em; color:#e74c3c; cursor:pointer;">×</button>
            <h3 style="margin:0 0 1em 0; color:#27ae60;">Nuevo Trabajador</h3>
            <label>Nombre: <input type="text" id="nuevoNombre" required></label>
            <label>Puesto: <input type="text" id="nuevoPuesto" required></label>
            <label>Teléfono: <input type="text" id="nuevoTelefono"></label>
            <label>Correo: <input type="email" id="nuevoCorreo"></label>
            <label>Turno: <input type="text" id="nuevoTurno"></label>
            <label>Ingreso: <input type="date" id="nuevoIngreso"></label>
            <label>Descripción: <textarea id="nuevoDescripcion" rows="2"></textarea></label>
            <label>Foto (URL): <input type="text" id="nuevoFoto" placeholder="../../imagenes/trabajadorX.jpg"></label>
            <button type="submit" style="background:#27ae60; color:#fff; border:none; border-radius:8px; padding:8px 0; font-size:1em; margin-top:0.5em;">Añadir</button>
          </form>
        </div>
    </main>
    <script>
const trabajadores = [
  {
    nombre: "pedro emiliano",
    puesto: "Cocinero",
    telefono: "555-123-4567",
    correo: "pedro.emiliano@haomeilai.com",
    turno: "Mañana",
    ingreso: "2022-03-12",
    descripcion: "Especialista en cocina oriental, responsable de la preparación de platos principales y control de calidad en cocina.",
    foto: "../../imagenes/pedro pendejo.jpg"
  },
  {
    nombre: "Ana Gómez",
    puesto: "Mesera",
    telefono: "555-987-6543",
    correo: "ana.gomez@haomeilai.com",
    turno: "Tarde",
    ingreso: "2023-07-05",
    descripcion: "Encargada de la atención al cliente en salón, toma de pedidos y servicio de mesas con excelente trato.",
    foto: "../../imagenes/trabajador2.jpg"
  },
  {
    nombre: "Luis Torres",
    puesto: "Repartidor",
    telefono: "555-222-3344",
    correo: "luis.torres@haomeilai.com",
    turno: "Noche",
    ingreso: "2024-01-20",
    descripcion: "Responsable de entregas a domicilio, atención al cliente externo y logística de rutas de reparto.",
    foto: "../../imagenes/trabajador3.jpg"
  },
  {
    nombre: "Luis Alfonso",
    puesto: "Repartidor",
    telefono: "555-333-4455",
    correo: "luis.alfonso@haomeilai.com",
    turno: "Mañana",
    ingreso: "2023-02-10",
    descripcion: "Apoyo en reparto y logística, cubre rutas alternas y ayuda en tareas generales del restaurante.",
    foto: "../../imagenes/trabajador4.jpg"
  }
];

function abrirModalEditar(index) {
  const t = trabajadores[index];
  document.getElementById('editIndex').value = index;
  document.getElementById('editNombre').value = t.nombre;
  document.getElementById('editPuesto').value = t.puesto;
  document.getElementById('editTelefono').value = t.telefono;
  document.getElementById('editCorreo').value = t.correo;
  document.getElementById('editTurno').value = t.turno;
  document.getElementById('editIngreso').value = t.ingreso;
  document.getElementById('editDescripcion').value = t.descripcion;
  document.getElementById('modalEditar').style.display = "flex";
}
function cerrarModal() {
  document.getElementById('modalEditar').style.display = "none";
}
document.getElementById('formEditar').onsubmit = function(e) {
  e.preventDefault();
  const i = document.getElementById('editIndex').value;
  trabajadores[i].nombre = document.getElementById('editNombre').value;
  trabajadores[i].puesto = document.getElementById('editPuesto').value;
  trabajadores[i].telefono = document.getElementById('editTelefono').value;
  trabajadores[i].correo = document.getElementById('editCorreo').value;
  trabajadores[i].turno = document.getElementById('editTurno').value;
  trabajadores[i].ingreso = document.getElementById('editIngreso').value;
  trabajadores[i].descripcion = document.getElementById('editDescripcion').value;
  renderTrabajadores();
  cerrarModal();
};

function abrirModalNuevo() {
  document.getElementById('formNuevo').reset();
  document.getElementById('modalNuevo').style.display = "flex";
}
function cerrarModalNuevo() {
  document.getElementById('modalNuevo').style.display = "none";
}
document.getElementById('formNuevo').onsubmit = function(e) {
  e.preventDefault();
  trabajadores.push({
    nombre: document.getElementById('nuevoNombre').value,
    puesto: document.getElementById('nuevoPuesto').value,
    telefono: document.getElementById('nuevoTelefono').value,
    correo: document.getElementById('nuevoCorreo').value,
    turno: document.getElementById('nuevoTurno').value,
    ingreso: document.getElementById('nuevoIngreso').value,
    descripcion: document.getElementById('nuevoDescripcion').value,
    foto: document.getElementById('nuevoFoto').value || "../../imagenes/trabajador1.jpg"
  });
  renderTrabajadores();
  cerrarModalNuevo();
};

function eliminarTrabajador(i) {
  if(confirm("¿Seguro que deseas eliminar este trabajador?")) {
    trabajadores.splice(i, 1);
    renderTrabajadores();
  }
}

// Renderizar trabajadores dinámicamente
function renderTrabajadores() {
  const cont = document.querySelector('.trabajadores-lista');
  cont.innerHTML = `<h2>Trabajadores Actuales</h2>` + trabajadores.map((t, i) => `
    <div class="trabajador-card">
      <img src="${t.foto}" alt="Foto ${t.nombre}" class="trabajador-foto">
      <div class="trabajador-info">
        <div class="trabajador-nombre">${t.nombre}</div>
        <div class="trabajador-puesto">${t.puesto}</div>
        <div class="trabajador-contacto">
          <span class="icon">📞</span> ${t.telefono} &nbsp; 
          <span class="icon">✉️</span> ${t.correo}
        </div>
        <div class="trabajador-extra">Turno: ${t.turno} | Ingreso: ${t.ingreso.split('-').reverse().join('/')}</div>
        <div class="trabajador-descripcion">${t.descripcion}</div>
      </div>
      <div class="trabajador-acciones">
        <button onclick="abrirModalEditar(${i})">Editar</button>
        <button onclick="eliminarTrabajador(${i})">Eliminar</button>
      </div>
    </div>
  `).join('');
  // Actualiza el total de trabajadores en la tarjeta
  document.getElementById('totalTrabajadores').textContent = trabajadores.length;
}
renderTrabajadores();
</script>
</body>
</html>