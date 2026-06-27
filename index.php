<?php
// Configuración inicial
$titulo_pagina = "Body Tech - Mejor Oferta Web";

// Estructura de ciudades y sus sedes
$ciudades_sedes = [
    'BOGOTÁ' => ['Autopista 135', 'Autopista 170', 'Bulevar', 'Carrera 11', 'Cabrera', 'Cedritos', 'Centro Mayor', 'Colina', 'Chapinero', 'Chicó', 'Diverplaza', 'Galerías', 'Floresta', 'Gran Estación', 'Hayuelos', 'Kennedy', 'Normandía', 'Pablo VI', 'Pasadena', 'Portal 80', 'Plaza Bosa', 'Plaza Central', 'Suba', 'Sultana', 'Titan', 'Torre Central', 'Calle 90', 'Connecta', 'Country 138', 'Ensueño', 'Paseo Villa del Río', 'Santa Ana'],
    'MEDELLÍN' => ['Robledo', 'Laureles', 'Avenida Colombia', 'Belén', 'Camino Real', 'Las Américas', 'Vegas', 'Premium Plaza', 'San Juan', 'San Lucas', 'Vizcaya', 'Mall del Este'],
    'ENVIGADO' => ['City Plaza', 'Villagrande'],
    'BELLO' => ['Niquía'],
    'RIONEGRO' => ['Llanogrande'],
    'BARRANQUILLA' => ['Parque Washington', 'Miramar', 'Viva Barranquilla', 'Recreo'],
    'SOLEDAD' => ['Soledad'],
    'CARTAGENA' => ['Bocagrande', 'Caribe Plaza', 'Los Ejecutivos', 'Plazuela', 'Gran Manzana'],
    'CALI' => ['Caney', 'Chipichape', 'Jardín Plaza', 'Oeste'],
    'PALMIRA' => ['Palmira'],
    'TULUÁ' => ['Tuluá'],
    'VALLEDUPAR' => ['Mayales'],
    'MONTERÍA' => ['Nuestro Montería'],
    'SOACHA' => ['Antares', 'Terreros'],
    'CHÍA' => ['Chía', 'Fontanar'],
    'VILLAVICENCIO' => ['Llanocentro', 'Viva Villavicencio'],
    'PASTO' => ['Pasto'],
    'ARMENIA' => ['Armenia'],
    'DOSQUEBRADAS' => ['Dos Quebradas'],
    'PEREIRA' => ['Pereira'],
    'BUCARAMANGA' => ['Cacique', 'Megamall'],
    'FLORIDABLANCA' => ['Caracolí'],
    'CÚCUTA' => ['Cúcuta'],
    'IBAGUÉ' => ['Ibagué'],
    'MANIZALES' => ['Manizales'],
    'TUNJA' => ['Tunja']
];

// Procesar selecciones del formulario
$ciudad_seleccionada = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
$sede_seleccionada = isset($_POST['sede']) ? $_POST['sede'] : '';

