<?php
// google_callback.php

session_start();
require 'conexion.php'; // Asegúrate de que esta ruta sea correcta

// ------------------------------------------------------------------------------------------------
// ⚠️ TUS VARIABLES DE CONFIGURACIÓN DE GOOGLE (DEBEN SER IDÉNTICAS A google_auth.php)
// ------------------------------------------------------------------------------------------------
const CLIENT_ID = '117774502467-9dooa96c54u43t1pm95utpp1ug9vgufe.apps.googleusercontent.com'; // <<-- ¡REEMPLAZAR!
const CLIENT_SECRET = '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'; // <<-- ¡REEMPLAZAR!
const REDIRECT_URI = 'https://vitalnews.blog/google_callback.php'; // <<-- ¡REEMPLAZAR con tu dominio!
// ------------------------------------------------------------------------------------------------


if (isset($_GET['code'])) {
    $action = $_SESSION['google_action'] ?? 'login';
    unset($_SESSION['google_action']); 
    
    try {
        // 1. INCLUIR LA LIBRERÍA
        require_once 'vendor/autoload.php';
        
        // 2. Configurar el cliente
        $client = new Google_Client();
        $client->setClientId(CLIENT_ID);
        $client->setClientSecret(CLIENT_SECRET);
        $client->setRedirectUri(REDIRECT_URI);
        
        // 3. Intercambiar el código por el token y obtener los datos
        $client->authenticate($_GET['code']);
        
        $oauth = new Google_Service_Oauth2($client);
        $google_user_info = $oauth->userinfo->get();

        $email = $google_user_info->email;
        $nombre = $google_user_info->name;
        
        // ------------------------------------------------------------------------------------------------
        // LÓGICA DE BASE DE DATOS (LOGIN/REGISTRO)
        // ------------------------------------------------------------------------------------------------
        
        // 4. Buscar al usuario por email
        $stmt = $conn->prepare("SELECT cliente_id, nombre, rol FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        
        if ($user) {
            // ✅ LOGIN: Usuario encontrado
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['cliente_id'] = $user['cliente_id'];
            $_SESSION['rol'] = $user['rol'];
            header("Location: inicio");
            exit();
            
        } elseif ($action === 'register') {
            // ✅ REGISTRO: Usuario no encontrado y solicitó registrarse
            $sql = "INSERT INTO usuarios (nombre, email, contraseña, rol, fecha_registro) VALUES (?, ?, '', 'usuario', NOW())";
            $stmt_insert = $conn->prepare($sql);
            $stmt_insert->bind_param("ss", $nombre, $email);
            
            if ($stmt_insert->execute()) {
                 // Iniciar sesión después del registro
                 $_SESSION['nombre'] = $nombre;
                 $_SESSION['cliente_id'] = $conn->insert_id;
                 $_SESSION['rol'] = 'usuario';
                 header("Location: login");
                 exit();
            } else {
                 header("Location: registro.php?error=db_error_google");
                 exit();
            }
            $stmt_insert->close();
            
        } else {
            // ❌ Error: Usuario no encontrado y la acción fue LOGIN
            header("Location: iniciodesesion.php?error=no_google_user");
            exit();
        }

    } catch (Exception $e) {
        // Error de la API o la librería
        error_log("Google Callback Error: " . $e->getMessage());
        header('Location: iniciodesesion.php?error=google_api_fail');
        exit();
    }

} else {
    // Error o cancelación por parte del usuario en la pantalla de Google
    header('Location: iniciodesesion.php?error=google_failed');
    exit();
}
?>