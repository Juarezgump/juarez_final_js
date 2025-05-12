<?php include_once '../templates/header.php'; ?>

<div class="container mt-3">
    <div class="row">
        <div class="col">
            <h1 class="text-center mb-4">Buscador de Libros</h1>
        </div>
    </div>
    
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
            <form id="book-search-form" class="form-control p-4">
                <div class="mb-3">
                    <label for="book-search" class="form-label">Buscar libros:</label>
                    <input type="text" id="book-search" class="form-control" placeholder="Título, autor o tema" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div>
    </div>
    
    <div id="book-loading" class="d-none text-center mb-4">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div id="book-results"></div>
        </div>
    </div>
</div>

<script src="../../src/js/library/buscar.js"></script>

<?php include_once '../templates/footer.php'; ?>