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
            <h1 class="text-center mb-2">REGISTRO DE MEDICAMENTOS</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form action="#" method="POST" class="form-control" id="formMedicamento">
                <div class="row mb-3">
                    <label for="med_nombre">INGRESE EL NOMBRE DEL MEDICAMENTO</label>
                    <input type="text" name="med_nombre" id="med_nombre" class="form-control" placeholder="Ingresa el Nombre del Medicamento" required>
                    <input type="hidden" name="med_id" class="form-control">
                </div>
                <div class="row mb-3">
                    <label for="med_vencimiento">INGRESE LA FECHA DE VENCIMIENTO DEL MEDICAMENTO</label>
                    <input type="text" name="med_vencimiento" id="med_vencimiento" class="form-control" placeholder="Ejemplo: 11/04/2025" required>
                </div>
                <div class="row mb-3">
                    <label for="med_desc">INGRESE LA DESCRIPCION DEL MEDICAMENTO</label>
                    <input type="text" name="med_desc" id="med_desc" class="form-control" placeholder="Ejemplo: Pastillas para el dolor" required>
                </div>

                <div class="row mb-3">
                    <label for="med_presentacion">INGRESE LA PRESENTACION DEL MEDICAMENTO</label>
                    <input type="text" name="med_presentacion" id="med_presentacion" class="form-control" placeholder="Ejemplo: Tabletas" required>
                </div>
                <div class="mb-3">
                    <label for="med_casa" class="form-label">Seleccione la Casa</label>
                        <select name="med_casa" id="med_casa" class="form-select" required>
                            <option value="" selected disabled>Casas/Proveedores</option>
                                <?php
                                    require_once '../../modelos/casa.php';
                                    $casa= new Casa();
                                    $casas = $casa->listarCasas();
                                    foreach($casas as $c){
                                    echo "<option value='{$c['casa_id']}'>{$c['casa_nombre']}</option>";
                                    }
                                ?>
                        </select>
                </div>           
                <div class="row mb-3">
                    <label for="med_disponible">INGRESE LA CANTIDAD DE UNIDADES</label>
                    <input type="number" name="med_disponible" id="med_disponible" class="form-control" placeholder="(1-10000)" required>
                </div>
                <div class="row mb-3">
                    <label for="med_precio">INGRESE EL PRECIO DEL MEDICAMENTO</label>
                    <input type="number" name="med_precio" id="med_precio" class="form-control" placeholder="Q......" required>
                </div>
               
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <button type="submit" form="formMedicamento" id="btnguardar" class="btn btn-success w-100">Registrar</button>
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
                        <th>Vencimiento</th>
                        <th>Descripción</th>
                        <th>Presentación</th>
                        <th>Casa/Proveedor</th>
                        <th>Disponibilidad</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla_medicamentos">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../../src/js/medicamento/guardarMedicamento.js"></script>

<?php if($error): ?>
<div class="alert alert-danger" role="alert">
    <?= $mensajeError ?>
</div>
<?php endif; ?>
<?php
include_once '../templates/footer.php';
?>