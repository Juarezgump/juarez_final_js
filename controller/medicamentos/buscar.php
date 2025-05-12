<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../../modelos/medicamentos.php';

try {
    $_POST['med_nombre'] = htmlspecialchars($_POST['med_nombre'] ?? '');
    $_POST['med_vencimiento'] = htmlspecialchars($_POST['med_vencimiento'] ?? '');
    $_POST['med_desc'] = htmlspecialchars($_POST['med_desc'] ?? '');
    $_POST['med_presentacion'] = htmlspecialchars($_POST['med_presentacion'] ?? '');
    if (isset($_POST['med_casa']) && $_POST['med_casa'] !== '') {
        $_POST['med_casa'] = filter_var($_POST['med_casa'], FILTER_VALIDATE_INT);
    } else {
        $_POST['med_casa'] = null; 
    }
    $_POST['med_disponible'] = filter_var($_POST['med_disponible'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['med_precio'] = filter_var($_POST['med_precio'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    
    $medConsulta = new Medicamentos($_POST);
    $medicamento = $medConsulta->buscar();
    
    if($medicamento){
        echo json_encode([
            'mensaje' => 'Datos encontrados',
            'datos' => $medicamento,
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
        'mensaje' => 'Ocurrio un error al buscar el medicamento',
        'detalle' => $e->getMessage(),
        'codigo' => 0
    ]);
}