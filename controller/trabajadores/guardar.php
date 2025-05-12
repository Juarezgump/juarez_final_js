<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../../modelos/trabajadores.php';

$_POST['tra_nombres'] = ucwords(htmlspecialchars($_POST['tra_nombres'] ?? ''));
if (isset($_POST['tra_edad'])) {
    if (filter_var($_POST['tra_edad'], FILTER_VALIDATE_INT) === false) {
        header('Location: ../../views/trabajadores/guardarTrabajador.php?error=2');
        exit;
    }
    $_POST['tra_edad'] = filter_var($_POST['tra_edad'], FILTER_SANITIZE_NUMBER_INT);
}
$_POST['tra_dpi'] = filter_var($_POST['tra_dpi'] ?? '', FILTER_SANITIZE_NUMBER_INT);
$_POST['tra_puesto'] = ucwords(htmlspecialchars($_POST['tra_puesto'] ?? ''));
$_POST['tra_telefono'] = filter_var($_POST['tra_telefono'] ?? '', FILTER_SANITIZE_NUMBER_INT);
$_POST['tra_correo'] = filter_var($_POST['tra_correo'] ?? '', FILTER_SANITIZE_EMAIL);
$_POST['tra_salario'] = htmlspecialchars($_POST['tra_salario'] ?? '');
$_POST['tra_genero'] = ucwords(htmlspecialchars($_POST['tra_genero'] ?? ''));
$_POST['tra_direccion'] = ucwords(htmlspecialchars($_POST['tra_direccion'] ?? ''));

if ($_POST['tra_nombres'] == '' || $_POST['tra_edad'] == '' || $_POST['tra_dpi'] == '' || $_POST['tra_puesto'] == '' 
    || $_POST['tra_telefono'] == '' || $_POST['tra_correo'] == '' || $_POST['tra_salario'] == '' || $_POST['tra_genero'] == '' || $_POST['tra_direccion'] == '') {

    echo json_encode([
        'mensaje' => 'DEBE VALIDAR LOS DATOS',
        'codigo' => 2
    ]);

    exit;
}else{
    try {
        $nuevoTrabajador = new Trabajadores($_POST);
        $resultado = $nuevoTrabajador->guardar();
    
        if($resultado['resultado'] == 1){
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'TRABAJADOR REGISTRADO CON EXITO',
                'post' => $_POST
            ]);
        }else{
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'NO SE REGISTRO EL TRABAJADOR',
            ]);
        }
        
    } catch (Exception $e) {
        echo json_encode([
            'mensaje' => 'OCURRIO UN ERROR AL INTENTAR REGISTRAR AL TRABAJADOR',
            'detalle' => $e->getMessage(),
            'codigo' => 0
        ]);
    }
}