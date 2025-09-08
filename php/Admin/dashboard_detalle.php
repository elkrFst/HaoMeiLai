<?php
// Simulación de datos para cada tipo
$tipo = $_GET['tipo'] ?? '';
if ($tipo === 'ventas') {
    echo '<h2>Detalle de Ventas Hoy</h2>';
    echo '<canvas id="graficoVentas" width="400" height="200"></canvas>';
    echo '<table><tr><th>Hora</th><th>Ventas</th></tr><tr><td>10:00</td><td>5</td></tr><tr><td>12:00</td><td>8</td></tr><tr><td>15:00</td><td>12</td></tr></table>';
    echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
    echo '<script>const ctx = document.getElementById("graficoVentas").getContext("2d");new Chart(ctx,{type:"bar",data:{labels:["10:00","12:00","15:00"],datasets:[{label:"Ventas",data:[5,8,12],backgroundColor:"#d90427"}]},options:{responsive:true}});</script>';
} elseif ($tipo === 'pedidos') {
    echo '<h2>Detalle de Pedidos Hoy</h2>';
    echo '<canvas id="graficoPedidos" width="400" height="200"></canvas>';
    echo '<table><tr><th>Hora</th><th>Pedidos</th></tr><tr><td>10:00</td><td>3</td></tr><tr><td>12:00</td><td>6</td></tr><tr><td>15:00</td><td>9</td></tr></table>';
    echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
    echo '<script>const ctx = document.getElementById("graficoPedidos").getContext("2d");new Chart(ctx,{type:"line",data:{labels:["10:00","12:00","15:00"],datasets:[{label:"Pedidos",data:[3,6,9],backgroundColor:"#d90427",borderColor:"#d90427"}]},options:{responsive:true}});</script>';
} elseif ($tipo === 'clientes') {
    echo '<h2>Detalle de Clientes Atendidos Hoy</h2>';
    echo '<canvas id="graficoClientes" width="400" height="200"></canvas>';
    echo '<table><tr><th>Hora</th><th>Clientes</th></tr><tr><td>10:00</td><td>4</td></tr><tr><td>12:00</td><td>7</td></tr><tr><td>15:00</td><td>10</td></tr></table>';
    echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
    echo '<script>const ctx = document.getElementById("graficoClientes").getContext("2d");new Chart(ctx,{type:"pie",data:{labels:["10:00","12:00","15:00"],datasets:[{label:"Clientes",data:[4,7,10],backgroundColor:["#d90427","#222","#888"]}]},options:{responsive:true}});</script>';
} else {
    echo '<h2>No hay información disponible</h2>';
}
