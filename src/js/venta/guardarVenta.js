const btnguardar = document.getElementById('btnguardar')
const formVenta = document.getElementById('formVenta')
const divTabla = document.getElementById('divTabla')
const btnBuscar = document.getElementById('btnBuscar')
const tbody = document.getElementById('tabla_ventas')

divTabla.classList.add('d-none')

const guardar = async(e) => {
   e.preventDefault()
   
   const URL = "/juarez_farmacia_final_js/controller/ventas/guardar.php"
   const body = new FormData(formVenta)
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
       formVenta.reset()
   } else {
       alert(data.mensaje)
   }
}

const buscar = async(e) => {
    e.preventDefault()

    const URL = "/juarez_farmacia_final_js/controller/ventas/buscar.php"
    const body = new FormData(formVenta)
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
        alert('Se encontraron los datos')
        divTabla.classList.remove('d-none')
        data.datos.forEach((v, index) => {
            const row = document.createElement("tr")

            row.innerHTML = `
            <td>${index + 1}</td>
            <td>${v.med_nombre || ''}</td>
            <td>${v.venta_cant}</td>
            <td>${v.cli_nombres}</td>
            <td>${v.tra_nombres}</td>
            `
            tbody.appendChild(row)
        })
    } else {
        const row = document.createElement("tr")
        row.innerHTML = `<td colspan="5" class="text-center">No hay ventas registradas</td>`
        tbody.appendChild(row)
        divTabla.classList.remove('d-none')
        if(data.codigo == 0){
            alert(data.mensaje || 'No se encontraron datos')
        }
    }
}

formVenta.addEventListener('submit', guardar)
btnBuscar.addEventListener('click', buscar)