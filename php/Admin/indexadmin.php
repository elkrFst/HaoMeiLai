<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Panel Administrador</title>
	<link rel="stylesheet" href="../../css/Admin.css">
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
			<button class="icon-btn" title="Inicio" onclick="location.href='../indexusuario.php'">
				<!-- Icono casa -->
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
			</button>
			<button class="icon-btn" title="Notificaciones">
				<!-- Icono campana -->
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
			</button>
			<button class="icon-btn almacen-btn" title="Almacen" onclick="location.href='almacen.php'">
				<!-- Icono caja (almacén) -->
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22" x2="12" y2="12"/></svg>
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
	   <main>
		<section class="admin-dashboard-cards" style="display: flex; gap: 2rem; margin-top: 2rem; justify-content: center; align-items: center;">
			   <div style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem 2rem; min-width: 220px;">
				   <div style="display: flex; justify-content: space-between; align-items: center;">
					   <span style="font-weight: 600; color: #333;">Ventas Hoy</span>
					   <span class="ventas-hoy" style="color: #27ae60; font-size: 1.2em;">$</span>
				   </div>
				   <div style="font-size: 2em; font-weight: bold; margin: 0.5em 0; color: #222;">$2,847</div>
				   <div style="color: #27ae60; font-size: 0.95em;">↗ +12% desde ayer</div>
			   </div>
			   <div style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem 2rem; min-width: 220px;">
				   <div style="display: flex; justify-content: space-between; align-items: center;">
					   <span style="font-weight: 600; color: #333;">Pedidos Hoy</span>
					   <span style="color: #3f51b5; font-size: 1.2em;">&#128722;</span>
				   </div>
				   <div style="font-size: 2em; font-weight: bold; margin: 0.5em 0; color: #222;">147</div>
				   <div style="color: #3f51b5; font-size: 0.95em;">🕒 8 en preparación</div>
			   </div>
			   <div style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem 2rem; min-width: 220px;">
				   <div style="display: flex; justify-content: space-between; align-items: center;">
					   <span style="font-weight: 600; color: #333;">Clientes Atendidos</span>
					   <span style="color: #a259e6; font-size: 1.2em;">&#128101;</span>
				   </div>
				   <div style="font-size: 2em; font-weight: bold; margin: 0.5em 0; color: #222;">89</div>
				   <div style="color: #a259e6; font-size: 0.95em;">⭐ 4.8 rating promedio</div>
			   </div>
			   <div style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem 2rem; min-width: 220px;">
				   <div style="display: flex; justify-content: space-between; align-items: center;">
					   <span style="font-weight: 600; color: #333;">Reservas Hoy</span>
					   <span style="color: #e74c3c; font-size: 1.2em;">&#128197;</span>
				   </div>
				   <div style="font-size: 2em; font-weight: bold; margin: 0.5em 0; color: #222;">23</div>
				   <div style="color: #e74c3c; font-size: 0.95em;">🗓 5 mesas disponibles</div>
			   </div>
		   </section>
	   </section>
	   <!-- Dashboard visual -->
	   <section class="admin-dashboard-visual" style="display: flex; flex-wrap: wrap; gap: 2rem; margin: 2rem 0; justify-content: center;">
		   <!-- Ventas de la Semana y Platos Populares -->
		   <div style="display: flex; gap: 2rem; width: 100%; max-width: 900px;">
			   <div style="flex: 2; background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem;">
				   <h3 style="margin-bottom: 1rem; font-size: 1.1em; color: #222;">Ventas de la Semana</h3>
				   <canvas id="ventasSemana" height="180"></canvas>
			   </div>
			   <div style="flex: 1; background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem;">
				   <h3 style="margin-bottom: 1rem; font-size: 1.1em; color: #222;">Platos Populares</h3>
				   <canvas id="platosPopulares" height="180"></canvas>
				   <ul style="margin-top: 1rem; font-size: 0.95em; color: #444; list-style: none; padding: 0;">
					   <li><span style="color:#e74c3c;">●</span> Pollo Agridulce <span style="float:right;">45</span></li>
					   <li><span style="color:#e67e22;">●</span> Chop Suey <span style="float:right;">38</span></li>
					   <li><span style="color:#f1c40f;">●</span> Arroz Frito <span style="float:right;">32</span></li>
					   <li><span style="color:#d35400;">●</span> Wonton <span style="float:right;">28</span></li>
				   </ul>
			   </div>
		   </div>
		   <!-- Pedidos Recientes -->
		   <div style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem; width: 100%; max-width: 900px; margin-top: 2rem;">
			   <h3 style="margin-bottom: 1rem; font-size: 1.1em; color: #222;">Pedidos Recientes</h3>
			   <!-- Barra de búsqueda -->
<div style="margin-bottom: 1rem; display: flex; align-items: center; gap: 10px;">
    <input type="text" id="busquedaPedidos" placeholder="Buscar pedido o cliente..." style="padding: 8px 12px; border-radius: 8px; border: 1px solid #ddd; width: 220px;">
    <button onclick="filtrarPedidos()" style="background:#e74c3c; color:#fff; border:none; border-radius:8px; padding:8px 18px; cursor:pointer;">Buscar</button>
