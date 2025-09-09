<?php
require '../conexion.php';

$sql = "SELECT * FROM empleados";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empleados - Hao Mei Lai</title>
    <link rel="stylesheet" href="../../css/Admin.css">
</head>
<body>
    <div class="admin-dashboard-visual">
        <h2>Lista de Empleados</h2>
        <table>
            <thead>
                <tr>
                    <th>Numero de cuenta</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['num_cnt']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No hay empleados registrados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>