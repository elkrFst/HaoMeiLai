<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Almacén de Productos | Hao Mei Lai</title>
    <link rel="stylesheet" href="../../css/Admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --rojo: #d62828;
            --rojo-oscuro: #b3000f;
            --dorado: #f1d48f; /* dorado suave */
            --dorado-oscuro: #e6b800; /* dorado secundario */
            --beige: #f5e6c8; /* beige cálido sidebar */
            --gris-claro: #f7f7f7;
            --gris-oscuro: #333333;
            --jade: #4caf93;
            --blanco: #fff;
        }
        body {
            background: var(--blanco);
            color: var(--gris-oscuro);
            font-family: 'Calibri', Arial, sans-serif;
            margin: 0;
        }
        .almacen-container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            background: var(--beige);
            width: 260px;
            padding: 32px 0 0 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 2px 0 16px rgba(0,0,0,0.08);
            border-right: 2px solid var(--gris-claro);
        }
        .sidebar .logo {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 40px;
            margin-left: 18px;
        }
        .sidebar .logo img {
            height: 64px;
            width: 64px;
            border-radius: 50%;
            border: 3px solid var(--rojo);
            background: var(--blanco);
            box-shadow: 0 2px 8px rgba(225,6,19,0.12);
        }
        .sidebar .logo span {
            font-size: 2rem;
            font-weight: bold;
            color: var(--rojo);
            letter-spacing: 2px;
            text-shadow: 1px 1px 8px var(--dorado);
        }
        .sidebar nav {
            width: 100%;
        }
        .sidebar nav a {
            display: flex;
            align-items: center;
            gap: 14px;
            color: var(--gris-oscuro);
            text-decoration: none;
            font-size: 1.08rem;
            padding: 14px 36px;
            border-radius: 10px 0 0 10px;
            margin-bottom: 10px;
            transition: background 0.2s, color 0.2s;
            font-weight: 500;
            position: relative;
        }
        .sidebar nav a.active, .sidebar nav a:hover {
            background: var(--blanco);
            color: var(--rojo);
            box-shadow: 2px 4px 16px rgba(214,40,40,0.10);
        }
        .main-content {
            flex: 1;
            padding: 48px 60px;
            background: linear-gradient(135deg, var(--blanco) 70%, var(--beige) 100%);
            min-height: 100vh;
        }
        .almacen-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 38px;
        }
        .almacen-header h1 {
            color: var(--rojo);
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0;
            letter-spacing: 2px;
            text-shadow: 1px 1px 8px var(--dorado);
        }
        .search-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--blanco);
            border-radius: 24px;
            padding: 10px 22px;
            border: 1px solid var(--dorado);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .search-bar input {
            border: none;
            background: transparent;
            font-size: 1.08rem;
            outline: none;
            color: var(--gris-oscuro);
            width: 140px;
        }
        .search-bar .icon {
            font-size: 1.2rem;
            color: var(--dorado-oscuro);
        }
        .user-icon {
            background: var(--blanco);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: var(--rojo);
            margin-left: 22px;
            border: 2px solid var(--dorado);
            box-shadow: 0 2px 8px rgba(214,40,40,0.10);
        }
        .almacen-title {
            font-size: 1.35rem;
            color: var(--gris-oscuro);
            font-weight: bold;
            margin-bottom: 28px;
            letter-spacing: 1px;
            text-shadow: 1px 1px 6px var(--blanco);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
            box-shadow: 0 2px 8px #1112;
        }
        .add-product-btn:hover {
            background: var(--dorado-oscuro);
            color: var(--gris-oscuro);
            border: 2px solid var(--rojo);
        }
        /* ...resto de estilos... */
        #almacen-table {
            border-collapse: separate !important;
            border-spacing: 0;
            font-size: 1em;
        }
        #almacen-table th, #almacen-table td {
            padding: 14px 18px;
            text-align: left;
            border-right: 1.5px solid #f1d48f;
        }
        #almacen-table th {
            background: var(--dorado);
            color: var(--gris-oscuro);
            font-weight: bold;
            border-bottom: 2.5px solid #e6b800;
            font-size: 1.08rem;
            letter-spacing: 1px;
        }
        #almacen-table td {
            color: var(--gris-oscuro);
            font-size: 1.05rem;
            border-bottom: 1.5px solid #f5e6c8;
        }
        #almacen-table tr {
            transition: background 0.2s;
        }
        #almacen-table tr:nth-child(even) {
            background: #f7f7f7;
        }
        #almacen-table tr:nth-child(odd) {
            background: #fff;
        }
        #almacen-table tr:hover {
            background: #fffbe6;
            box-shadow: 0 2px 12px rgba(214,40,40,0.08);
        }
        /* --- TRABAJADORES --- */
        .trabajadores-lista {
            margin: 2rem auto;
            max-width: 900px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 2rem 2.5rem;
        }
        .trabajadores-lista h2 {
            color: var(--rojo);
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 2rem;
            text-align: left;
        }
        .trabajador-card {
            display: flex;
            align-items: flex-start;
            gap: 28px;
            background: var(--gris-claro);
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(214,40,40,0.07);
            margin-bottom: 2rem;
            padding: 1.5rem 1.2rem;
            transition: box-shadow 0.2s;
        }
        .trabajador-card:hover {
            box-shadow: 0 4px 18px rgba(214,40,40,0.13);
        }
        .trabajador-foto {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid var(--dorado);
            box-shadow: 0 2px 8px rgba(214,40,40,0.10);
            background: #fff;
        }
        .trabajador-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .trabajador-nombre {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--rojo);
            margin-bottom: 2px;
        }
        .trabajador-puesto {
            font-size: 1.08rem;
            color: var(--gris-oscuro);
            font-weight: 500;
        }
        .trabajador-contacto {
            font-size: 0.98rem;
            color: #444;
            margin-bottom: 2px;
        }
        .trabajador-extra {
            font-size: 0.95rem;
            color: var(--dorado-oscuro);
        }
        .trabajador-descripcion {
            font-size: 0.98rem;
            color: var(--gris-oscuro);
            margin-top: 4px;
        }
        .trabajador-acciones {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: flex-end;
        }
        .trabajador-acciones button {
            background: var(--rojo);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 18px;
            font-size: 1em;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(214,40,40,0.10);
            transition: background 0.2s;
        }
        .trabajador-acciones button:hover {
            background: var(--dorado-oscuro);
            color: var(--gris-oscuro);
        }
        @media (max-width: 700px) {
            .trabajadores-lista {
                padding: 1rem 0.5rem;
            }
            .trabajador-card {
                flex-direction: column;
                align-items: center;
                gap: 16px;
            }
            .trabajador-acciones {
                flex-direction: row;
                gap: 10px;
                align-items: center;
            }
        }
    </style>
