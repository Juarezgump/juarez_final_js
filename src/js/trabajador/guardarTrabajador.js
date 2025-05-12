const btnguardar = document.getElementById('btnguardar')
const formTrabajador = document.getElementById('formTrabajador')
const divTabla = document.getElementById('divTabla')
const btnBuscar = document.getElementById('btnBuscar')
const tbody = document.getElementById('tabla_trabajadores')
const btnModificar = document.getElementById('btnModificar')
const btnCancelar = document.getElementById('btnCancelar')

divTabla.classList.add('d-none')


const guardar = async(e) => {
   e.preventDefault()
   
const URL = "/juarez_farmacia_final_js/controller/trabajadores/guardar.php";
const body = new FormData(formTrabajador)
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
}else{
    alert(data.mensaje)
}
}

const buscar = async(e) => {
    e.preventDefault()

    const URL = "/juarez_farmacia_final_js/controller/trabajadores/buscar.php";
    const body = new FormData(formTrabajador)
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
        alert('Se encontraron los datos')
        divTabla.classList.remove('d-none')
        data.datos.forEach((t, index) => {
            const row = document.createElement("tr");

            row.innerHTML = `
            <td>${index + 1}</td>
            <td>${t.tra_nombres || ''}</td>
            <td>${t.tra_edad}</td>
            <td>${t.tra_dpi}</td>
            <td>${t.tra_puesto}</td>
            <td>${t.tra_telefono}</td>
            <td>${t.tra_correo}</td>
            <td>${t.tra_salario}</td>
            <td>${t.tra_genero}</td>
            <td>${t.tra_direccion}</td>      
            <td class="text-center">
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Acciones
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" onClick="Asignar('${btoa(t.tra_id)}')"><i class="bi bi-pencil-square me-2"></i>Modificar</a></li>
                        <li><a class="dropdown-item" onClick="Eliminar('${btoa(t.tra_id)}')"><i class="bi bi-trash me-2"></i>Eliminar</a></li>
                    </ul>
                </div>
            </td>
            `;
            tbody.appendChild(row);
        });
    } else {
        const row = document.createElement("tr");
        row.innerHTML = `<td colspan="11">No hay trabajadores registrados</td>`;
        tbody.appendChild(row);
    }
}

window.Asignar = async(tra_id) => {
    const URL = "/juarez_farmacia_final_js/controller/trabajadores/modificar.php?tra_id=" + tra_id;
    const headers = new Headers();
    headers.append('clave', '124');

    const config = {
        method: 'GET',
        headers
    };

    const respuesta = await fetch(URL, config);
    const data = await respuesta.json();
    console.log(data);
    
    formTrabajador.tra_id.value = atob(tra_id);
    formTrabajador.tra_nombres.value = data.datos.tra_nombres;
    formTrabajador.tra_edad.value = data.datos.tra_edad;
    formTrabajador.tra_dpi.value = data.datos.tra_dpi;
    formTrabajador.tra_puesto.value = data.datos.tra_puesto;
    formTrabajador.tra_telefono.value = data.datos.tra_telefono;
    formTrabajador.tra_correo.value = data.datos.tra_correo;
    formTrabajador.tra_salario.value = data.datos.tra_salario;
    formTrabajador.tra_genero.value = data.datos.tra_genero;
    formTrabajador.tra_direccion.value = data.datos.tra_direccion;
    
    btnguardar.classList.add('d-none');
    btnBuscar.classList.add('d-none');
    btnModificar.classList.remove('d-none');
    btnCancelar.classList.remove('d-none');
}



const Modificar = async(e) => {
    e.preventDefault();
    
    const URL = "/juarez_farmacia_final_js/controller/trabajadores/modificar.php";
    const body = new FormData(formTrabajador);
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
        formTrabajador.reset();
        buscar(new Event('click'));
        
        btnBuscar.classList.remove('d-none');
        btnguardar.classList.remove('d-none');
        btnModificar.classList.add('d-none');
        btnCancelar.classList.add('d-none');
        
        alert(data.mensaje);
    } else {
        alert(data.mensaje);
    }
}

btnCancelar.addEventListener('click', () => {
    formTrabajador.reset();
    btnBuscar.classList.remove('d-none');
    btnguardar.classList.remove('d-none');
    btnModificar.classList.add('d-none');
    btnCancelar.classList.add('d-none');
});

formTrabajador.addEventListener('submit', guardar);
btnBuscar.addEventListener('click', buscar);
btnModificar.addEventListener('click', Modificar);