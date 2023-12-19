// Función para cargar los datos de la convocatoria en el formulario
function cargaConvocatoria(convocatoria) {
    var formulario = document.getElementsByClassName("formulario")[0];
    formulario.querySelector("#idConvocatoria").value = convocatoria.id;
    formulario.querySelector("#movilidades").value = convocatoria.movilidades;
    formulario.querySelector("#duracion").value = convocatoria.duracion;
    formulario.querySelector("#tipo").value = convocatoria.tipo;
    formulario.querySelector("#codigoProyecto").value = convocatoria.codigoProyecto;
    formulario.querySelector("#destinos").value = convocatoria.destinos;
    formulario.querySelector("#inicioSolicitud").value = convocatoria.inicioSolicitud;
    formulario.querySelector("#finSolicitud").value = convocatoria.finSolicitud;
    formulario.querySelector("#inicioPrueba").value = convocatoria.inicioPrueba;
    formulario.querySelector("#finPrueba").value = convocatoria.finPrueba;
    formulario.querySelector("#listaProv").value = convocatoria.listaProv;
    formulario.querySelector("#listaDef").value = convocatoria.listaDef;

}

// Función para limpiar el formulario de convocatoria
function limpiaConvocatoria() {
    var formulario = document.getElementsByClassName("formulario")[0];
    formulario.querySelector("#idConvocatoria").value = "";
    formulario.querySelector("#movilidades").value = "";
    formulario.querySelector("#duracion").value = "";
    formulario.querySelector("#tipo").value = "";
    formulario.querySelector("#codigoProyecto").value = "";
    formulario.querySelector("#destinos").value = "";
    formulario.querySelector("#inicioSolicitud").value = "";
    formulario.querySelector("#finSolicitud").value = "";
    formulario.querySelector("#inicioPrueba").value = "";
    formulario.querySelector("#finPrueba").value = "";
    formulario.querySelector("#listaProv").value = "";
    formulario.querySelector("#listaDef").value = "";
    // Aquí puedes agregar más campos según sea necesario
}

// Función para guardar la convocatoria
function guardaConvocatoria() {
    var formulario = document.getElementsByClassName("formulario")[0];
    var convocatoria = {
        "id": formulario.querySelector("#idConvocatoria").value,
        "movilidades": formulario.querySelector("#movilidades").value,
        "duracion": formulario.querySelector("#duracion").value,
        "tipo": formulario.querySelector("#tipo").value,
        "codigoProyecto": formulario.querySelector("#codigoProyecto").value,
        "destinos": formulario.querySelector("#destinos").value,
        "inicioSolicitud": formulario.querySelector("#inicioSolicitud").value,
        "finSolicitud": formulario.querySelector("#finSolicitud").value,
        "inicioPrueba": formulario.querySelector("#inicioPrueba").value,
        "finPrueba": formulario.querySelector("#finPrueba").value,
        "listaProv": formulario.querySelector("#listaProv").value,
        "listaDef": formulario.querySelector("#listaDef").value
    };
    var convocatoriaJson = JSON.stringify(convocatoria);
    console.log(convocatoriaJson);
    fetch("http://localhost/DEWESE/examinator/api/ApiConvocatoria.php", {
        method: "POST",
        body: convocatoriaJson,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(y => {
        refrescaConvocatorias();
        console.log("ok");
    });
    limpiaConvocatoria();
}

// Función para refrescar las convocatorias
async function refrescaConvocatorias() {
    var convocatorias = document.getElementById("convocatorias");
    while (convocatorias.firstChild) {
        convocatorias.removeChild(convocatorias.firstChild);
    }
    fetch("http://localhost/DEWESE/examinator/plantillas/convocatoria.html")
        .then(x => x.text())
        .then(async y => {
            console.log(y)
            var contenedor = document.createElement("div");
            contenedor.innerHTML = y;
            var convocatoria = contenedor.firstChild;
            const d = await fetch("http://localhost/DEWESE/examinator/api/ApiConvocatoria.php?menu=examenManual")
            const a = await d.json()
            for (let i = 0; i < a.length; i++) {
                var nuevaConvocatoria = convocatoria.cloneNode(true);
                nuevaConvocatoria.querySelector(".id").innerHTML = a[i].id;
                nuevaConvocatoria.addEventListener('click', function() {
                    cargaConvocatoria(a[i]);
                });
                convocatorias.appendChild(nuevaConvocatoria);
            };
        })
        .catch(error => {
            console.error('Error al obtener plantilla de convocatoria:', error);
        });
}
