<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../../modelos/trabajadores.php';

try {
    $_POST['tra_nombres'] = htmlspecialchars($_POST['tra_nombres'] ?? '');
    $_POST['tra_edad'] = filter_var($_POST['tra_edad'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['tra_dpi'] = filter_var($_POST['tra_dpi'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['tra_puesto'] = htmlspecialchars($_POST['tra_puesto'] ?? '');
    $_POST['tra_telefono'] = filter_var($_POST['tra_telefono'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['tra_correo'] = filter_var($_POST['tra_correo'] ?? '', FILTER_SANITIZE_EMAIL);
    $_POST['tra_salario'] = htmlspecialchars($_POST['tra_salario'] ?? '');
    $_POST['tra_genero'] = htmlspecialchars($_POST['tra_genero'] ?? '');
    $_POST['tra_direccion'] = htmlspecialchars($_POST['tra_direccion'] ?? '');

    $tra_consulta = new Trabajadores($_POST);
    $trabajador = $tra_consulta->buscar();
    
    if($trabajador){
        echo json_encode([
            'mensaje' => 'Datos encontrados',
            'datos' => $trabajador,
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
        'mensaje' => 'Ocurrio un error al buscar al trabajador',
        'detalle' => $e->getMessage(),
        'codigo' => 0
    ]);
}