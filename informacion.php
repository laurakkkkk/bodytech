<?php
// Obtener los datos del plan desde la URL
$plan_nombre = isset($_GET['plan']) ? $_GET['plan'] : '';
$plan_precio = isset($_GET['precio']) ? floatval($_GET['precio']) : 0;

// Coach con 10% de descuento
$coach_precio_base = 79900;
$coach_descuento = 0.10;
$coach_precio = $coach_precio_base * (1 - $coach_descuento);

// Total inicial
$total = $plan_precio;

// Validar que se recibieron datos
if (empty($plan_nombre) || $plan_precio == 0) {
    header('Location: index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Body Tech - Información de Compra</title>
    <style>
        @font-face {
            font-family: 'Gotham';
            src: url('gotham-book.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Gotham', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f5f5;
        }

        /* Header */
        header {
            background-color: #ffffff;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo img {
            height: 35px;
            width: auto;
        }

        .header-buttons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .oferta-btn {
            background-color: #ff8c00;
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #1a1a1a;
        }

        /* Container */
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content {
            padding: 20px;
            flex: 1;
        }

        /* Steps */
        .steps {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .step {
            width: 35px;
            height: 35px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 14px;
        }

        .step.active {
            background-color: #ff8c00;
        }

        .step.inactive {
            background-color: #ddd;
            color: #999;
        }

        /* Title */
        .title {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 25px;
        }

        /* Plan Card */
        .plan-card {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .plan-info {
            flex: 1;
        }

        .plan-name {
            font-size: 13px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .plan-category {
            font-size: 12px;
            color: #999;
        }

        .plan-price {
            font-size: 22px;
            font-weight: 900;
            color: #ff8c00;
            margin-top: 5px;
        }

        .plan-actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #f0f0f0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .action-btn img {
            width: 20px;
            height: 20px;
        }

        /* Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #1a1a1a;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 13px;
            font-family: 'Gotham', sans-serif;
        }

        /* Cuota */
        .cuota {
            background-color: #f9f9f9;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            font-weight: 700;
            color: #1a1a1a;
        }

        /* Complementos */
        .complementos-title {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .complemento-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            text-align: center;
        }

        .complemento-name {
            font-size: 13px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .complemento-price {
            font-size: 32px;
            font-weight: 900;
            color: #ff8c00;
            margin-bottom: 15px;
        }

        .complemento-btn {
            width: 100%;
            background-color: #ff8c00;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .complemento-info {
            font-size: 12px;
            color: #999;
        }

        /* Total */
        .total-section {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            font-size: 13px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .total-price {
            font-size: 20px;
            font-weight: 900;
            color: #ff8c00;
        }

        /* Pay Button */
        .pay-btn {
            width: 100%;
            background-color: #ff8c00;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            text-transform: uppercase;
            display: block;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .pay-btn:hover {
            background-color: #e67e00;
        }

        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: auto;
            height: auto;
            background-color: transparent;
            z-index: 50;
        }

        .whatsapp-button img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header>
            <div class="logo">
                <img src="logo.png" alt="Body Tech">
            </div>
            <div class="header-buttons">
                <button class="oferta-btn">OFERTAS</button>
                <button class="menu-toggle">☰</button>
            </div>
        </header>

        <!-- Content -->
        <div class="content">
            <!-- Steps -->
            <div class="steps">
                <div class="step active">1</div>
                <div class="step inactive">2</div>
            </div>

            <!-- Title -->
            <div class="title">Resumen de tus productos</div>

            <!-- Plan -->
            <div class="plan-card">
                <div class="plan-info">
                    <div class="plan-name"><?php echo htmlspecialchars($plan_nombre); ?></div>
                    <div class="plan-category">/ premium</div>
                    <div class="plan-price">$ <?php echo number_format($plan_precio); ?></div>
                </div>
                <div class="plan-actions">
                    <button class="action-btn"><img src="basru.png" alt="Eliminar"></button>
                    <button class="action-btn">∧</button>
                </div>
            </div>

            <!-- Fecha de Inicio -->
            <div class="form-group">
                <label class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-input" value="2026-06-20">
            </div>

            <!-- Cuota -->
            <div class="cuota">
                <span>Cuota 2026-06-20 - 2026-07-20</span>
                <span>$ <?php echo number_format($plan_precio); ?></span>
            </div>

            <!-- Complementos -->
            <div class="complementos-title">Complementa tu plan</div>

            <div class="complemento-card">
                <div class="complemento-name">My Coach Virtual Mensual</div>
                <div style="font-size: 12px; color: #999; text-decoration: line-through; margin-bottom: 5px;">
                    $ <?php echo number_format($coach_precio_base); ?>
                </div>
                <div class="complemento-price">$ <?php echo number_format(round($coach_precio)); ?></div>
                <button class="complemento-btn">Agregar <img src="carrito.png" alt="carrito" style="width: 16px; height: 16px; vertical-align: middle; margin-left: 4px;"></button>
                <div class="complemento-info">Ver más ▼</div>
            </div>

            <!-- Total -->
            <div class="total-section">
                <span class="total-label">Total a pagar:</span>
                <span class="total-price">$ <?php echo number_format($plan_precio); ?></span>
            </div>

            <!-- Pay Button -->
            <a href="pago.php?plan=<?php echo urlencode($plan_nombre); ?>&precio=<?php echo round($plan_precio); ?>" class="pay-btn">Ir a pagar</a>
        </div>
    </div>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/YOUR_NUMBER" class="whatsapp-button">
        <img src="whatsapp.png" alt="WhatsApp">
    </a>

    <script>
        let coachAgregado = false;
        const planPrecio = <?php echo $plan_precio; ?>;
        const coachPrecio = <?php echo round($coach_precio); ?>;
        const planNombre = "<?php echo htmlspecialchars($plan_nombre); ?>";
        let totalActual = planPrecio;

        document.querySelector('.complemento-btn').addEventListener('click', function() {
            if (!coachAgregado) {
                // Cambiar el botón a un estado de agregado
                this.textContent = '✓ Agregado';
                this.style.opacity = '0.6';
                this.disabled = true;
                
                // Actualizar el total
                totalActual = planPrecio + coachPrecio;
                document.querySelector('.total-price').textContent = '$ ' + totalActual.toLocaleString('es-CO');
                
                // Actualizar el link del botón de pago
                const payBtn = document.querySelector('.pay-btn');
                payBtn.href = 'pago.php?plan=' + encodeURIComponent(planNombre) + '&precio=' + totalActual + '&coach=' + coachPrecio;
                
                // Marcar como agregado
                coachAgregado = true;
            }
        });
    </script>
</body>
</html>