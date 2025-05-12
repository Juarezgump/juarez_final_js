<?php

header('Content-Type: application/json; charset=utf-8');


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../../modelos/cliente.php';

$_POST['cli_nombres'] = ucwords(htmlspecialchars($_POST['cli_nombres'] ?? ''));
if (isset($_POST['cli_edad'])) {
    if (filter_var($_POST['cli_edad'], FILTER_VALIDATE_INT) === false) {
        header('Location: ../../views/clientes/guardarCliente.php?error=2');
        exit;
    }
    $_POST['cli_edad'] = filter_var($_POST['cli_edad'], FILTER_SANITIZE_NUMBER_INT);
}
$_POST['cli_dpi'] = filter_var($_POST['cli_dpi'] ?? '', FILTER_SANITIZE_NUMBER_INT);
$_POST['cli_nit'] = filter_var($_POST['cli_nit'] ?? '', FILTER_SANITIZE_NUMBER_INT);
$_POST['cli_telefono'] = filter_var($_POST['cli_telefono'] ?? '', FILTER_SANITIZE_NUMBER_INT);
$_POST['cli_correo'] = filter_var($_POST['cli_correo'] ?? '', FILTER_SANITIZE_EMAIL);
$_POST['cli_genero'] = ucwords(htmlspecialchars($_POST['cli_genero'] ?? ''));
$_POST['cli_direccion'] = ucwords(htmlspecialchars($_POST['cli_direccion'] ?? ''));

if ($_POST['cli_nombres']== '' || $_POST['cli_edad']== '' || $_POST['cli_dpi']== '' || $_POST['cli_nit']== '' 
|| $_POST['cli_telefono']== '' || $_POST['cli_correo']== '' || $_POST['cli_genero']== '' || $_POST['cli_direccion']== '') {

    $resultado =[
        'mensaje' => 'DEBE VALIDAR LOS DATOS',
        'codigo' => 2
    ];

    header('Location: ../../views/clientes/gaurdarCliente.php?error=1');
    exit;
}else{
    try {


        $nuevoUsuario = new Cliente($_POST);
        $usuario = $nuevoUsuario->guardar();
    
if($usuario['resultado'] == 1){
    echo json_encode([
        'codigo' => 1,
        'mensaje' => 'CLIENTE REGISTRADO CON EXITO',
        'post' => $_POST
    ]);
}else{
    echo json_encode([
        'codigo' => 0,
        'mensaje' => 'NO SE REGISTRO EL CLIENTE',
    ]);
}
        
    } catch (Exception $e) {
        echo json_encode([
            'mensaje' => 'OCURRIO UN ERROR AL INTNETAR REGISTAR AL CLIENTE',
            'detalle' => $e->getMessage(),
            'codigo' => 0
        ]);
    }
    
}

