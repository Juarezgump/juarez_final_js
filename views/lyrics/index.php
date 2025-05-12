<?php include_once '../templates/header.php'; ?>

<div class="container mt-3">
    <div class="row">
        <div class="col">
            <h1 class="text-center mb-4">Buscador de Letras de Canciones</h1>
        </div>
    </div>
    
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
            <form id="lyrics-search-form" class="form-control p-4">
                <div class="mb-3">
                    <label for="artist-input" class="form-label">Artista:</label>
                    <input type="text" id="artist-input" class="form-control" placeholder="Ej: Coldplay, Ed Sheeran" required>
                </div>
                <div class="mb-3">
                    <label for="song-input" class="form-label">Canción:</label>
                    <input type="text" id="song-input" class="form-control" placeholder="Ej: Viva la Vida, Perfect" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Buscar Letra</button>
                </div>
            </form>
        </div>
    </div>
    
    <div id="lyrics-loading" class="d-none text-center mb-4">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div id="lyrics-result"></div>
        </div>
    </div>
</div>

<script src="../../src/js/lyrics/buscar.js"></script>

<?php include_once '../templates/footer.php'; ?>