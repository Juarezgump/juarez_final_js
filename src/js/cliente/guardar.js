const btnguardar = document.getElementById('btnguardar')
const formCliente = document.getElementById('formCliente')
const divTabla = document.getElementById('divTabla')
const btnBuscar = document.getElementById('btnBuscar')
const tbody = document.getElementById('tabla_clientes')
const btnModificar = document.getElementById('btnModificar')
const btnCancelar = document.getElementById('btnCancelar')

divTabla.classList.add('d-none')

const guardar = async(e) => {
   e.preventDefault()
   
const URL = "/juarez_farmacia_final_js/controller/clientes/guardar.php";
const body = new FormData(formCliente)
const headers = new Headers()
headers.append('clave', '1234')
const config = {
    method: 'POST',
    headers,
    body
}

const respuesta = await fetch(URL, config)
const data = await respuesta.json()
console.log(data)
if(data.codigo == 1){
    alert(data.mensaje)
    formCliente.reset() // Limpiar el formulario después de guardar
    
    // Actualizar la tabla automáticamente
    buscar(new Event('click'))
    
    // Actualizar noticias
    cargarNoticias()
}else{
    alert(data.mensaje)
}
}

const buscar = async(e) => {
    e.preventDefault()

    const URL = "/juarez_farmacia_final_js/controller/clientes/buscar.php";
    const body = new FormData(formCliente)
    const headers = new Headers()
    headers.append('clave', '1234')

    const config = {
        method: "POST",
        headers,
        body
    }

    const respuesta = await fetch(URL, config)
    const data = await respuesta.json()
    console.log(data);
    
    tbody.innerHTML = '';
    
    if(data.codigo == 1){
        // Solo mostrar alerta si no fue llamado desde la función guardar
        if(e.type === 'click') {
            alert('Se encontraron los datos')
        }
        divTabla.classList.remove('d-none')
        data.datos.forEach((c, index) => {
            const row = document.createElement("tr");

            row.innerHTML = `
            <td>${index + 1}</td>
            <td>${c.cli_nombres || ''}</td>
            <td>${c.cli_edad}</td>
            <td>${c.cli_dpi}</td>
            <td>${c.cli_nit}</td>
            <td>${c.cli_telefono}</td>
            <td>${c.cli_correo}</td>
            <td>${c.cli_genero}</td>
            <td>${c.cli_direccion}</td>      
            <td class="text-center">
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Acciones
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" onClick="Asignar('${btoa(c.cli_id)}')"><i class="bi bi-pencil-square me-2"></i>Modificar</a></li>
                        <li><a class="dropdown-item" onClick="Eliminar('${btoa(c.cli_id)}')"><i class="bi bi-trash me-2"></i>Eliminar</a></li>
                    </ul>
                </div>
            </td>
            `;
            tbody.appendChild(row);
        });
    } else {
        const row = document.createElement("tr");
        row.innerHTML = `<td colspan="10">No hay clientes registrados</td>`;
        tbody.appendChild(row);
        divTabla.classList.remove('d-none')
        if (data.codigo == 0 && e.type === 'click') {
            alert(data.mensaje)
        }
    }
}

window.Asignar = async(cli_id) => {
    const URL = "/juarez_farmacia_final_js/controller/clientes/modificar.php?cli_id=" + cli_id;
    const headers = new Headers();
    headers.append('clave', '124');

    const config = {
        method: 'GET',
        headers
    };

    const respuesta = await fetch(URL, config);
    const data = await respuesta.json();
    console.log(data);
    
    formCliente.cli_id.value = atob(cli_id);
    formCliente.cli_nombres.value = data.datos.cli_nombres;
    formCliente.cli_edad.value = data.datos.cli_edad;
    formCliente.cli_dpi.value = data.datos.cli_dpi;
    formCliente.cli_nit.value = data.datos.cli_nit;
    formCliente.cli_telefono.value = data.datos.cli_telefono;
    formCliente.cli_correo.value = data.datos.cli_correo;
    formCliente.cli_genero.value = data.datos.cli_genero;
    formCliente.cli_direccion.value = data.datos.cli_direccion;
    
    btnguardar.classList.add('d-none');
    btnBuscar.classList.add('d-none');
    btnModificar.classList.remove('d-none');
    btnCancelar.classList.remove('d-none');
}

const Modificar = async(e) => {
    e.preventDefault();
    
    const URL = "/juarez_farmacia_final_js/controller/clientes/modificar.php";
    const body = new FormData(formCliente);
    const headers = new Headers();
    headers.append('clave', '124');

    const config = {
        method: 'POST',
        headers,
        body
    };

    const respuesta = await fetch(URL, config);
    const data = await respuesta.json();
    console.log(data);
    
    if(data.codigo == 1){
        tbody.innerHTML = '';
        formCliente.reset();
        buscar(new Event('click'));
        
        btnBuscar.classList.remove('d-none');
        btnguardar.classList.remove('d-none');
        btnModificar.classList.add('d-none');
        btnCancelar.classList.remove('d-none');
        
        alert(data.mensaje);
    } else {
        alert(data.mensaje);
    }
}

btnCancelar.addEventListener('click', () => {
    formCliente.reset();
    btnBuscar.classList.remove('d-none');
    btnguardar.classList.remove('d-none');
    btnModificar.classList.add('d-none');
    btnCancelar.classList.remove('d-none');
});

formCliente.addEventListener('submit', guardar);
btnBuscar.addEventListener('click', buscar);
btnModificar.addEventListener('click', Modificar);


//API para obtener noticias desde Hacker.news
const cargarNoticias = async() => {
    const noticiasContainer = document.getElementById('noticias-salud');
    if (!noticiasContainer) return;
    
    noticiasContainer.innerHTML = `
        <div class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando noticias...</span>
            </div>
        </div>
    `;
    
    try {
        const topStoriesResponse = await fetch('https://hacker-news.firebaseio.com/v0/topstories.json');
        const topStories = await topStoriesResponse.json();
        
        const storyPromises = topStories.slice(0, 3).map(id => 
            fetch(`https://hacker-news.firebaseio.com/v0/item/${id}.json`)
                .then(response => response.json())
        );
        
        const stories = await Promise.all(storyPromises);
        
        if (stories.length > 0) {
            let html = '';
            
            stories.forEach(story => {
                const fecha = new Date(story.time * 1000).toLocaleDateString('es-MX');
                
                html += `
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">${story.title}</h5>
                            <p class="card-text">
                                <small class="text-muted">Por: ${story.by} - ${fecha}</small>
                            </p>
                            <p class="card-text">
                                <span class="badge bg-info">${story.score} puntos</span>
                                <span class="badge bg-secondary">${story.descendants || 0} comentarios</span>
                            </p>
                            <a href="${story.url || `https://news.ycombinator.com/item?id=${story.id}`}" 
                               target="_blank" class="btn btn-sm btn-outline-success">Leer más</a>
                        </div>
                    </div>
                `;
            });
            
            noticiasContainer.innerHTML = html;
        } else {
            noticiasContainer.innerHTML = `
                <div class="alert alert-info">
                    No se encontraron noticias en este momento.
                </div>
            `;
        }
    } catch (error) {
        console.error('Error al cargar noticias:', error);
        noticiasContainer.innerHTML = `
            <div class="alert alert-warning">
                Actualmente no podemos mostrar noticias. Por favor, intente más tarde.
            </div>
        `;
    }
}

document.addEventListener('DOMContentLoaded', cargarNoticias);