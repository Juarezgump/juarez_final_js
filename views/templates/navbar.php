<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-danger">
  <div class="container-fluid">
    <a class="navbar-brand fs-3 fw-bold text-warning" href="../../views/troza/troza.php" style="text-shadow: 1px 1px 2px #000;">
      <i class="bi bi-prescription2"></i> "LA TROZA"
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active fw-bold fs-5 text-white" aria-current="page" href="../../views/inicio/inicio.php" style="text-shadow: 1px 1px 1px rgba(255,255,255,0.5);">
            <i class="bi bi-house-door-fill me-1"></i>Inicio
          </a>
        </li>
        
        <!-- GESTIÓN FARMACÉUTICA -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold fs-5 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-shadow: 1px 1px 1px rgba(255,255,255,0.5);">
            <i class="bi bi-capsule-pill me-1"></i>Farmacia
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="../../views/medicamentos/guardarMed.php"><i class="bi bi-medicine-bottle me-2"></i>Medicamentos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../../views/casa/guardarCasa.php"><i class="bi bi-building me-2"></i>Proveedores</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../../views/ventas/guardarVenta.php"><i class="bi bi-cart-plus me-2"></i>Ventas</a></li>
          </ul>
        </li>
        
        <!-- GESTIÓN PERSONAS -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold fs-5 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-shadow: 1px 1px 1px rgba(255,255,255,0.5);">
            <i class="bi bi-people-fill me-1"></i>Personas
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="../../views/clientes/guardarCliente.php"><i class="bi bi-person-plus-fill me-2"></i>Clientes</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../../views/trabajadores/guardarTrabajador.php"><i class="bi bi-person-plus-fill me-2"></i>Trabajadores</a></li>
          </ul>
        </li>
        
        <!-- APIS -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold fs-5 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-shadow: 1px 1px 1px rgba(255,255,255,0.5); background-color: #a61b1b; border-radius: 5px;">
            <i class="bi bi-cloud-fill me-1"></i>APIs
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="../../views/library/index.php"><i class="bi bi-book me-2"></i>Librería</a></li>
            <li><a class="dropdown-item" href="../../views/lyrics/index.php"><i class="bi bi-music-note-beamed me-2"></i>Letras de Canciones</a></li>
            <li><a class="dropdown-item" href="../../views/nasa/index.php"><i class="bi bi-stars me-2"></i>Imágenes NASA</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid" style="margin-top: 70px; padding-top: 20px;">