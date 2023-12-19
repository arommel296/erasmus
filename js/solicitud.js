import Recuadro from "./recuadro.js";


window.addEventListener("load", function () {
    var btnCapturar = document.getElementById("capturar");

    btnCapturar.addEventListener("click", capturar);

    //Cuando se introduzca una fecha se comprueba la edad
    var fnac = document.getElementById("fechaNac");
    console.log(fnac);
    fnac.addEventListener("change", function () {
        //variables a deshabilitar si es mayor de edad:
        var dniTutor = document.getElementById("dniTutor");
        var nombreTutor = document.getElementById("nombreTutor");
        var apellidosTutor = document.getElementById("apellidosTutor");
        var telefonoTutor = document.getElementById("telefonoTutor");
        var domicilioTutor = document.getElementById("domicilioTutor");
        let array = [dniTutor, nombreTutor, apellidosTutor, telefonoTutor, domicilioTutor];

        console.log(fnac.value);
        if (esMayorDeEdad(fnac.value)) {
            array.forEach(element => {
                element.setAttribute('data-valida', 'relleno');
            });
            limpiaCampos(array);
            deshabilita(array);
        } else{
            habilita(array);
        }
    })

    //Cogemos el id de la convocatoria que se va a solicitar de la url
    var urlParams = window.location.search;
    var idConvocatoria = urlParams.split('idConvocatoria=')[1];

    //Insertamos el id de convocatoria en el campo invisible id
    var id = document.getElementById("id");
    id.setAttribute("value", idConvocatoria);
    console.log(id);

    var items = document.getElementById("items");
    //Hacemos una llamada ayax al servidor para saber el número de archivos requeridos para esta convocatoria
    fetch('http://localhost/DEWESE/erasmus/api/ApiConvocatoriaBaremo.php?idConvocatoria='+idConvocatoria)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                data.forEach(item => {
                    var fila = document.createElement("div");
                    fila.innerHTML='<div class="fila">'+
                    '<class="campo">'+
                    '<label for="'+item.id+'">'+item.nombre+':</label>'+
                    '<input type="file" id="'+item.id+'" name="'+item.nombre+'">'+
                    '<button class="verPdf">Previsualización</button>'+
                    '</div>'+
                    '</div>';
                    items.appendChild(fila);

                    // Agrega un controlador de eventos al botón de previsualización
                    fila.querySelector('.verPdf').addEventListener('click', function(ev) {
                        ev.preventDefault();
                        // el archivo del input
                        let file = document.getElementById(item.id).files[0];

                        if (file.type == "application/pdf") {
                            var iframe = document.createElement("iframe");
                            iframe.style.width = "100%";
                            iframe.style.height = "100%";
                            //modal
                            var modal = document.createElement("div");
                            modal.style.position = "fixed";
                            modal.style.left = "0";
                            modal.style.top = "0";
                            modal.style.width = "100%";
                            modal.style.height = "100%";
                            modal.style.backgroundColor = "rgba(0,0,0,0.5)";
                            modal.style.zIndex = 99;
                            document.body.appendChild(modal);
                
                            //visualizador
                            var visualizador = document.createElement("div");
                            visualizador.style.position = "fixed";
                            visualizador.style.left = "15%";
                            visualizador.style.top = "15%";
                            visualizador.style.width = "70%";
                            visualizador.style.height = "70%";
                            visualizador.style.backgroundColor = "white";
                            visualizador.style.zIndex = 100;
                            document.body.appendChild(visualizador);
                            visualizador.appendChild(iframe);
                
                            var closer = document.createElement("span");
                            closer.innerHTML = "X";
                            closer.style.padding = "0.6em"
                            closer.style.position = "fixed";
                            closer.style.top = "0";
                            closer.style.right = "0";
                            closer.style.backgroundColor = "white";
                            closer.style.zIndex = 101;
                            document.body.appendChild(closer);
                
                            closer.onclick = function () {
                                document.body.removeChild(modal);
                                document.body.removeChild(visualizador);
                                document.body.removeChild(this);
                            }
                

                
                            iframe.src=URL.createObjectURL(file)
                        }

                    })

                })
            })
            .catch(error => console.error('Error:', error));


    //Recogida de datos de la solicitud:
    var enviar = document.querySelector('input[type="submit"]');
    enviar.addEventListener("click", function (event) {
        event.preventDefault();
        
        // Crear un objeto para almacenar los datos del formulario
        let formData = {};

        // Recoger los datos del solicitante
        formData.idConvocatoria = document.getElementById('id').value;
        formData.dni = document.getElementById('dni').value;
        formData.nombre = document.getElementById('nombre').value;
        formData.apellidos = document.getElementById('apellidos').value;
        formData.curso = document.getElementById('curso').value;
        formData.telefono = document.getElementById('telefono').value;
        formData.correo = document.getElementById('correo').value;
        formData.fechaNac = document.getElementById('fechaNac').value;
        formData.domicilio = document.getElementById('domicilio').value;

        // Recoger los datos del tutor legal
        formData.dniTutor = document.getElementById('dniTutor').value;
        formData.nombreTutor = document.getElementById('nombreTutor').value;
        formData.apellidosTutor = document.getElementById('apellidosTutor').value;
        formData.telefonoTutor = document.getElementById('telefonoTutor').value;
        formData.domicilioTutor = document.getElementById('domicilioTutor').value;

        // Recoger la contraseña
        formData.pass = document.getElementById('pass1').value;
        // formData.pass2 = document.getElementById('pass2').value;

        // Recoger la imagen
        let imagen = document.getElementById('foto').src;
        console.log(imagen);
        formData.imagen = imagen;

        // Ahora, formData contiene todos los datos del formulario
        console.log(formData);

        fetch('http://localhost/DEWESE/erasmus/api/ApiSolicitud.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())  // convertir a texto en lugar de JSON
        .then(data => {
            console.log(data);  // imprimir los datos en texto
            return JSON.parse(data);  // luego intentar parsear a JSON
        })
        .then(json => console.log(json))  // imprimir los datos en formato JSON
        .catch(error => console.error('Error:', error));

    })


    //Habilitar el botón de quitar foto si se ha realizado captura:
    var quitar = document.getElementById("quitar");
    let img = document.getElementById('foto');
    var imagen = document.getElementById("imagen");

    // Comprueba si hay una imagen cargada cuando se selecciona un archivo
    imagen.addEventListener("change", function () {
        if (imagen.files.length > 0) {
            deshabilita([btnCapturar]);
            img.src = URL.createObjectURL(imagen.files[0]);
            img.style.display="block";
        } else {
            habilita([btnCapturar]);
            img.src="";
            img.style.display="none";
        }
    })


    // Descarta la foto y habilita el input
    quitar.addEventListener("click", function (ev) {
        ev.preventDefault();
        img.src = "";
        img.alt = "";
        img.style.display = "none";
        habilita([imagen]);
        deshabilita([quitar]);
        // quitar.disabled = true;
    })


})


