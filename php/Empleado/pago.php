<?php
// pago.php
session_start();

// Evitar que el navegador use caché
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Empleado') {
    header("Location: /login");
    exit();
}

// Inicializar variables
$carrito = [];
$total = 0;
$pago_exitoso = false;

// Procesar datos del carrito - tanto en GET como en POST
if (isset($_POST['carrito'])) {
    $carrito = json_decode($_POST['carrito'], true);
} elseif (isset($_GET['carrito'])) {
    $carrito = json_decode($_GET['carrito'], true);
}

// Calcular total
foreach ($carrito as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

// Procesar pago
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar_pago'])) {
    $metodo_pago = $_POST['metodo_pago'];
    $pago_efectivo = isset($_POST['pago_efectivo']) ? floatval($_POST['pago_efectivo']) : 0;
    
    // Recalcular el total desde el carrito enviado
    $carrito_pago = json_decode($_POST['carrito_data'], true);
    $total_pago = 0;
    foreach ($carrito_pago as $item) {
        $total_pago += $item['precio'] * $item['cantidad'];
    }
    
    $cambio = $pago_efectivo - $total_pago;
    
    // Aquí iría la conexión con la pasarela de pago real
    // Por ahora simulamos un pago exitoso
    $pago_exitoso = true;
    
    // Usar los valores del pago procesado
    $total = $total_pago;
    $carrito = $carrito_pago;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Método de Pago - HAO MEI LAI</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f6e7d8;
            color: #3a2c1e;
            line-height: 1.6;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.15);
            overflow: hidden;
        }
        header {
            background-color: #7b2c2c;
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
            color: #7b2c2c;
            padding-bottom: 10px;
            border-bottom: 2px solid #e8d5c0;
        }
        h3 {
            color: #7b2c2c;
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
            border-top: 2px solid #7b2c2c;
            color: #7b2c2c;
        }
        .metodos-pago {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .metodo {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid transparent;
            text-align: center;
        }
        .metodo:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }
        .metodo.seleccionado {
            border-color: #7b2c2c;
            background-color: #f8f9fa;
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
        
        /* ESTILOS ESPECÍFICOS PARA EFECTIVO */
        .cash-input-section {
            background: #e8f4fd;
            padding: 20px;
            border-radius: 10px;
            margin-top: 15px;
        }
        .cash-row {
            display: flex;
            gap: 15px;
            align-items: end;
            margin-bottom: 15px;
        }
        .cash-col {
            flex: 1;
        }
        .amount-input {
            font-size: 1.2em;
            text-align: center;
            border: 2px solid #7b2c2c;
            border-radius: 8px;
            background: white;
        }
        .change-display {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            text-align: center;
            display: none;
        }
        .change-negative {
            background: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        .quick-amounts {
            margin-top: 15px;
        }
        .quick-btn {
            background: #a33d3d;
            color: white;
            border: none;
            padding: 8px 16px;
            margin: 2px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }
        .quick-btn:hover {
            background: #7b2c2c;
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
            background: #7b2c2c;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: background 0.3s;
            display: inline-block;
            text-align: center;
        }
        .btn:hover {
            background: #a33d3d;
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
        .mensaje-exito {
            background: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
            border: 1px solid #c3e6cb;
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
            .cash-row {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>HAO MEI LAI</h1>
            <p>Restaurante Chino Auténtico</p>
        </header>

        <div class="content">
            <?php if ($pago_exitoso): ?>
                <div class="mensaje-exito">
                    <h3>¡Pago realizado con éxito!</h3>
                    <p>Método de pago: <?php echo htmlspecialchars($_POST['metodo_pago']); ?>.</p>
                    <?php if ($_POST['metodo_pago'] === 'efectivo' && isset($_POST['pago_efectivo']) && $_POST['pago_efectivo'] > 0): ?>
                        <p><strong>Total a pagar:</strong> $<?php echo number_format($total, 2); ?></p>
                        <p><strong>Efectivo recibido:</strong> $<?php echo number_format($_POST['pago_efectivo'], 2); ?></p>
                        <?php if ($cambio > 0): ?>
                            <p><strong>Cambio a entregar:</strong> <span style="color: #28a745; font-size: 1.3em;">$<?php echo number_format($cambio, 2); ?></span></p>
                        <?php elseif ($cambio == 0): ?>
                            <p><strong>Pago exacto - Sin cambio</strong></p>
                        <?php endif; ?>
                    <?php endif; ?>
                    <p>Tu pedido será preparado lo antes posible.</p>
                    <p>¡Gracias por tu compra!</p>
                    <div style="margin-top: 20px;">
                        <a href="caja" class="btn">Volver al Menú</a>
                    </div>
                </div>
            <?php else: ?>
                <h2>Confirmación de Pago</h2>
                
                <div class="resumen-pedido">
                    <h3>Resumen de tu Pedido</h3>
                    <?php if (!empty($carrito)): ?>
                        <?php foreach ($carrito as $item): ?>
                            <div class="producto">
                                <div><?php echo htmlspecialchars($item['nombre']); ?> (x<?php echo $item['cantidad']; ?>)</div>
                                <div>$<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay productos en el carrito.</p>
                    <?php endif; ?>
                    
                    <div class="total">
                        Total: $<?php echo number_format($total, 2); ?>
                    </div>
                </div>

                <form method="post" id="form-pago">
                    <!-- Campo oculto para enviar los datos del carrito -->
                    <input type="hidden" name="carrito_data" value="<?php echo htmlspecialchars(json_encode($carrito)); ?>">
                    
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
                                <div class="cash-input-section">
                                    <div class="cash-row">
                                        <div class="cash-col">
                                            <label>Total a Pagar:</label>
                                            <input type="text" class="form-control" value="$<?php echo number_format($total, 2); ?>" readonly>
                                        </div>
                                        <div class="cash-col">
                                            <label>Cantidad Recibida:</label>
                                            <input type="number" 
                                                   class="form-control amount-input" 
                                                   id="cashAmount" 
                                                   name="pago_efectivo"
                                                   placeholder="0.00" 
                                                   step="0.01"
                                                   min="0"
                                                   oninput="calculateChange()"
                                                   onkeydown="preventNegative(event)">
                                        </div>
                                    </div>
                                    
                                    <div id="changeDisplay" class="change-display">
                                        <strong id="changeText"></strong>
                                    </div>

                                    <div class="quick-amounts">
                                        <small style="color: #666;">Cantidad exacta o botones rápidos:</small><br>
                                        <button type="button" class="quick-btn" onclick="setAmount(<?php echo $total; ?>)">Exacto ($<?php echo number_format($total, 0); ?>)</button>
                                        <button type="button" class="quick-btn" onclick="setAmount(<?php echo ceil($total/50)*50; ?>)">$<?php echo ceil($total/50)*50; ?></button>
                                        <button type="button" class="quick-btn" onclick="setAmount(<?php echo ceil($total/100)*100; ?>)">$<?php echo ceil($total/100)*100; ?></button>
                                        <button type="button" class="quick-btn" onclick="setAmount(300)">$300</button>
                                        <button type="button" class="quick-btn" onclick="setAmount(500)">$500</button>
                                        <button type="button" class="quick-btn" onclick="setAmount(1000)">$1000</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" id="metodo_pago" name="metodo_pago" value="">
                    
                    <div class="acciones">
                        <a href="caja" class="btn btn-secundario">Volver al Menú</a>
                        <button type="submit" name="confirmar_pago" class="btn" id="btn-confirmar">Confirmar Pago</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const totalToPay = <?php echo $total; ?>;
        
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
        
        // Función para calcular el cambio en efectivo
        function calculateChange() {
            const cashAmount = parseFloat(document.getElementById('cashAmount').value) || 0;
            const changeDisplay = document.getElementById('changeDisplay');
            const changeText = document.getElementById('changeText');
            const btnConfirmar = document.getElementById('btn-confirmar');
            
            if (cashAmount > 0) {
                const change = cashAmount - totalToPay;
                changeDisplay.style.display = 'block';
                
                if (change >= 0) {
                    changeDisplay.className = 'change-display';
                    if (change === 0) {
                        changeText.innerHTML = `<span style="color: #28a745; font-size: 1.2em;">Pago exacto - Sin cambio</span>`;
                    } else {
                        changeText.innerHTML = `Cambio a regresar: <span style="font-size: 1.3em; color: #28a745; font-weight: bold;">$${change.toFixed(2)}</span>`;
                    }
                    btnConfirmar.disabled = false;
                    btnConfirmar.style.opacity = '1';
                } else {
                    changeDisplay.className = 'change-display change-negative';
                    changeText.innerHTML = `<strong>Cantidad insuficiente</strong><br>Faltan: <span style="font-size: 1.2em;">$${Math.abs(change).toFixed(2)}</span>`;
                    btnConfirmar.disabled = true;
                    btnConfirmar.style.opacity = '0.6';
                }
            } else {
                changeDisplay.style.display = 'none';
                btnConfirmar.disabled = false;
                btnConfirmar.style.opacity = '1';
            }
        }

        function setAmount(amount) {
            document.getElementById('cashAmount').value = amount;
            calculateChange();
        }

        // Función para prevenir números negativos
        function preventNegative(event) {
            // Prevenir teclas de menos y e (notación científica)
            if (event.key === '-' || event.key === 'e' || event.key === 'E') {
                event.preventDefault();
            }
        }
        
        // Seleccionar automáticamente el primer método de pago
        document.addEventListener('DOMContentLoaded', function() {
            if (metodosPago.length > 0) {
                metodosPago[0].click();
            }
        });
        
        // Validación del formulario
        document.getElementById('form-pago').addEventListener('submit', function(e) {
            const metodoSeleccionado = document.getElementById('metodo_pago').value;
            
            if (!metodoSeleccionado) {
                e.preventDefault();
                alert('Por favor, selecciona un método de pago.');
                return;
            }
            
            // Validación para efectivo
            if (metodoSeleccionado === 'efectivo') {
                const cashAmount = parseFloat(document.getElementById('cashAmount').value) || 0;
                
                if (cashAmount < totalToPay) {
                    e.preventDefault();
                    alert('La cantidad ingresada es insuficiente para cubrir el total.');
                    return;
                }
                
                // Sin mensaje de confirmación - enviar directamente
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