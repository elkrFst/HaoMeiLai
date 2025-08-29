<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Panel Administrador</title>
	<link rel="stylesheet" href="../css/Admin.css">
</head>
<body>
	   <header class="header-admin">
		   <div class="header-left">
			   <img src="../imagenes/logo comida.png" alt="Logo Hao Mei Lai" class="logo-header">
			   <span class="nombre-header">HAO MEI LAI</span>
		   </div>
		   <div class="header-right">
			   <!-- Botón menú-->
			   <button class="icon-btn menu-btn" id="menuToggle" title="Menú">
				   <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
			   </button>
			   <!-- Menú desplegable -->
			   <div class="dropdown-menu" id="dropdownMenu">
				   <div class="dropdown-top">
					   <div class="perfil-img"></div>
					   <span class="perfil-nombre">Administrador</span>
					   <button class="icon-btn" title="Salir">
						   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
					   </button>
				   </div>
				   <div class="dropdown-icons">
					   <button class="icon-btn" title="Inicio" onclick="location.href='indexusuario.php'">
						   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
					   </button>
					   <button class="icon-btn" title="Notificaciones">
						   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
					   </button>
					   <button class="icon-btn" title="Configuración">
						   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h.09a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51h.09a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v.09a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
					   </button>
				   </div>
			   </div>
		   </div>
	   </header>
	   <script>
	   // Mostrar/ocultar menú desplegable
	   const menuToggle = document.getElementById('menuToggle');
	   const dropdownMenu = document.getElementById('dropdownMenu');
	   menuToggle.addEventListener('click', function() {
		   dropdownMenu.classList.toggle('show');
	   });
	   // Cerrar menú al hacer clic fuera
	   document.addEventListener('click', function(e) {
		   if (!dropdownMenu.contains(e.target) && !menuToggle.contains(e.target)) {
			   dropdownMenu.classList.remove('show');
		   }
	   });
	   </script>
	<!-- ...contenido de la página... -->
</body>
</html>
