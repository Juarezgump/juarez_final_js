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
            <h1 class="text-center mb-2">REGISTRO DE VENTAS</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form action="#" method="POST" class="form-control" id="formVenta">
                <input type="hidden" name="venta_id" id="venta_id" value="">
                <div class="mb-3">
                    <label for="med_venta" class="form-label">Seleccione el Nombre del Medicamento</label>
                    <select name="med_venta" id="med_venta" class="form-select" required>
                        <option value="" selected disabled>Medicamentos</option>
                        <?php
                            require_once '../../modelos/medicamentos.php';
                            $med= new Medicamentos();
                            $medicamentos = $med->listarMedicamentos();
                            foreach($medicamentos as $d){
                                echo "<option value='{$d['med_id']}'>{$d['med_nombre']}</option>";
                            }
                        ?>
                    </select>
                </div>          
                <div class="row mb-3">
                    <label for="venta_cant">CANTIDAD DE UNIDADES VENDIDAS</label>
                    <input type="number" name="venta_cant" id="venta_cant" class="form-control" placeholder="Ejemplo: (1-100)" required>
                </div>

                <div class="mb-3">
                    <label for="med_cliente" class="form-label">Seleccione el Nombre del Cliente</label>
                    <select name="med_cliente" id="med_cliente" class="form-select" required>
                        <option value="" selected disabled>Clientes</option>
                        <?php
                            require_once '../../modelos/cliente.php';
                            $cli= new Cliente();
                            $clientes = $cli->listarClientes();
                            foreach($clientes as $c){
                                echo "<option value='{$c['cli_id']}'>{$c['cli_nombres']}</option>";
                            }
                        ?>
                    </select>
                </div>  
                <div class="mb-3">
                    <label for="med_tra" class="form-label">Seleccione el Nombre del Trabajador</label>
                    <select name="med_tra" id="med_tra" class="form-select" required>
                        <option value="" selected disabled>Trabajadores</option>
                        <?php
                            require_once '../../modelos/trabajadores.php';
                            $tra= new Trabajadores();
                            $trabajadores = $tra->listarTrabajadores();
                            foreach($trabajadores as $t){
                                echo "<option value='{$t['tra_id']}'>{$t['tra_nombres']}</option>";
                            }
                        ?>
                    </select>
                </div>  
               
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <button type="submit" id="btnguardar" class="btn btn-success w-100">Registrar</button>
                    </div>
                    <div class="col-lg-6">
                        <button type="button" id="btnBuscar" class="btn btn-secondary w-100">Buscar</button>
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
                        <th>Nombre del Medicamento</th>
                        <th>Cantidad de Medicamento</th>
                        <th>Nombre del Cliente</th>
                        <th>Nombre del Trabajador</th>
                    </tr>
                </thead>
                <tbody id="tabla_ventas">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../../src/js/venta/guardarVenta.js"></script>

<?php if($error): ?>
<div class="alert alert-danger" role="alert">
    <?= $mensajeError ?>
</div>
<?php endif; ?>
<?php
include_once '../templates/footer.php';
?>