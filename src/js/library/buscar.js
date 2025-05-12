const bookForm = document.getElementById('book-search-form');
const bookResults = document.getElementById('book-results');

const searchBooks = async (e) => {
    e.preventDefault();
    const searchTerm = document.getElementById('book-search').value;
    
    if (!searchTerm) return;
    
    bookResults.innerHTML = '<p>Buscando libros...</p>';
    
    try {
        const response = await fetch(`https://openlibrary.org/search.json?q=${encodeURIComponent(searchTerm)}`);
        const data = await response.json();
        
        displayBooks(data.docs);
    } catch (error) {
        console.error('Error al buscar libros:', error);
        bookResults.innerHTML = '<p class="alert alert-danger">Error al buscar libros</p>';
    }
}

const displayBooks = (books) => {
    if (!books || books.length === 0) {
        bookResults.innerHTML = '<p>No se encontraron libros</p>';
        return;
    }
    
    let html = '';
    books.slice(0, 10).forEach(book => {
        let coverUrl = '';
        if (book.cover_i) {
            coverUrl = `https://covers.openlibrary.org/b/id/${book.cover_i}-M.jpg`;
        }
        
        html += `
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-2">
                        ${coverUrl ? `<img src="${coverUrl}" class="img-fluid rounded-start" alt="Portada">` : '<div class="text-center p-4">Sin portada</div>'}
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <h5 class="card-title">${book.title}</h5>
                            <p class="card-text">Autor(es): ${book.author_name ? book.author_name.join(', ') : 'Desconocido'}</p>
                            <p class="card-text">Año de publicación: ${book.first_publish_year || 'Desconocido'}</p>
                            <p class="card-text">Editorial: ${book.publisher ? book.publisher[0] : 'Desconocida'}</p>
                            <a href="https://openlibrary.org${book.key}" target="_blank" class="btn btn-primary">Ver en Open Library</a>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });
    
    bookResults.innerHTML = html;
}

bookForm.addEventListener('submit', searchBooks);