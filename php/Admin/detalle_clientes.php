<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../../iniciodesesion.php');
    exit();
}
require_once '../../conexion.php';

// Tarjetas resumen
$anio = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM clientes WHERE atendido=1"))[0];
$mes = $anio;
$semana = $anio;
$dia = $anio;

// Datos para la gráfica (últimos 7 días)
$labels = [];
$data = [];
for ($i = 6; $i >= 0; $i--) {
    $fecha = date('Y-m-d', strtotime("-$i days"));
    $labels[] = date('d M', strtotime($fecha));
    $sql = "SELECT COUNT(*) FROM clientes WHERE atendido=1 AND DATE(fecha_registro)='$fecha'";
    $res = mysqli_fetch_row(mysqli_query($conn, $sql));
    $data[] = $res ? intval($res[0]) : 0;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detalle Clientes Atendidos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #fff7e6 0%, #ffe0b2 100%);
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        h2 {
            color: #a33d3d;
            font-weight: bold;
            margin-bottom: 2rem;
            letter-spacing: 1px;
            text-align: center;
        }
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(163,61,61,0.08);
            background: #fff;
            margin-bottom: 18px;
            transition: transform 0.15s;
        }
        .card:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 8px 24px rgba(163,61,61,0.13);
        }
        .card h5 {
            color: #a33d3d;
            font-weight: 600;
            font-size: 1.1em;
            margin-bottom: 0.5rem;
        }
        .card .fs-2 {
            color: #f6c453;
            font-weight: bold;
            font-size: 2.2em;
        }
        .btn-primary {
            background: #a33d3d;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: box-shadow 0.2s;
        }
        .btn-primary:hover {
            background: #f6c453;
            color: #a33d3d;
            box-shadow: 0 2px 8px rgba(163,61,61,0.13);
        }
        .grafica-container {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(163,61,61,0.08);
            padding: 2rem;
            margin: 2rem 0;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2><span style="font-size:1.2em;">👥</span> Detalle de Clientes Atendidos</h2>
    <div class="row">
        <div class="col-md-3"><div class="card text-center"><div class="card-body"><h5>Año</h5><p class="fs-2"><?php echo $anio; ?></p></div></div></div>
        <div class="col-md-3"><div class="card text-center"><div class="card-body"><h5>Mes</h5><p class="fs-2"><?php echo $mes; ?></p></div></div></div>
        <div class="col-md-3"><div class="card text-center"><div class="card-body"><h5>Semana</h5><p class="fs-2"><?php echo $semana; ?></p></div></div></div>
        <div class="col-md-3"><div class="card text-center"><div class="card-body"><h5>Día</h5><p class="fs-2"><?php echo $dia; ?></p></div></div></div>
    </div>
    <div class="grafica-container">
        <h5 class="mb-4 text-center">Clientes atendidos en los últimos 7 días</h5>
        <canvas id="graficaClientes"></canvas>
    </div>
    <a href="dashboard.php" class="btn btn-primary mt-4">Regresar al Dashboard</a>
</div>
<script>
const ctx = document.getElementById('graficaClientes').getContext('2d');
const grafica = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: 'Clientes atendidos',
            data: <?php echo json_encode($data); ?>,
            borderColor: '#a33d3d',
            backgroundColor: 'rgba(246,196,83,0.2)',
            fill: true,
            tension: 0.3,
            pointBackgroundColor: '#a33d3d',
            pointRadius: 5,
            pointHoverRadius: 7
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 } }
        }
    }
});
</script>
</body>
</html>
