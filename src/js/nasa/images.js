const fetchNASAImage = async () => {
    try {
        const response = await fetch('https://api.nasa.gov/planetary/apod?api_key=DEMO_KEY');
        const data = await response.json();
        
        document.getElementById('nasa-image').src = data.url;
        document.getElementById('nasa-title').textContent = data.title;
        document.getElementById('nasa-description').textContent = data.explanation;
        document.getElementById('nasa-date').textContent = `Fecha: ${data.date}`;
    } catch (error) {
        console.error('Error al obtener datos de NASA:', error);
        document.getElementById('nasa-error').textContent = 'No se pudo cargar la imagen del día';
    }
}

document.addEventListener('DOMContentLoaded', fetchNASAImage);