<?php
$host = "localhost";      // Servidor de base de datos
$dbname = "HaoMeiLai";    // Nombre de la base de datos
$username = "root";       // Usuario de la base de datos
$password = "";           // Contraseña del usuario (cámbiala si tienes)

try {
    // Crear conexión usando PDO
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configurar modo de errores para PDO
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mensaje opcional para pruebas
    // echo "Conexión exitosa a la base de datos $dbname";

} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit();
}
?>
