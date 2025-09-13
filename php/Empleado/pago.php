<?php
// pago.php
session_start();

// Procesar datos del carrito
$carrito = [];
if (isset($_POST['carrito'])) {
    $carrito = json_decode($_POST['carrito'], true);
}

// Calcular total
$total = 0;
foreach ($carrito as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

// Procesar pago
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar_pago'])) {
    $metodo_pago = $_POST['metodo_pago'];
    $hora_entrega = $_POST['hora_entrega'];
    
    // Aquí iría la conexión con la pasarela de pago real
    // Por ahora simulamos un pago exitoso
    
    $pago_exitoso = true;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Método de Pago - Restaurante JUAN</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f9f3e9;
            color: #3a2c1e;
            line-height: 1.6;
            padding: 20px;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="%23f9f3e9"/><path d="M0,0 L100,100 M100,0 L0,100" stroke="%23e8d5c0" stroke-width="1"/></svg>');
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        header {
            background-color: #8B0000;
            color: white;
            padding: 25px 0;
            text-align: center;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }
        h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #8B0000;
            padding-bottom: 10px;
            border-bottom: 2px solid #e8d5c0;
        }
        h3 {
            color: #8B0000;
            margin-bottom: 15px;
            font-size: 1.4rem;
        }
        .content {
            padding: 30px;
        }
        .resumen-pedido {
            background: #fffaf0;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border: 1px solid #e8d5c0;
        }
        .producto {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px dashed #e8d5c0;
        }
        .producto:last-child {
            border-bottom: none;
        }
        .total {
            font-weight: bold;
            font-size: 1.4rem;
            text-align: right;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #8B0000;
            color: #8B0000;
        }
        .metodos-pago {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .metodo {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid transparent;
            text-align: center;
        }
        .metodo:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }
        .metodo.seleccionado {
            border-color: #8B0000;
            background-color: #fff0f0;
        }
        .icono {
            font-size: 40px;
            margin-bottom: 15px;
            display: block;
        }
        .detalles-pago {
            display: none;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #e8d5c0;
            text-align: left;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #5a4a3a;
        }
        input, select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #dcc8b2;
            border-radius: 5px;
            font-size: 16px;
            background: #fffaf0;
        }
        .btn {
            background: #8B0000;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: background 0.3s;
            display: inline-block;
            text-align: center;
        }
        .btn:hover {
            background: #a52a2a;
        }
        .btn-secundario {
            background: #8b8b8b;
        }
        .btn-secundario:hover {
            background: #6b6b6b;
        }
        .acciones {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .hora-entrega {
            background: #fffaf0;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border: 1px solid #e8d5c0;
        }
        .mensaje-exito {
            background: #dff0d8;
            color: #3c763d;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
            border: 1px solid #d6e9c6;
        }
        @media (max-width: 768px) {
            .metodos-pago {
                grid-template-columns: 1fr;
            }
            .acciones {
                flex-direction: column;
                gap: 15px;
            }
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>JUAN</h1>
            <p>Restaurante Chino Auténtico</p>
        </header>

        <div class="content">
            <?php if (isset($pago_exitoso) && $pago_exitoso): ?>
                <div class="mensaje-exito">
                    <h3>¡Pago realizado con éxito!</h3>
                    <p>Tu pedido será entregado a las <?php echo htmlspecialchars($_POST['hora_entrega']); ?>.</p>
                    <p>Método de pago: <?php echo htmlspecialchars($_POST['metodo_pago']); ?>.</p>
                    <p>Gracias por tu compra.</p>
                    <div style="margin-top: 20px;">
                        <a href="empleado.php" class="btn">Volver al Menú</a>
                    </div>
                </div>
            <?php else: ?>
                <h2>Confirmación de Pago</h2>
                
                <div class="resumen-pedido">
                    <h3>Resumen de tu Pedido</h3>
                    <?php foreach ($carrito as $item): ?>
                        <div class="producto">
                            <div><?php echo htmlspecialchars($item['nombre']); ?> (x<?php echo $item['cantidad']; ?>)</div>
                            <div>$<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></div>
                        </div>
                    <?php endforeach; ?>
                    
                    <div class="total">
                        Total: $<?php echo number_format($total, 2); ?>
                    </div>
                </div>

                <form method="post" id="form-pago">
                    <div class="hora-entrega">
                        <h3>Hora de Entrega</h3>
                        <div class="form-group">
                            <label for="hora_entrega">Selecciona la hora de entrega:</label>
                            <input type="time" id="hora_entrega" name="hora_entrega" required 
                                   min="11:00" max="22:00" value="<?php echo date('H:i', strtotime('+45 minutes')); ?>">
                        </div>
                    </div>

                    <h3>Selecciona Método de Pago</h3>
                    
                    <div class="metodos-pago">
                        <div class="metodo" data-metodo="tarjeta">
                            <span class="icono">💳</span>
                            <h4>Tarjeta de Crédito/Débito</h4>
                            <div class="detalles-pago" id="detalles-tarjeta">
                                <div class="form-group">
                                    <label for="numero_tarjeta">Número de tarjeta:</label>
                                    <input type="text" id="numero_tarjeta" name="numero_tarjeta" placeholder="1234 5678 9012 3456">
                                </div>
                                <div class="form-group">
                                    <label for="fecha_vencimiento">Fecha de vencimiento:</label>
                                    <input type="text" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="MM/AA">
                                </div>
                                <div class="form-group">
                                    <label for="cvv">CVV:</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="123">
                                </div>
                            </div>
                        </div>
                        
                        <div class="metodo" data-metodo="paypal">
                            <span class="icono">📱</span>
                            <h4>PayPal</h4>
                            <div class="detalles-pago" id="detalles-paypal">
                                <p>Serás redirigido a PayPal para completar tu pago.</p>
                            </div>
                        </div>
                        
                        <div class="metodo" data-metodo="efectivo">
                            <span class="icono">💰</span>
                            <h4>Efectivo</h4>
                            <div class="detalles-pago" id="detalles-efectivo">
                                <p>Paga en efectivo cuando te entreguemos tu pedido.</p>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" id="metodo_pago" name="metodo_pago" value="">
                    
                    <div class="acciones">
                        <a href="empleado.php" class="btn btn-secundario">Volver al Menú</a>
                        <button type="submit" name="confirmar_pago" class="btn">Confirmar Pago</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Selección de método de pago
        const metodosPago = document.querySelectorAll('.metodo');
        metodosPago.forEach(metodo => {
            metodo.addEventListener('click', function() {
                // Quitar selección anterior
                metodosPago.forEach(m => {
                    m.classList.remove('seleccionado');
                    const detalles = m.querySelector('.detalles-pago');
                    if (detalles) detalles.style.display = 'none';
                });
                
                // Marcar como seleccionado
                this.classList.add('seleccionado');
                
                // Mostrar detalles del método seleccionado
                const detalles = this.querySelector('.detalles-pago');
                if (detalles) {
                    detalles.style.display = 'block';
                }
                
                // Establecer el valor del método de pago
                document.getElementById('metodo_pago').value = this.getAttribute('data-metodo');
            });
        });
        
        // Seleccionar automáticamente el primer método de pago
        document.addEventListener('DOMContentLoaded', function() {
            if (metodosPago.length > 0) {
                metodosPago[0].click();
            }
        });
        
        // Validación del formulario
        document.getElementById('form-pago').addEventListener('submit', function(e) {
            const metodoSeleccionado = document.getElementById('metodo_pago').value;
            const horaEntrega = document.getElementById('hora_entrega').value;
            
            if (!metodoSeleccionado) {
                e.preventDefault();
                alert('Por favor, selecciona un método de pago.');
                return;
            }
            
            if (!horaEntrega) {
                e.preventDefault();
                alert('Por favor, selecciona una hora de entrega.');
                return;
            }
            
            // Validación adicional para tarjeta
            if (metodoSeleccionado === 'tarjeta') {
                const numero = document.getElementById('numero_tarjeta').value;
                const fecha = document.getElementById('fecha_vencimiento').value;
                const cvv = document.getElementById('cvv').value;
                
                if (!numero || !fecha || !cvv) {
                    e.preventDefault();
                    alert('Por favor, completa todos los datos de la tarjeta.');
                    return;
                }
            }
        });
    </script>
</body>
</html>