<?php include_once '../templates/header.php'; ?>

<div class="container mt-3">
    <div class="row">
        <div class="col">
            <h1 class="text-center mb-4">Imagen Astronómica del Día (NASA)</h1>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body text-center">
                    <div id="nasa-loading" class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                    </div>
                    <h2 id="nasa-title" class="card-title mb-3"></h2>
                    <p id="nasa-date" class="text-muted"></p>
                    <div class="text-center mb-3">
                        <img id="nasa-image" class="img-fluid rounded" src="" alt="Imagen astronómica del día" style="max-height: 500px;">
                    </div>
                    <p id="nasa-description" class="card-text text-start"></p>
                    <p id="nasa-error" class="text-danger"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../../src/js/nasa/images.js"></script>

<?php include_once '../templates/footer.php'; ?>