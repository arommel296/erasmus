window.addEventListener('load', function () {
    // var iniSol = document.getElementById("inicioSolicitud");
    // iniSol.addEventListener("change", function () {

    //     console.log(iniSol.value);
    // })

    // Obtenemos el select múltiple por su id
    // var selectDest = document.getElementById('selectGrupo').childNodes[0];

    var selectDest = document.getElementsByName('grupo')[0];

    console.log("hola");
    // Realizamos una solicitud fetch a la API
    fetch('http://localhost/DEWESE/erasmus/api/ApiDestinatario.php')
        .then(response => response.json())
        .then(data => {
            // Iteramos sobre cada objeto en los datos obtenidos
            data.forEach(function (destinatario) {
                // Crea un nuevo elemento option
                var option = document.createElement('option');

                // Establecemos el valor y el texto del option con los datos del destinatario
                option.value = destinatario.codigoGrupo;
                option.text = destinatario.codigoGrupo;

                // Añadimos el option al select
                selectDest.add(option);
            });
        })
        .catch(error => console.error('Error:', error));

    var listado = document.getElementById("listadoConvoc").childNodes[3];
    console.log(listado);
    selectDest.addEventListener("change", function () {
        var seleccionado = this.value;
        fetch('http://localhost/DEWESE/erasmus/api/ApiDestinatarioConvocatoria.php?grupo='+seleccionado)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                listado.innerHTML = "";  // Vacía la tabla
                // Añade las nuevas filas a la tabla
                data.forEach(function (convocatoria) {
                    var fila = document.createElement("tr");
                    fila.innerHTML =
                    '<td>' + convocatoria.codigoProyecto + '</td>' +
                    '<td>' + formatearFecha(convocatoria.inicioSolicitud) + '</td>' +
                    '<td>' + formatearFecha(convocatoria.finSolicitud) + '</td>' +
                    '<td>' + '<a href="?menu=solicitud&idConvocatoria=' + convocatoria.id + '">Solicitar</a>' + '</td>';
                    listado.appendChild(fila);
                })
            })
            .catch(error => console.error('Error:', error));
    })

})


// Función para poner el formato de fecha dd/mm/yyyy
function formatearFecha(fecha) {
    var d = new Date(fecha);
    var dia = ("0" + d.getDate()).slice(-2);
    var mes = ("0" + (d.getMonth() + 1)).slice(-2);
    var anio = d.getFullYear();
    return dia + "/" + mes + "/" + anio;
}