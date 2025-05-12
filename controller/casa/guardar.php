<?php
// Evitar espacios antes de la cabecera PHP
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '0'); // Desactivamos la visualización de errores para evitar que se mezclen con el JSON
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

try {
    require '../../modelos/casa.php';

    $_POST['casa_nombre'] = ucwords(htmlspecialchars($_POST['casa_nombre'] ?? ''));
    $_POST['casa_direccion'] = ucwords(htmlspecialchars($_POST['casa_direccion'] ?? ''));
    $_POST['casa_telefono'] = filter_var($_POST['casa_telefono'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['casa_jefe'] = ucwords(htmlspecialchars($_POST['casa_jefe'] ?? ''));

    if ($_POST['casa_nombre'] == '' || $_POST['casa_direccion'] == '' || $_POST['casa_telefono'] == '' || $_POST['casa_jefe'] == '') {
        echo json_encode([
            'mensaje' => 'DEBE VALIDAR LOS DATOS',
            'codigo' => 2
        ]);
    } else {
        $nuevaCasa = new Casa($_POST);
        $resultado = $nuevaCasa->guardar();
    
        if($resultado['resultado'] == 1){
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'PROVEEDOR/CASA REGISTRADO CON EXITO',
                'post' => $_POST
            ]);
        } else {
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'NO SE REGISTRO EL PROVEEDOR/CASA',
            ]);
        }
    }
} catch (Exception $e) {
    echo json_encode([
        'mensaje' => 'OCURRIO UN ERROR AL INTENTAR REGISTRAR EL PROVEEDOR/CASA',
        'detalle' => $e->getMessage(),
        'codigo' => 0
    ]);
}
