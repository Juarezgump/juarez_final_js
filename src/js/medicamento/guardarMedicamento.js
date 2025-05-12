const btnguardar = document.getElementById('btnguardar')
const formMedicamento = document.getElementById('formMedicamento')
const divTabla = document.getElementById('divTabla')
const btnBuscar = document.getElementById('btnBuscar')
const tbody = document.getElementById('tabla_medicamentos')
const btnModificar = document.getElementById('btnModificar')
const btnCancelar = document.getElementById('btnCancelar')

divTabla.classList.add('d-none')


const guardar = async(e) => {
   e.preventDefault()
   
const URL = "/juarez_farmacia_final_js/controller/medicamentos/guardar.php";
const body = new FormData(formMedicamento)
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

    const URL = "/juarez_farmacia_final_js/controller/medicamentos/buscar.php";
    const body = new FormData(formMedicamento)
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
        data.datos.forEach((m, index) => {
            const row = document.createElement("tr");

            row.innerHTML = `
            <td>${index + 1}</td>
            <td>${m.med_nombre || ''}</td>
            <td>${m.med_vencimiento}</td>
            <td>${m.med_desc}</td>
            <td>${m.med_presentacion}</td>
            <td>${m.casa_nombre}</td>
            <td>${m.med_disponible}</td>
            <td>${m.med_precio}</td>      
            <td class="text-center">
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Acciones
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" onClick="Asignar('${btoa(m.med_id)}')"><i class="bi bi-pencil-square me-2"></i>Modificar</a></li>
                        <li><a class="dropdown-item" onClick="Eliminar('${btoa(m.med_id)}')"><i class="bi bi-trash me-2"></i>Eliminar</a></li>
                    </ul>
                </div>
            </td>
            `;
            tbody.appendChild(row);
        });
    } else {
        const row = document.createElement("tr");
        row.innerHTML = `<td colspan="9">No hay medicamentos registrados</td>`;
        tbody.appendChild(row);
    }
}

window.Asignar = async(med_id) => {
    const URL = "/juarez_farmacia_final_js/controller/medicamentos/modificar.php?med_id=" + med_id;
    const headers = new Headers();
    headers.append('clave', '124');

    const config = {
        method: 'GET',
        headers
    };

    const respuesta = await fetch(URL, config);
    const data = await respuesta.json();
    console.log(data);
    
    formMedicamento.med_id.value = atob(med_id);
    formMedicamento.med_nombre.value = data.datos.med_nombre;
    formMedicamento.med_vencimiento.value = data.datos.med_vencimiento;
    formMedicamento.med_desc.value = data.datos.med_desc;
    formMedicamento.med_presentacion.value = data.datos.med_presentacion;
    formMedicamento.med_casa.value = data.datos.med_casa;
    formMedicamento.med_disponible.value = data.datos.med_disponible;
    formMedicamento.med_precio.value = data.datos.med_precio;
    
    btnguardar.classList.add('d-none');
    btnBuscar.classList.add('d-none');
    btnModificar.classList.remove('d-none');
    btnCancelar.classList.remove('d-none');
}


const Modificar = async(e) => {
    e.preventDefault();
    
    const URL = "/juarez_farmacia_final_js/controller/medicamentos/modificar.php";
    const body = new FormData(formMedicamento);
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
        formMedicamento.reset();
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
    formMedicamento.reset();
    btnBuscar.classList.remove('d-none');
    btnguardar.classList.remove('d-none');
    btnModificar.classList.add('d-none');
    btnCancelar.classList.add('d-none');
});

formMedicamento.addEventListener('submit', guardar);
btnBuscar.addEventListener('click', buscar);
btnModificar.addEventListener('click', Modificar);