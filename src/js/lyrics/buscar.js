const lyricsForm = document.getElementById('lyrics-search-form');
const lyricsResult = document.getElementById('lyrics-result');

const searchLyrics = async (e) => {
    e.preventDefault();
    const artist = document.getElementById('artist-input').value;
    const song = document.getElementById('song-input').value;
    
    if (!artist || !song) {
        lyricsResult.innerHTML = '<p class="alert alert-warning">Por favor ingresa el artista y la canción</p>';
        return;
    }
    
    lyricsResult.innerHTML = '<p>Buscando letra...</p>';
    
    try {
        const response = await fetch(`https://api.lyrics.ovh/v1/${encodeURIComponent(artist)}/${encodeURIComponent(song)}`);
        const data = await response.json();
        
        if (data.lyrics) {
            const formattedLyrics = data.lyrics.replace(/\n/g, '<br>');
            lyricsResult.innerHTML = `
                <div class="card">
                    <div class="card-header">
                        ${song} - ${artist}
                    </div>
                    <div class="card-body">
                        <p class="card-text">${formattedLyrics}</p>
                    </div>
                </div>
            `;
        } else {
            lyricsResult.innerHTML = '<p class="alert alert-warning">No se encontró la letra de la canción</p>';
        }
    } catch (error) {
        console.error('Error al buscar la letra:', error);
        lyricsResult.innerHTML = '<p class="alert alert-danger">Error al buscar la letra de la canción</p>';
    }
}

lyricsForm.addEventListener('submit', searchLyrics);