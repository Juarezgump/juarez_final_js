<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../../modelos/cliente.php';

try {
    $_POST['cli_nombres'] = htmlspecialchars($_POST['cli_nombres'] ?? '');
    $_POST['cli_edad'] = filter_var($_POST['cli_edad'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['cli_dpi'] = filter_var($_POST['cli_dpi'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['cli_nit'] = filter_var($_POST['cli_nit'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['cli_telefono'] = filter_var($_POST['cli_telefono'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['cli_correo'] = filter_var($_POST['cli_correo'] ?? '', FILTER_SANITIZE_EMAIL);
    $_POST['cli_genero'] = htmlspecialchars($_POST['cli_genero'] ?? '');
    $_POST['cli_direccion'] = htmlspecialchars($_POST['cli_direccion'] ?? '');


    $cli_consulta = new Cliente($_POST);
    $cliente = $cli_consulta->buscar();
    
    if($cliente){
        echo json_encode([
            'mensaje' => 'Datos encontrados',
            'datos' => $cliente,
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
        'mensaje' => 'Ocurrio un error al buscar al cliente',
        'detalle' => $e->getMessage(),
        'codigo' => 0
    ]);
}

