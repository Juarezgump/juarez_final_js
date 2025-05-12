<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../../modelos/ventas.php';

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

if ($_POST['med_venta'] == null || $_POST['venta_cant'] == '' || $_POST['med_cliente'] == null || $_POST['med_tra'] == null) {
    echo json_encode([
        'mensaje' => 'DEBE VALIDAR LOS DATOS',
        'codigo' => 2
    ]);
    exit;
} else {
    try {
        $nuevaVenta = new Ventas($_POST);
        $resultado = $nuevaVenta->guardar();
    
        if($resultado['resultado'] == 1){
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'VENTA REGISTRADA CON EXITO',
                'post' => $_POST
            ]);
        } else {
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'NO SE REGISTRO LA VENTA',
            ]);
        }
        
    } catch (Exception $e) {
        echo json_encode([
            'mensaje' => 'OCURRIO UN ERROR AL INTENTAR REGISTRAR LA VENTA',
            'detalle' => $e->getMessage(),
            'codigo' => 0
        ]);
    }
}