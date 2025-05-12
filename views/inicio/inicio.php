<?php include_once '../templates/header.php'; ?>

<div class="container text-center">
    <h1 class="my-4">Bienvenidos a la Administración</h1>
    
    <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><i class="bi bi-people"></i> Clientes</h2>
                    <p class="card-text">Gestionar información de clientes</p>
                    <div class="d-grid">
                        <a href="../../views/clientes/guardarCliente.php" class="btn btn-primary btn-lg">
                            Gestionar Clientes
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><i class="bi bi-tag"></i>Trabajadores</h2>
                    <p class="card-text">Gestionar Trabajadores</p>
                    <div class="d-grid">
                        <a href="../../views/trabajadores/guardarTrabajador.php" class="btn btn-success btn-lg">
                            Gestionar Trabajadores
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><i class="bi bi-bicycle"></i>Casas/Proveedores</h2>
                    <p class="card-text">Administrar las Casas/Proveedores</p>
                    <div class="d-grid">
                        <a href="../../views/casa/guardarCasa.php" class="btn btn-danger btn-lg">
                            Gestionar Casas/Proveedores
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><i class="bi bi-bicycle"></i>Medicamentos</h2>
                    <p class="card-text">Administrar Inventario de Medicamentos</p>
                    <div class="d-grid">
                        <a href="../../views/medicamentos/guardarMed.php" class="btn btn-info btn-lg text-white">
                            Gestionar Medicamentos
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><i class="bi bi-bicycle"></i>Ventas</h2>
                    <p class="card-text">Gestionar Ventas</p>
                    <div class="d-grid">
                        <a href="../../views/ventas/guardarVenta.php" class="btn btn-warning btn-lg text-white">
                            Gestionar Ventas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../templates/footer.php'; ?>