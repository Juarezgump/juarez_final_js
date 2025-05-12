<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);
require '../../modelos/cliente.php';

if (isset($_GET['cli_id'])) {
    $_GET['cli_id'] = filter_var(base64_decode($_GET['cli_id']), FILTER_SANITIZE_NUMBER_INT);
    $modificar = new Cliente();
    $ClienteModificar = $modificar->buscarID($_GET['cli_id']);

    if ($ClienteModificar) {
        echo json_encode([
            'codigo' => 1,
            'datos' => $ClienteModificar
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
    $_POST['cli_nombres'] = ucwords(htmlspecialchars($_POST['cli_nombres'] ?? ''));
    $_POST['cli_edad'] = filter_var($_POST['cli_edad'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['cli_dpi'] = filter_var($_POST['cli_dpi'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['cli_nit'] = filter_var($_POST['cli_nit'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['cli_telefono'] = filter_var($_POST['cli_telefono'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $_POST['cli_correo'] = filter_var($_POST['cli_correo'] ?? '', FILTER_SANITIZE_EMAIL);
    $_POST['cli_genero'] = ucwords(htmlspecialchars($_POST['cli_genero'] ?? ''));
    $_POST['cli_direccion'] = ucwords(htmlspecialchars($_POST['cli_direccion'] ?? ''));

    if ($_POST['cli_nombres'] == '' || $_POST['cli_edad'] == '' || $_POST['cli_dpi'] == '' || $_POST['cli_nit'] == ''
        || $_POST['cli_telefono'] == '' || $_POST['cli_correo'] == '' || $_POST['cli_genero'] == '' || $_POST['cli_direccion'] == '') {
        echo json_encode([
            'mensaje' => 'DEBE VALIDAR LOS DATOS',
            'codigo' => 2
        ]);
        exit;
    } else {
        try {
            $clienteNuevo = new Cliente($_POST);
            $modificar = $clienteNuevo->modificar();

            if ($modificar['resultado'] == 1) {
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'CLIENTE MODIFICADO CORRECTAMENTE'
                ]);
                exit;
            } else {
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'CLIENTE MODIFICADO INCORRECTAMENTE'
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