// Obtener sedes de la ciudad seleccionada
$sedes = isset($ciudades_sedes[$ciudad_seleccionada]) ? $ciudades_sedes[$ciudad_seleccionada] : [];
$ciudades = array_keys($ciudades_sedes);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?></title>
    <style>
        @font-face {
            font-family: 'Gotham';
            src: url('gotham-book.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Gotham-Medium';
            src: url('gotham-medium.woff2') format('woff2');
            font-weight: 500;
            font-style: normal;
        }

        @font-face {
            font-family: 'Gotham-Black';
            src: url('gotham-black.woff2') format('woff2');
            font-weight: 900;
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

        .logo {
            font-size: 18px;
            font-weight: 900;
            color: #1a1a1a;
            letter-spacing: -1px;
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 35px !important;
            width: auto;
        }

        .logo-text {
            display: none;
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
            transition: background-color 0.3s;
        }

        .oferta-btn:hover {
            background-color: #e67e00;
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #1a1a1a;
        }

        /* Main Content */
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-section {
            padding: 25px 15px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            max-width: 360px;
            margin: 0 auto;
        }

        .section-title {
            font-size: 22px;
            font-weight: 900;
            font-family: 'Gotham-Black', sans-serif;
            color: #000000;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: -1px;
            line-height: 1.2;
            width: 100%;
        }

        .description {
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 20px;
            width: 100%;
            max-width: 320px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .form-select {
            width: 100%;
            padding: 14px 16px;
            border: 3px solid #ff8c00;
            border-radius: 12px;
            font-size: 15px;
            color: #1a1a1a;
            font-family: 'Gotham', sans-serif;
            font-weight: 500;
            appearance: none;
            background-color: #ffffff;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 20px;
            padding-right: 40px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .form-select:hover {
            border-color: #ff8c00;
            background-color: #ffffff;
        }

        .form-select:focus {
            border-color: #ff8c00;
            outline: none;
            background-color: #ffffff;
        }
        
        .form-select option {
            background-color: #ffffff;
            color: #1a1a1a;
            padding: 18px 16px;
            line-height: 2;
            margin: 8px 0;
        }
        
        .form-select option:checked {
            background: #f5f5f5;
            background-color: #f5f5f5 !important;
            color: #1a1a1a !important;
        }

        /* Section con imagen y overlay */
        .promo-section {
            position: relative;
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            color: white;
            overflow: hidden;
            flex: 1;
        }

        .promo-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.6;
        }

        .promo-overlay {
            position: relative;
            z-index: 2;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            height: 100%;
        }

        .chicos-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .whatsapp-button {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: auto;
            height: auto;
            background-color: transparent;
            border-radius: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            box-shadow: none;
            z-index: 50;
            transition: transform 0.3s;
            text-decoration: none;
        }

        .whatsapp-button:hover {
            transform: scale(1.1);
        }

        .selection-info {
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 13px;
            color: #333;
        }

        .selection-info strong {
            color: #ff8c00;
        }

        @media (max-width: 480px) {
            .container {
                max-width: 100%;
            }
        }

        /* Footer */
        .footer {
            background-color: #1a1a1a;
            color: white;
            padding: 40px 20px 20px 20px;
            text-align: center;
        }

        .footer-logo {
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
        }

        .footer-logo img {
            height: 30px;
            width: auto;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 30px;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background-color: white;
            border-radius: 50%;
            text-decoration: none;
        }

        .social-link img {
            width: 28px;
            height: 28px;
            object-fit: contain;
        }

        .social-link:hover {
            transform: scale(1.1);
            transition: transform 0.3s;
        }

        .footer-menu {
            display: flex;
            flex-direction: column;
            gap: 0;
            margin-bottom: 20px;
        }

        .footer-menu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            text-decoration: none;
            color: white;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: color 0.3s;
        }

        .footer-menu-item:hover {
            color: #ff8c00;
        }

        .footer-menu-item:last-child {
            border-bottom: none;
        }

        .footer-menu-item .arrow {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.5);
        }

        .footer-divider {
            height: 1px;
            background-color: rgba(255, 255, 255, 0.1);
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header>
            <div class="logo">
                <img src="logo.png" alt="Body Tech" style="height: 40px; margin-right: 10px;">
            </div>
            <div class="header-buttons">
                <button class="oferta-btn" onclick="goToOfertas()">OFERTAS</button>
                <button class="menu-toggle" onclick="toggleMenu()">☰</button>
            </div>
        </header>

        <!-- Content Section -->
        <div class="content-section">
            <h1 class="section-title">Mejor oferta web</h1>
            <p class="description">
                Selecciona una ciudad, una sede y personaliza las condiciones para ver las tarifas
            </p>

            <form method="POST" action="sede.php">
                <div class="form-group">
                    <label class="form-label">Ciudad</label>
                    <select class="form-select" name="ciudad" id="ciudadSelect" onchange="actualizarSedes()">
                        <option value="">Selecciona tu ciudad</option>
                        <?php foreach($ciudades as $ciudad): ?>
                            <option value="<?php echo $ciudad; ?>" <?php if($ciudad_seleccionada == $ciudad) echo 'selected'; ?>>
                                <?php echo $ciudad; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Sede</label>
                    <select class="form-select" name="sede" id="sedeSelect" onchange="enviarFormulario()">
                        <option value="">Selecciona tu sede</option>
                        <?php foreach($sedes as $sede): ?>
                            <option value="<?php echo $sede; ?>" <?php if($sede_seleccionada == $sede) echo 'selected'; ?>>
                                <?php echo $sede; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>

        <!-- Promo Section -->
        <div class="promo-section">
            <img src="chicos.png" alt="Chicos" class="chicos-image">
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-logo">
                <img src="body.png" alt="Body Tech" style="height: 30px; width: auto;">
            </div>

            <div class="social-icons">
                <a href="https://facebook.com" class="social-link" title="Facebook">
                    <img src="logo-de-facebook.png" alt="Facebook">
                </a>
                <a href="https://instagram.com" class="social-link" title="Instagram">
                    <img src="instagram.png" alt="Instagram">
                </a>
                <a href="https://twitter.com" class="social-link" title="Twitter">
                    <img src="gorjeo.png" alt="Twitter">
                </a>
                <a href="https://youtube.com" class="social-link" title="YouTube">
                    <img src="youtube.png" alt="YouTube">
                </a>
            </div>

            <div class="footer-menu">
                <a href="#" class="footer-menu-item">
                    <span>Conócenos</span>
                    <span class="arrow">›</span>
                </a>
                <a href="#" class="footer-menu-item">
                    <span>Legal</span>
                    <span class="arrow">›</span>
                </a>
                <a href="#" class="footer-menu-item">
                    <span>Descarga nuestra app</span>
                    <span class="arrow">›</span>
                </a>
            </div>

            <div class="footer-divider"></div>
        </footer>
    </div>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/YOUR_NUMBER" class="whatsapp-button" title="Contactanos por WhatsApp">
        <img src="whatsapp.png" alt="WhatsApp" style="width: 50px; height: 50px;">
    </a>

    <script>
        // Estructura de ciudades y sedes en JavaScript
        const ciudadesSedes = <?php echo json_encode($ciudades_sedes); ?>;

        function actualizarSedes() {
            const ciudadSelect = document.getElementById('ciudadSelect');
            const sedeSelect = document.getElementById('sedeSelect');
            const ciudadSeleccionada = ciudadSelect.value;

            // Limpiar opciones anteriores pero dejar la opción por defecto
            sedeSelect.innerHTML = '<option value="">Selecciona tu sede</option>';

            // Añadir nuevas opciones
            if (ciudadSeleccionada && ciudadesSedes[ciudadSeleccionada]) {
                ciudadesSedes[ciudadSeleccionada].forEach(sede => {
                    const option = document.createElement('option');
                    option.value = sede;
                    option.text = sede;
                    sedeSelect.appendChild(option);
                });
                
                // Si solo hay una sede, seleccionarla y enviar automáticamente
                if (ciudadesSedes[ciudadSeleccionada].length === 1) {
                    sedeSelect.value = ciudadesSedes[ciudadSeleccionada][0];
                    setTimeout(() => {
                        enviarFormulario();
                    }, 100);
                }
            }
        }

        function enviarFormulario() {
            const ciudadSelect = document.getElementById('ciudadSelect');
            const sedeSelect = document.getElementById('sedeSelect');
            
            // Validar que ambos tengan valores
            if (ciudadSelect.value && sedeSelect.value) {
                document.querySelector('form').submit();
            }
        }

        function toggleMenu() {
            alert('Menú');
        }

        function goToOfertas() {
            alert('Sección de ofertas');
        }
    </script>
</body>
</html>