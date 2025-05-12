<?php
require "../../modelos/trabajadores.php";
include_once '../../views/templates/header.php';
$_GET['tra_id'] = filter_var(base64_decode($_GET['tra_id']), FILTER_SANITIZE_NUMBER_INT);

$eliminar = new Trabajadores($_GET);

try{
    $clienteEliminar = $eliminar->eliminar();

    $resultado =[
        'mensaje' => 'TRABAJADOR ELIMINADO EXITOASAMENTE',
        'codigo' => 1
    ];
}catch (PDOException $pe){
    $resultado=[
        'mensaje' => 'OCURRIO UN ERROR AL ELIMINAR EL TRABAJADOR DE LA BASE DE DATOS',
        'detalle' => $pe->getMessage(),
        'codigo' => 0
    ];
}catch (Exception $e){
    $resultado =[
        'mensaje' => 'OCURRIO UN ERROR',
        'detalle' => $e->getMessage(),
        'codigo' => 0
    ];
}

$alertas = ['danger', 'success', 'warning'];
  
include_once '../../views/templates/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-6 alert alert-<?=$alertas[$resultado['codigo']] ?>" role="alert">
        <?= $resultado['mensaje'] ?>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <a href="../../views/trabajadores/buscarTrabajador.php" class="btn btn-primary w-100">Regresar</a>
    </div>
</div>


<?php include_once '../../views/templates/footer.php'; ?>
