<?php 
include_once '../templates/header.php'; 

$error = false;
$mensajeError = "DEBE COMPLETAR TODOS LOS DATOS";

if(isset($_GET['error'])) {
    $error = true;
    if(isset($_GET['mensaje'])) {
        $mensajeError = $_GET['mensaje'];
    } else {
        switch($_GET['error']) {
            case '1':
                $mensajeError = "DEBE COMPLETAR TODOS LOS DATOS";
                break;
            case '2':
                $mensajeError = "ERROR DE VALIDACIÓN";
                break;
            default:
                $mensajeError = "OCURRIÓ UN ERROR EN EL FORMULARIO";
        }
    }
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col">
            <h1 class="text-center mb-2">REGISTRO DE CASAS/PROVEEDORES</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form action="#" method="POST" class="form-control" id="formCasa">
                <input type="hidden" name="casa_id" id="casa_id" value="">
                <div class="row mb-3">
                    <label for="casa_nombre">INGRESE EL NOMBRE DE LA CASA</label>
                    <input type="text" name="casa_nombre" id="casa_nombre" class="form-control" placeholder="Ingresa el nombre del proveedor" required>
                </div>
                <div class="row mb-3">
                    <label for="casa_direccion">INGRESE LA DIRECCION DEL PROVEEDOR/CASA</label>
                    <input type="text" name="casa_direccion" id="casa_direccion" class="form-control" placeholder="Ingresa la direccion" required>
                </div>
                <div class="row mb-3">
                    <label for="casa_telefono">INGRESE EL NUMERO DE LA CASA/PROVEEDOR</label>
                    <input type="number" name="casa_telefono" id="casa_telefono" class="form-control" placeholder="Ingresa el numero de telefono de la casa/proveedor" required>
                </div>

                <div class="row mb-3">
                    <label for="casa_jefe">INGRESE EL NOMBRE DEL JEFE DE LA CASA/PROVEEDOR</label>
                    <input type="text" name="casa_jefe" id="casa_jefe" class="form-control" placeholder="Ingresa el nombre del jefe" required>
                </div>
               
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <button type="submit" id="btnguardar" class="btn btn-success w-100">Registrar</button>
                    </div>
                    <div class="col-lg-6">
                        <button type="button" id="btnBuscar" class="btn btn-secondary w-100">Buscar</button>
                    </div>
                    <div class="col-lg-6">
                        <button type="button" id="btnModificar" class="btn btn-secondary w-100 d-none">Modificar</button>
                    </div>
                    <div class="col-lg-6">
                        <button type="button" id="btnCancelar" class="btn btn-secondary w-100 d-none">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row mt-4" id="divTabla">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Jefe</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla_casas">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../../src/js/casa/guardarCasa.js"></script>

<?php if($error): ?>
<div class="alert alert-danger" role="alert">
    <?= $mensajeError ?>
</div>
<?php endif; ?>
<?php
include_once '../templates/footer.php';
?>