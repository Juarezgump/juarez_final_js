<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);
require '../../modelos/medicamentos.php';

if (isset($_GET['med_id'])) {
    $_GET['med_id'] = filter_var(base64_decode($_GET['med_id']), FILTER_SANITIZE_NUMBER_INT);
    $modificar = new Medicamentos();
    $medicamentoModificar = $modificar->buscarID($_GET['med_id']);

    if ($medicamentoModificar) {
        echo json_encode([
            'codigo' => 1,
            'datos' => $medicamentoModificar
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
            $medicamentoNuevo = new Medicamentos($_POST);
            $modificar = $medicamentoNuevo->modificar();

            if ($modificar['resultado'] == 1) {
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'MEDICAMENTO MODIFICADO CORRECTAMENTE'
                ]);
                exit;
            } else {
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'MEDICAMENTO MODIFICADO INCORRECTAMENTE'
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