</div>
<script>
function filtrarPedidos() {
    const input = document.getElementById('busquedaPedidos').value.toLowerCase();
    const filas = document.querySelectorAll('table tbody tr');
    filas.forEach(fila => {
        const texto = fila.innerText.toLowerCase();
        fila.style.display = texto.includes(input) ? '' : 'none';
    });
}
</script>
			   <table style="width: 100%; border-collapse: collapse; font-size: 0.98em;">
				   <thead>
					   <tr style="color: #888; text-align: left;">
						   <th>ID Pedido</th>
						   <th>Cliente</th>
						   <th>Platos</th>
						   <th>Total</th>
						   <th>Estado</th>
						   <th>Hora</th>
					   </tr>
				   </thead>
				   <tbody>
					   <tr><td>#001</td><td>María García</td><td>Pollo Agridulce, Arroz Frito</td><td style="color:#27ae60;">$25.50</td><td><span style="background:#d4f8e8;color:#27ae60;padding:2px 8px;border-radius:8px;">Completado</span></td><td>14:30</td></tr>
					   <tr><td>#002</td><td>Carlos López</td><td>Chop Suey, Wonton</td><td style="color:#27ae60;">$32.00</td><td><span style="background:#f7f3d4;color:#e67e22;padding:2px 8px;border-radius:8px;">En preparación</span></td><td>14:45</td></tr>
					   <tr><td>#003</td><td>Ana Martínez</td><td>Pato Pekín, Sopa Wonton</td><td style="color:#27ae60;">$45.75</td><td><span style="background:#fbeee6;color:#e74c3c;padding:2px 8px;border-radius:8px;">Pendiente</span></td><td>15:00</td></tr>
					   <tr><td>#004</td><td>Pedro Silva</td><td>Cerdo Agridulce</td><td style="color:#27ae60;">$18.25</td><td><span style="background:#d4f8e8;color:#27ae60;padding:2px 8px;border-radius:8px;">Completado</span></td><td>15:15</td></tr>
					   <tr><td>#005</td><td>Laura Torres</td><td>Pollo Kung Pao, Té Verde</td><td style="color:#27ae60;">$28.50</td><td><span style="background:#f7f3d4;color:#e67e22;padding:2px 8px;border-radius:8px;">En preparación</span></td><td>15:30</td></tr>
				   </tbody>
			   </table>
			   <button style="float:right; margin-top:1rem; background:#e74c3c; color:#fff; border:none; border-radius:8px; padding:8px 18px; cursor:pointer; font-size:0.98em;">Ver Todos</button>
		   </div>
		   <!-- Estado y Acciones Rápidas -->
		   <div style="display: flex; gap: 2rem; width: 100%; max-width: 900px; margin-top: 2rem;">
			   <div style="flex: 1; background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem;">
				   <h3 style="margin-bottom: 1rem; font-size: 1.1em; color: #222;">Estado del Restaurante</h3>
				   <div style="margin-bottom: 0.7em;">Mesas Ocupadas <span style="float:right; font-weight: bold;">18/23</span></div>
				   <div style="background:#e74c3c; height:8px; border-radius:4px; width:80%; margin-bottom:1em;"></div>
				   <div style="margin-bottom: 0.7em;">Staff en Turno <span style="float:right; font-weight: bold;">12 personas</span></div>
				   <div>Inventario Crítico <span style="float:right; color:#e74c3c; font-weight:bold;">3 ítems</span></div>
			   </div>
			   <div style="flex: 1; background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem;">
				   <h3 style="margin-bottom: 1rem; font-size: 1.1em; color: #222;">Acciones Rápidas</h3>
				   <button style="width:100%; background:#e74c3c; color: #222; border:none; border-radius:8px; padding:8px 0 8px 16px; margin-bottom:8px; font-size:0.98em; display:flex; align-items:center; gap:8px; justify-content:flex-start;" onclick="location.href='trabajadores.php'">
        <span>👥</span> Ver Trabajadores
    </button>
    <button style="width:100%; background:#e74c3c; color: #222; border:none; border-radius:8px; padding:8px 0 8px 16px; margin-bottom:8px; font-size:0.98em; display:flex; align-items:center; gap:8px; justify-content:flex-start;" onclick="location.href='almacen.php'">
        <span>🍽</span> Gestionar Menú
    </button>
   
   
			   </div>
		   </div>
	   </section>
	   <!-- Scripts para gráficas -->
	   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	   <script>
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
	   <!-- Fin dashboard visual -->
	   <!-- Notificación toast -->
<div id="toast" style="display:none;position:fixed;bottom:30px;right:30px;z-index:9999;background:#e74c3c;color:#fff;padding:16px 28px;border-radius:8px;font-size:1.1em;box-shadow:0 2px 8px rgba(0,0,0,0.15);">¡Acción realizada!</div>
<script>
function showToast(msg) {
    const toast = document.getElementById('toast');
    toast.textContent = msg;
    toast.style.display = 'block';
    setTimeout(()=>{toast.style.display='none';}, 2500);
}
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.admin-dashboard-cards div[style*="font-size: 2em"]').forEach(el => {
        const target = parseInt(el.textContent.replace(/\D/g,''));
        let count = 0;
        const step = Math.ceil(target / 40);
        const interval = setInterval(() => {
            count += step;
            if(count >= target) {
                el.textContent = el.textContent.replace(/\d+/, target);
                clearInterval(interval);
            } else {
                el.textContent = el.textContent.replace(/\d+/, count);
            }
        }, 30);
    });
});
</script>
	   </main>
</body>
</html>
