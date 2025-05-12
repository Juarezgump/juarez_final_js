<?php
// Evitar espacios antes de la cabecera PHP
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '0'); // Desactivamos la visualización de errores para evitar que se mezclen con el JSON
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

try {
    require '../../modelos/casa.php';

    $_POST['casa_nombre'] = htmlspecialchars($_POST['casa_nombre'] ?? '');
    $_POST['casa_direccion'] = htmlspecialchars($_POST['casa_direccion'] ?? '');
    $_POST['casa_telefono'] = filter_var($_POST['casa_telefono'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['casa_jefe'] = htmlspecialchars($_POST['casa_jefe'] ?? '');

    $casaConsulta = new Casa($_POST);
    $casa = $casaConsulta->buscar();
    
    if($casa && !empty($casa)){
        echo json_encode([
            'mensaje' => 'Datos encontrados',
            'datos' => $casa,
            'codigo' => 1
        ]);
    } else {
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'No se encontraron datos',
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'mensaje' => 'Ocurrio un error al buscar la casa/proveedor',
        'detalle' => $e->getMessage(),
        'codigo' => 0
    ]);
}