function capturar(ev) {
    ev.preventDefault();
    var iframe = document.createElement("iframe");
    iframe.style.width = "100%";
    iframe.style.height = "100%";
    //modal
    var modal = document.createElement("div");
    modal.style.position = "fixed";
    modal.style.left = "0";
    modal.style.top = "0";
    modal.style.width = "100%";
    modal.style.height = "100%";
    modal.style.backgroundColor = "rgba(0,0,0,0.5)";
    modal.style.zIndex = 99;
    document.body.appendChild(modal);

    //visualizador
    var visualizador = document.createElement("div");
    visualizador.style.position = "fixed";
    visualizador.style.left = "15%";
    visualizador.style.top = "15%";
    visualizador.style.width = "70%";
    visualizador.style.height = "70%";
    visualizador.style.backgroundColor = "white";
    visualizador.style.zIndex = 100;
    document.body.appendChild(visualizador);
    visualizador.appendChild(iframe);

    var closer = document.createElement("span");
    closer.innerHTML = "X";
    closer.style.padding = "5px"
    closer.style.position = "fixed";
    closer.style.top = "0";
    closer.style.right = "0";
    closer.style.zIndex = 101;
    document.body.appendChild(closer);

    closer.onclick = function () {
        document.body.removeChild(modal);
        document.body.removeChild(visualizador);
        document.body.removeChild(this);
        //Parar la webcam
        player.srcObject.getTracks().forEach(function (track) {
            track.stop();
        })
    }

    var player = document.createElement('video');
    player.id = 'player';
    player.style.width = '50%';
    player.style.height = '50%';
    player.style.zIndex = 102;
    player.autoplay = true;

    var capturaButton = document.createElement('button');
    capturaButton.id = 'captura';
    capturaButton.innerText = 'Capturar';
    capturaButton.style.zIndex = 102;

    visualizador.appendChild(player);
    visualizador.appendChild(capturaButton);

    player.style.position = 'absolute';
    player.style.top = '100px';
    player.style.left = '50px';

    capturaButton.style.position = 'absolute';
    capturaButton.style.bottom = '5px';
    capturaButton.style.right = '5px';

    const canvas = document.createElement('canvas');
    canvas.id = 'canvas';
    canvas.width = "448px";
    canvas.height = "337px";
    const context = canvas.getContext('2d');
    // canvas.width = player.width; // Establece el ancho del canvas igual al ancho del video
    // canvas.height = player.height; // Establece el alto del canvas igual al alto del video


    const constraints = {
        video: true,
    };

    navigator.mediaDevices.getUserMedia(constraints).then((stream) => {
        player.srcObject = stream;
        player.oncanplay = function () {
            canvas.width = player.videoWidth;
            canvas.height = player.videoHeight;
        };

    });

    capturaButton.addEventListener('click', () => {
        // Pinta la imagen de la cámara en el canvas.
        context.drawImage(player, 0, 0, canvas.width, canvas.height);
        var recuadro = new Recuadro(0, 0, canvas.width, canvas.height, canvas);
        var imagenRecortada = recuadro.recortar();

        imagenRecortada.style.position = 'absolute';
        imagenRecortada.style.top = '100px';
        imagenRecortada.style.right = '133px';
        imagenRecortada.style.width = player.style.width - 136;
        imagenRecortada.style.height = player.style.height;
        // imagenRecortada.style.width = 448;
        // imagenRecortada.style.height = 337;
        visualizador.appendChild(imagenRecortada);

        let fotillo = document.getElementById("canv").toDataURL('image/png');
        localStorage.setItem('imagen', fotillo);
        let img = document.getElementById('foto');
        img.src = localStorage.getItem('imagen');

        img.style.display = "block";

        var fileImagen = document.getElementById("imagen");
        var descartar = document.getElementById("quitar");
        let array = [fileImagen];
        deshabilita(array);
        habilita([descartar]);

    });



}

// Función para saber si es mayor de edad con la fecha introducida
function esMayorDeEdad(fecha) {
    console.log(fecha);
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    return edad >= 18;
}


//Función a la que se le pasa un array de los elementos html que queremos deshabilitar
function deshabilita(array) {
    array.forEach(element => {
        element.disabled = true;
    });
}

//Función a la que se le pasa un array de los elementos html que queremos habilitar
function habilita(array) {
    array.forEach(element => {
        element.disabled = false;
    });
}

//Función a la que se le pasa un array de los elementos html que queremos limpiar
function limpiaCampos(array) {
    array.forEach(element => {
        element.value = "";
    })
}