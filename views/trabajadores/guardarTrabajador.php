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
                $mensajeError = "LA EDAD DEBE SER UN NÚMERO";
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
            <h1 class="text-center mb-2">REGISTRO DE TRABAJADORES</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form action="#" method="POST" class="form-control" id="formTrabajador">
                <div class="row mb-3">
                    <label for="tra_nombres">INGRESE EL NOMBRE DEL TRABAJADOR</label>
                    <input type="text" name="tra_nombres" id="tra_nombres" class="form-control" placeholder="Ingresa el nombre" required>
                    <input type="hidden" name="tra_id" class="form-control">
                </div>
                <div class="row mb-3">
                    <label for="tra_edad">INGRESE LA EDAD DEL TRABAJADOR</label>
                    <input type="number" name="tra_edad" id="tra_edad" class="form-control" placeholder="Ingresa la edad" required>
                </div>
                <div class="row mb-3">
                    <label for="tra_dpi">INGRESE EL NUMERO DE DPI DEL TRABAJADOR</label>
                    <input type="number" name="tra_dpi" id="tra_dpi" class="form-control" placeholder="Ingresa el numero de dpi" required>
                </div>

                <div class="row mb-3">
                    <label for="tra_puesto">INGRESA EL PUESTO DEL TRABAJADOR</label>
                    <input type="text" name="tra_puesto" id="tra_puesto" class="form-control" placeholder="Ingresa el puesto" required>
                </div>

                <div class="row mb-3">
                    <label for="tra_telefono">INGRESE EL NUMERO DEL TRABAJADOR</label>
                    <input type="number" name="tra_telefono" id="tra_telefono" class="form-control" placeholder="Ingresa el numero de teléfono" required>
                </div>
                <div class="row mb-3">
                    <label for="tra_correo">INGRESE EL CORREO ELECTRONICO DEL TRABAJADOR</label>
                    <input type="email" name="tra_correo" id="tra_correo" class="form-control" placeholder="jose@gmail.com" required>
                </div>
                <div class="row mb-3">
                    <label for="tra_salario">INGRESE EL SALARIO DEL TRABAJADOR</label>
                    <input type="number" name="tra_salario" id="tra_salario" class="form-control" placeholder="Ingresa el Salario" required>
                </div>
                <div class="row mb-3">
                    <label for="tra_genero">INGRESE EL GENERO DEL TRABAJADOR</label>
                    <input type="text" name="tra_genero" id="tra_genero" class="form-control" placeholder="Ingresa el genero (Masculino o Femenino)" required>
                </div>
                <div class="row mb-3">
                    <label for="tra_direccion">INGRESE LA DIRECCION DEL TRABAJADOR</label>
                    <input type="text" name="tra_direccion" id="tra_direccion" class="form-control" placeholder="Ingresa la direccion" required>
                </div>
               
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <button type="submit" form="formTrabajador" id="btnguardar" class="btn btn-success w-100">Registrar</button>
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
                        <th>Edad</th>
                        <th>DPI</th>
                        <th>Puesto</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Salario</th>
                        <th>Género</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla_trabajadores">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../../src/js/trabajador/guardarTrabajador.js"></script>

<?php if($error): ?>
<div class="alert alert-danger" role="alert">
    <?= $mensajeError ?>
</div>
<?php endif; ?>
<?php
include_once '../templates/footer.php';
?>