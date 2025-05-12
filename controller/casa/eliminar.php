<?php
require "../../modelos/casa.php";
include_once '../../views/templates/header.php';
$_GET['casa_id'] = filter_var(base64_decode($_GET['casa_id']), FILTER_SANITIZE_NUMBER_INT);

$eliminar = new Casa($_GET);

try{
    $clienteEliminar = $eliminar->eliminar();

    $resultado =[
        'mensaje' => 'CASA/PROVEEDOR ELIMINADO EXITOASAMENTE',
        'codigo' => 1
    ];
}catch (PDOException $pe){
    $resultado=[
        'mensaje' => 'OCURRIO UN ERROR AL ELIMINAR LA CASA/PROVEEDOR DE LA BASE DE DATOS',
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
        <a href="../../views/casa/buscarCasa.php" class="btn btn-primary w-100">Regresar</a>
    </div>
</div>


<?php include_once '../../views/templates/footer.php'; ?>
