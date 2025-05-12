<?php
// Evitar espacios antes de la cabecera PHP
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '0'); // Desactivamos la visualización de errores para evitar que se mezclen con el JSON
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

try {
    require '../../modelos/casa.php';

    if (isset($_GET['casa_id'])) {
        $_GET['casa_id'] = filter_var(base64_decode($_GET['casa_id']), FILTER_SANITIZE_NUMBER_INT);
        $modificar = new Casa();
        $casaModificar = $modificar->buscarID($_GET['casa_id']);

        if ($casaModificar) {
            echo json_encode([
                'codigo' => 1,
                'datos' => $casaModificar
            ]);
        } else {
            echo json_encode([
                'codigo' => 0,
                'datos' => "No se encontro registro"
            ]);
        }
    } else {
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
            $casaNueva = new Casa($_POST);
            $modificar = $casaNueva->modificar();

            if ($modificar['resultado'] == 1) {
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'CASA/PROVEEDOR MODIFICADO CORRECTAMENTE'
                ]);
            } else {
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'CASA/PROVEEDOR MODIFICADO INCORRECTAMENTE'
                ]);
            }
        }
    }
} catch (PDOException $pe) {
    echo json_encode([
        'mensaje' => 'OCURRIO ERROR EN LA EJECUCION',
        'detalle' => $pe->getMessage(),
        'codigo' => 0
    ]);
} catch (Exception $e) {
    echo json_encode([
        'mensaje' => 'OCURRIO ERROR EN LA EJECUCION',
        'detalle' => $e->getMessage(),
        'codigo' => 0
    ]);
}
