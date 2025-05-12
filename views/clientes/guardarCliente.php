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
            <h1 class="text-center mb-2">REGISTRO DE CLIENTES</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-12">
            <form action="#" method="POST" class="form-control" id="formCliente">
                <div class="row mb-3">
                    <label for="cli_nombres">INGRESE EL NOMBRE DEL CLIENTE</label>
                    <input type="text" name="cli_nombres" id="cli_nombres" class="form-control" placeholder="Ingresa el nombre del Cliente" required>
                    <input type="hidden" name="cli_id" class="form-control">
                </div>
                <div class="row mb-3">
                    <label for="cli_edad">INGRESE LA EDAD DEL CLIENTE</label>
                    <input type="number" name="cli_edad" id="cli_edad" class="form-control" placeholder="Ingresa la edad del Cliente" required>
                </div>
                <div class="row mb-3">
                    <label for="cli_dpi">INGRESE EL NUMERO DE DPI DEL CLIENTE</label>
                    <input type="number" name="cli_dpi" id="cli_dpi" class="form-control" placeholder="Ingresa el numero de DPI del Cliente" required>
                </div>

                <div class="row mb-3">
                    <label for="cli_nit">INGRESE EL NUMERO DE NIT DEL CLIENTE</label>
                    <input type="number" name="cli_nit" id="cli_nit" class="form-control" placeholder="Ingresa el numero de NIT del Cliente" required>
                </div>

                <div class="row mb-3">
                    <label for="cli_telefono">INGRESE EL NUMERO DE TELEFONO CLIENTE</label>
                    <input type="number" name="cli_telefono" id="cli_telefono" class="form-control" placeholder="Ingresa el numero de Telefono del Cliente" required>
                </div>
                <div class="row mb-3">
                    <label for="cli_correo">INGRESE EL CORREO ELECTRONICO DEL CLIENTE</label>
                    <input type="email" name="cli_correo" id="cli_correo" class="form-control" placeholder="jose@gmail.com" required>
                </div>
               
                <div class="row mb-3">
                    <label for="cli_genero">INGRESE EL GENERO DEL CLIENTE</label>
                    <input type="text" name="cli_genero" id="cli_genero" class="form-control" placeholder="Ingresa el Genero (Masculino o Femenino)" required>
                </div>
                <div class="row mb-3">
                    <label for="cli_direccion">INGRESE LA DIRECCION DEL CLIENTE</label>
                    <input type="text" name="cli_direccion" id="cli_direccion" class="form-control" placeholder="Ingresa la direccion del cliente" required>
                </div>
               
                <div class="row justify-content-center">
                    <div class="col-lg-6 mb-2">
                        <button type="submit" form="formCliente" id="btnguardar" class="btn btn-success w-100">Registrar</button>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <button type="button" id="btnBuscar" class="btn btn-secondary w-100">Buscar</button>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <button type="button" id="btnModificar" class="btn btn-secondary w-100 d-none">Modificar</button>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <button type="button" id="btnCancelar" class="btn btn-secondary w-100 d-none">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-lg-4 col-md-12">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Noticias de Salud</h5>
                </div>
                <div class="card-body" id="noticias-salud">
                    <p class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Cargando noticias...</span>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php if($error): ?>
    <div class="row mt-3">
        <div class="col">
            <div class="alert alert-danger" role="alert">
                <?php echo $mensajeError; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

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
                            <th>NIT</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Género</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_clientes">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../../src/js/cliente/guardar.js"></script>

<?php
include_once '../templates/footer.php';
?>