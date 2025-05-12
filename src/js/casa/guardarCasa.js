const btnguardar = document.getElementById('btnguardar')
const formCasa = document.getElementById('formCasa')
const divTabla = document.getElementById('divTabla')
const btnBuscar = document.getElementById('btnBuscar')
const tbody = document.getElementById('tabla_casas')
const btnModificar = document.getElementById('btnModificar')
const btnCancelar = document.getElementById('btnCancelar')

divTabla.classList.add('d-none')

const guardar = async(e) => {
   e.preventDefault()
   
    const URL = "/juarez_farmacia_final_js/controller/casa/guardar.php"
    const body = new FormData(formCasa)
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
        formCasa.reset()
        
        // Actualizar la tabla automáticamente
        buscar(new Event('click'))
    }else{
        alert(data.mensaje)
    }
}

const buscar = async(e) => {
    e.preventDefault()

    const URL = "/juarez_farmacia_final_js/controller/casa/buscar.php"
    const body = new FormData(formCasa)
    const headers = new Headers()
    headers.append('clave', '1234')

    const config = {
        method: "POST",
        headers,
        body
    }

    const respuesta = await fetch(URL, config)
    const data = await respuesta.json()
    console.log(data)
    
    tbody.innerHTML = ''
    
    if(data.codigo == 1 && data.datos && data.datos.length > 0){
        // Solo mostrar alerta si no fue llamado desde la función guardar
        if(e.type === 'click') {
            alert('Se encontraron los datos')
        }
        divTabla.classList.remove('d-none')
        data.datos.forEach((c, index) => {
            const row = document.createElement("tr")

            row.innerHTML = `
            <td>${index + 1}</td>
            <td>${c.casa_nombre || ''}</td>
            <td>${c.casa_direccion}</td>
            <td>${c.casa_telefono}</td>
            <td>${c.casa_jefe}</td>      
            <td class="text-center">
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Acciones
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" onClick="Asignar('${btoa(c.casa_id)}')"><i class="bi bi-pencil-square me-2"></i>Modificar</a></li>
                        <li><a class="dropdown-item" onClick="Eliminar('${btoa(c.casa_id)}')"><i class="bi bi-trash me-2"></i>Eliminar</a></li>
                    </ul>
                </div>
            </td>
            `
            tbody.appendChild(row)
        })
    } else {
        const row = document.createElement("tr")
        row.innerHTML = `<td colspan="6" class="text-center">No hay casas/proveedores registrados</td>`
        tbody.appendChild(row)
        divTabla.classList.remove('d-none')
        if (data.codigo == 0 && e.type === 'click') {
            alert(data.mensaje)
        }
    }
}

window.Asignar = async(casa_id) => {
    const URL = "/juarez_farmacia_final_js/controller/casa/modificar.php?casa_id=" + casa_id
    const headers = new Headers()
    headers.append('clave', '124')

    const config = {
        method: 'GET',
        headers
    }

    const respuesta = await fetch(URL, config)
    const data = await respuesta.json()
    console.log(data)
    
    if (data.codigo == 1 && data.datos) {
        formCasa.casa_id.value = atob(casa_id)
        formCasa.casa_nombre.value = data.datos.casa_nombre
        formCasa.casa_direccion.value = data.datos.casa_direccion
        formCasa.casa_telefono.value = data.datos.casa_telefono
        formCasa.casa_jefe.value = data.datos.casa_jefe
        
        btnguardar.classList.add('d-none')
        btnBuscar.classList.add('d-none')
        btnModificar.classList.remove('d-none')
        btnCancelar.classList.remove('d-none')
    } else {
        alert('Error al obtener los datos para modificar')
    }
}

const Modificar = async(e) => {
    e.preventDefault()
    
    const URL = "/juarez_farmacia_final_js/controller/casa/modificar.php"
    const body = new FormData(formCasa)
    const headers = new Headers()
    headers.append('clave', '124')

    const config = {
        method: 'POST',
        headers,
        body
    }

    const respuesta = await fetch(URL, config)
    const data = await respuesta.json()
    console.log(data)
    
    if(data.codigo == 1){
        tbody.innerHTML = ''
        formCasa.reset()
        buscar(new Event('click'))
        
        btnBuscar.classList.remove('d-none')
        btnguardar.classList.remove('d-none')
        btnModificar.classList.add('d-none')
        btnCancelar.classList.add('d-none')
        
        alert(data.mensaje)
    } else {
        alert(data.mensaje)
    }
}

btnCancelar.addEventListener('click', () => {
    formCasa.reset()
    btnBuscar.classList.remove('d-none')
    btnguardar.classList.remove('d-none')
    btnModificar.classList.add('d-none')
    btnCancelar.classList.add('d-none')
})

formCasa.addEventListener('submit', guardar)
btnBuscar.addEventListener('click', buscar)
btnModificar.addEventListener('click', Modificar)