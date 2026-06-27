<?php
// Procesar el formulario si se envía
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departamento = $_POST['departamento'] ?? '';
    $ciudad = $_POST['ciudad'] ?? '';
    $barrio = $_POST['barrio'] ?? '';
    
    if (!empty($departamento) && !empty($ciudad) && !empty($barrio)) {
        $mensaje = "✅ Datos guardados: $departamento, $ciudad, $barrio";
        // Aquí puedes guardar en base de datos o enviar por email
    } else {
        $mensaje = "❌ Por favor complete todos los campos";
    }
}

// Incluir el contenido de index.html
include 'index.html';
?>
