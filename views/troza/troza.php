<?php include_once '../templates/headertroza.php'; ?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../../views/images/medic.png" class="d-block w-100" alt="Imagen 1" height="560px">
            <div class="carousel-caption d-none d-md-block" style="color: black;">
            </div>
        </div>
        <div class="carousel-item">
            <img src="../../views/images/med.jpg" class="d-block w-100" alt="Imagen 2" height="560px">
            <div class="carousel-caption d-none d-md-block" style="color: black;">
            </div>
        </div>
        <div class="carousel-item">
            <img src="../../views/images/med3.jpg" class="d-block w-100" alt="Imagen 3" height="560px">
            <div class="carousel-caption d-none d-md-block" style="color: black;">
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center mb-4">
            <h1>Bienvenido a "La Troza"</h1>
            <p class="lead">La mejor Farmaceutica en el Mundo</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <img src="../../views/images/med4.jpg" class="card-img-top" alt="Característica 1">
                <div class="card-body">
                    <h5 class="card-title text-info">Diclofenaco</h5>
                    <p class="card-text">Alivia todos tus dolores. </p>
                    <a href="#" class="btn btn-info text-white">Más información</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <img src="../../views/images/med5.jpg" class="card-img-top" alt="Característica 2">
                <div class="card-body">
                    <h5 class="card-title text-info">Paracetamol</h5>
                    <p class="card-text">Alivia tus dolores de estoamgo</p>
                    <a href="#" class="btn btn-info text-white">Más información</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <img src="../../views/images/med6.jpg" class="card-img-top" alt="Característica 3">
                <div class="card-body">
                    <h5 class="card-title text-info">Tramadol</h5>
                    <p class="card-text">Rapido alivio del resfrio.</p>
                    <a href="#" class="btn btn-info text-white">Más información</a>
                </div>
            </div>
        </div>
    </div>



<?php include_once '../templates/footertroza.php'; ?>