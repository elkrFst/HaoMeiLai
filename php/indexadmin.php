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
	<!-- ...contenido de la página... -->
</body>
</html>
