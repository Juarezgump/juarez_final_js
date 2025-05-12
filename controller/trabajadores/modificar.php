<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);
require '../../modelos/trabajadores.php';

if (isset($_GET['tra_id'])) {
    $_GET['tra_id'] = filter_var(base64_decode($_GET['tra_id']), FILTER_SANITIZE_NUMBER_INT);
    $modificar = new Trabajadores();
    $trabajadorModificar = $modificar->buscarID($_GET['tra_id']);

    if ($trabajadorModificar) {
        echo json_encode([
            'codigo' => 1,
            'datos' => $trabajadorModificar
        ]);
        exit;
    } else {
        echo json_encode([
            'codigo' => 0,
            'datos' => "No se encontro registro"
        ]);
        exit;
    }
    exit;
} else {
    $_POST['tra_nombres'] = ucwords(htmlspecialchars($_POST['tra_nombres'] ?? ''));
    $_POST['tra_edad'] = filter_var($_POST['tra_edad'] ?? '', FILTER_SANITIZE_NUMBER_INT);
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
    } else {
        try {
            $trabajadorNuevo = new Trabajadores($_POST);
            $modificar = $trabajadorNuevo->modificar();

            if ($modificar['resultado'] == 1) {
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'TRABAJADOR MODIFICADO CORRECTAMENTE'
                ]);
                exit;
            } else {
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'TRABAJADOR MODIFICADO INCORRECTAMENTE'
                ]);
                exit;
            }
        } catch (PDOException $pe) {
            echo json_encode([
                'mensaje' => 'OCURRIO ERROR EN LA EJECUCION',
                'detalle' => $pe->getMessage(),
                'codigo' => 0
            ]);
            exit;
        } catch (Exception $e) {
            echo json_encode([
                'mensaje' => 'OCURRIO ERROR EN LA EJECUCION',
                'detalle' => $e->getMessage(),
                'codigo' => 0
            ]);
            exit;
        }
    }
}
?>