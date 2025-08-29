  // Dashboard desplegable
        function toggleDashboardMenu() {
            var menu = document.getElementById('dashboardMenu');
            menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'flex' : 'none';
        }
        function hideDashboardMenu() {
            setTimeout(function() {
                document.getElementById('dashboardMenu').style.display = 'none';
            }, 150);
        }
        // Cierra el menú si se hace clic fuera
        document.addEventListener('click', function(e) {
            var menu = document.getElementById('dashboardMenu');
            var icon = document.querySelector('.dashboard-icon');
            if (!icon.contains(e.target) && !menu.contains(e.target)) {
                menu.style.display = 'none';
            }
        });