</head>
<body>
<div class="almacen-container">
    <aside class="sidebar">
        <div class="logo">
            <img src="../../imagenes/logo comida.png" alt="Logo Hao Mei Lai">
            <span>HAO MEI LAI</span>
        </div>
        <nav>
            <a href="#" id="dashboard-link" class="active"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            <a href="#" id="productos-link"><i class="fa-solid fa-box"></i> Productos</a>
            <a href="#" id="trabajadores-link"><i class="fa-solid fa-users"></i> Trabajadores</a>
            <a href="../iniciodesesión.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
        </nav>
    </aside>
    <main class="main-content">
                <!-- SECCIÓN TRABAJADORES -->
                <section id="trabajadores-section" style="display:none;">
                        <div class="admin-dashboard-cards" style="display: flex; gap: 2rem; margin-top: 7rem; justify-content: center; align-items: center;">
                                <div style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem 2rem; min-width: 220px;">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <span style="font-weight: 600; color: #333;">Trabajadores</span>
                                                <span style="color: #e74c3c; font-size: 1.2em;">👥</span>
                                        </div>
                                        <div style="font-size: 2em; font-weight: bold; margin: 0.5em 0; color: #222;" id="totalTrabajadores">0</div>
                                        <div style="color: #e74c3c; font-size: 0.95em;">Activos en el sistema</div>
                                </div>
                        </div>
                        <div class="trabajadores-lista">
                                <h2>Trabajadores Actuales</h2>
                        </div>
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
                </section>
        <!-- INICIO DASHBOARD VISUAL -->
        <section id="dashboard-section">
            <!-- Aquí va TODO el contenido del dashboard visual original -->
            <div class="admin-dashboard-cards" style="display: flex; gap: 2rem; margin-top: 2rem; justify-content: center; align-items: center;">
                <!-- ...copiado igual que antes... -->
                <a href="dashboard_detalle.php?card=ventas" style="text-decoration:none;">
                    <div style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem 2rem; min-width: 220px; cursor:pointer; transition:box-shadow 0.2s;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-weight: 600; color: #333;">Ventas Hoy</span>
                            <span class="ventas-hoy" style="color: #27ae60; font-size: 1.2em;">$</span>
                        </div>
                        <div style="font-size: 2em; font-weight: bold; margin: 0.5em 0; color: #222;">$2,847</div>
                        <div style="color: #27ae60; font-size: 0.95em;">↗ +12% desde ayer</div>
                    </div>
                </a>
                <a href="dashboard_detalle.php?card=pedidos" style="text-decoration:none;">
                    <div style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem 2rem; min-width: 220px; cursor:pointer; transition:box-shadow 0.2s;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-weight: 600; color: #333;">Pedidos Hoy</span>
                            <span style="color: #3f51b5; font-size: 1.2em;">&#128722;</span>
                        </div>
                        <div style="font-size: 2em; font-weight: bold; margin: 0.5em 0; color: #222;">147</div>
                        <div style="color: #3f51b5; font-size: 0.95em;">🕒 8 en preparación</div>
                    </div>
                </a>
                <a href="dashboard_detalle.php?card=clientes" style="text-decoration:none;">
                    <div style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem 2rem; min-width: 220px; cursor:pointer; transition:box-shadow 0.2s;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-weight: 600; color: #333;">Clientes Atendidos</span>
                            <span style="color: #a259e6; font-size: 1.2em;">&#128101;</span>
                        </div>
                        <div style="font-size: 2em; font-weight: bold; margin: 0.5em 0; color: #222;">89</div>
                        <div style="color: #a259e6; font-size: 0.95em;">⭐ 4.8 rating promedio</div>
                    </div>
                </a>
            </div>
            <div class="admin-dashboard-visual" style="display: flex; flex-wrap: wrap; gap: 2rem; margin: 2rem 0; justify-content: center;">
                <!-- ...resto del dashboard visual igual que antes... -->
                <!-- (copiado igual que el original) -->
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // --- TRABAJADORES JS ---
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
                function renderTrabajadores() {
                    const cont = document.querySelector('.trabajadores-lista');
                    cont.innerHTML = `<h2>Trabajadores Actuales</h2>` + trabajadores.map((t, i) => `
                        <div class=\"trabajador-card\">
                            <img src=\"${t.foto}\" alt=\"Foto ${t.nombre}\" class=\"trabajador-foto\">
                            <div class=\"trabajador-info\">
                                <div class=\"trabajador-nombre\">${t.nombre}</div>
                                <div class=\"trabajador-puesto\">${t.puesto}</div>
                                <div class=\"trabajador-contacto\">
                                    <span class=\"icon\">📞</span> ${t.telefono} &nbsp; 
                                    <span class=\"icon\">✉️</span> ${t.correo}
                                </div>
                                <div class=\"trabajador-extra\">Turno: ${t.turno} | Ingreso: ${(t.ingreso||'').split('-').reverse().join('/')}</div>
                                <div class=\"trabajador-descripcion\">${t.descripcion}</div>
                            </div>
                            <div class=\"trabajador-acciones\">
                                <button onclick=\"abrirModalEditar(${i})\">Editar</button>
                                <button onclick=\"eliminarTrabajador(${i})\">Eliminar</button>
                            </div>
                        </div>
                    `).join('');
                    document.getElementById('totalTrabajadores').textContent = trabajadores.length;
                }
                // Mostrar trabajadores al hacer clic en el menú
                function marcarSoloActivo(id) {
                    document.getElementById('dashboard-link').classList.remove('active');
                    document.getElementById('productos-link').classList.remove('active');
                    document.getElementById('trabajadores-link').classList.remove('active');
                    if (id) document.getElementById(id).classList.add('active');
                }
                document.getElementById('dashboard-link').addEventListener('click', function(e) {
                    e.preventDefault();
                    document.getElementById('dashboard-section').style.display = '';
                    document.getElementById('almacen-section').style.display = 'none';
                    document.getElementById('trabajadores-section').style.display = 'none';
                    marcarSoloActivo('dashboard-link');
                });
                document.getElementById('productos-link').addEventListener('click', function(e) {
                    e.preventDefault();
                    document.getElementById('dashboard-section').style.display = 'none';
                    document.getElementById('almacen-section').style.display = '';
                    document.getElementById('trabajadores-section').style.display = 'none';
                    marcarSoloActivo('productos-link');
                });
                document.getElementById('trabajadores-link').addEventListener('click', function(e) {
                    e.preventDefault();
                    document.getElementById('dashboard-section').style.display = 'none';
                    document.getElementById('almacen-section').style.display = 'none';
                    document.getElementById('trabajadores-section').style.display = '';
                    marcarSoloActivo('trabajadores-link');
                    renderTrabajadores();
                });
                // Gráfica de barras Ventas de la Semana
                const ctxVentas = document.getElementById('ventasSemana').getContext('2d');
                new Chart(ctxVentas, {
                    type: 'bar',
                    data: {
                        labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                        datasets: [{
                            label: 'Ventas',
                            data: [3200, 4100, 5400, 5000, 8700, 9500, 10200],
                            backgroundColor: '#e74c3c',
                            borderRadius: 6
                        }]
                    },
                    options: {
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true } }
                    }
                });
                // Gráfica de donas Platos Populares
                const ctxPlatos = document.getElementById('platosPopulares').getContext('2d');
                new Chart(ctxPlatos, {
                    type: 'doughnut',
                    data: {
                        labels: ['Pollo Agridulce', 'Chop Suey', 'Arroz Frito', 'Wonton'],
                        datasets: [{
                            data: [45, 38, 32, 28],
                            backgroundColor: ['#e74c3c', '#e67e22', '#f1c40f', '#d35400']
                        }]
                    },
                    options: {
                        plugins: { legend: { display: false } }
                    }
                });
            </script>
        </section>
        <!-- SECCIÓN ALMACÉN (PRODUCTOS) -->
        <section id="almacen-section" style="display:none;">
            <div class="almacen-header" style="background:#fff; border-radius:16px; box-shadow:0 2px 8px rgba(0,0,0,0.05); padding:1.5rem 2rem; margin-bottom:2rem; display:flex; align-items:center; justify-content:space-between;">
                <h1 style="color:var(--rojo); font-size:2.2rem; font-weight:bold; margin:0; letter-spacing:2px; text-shadow:1px 1px 8px var(--dorado);">Almacén de Productos</h1>
                <div class="search-bar">
                    <input type="text" id="busquedaProducto" placeholder="Buscar producto...">
                    <span class="icon"><i class="fa fa-search"></i></span>
                </div>
                <button class="add-product-btn" style="background:var(--dorado); color:var(--rojo); border:none; border-radius:8px; padding:10px 22px; font-weight:bold; font-size:1.08rem; box-shadow:0 2px 8px #1112; cursor:pointer;">+ Agregar Producto</button>
            </div>
            <div class="almacen-title" style="font-size:1.35rem; color:var(--gris-oscuro); font-weight:bold; margin-bottom:28px; letter-spacing:1px; text-shadow:1px 1px 6px var(--blanco); display:flex; align-items:center; justify-content:space-between;">Stock Actual</div>
            <div id="almacen-table-container" style="background:#fff; border-radius:16px; box-shadow:0 2px 8px #1112; padding:1.5rem;">
                <table id="almacen-table" style="width:100%; border-collapse:collapse; font-size:1em;">
                    <thead>
                        <tr style="color:#888; text-align:left;">
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Los productos se renderizan aquí con JS -->
                    </tbody>
                </table>
                <div id="almacen-pagination" style="margin-top:1.5rem; display:flex; justify-content:center; gap:8px;"></div>
            </div>
            <script>
            // Datos de ejemplo (puedes reemplazar por datos reales de PHP)
            const productos = [
                {id:'001', nombre:'Pollo Agridulce', categoria:'Plato Fuerte', stock:32, precio:120},
                {id:'002', nombre:'Chop Suey', categoria:'Plato Fuerte', stock:18, precio:95},
                {id:'003', nombre:'Wonton', categoria:'Entrada', stock:40, precio:60},
                {id:'004', nombre:'Arroz Frito', categoria:'Guarnición', stock:25, precio:50},
                {id:'005', nombre:'Rollitos Primavera', categoria:'Entrada', stock:30, precio:45},
                {id:'006', nombre:'Mapo Tofu', categoria:'Plato Fuerte', stock:15, precio:110},
                {id:'007', nombre:'Dumplings', categoria:'Entrada', stock:22, precio:70},
                {id:'008', nombre:'Chow Mein', categoria:'Plato Fuerte', stock:28, precio:105},
                {id:'009', nombre:'Cerdo Agridulce', categoria:'Plato Fuerte', stock:20, precio:125},
                {id:'010', nombre:'Sopa Wonton', categoria:'Sopa', stock:17, precio:80},
                {id:'011', nombre:'Pollo Gongbao', categoria:'Plato Fuerte', stock:19, precio:115},
                {id:'012', nombre:'Té Verde', categoria:'Bebida', stock:50, precio:35},
                {id:'013', nombre:'Chow Fan', categoria:'Guarnición', stock:21, precio:55},
                {id:'014', nombre:'Sopa de Maíz', categoria:'Sopa', stock:14, precio:75},
                {id:'015', nombre:'Cerdo BBQ', categoria:'Plato Fuerte', stock:16, precio:130},
                {id:'016', nombre:'Ensalada Oriental', categoria:'Entrada', stock:24, precio:60},
                {id:'017', nombre:'Sésamo Pollo', categoria:'Plato Fuerte', stock:13, precio:120},
                {id:'018', nombre:'Bebida de Lichi', categoria:'Bebida', stock:35, precio:40},
                {id:'019', nombre:'Sopa Agripicante', categoria:'Sopa', stock:12, precio:85},
                {id:'020', nombre:'Fideos Udon', categoria:'Guarnición', stock:20, precio:65},
                {id:'021', nombre:'Sushi Roll', categoria:'Entrada', stock:18, precio:90},
                {id:'022', nombre:'Té Rojo', categoria:'Bebida', stock:28, precio:38},
                {id:'023', nombre:'Sopa de Pollo', categoria:'Sopa', stock:15, precio:78},
                {id:'024', nombre:'Arroz Blanco', categoria:'Guarnición', stock:40, precio:35}
            ];
            let paginaActual = 1;
            const porPagina = 8;
            async function cargarProductos() {
                const res = await fetch('Admin/productos_api.php');
                productos = await res.json();
                renderTablaAlmacen();
            }
            function renderTablaAlmacen() {
                const tbody = document.querySelector('#almacen-table tbody');
                tbody.innerHTML = '';
                let filtro = document.getElementById('busquedaProducto').value.toLowerCase();
                let filtrados = productos.filter(p => p.nombre.toLowerCase().includes(filtro) || p.categoria.toLowerCase().includes(filtro));
                let totalPaginas = Math.ceil(filtrados.length / porPagina);
                paginaActual = Math.min(paginaActual, totalPaginas || 1);
                let inicio = (paginaActual-1)*porPagina;
                let fin = inicio+porPagina;
                filtrados.slice(inicio, fin).forEach(p => {
                    tbody.innerHTML += `<tr>
                        <td>${p.id}</td>
                        <td>${p.nombre}</td>
                        <td>${p.categoria}</td>
                        <td>${p.stock}</td>
                        <td>$${p.precio}</td>
                        <td>
                            <button onclick="abrirModalEditarProducto(${p.id})" style='background:var(--dorado);color:var(--rojo);border:none;border-radius:6px;padding:6px 14px;cursor:pointer;'>Editar</button>
                            <button onclick="eliminarProducto(${p.id})" style='background:#e74c3c;color:#fff;border:none;border-radius:6px;padding:6px 14px;cursor:pointer;margin-left:6px;'>Eliminar</button>
                        </td>
                    </tr>`;
                });
                // Paginación
                const pagCont = document.getElementById('almacen-pagination');
                pagCont.innerHTML = '';
                for(let i=1; i<=totalPaginas; i++) {
                    pagCont.innerHTML += `<button onclick='cambiarPaginaAlmacen(${i})' style='background:${i===paginaActual?'var(--rojo)':'var(--dorado)'};color:${i===paginaActual?'#fff':'var(--gris-oscuro)'};border:none;border-radius:6px;padding:6px 14px;cursor:pointer;font-weight:bold;'>${i}</button>`;
                }
            }
            function cambiarPaginaAlmacen(pag) {
                paginaActual = pag;
                renderTablaAlmacen();
            }
            document.getElementById('busquedaProducto').addEventListener('input', function(){
                paginaActual = 1;
                renderTablaAlmacen();
            });
            // Inicializar tabla al mostrar sección
            document.getElementById('productos-link').addEventListener('click', function(){
                cargarProductos();
            });
            async function eliminarProducto(id) {
                if(!confirm('¿Seguro que deseas eliminar este producto?')) return;
                await fetch('Admin/productos_api.php', {
                    method: 'DELETE',
                    headers: {'Content-Type':'application/json'},
                    body: JSON.stringify({id})
                });
                cargarProductos();
            }
            function abrirModalEditarProducto(id) {
                const prod = productos.find(p => p.id == id);
                if(!prod) return;
                document.getElementById('editId').value = prod.id;
                document.getElementById('editNombre').value = prod.nombre;
                document.getElementById('editCategoria').value = prod.categoria;
                document.getElementById('editStock').value = prod.stock;
                document.getElementById('editPrecio').value = prod.precio;
                document.getElementById('modalEditarProducto').style.display = 'flex';
            }
            function cerrarModalEditarProducto() {
                document.getElementById('modalEditarProducto').style.display = 'none';
            }
            document.getElementById('formEditarProducto').onsubmit = async function(e) {
                e.preventDefault();
                const id = document.getElementById('editId').value;
                const nombre = document.getElementById('editNombre').value;
                const categoria = document.getElementById('editCategoria').value;
                const stock = document.getElementById('editStock').value;
                const precio = document.getElementById('editPrecio').value;
                await fetch('Admin/productos_api.php', {
                    method: 'PUT',
                    headers: {'Content-Type':'application/json'},
                    body: JSON.stringify({id, nombre, categoria, stock, precio})
                });
                cerrarModalEditarProducto();
                cargarProductos();
            };
            </script>
        </section>
        <script>
        // Navegación dinámica entre dashboard y almacén
        document.getElementById('dashboard-link').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('dashboard-section').style.display = '';
            document.getElementById('almacen-section').style.display = 'none';
            this.classList.add('active');
            document.getElementById('productos-link').classList.remove('active');
        });
        document.getElementById('productos-link').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('dashboard-section').style.display = 'none';
            document.getElementById('almacen-section').style.display = '';
            this.classList.add('active');
            document.getElementById('dashboard-link').classList.remove('active');
        });
        </script>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>