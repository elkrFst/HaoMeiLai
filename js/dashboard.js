// Dashboard desplegable
        function toggleDashboardMenu() {
            var menu = document.getElementById('dashboardMenu');
            menu.classList.toggle('show');
        }
        function hideDashboardMenu() {
            setTimeout(function() {
                var menu = document.getElementById('dashboardMenu');
                menu.classList.remove('show');
            }, 200);
        }
        // Cierra el menú si se hace clic fuera
        document.addEventListener('click', function(e) {
            var menu = document.getElementById('dashboardMenu');
            var icon = document.querySelector('.dashboard-icon');
            if (!icon.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.remove('show');
            }
        });