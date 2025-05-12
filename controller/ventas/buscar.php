<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../../modelos/ventas.php';

try {
    if (isset($_POST['med_venta']) && $_POST['med_venta'] !== '') {
        $_POST['med_venta'] = filter_var($_POST['med_venta'], FILTER_VALIDATE_INT);
    } else {
        $_POST['med_venta'] = null; 
    }
    $_POST['venta_cant'] = filter_var($_POST['venta_cant'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    if (isset($_POST['med_cliente']) && $_POST['med_cliente'] !== '') {
        $_POST['med_cliente'] = filter_var($_POST['med_cliente'], FILTER_VALIDATE_INT);
    } else {
        $_POST['med_cliente'] = null; 
    }
    if (isset($_POST['med_tra']) && $_POST['med_tra'] !== '') {
        $_POST['med_tra'] = filter_var($_POST['med_tra'], FILTER_VALIDATE_INT);
    } else {
        $_POST['med_tra'] = null; 
    }
    
    $ventConsulta = new Ventas($_POST);
    $venta = $ventConsulta->buscar();
    
    if($venta && !empty($venta)){
        echo json_encode([
            'mensaje' => 'Datos encontrados',
            'datos' => $venta,
            'codigo' => 1
        ]);
        exit;
    }else{
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'No se encontraron datos',
        ]);
        exit;
    }
}catch (Exception $e){
    echo json_encode([
        'mensaje' => 'Ocurrio un error al buscar la venta',
        'detalle' => $e->getMessage(),
        'codigo' => 0
    ]);
}