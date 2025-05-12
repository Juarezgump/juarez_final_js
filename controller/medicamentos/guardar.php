<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../../modelos/medicamentos.php';

$_POST['med_nombre'] = ucwords(htmlspecialchars($_POST['med_nombre'] ?? ''));
$_POST['med_vencimiento'] = htmlspecialchars($_POST['med_vencimiento'] ?? '');
$_POST['med_desc'] = ucwords(htmlspecialchars($_POST['med_desc'] ?? ''));
$_POST['med_presentacion'] = ucwords(htmlspecialchars($_POST['med_presentacion'] ?? ''));
if (isset($_POST['med_casa']) && $_POST['med_casa'] !== '') {
    $_POST['med_casa'] = filter_var($_POST['med_casa'], FILTER_VALIDATE_INT);
} else {
    $_POST['med_casa'] = null; 
}
$_POST['med_disponible'] = filter_var($_POST['med_disponible'] ?? '', FILTER_SANITIZE_NUMBER_INT);
$_POST['med_precio'] = filter_var($_POST['med_precio'] ?? '', FILTER_SANITIZE_NUMBER_INT);

if ($_POST['med_nombre'] == '' || $_POST['med_vencimiento'] == '' || $_POST['med_desc'] == '' || $_POST['med_presentacion'] == '' 
    || $_POST['med_disponible'] == '' || $_POST['med_precio'] == '' || $_POST['med_casa'] == null) {

    echo json_encode([
        'mensaje' => 'DEBE VALIDAR LOS DATOS',
        'codigo' => 2
    ]);

    exit;
} else {
    try {
        $nuevoMedicamento = new Medicamentos($_POST);
        $resultado = $nuevoMedicamento->guardar();
    
        if($resultado['resultado'] == 1){
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'MEDICAMENTO REGISTRADO CON EXITO',
                'post' => $_POST
            ]);
        } else {
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'NO SE REGISTRO EL MEDICAMENTO',
            ]);
        }
        
    } catch (Exception $e) {
        echo json_encode([
            'mensaje' => 'OCURRIO UN ERROR AL INTENTAR REGISTRAR EL MEDICAMENTO',
            'detalle' => $e->getMessage(),
            'codigo' => 0
        ]);
    }
}