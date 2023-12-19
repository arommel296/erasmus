// //Una vez cargado todo el contenido del DOM, se ejecuta la función anónima.
console.log("cc");
document.addEventListener('DOMContentLoaded', function(){
    console.log("bb");
    var iniSol = document.getElementById("inicioSolicitud");
    iniSol.addEventListener("change", function () {
        console.log("aaa");
        console.log(iniSol.value);
    })

    // Obtenemos el select múltiple por su id
    var selectDest = document.getElementById('destinatarios');

    // Realizamos una solicitud fetch a la API
    fetch('http://localhost/DEWESE/erasmus/api/ApiDestinatario.php')
        .then(response => response.json())
        .then(data => {
            // Iteramos sobre cada objeto en los datos obtenidos
            data.forEach(function(destinatario) {
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


     // Obtenemos el select por su id
     var selectPro = document.getElementById('proyecto');

     // Realizamos una solicitud fetch a tu API
     fetch('http://localhost/DEWESE/erasmus/api/ApiProyecto.php')
         .then(response => response.json())
         .then(data => {
             // Iteramos sobre cada objeto en los datos obtenidos
             data.forEach(function(proyecto) {
                 // Crea un nuevo elemento option
                 var option = document.createElement('option');
                 
                 // Establecemos el valor y el texto del option con los datos del destinatario
                 option.value = proyecto.codigo;
                 option.text = proyecto.codigo; 
 
                 // Añadimos el option al select
                 selectPro.add(option);
             });
         })
         .catch(error => console.error('Error:', error));


    // Selecciona todos los checkboxes
    var checkboxes = document.querySelectorAll('input[type=checkbox]');
    var table = document.createElement("div");
    table.id = "table4";
    table.style.display = "none";
    //Crear tabla con los idiomas
    table.innerHTML = '<table><thead><tr><th>A1</th><th>A2</th><th>B1</th><th>B2</th><th>C1</th><th>C2</th></tr></thead><tbody><tr><td><input type="number" name="a1" id="a1"></td><td><input type="number" name="a2" id="a2"></td><td><input type="number" name="b1" id="b1"></td><td><input type="number" name="b2" id="b2"></td><td><input type="number" name="c1" id="c1"></td><td><input type="number" name="c2" id="c2"></td></tr></tbody></table>';
    checkboxes.forEach(function(checkbox, i) {
        // Añade un event listener a cada checkbox
        checkbox.addEventListener('change', function () {
            let a = i+1;
            var itemB = document.getElementById("itemB"+a);
            if (this.checked) {
                // Cambia el color de fondo dependiendo del estado del checkbox
                itemB.classList.add("itemB");
                if(a === 4){
                    // Inserta la tabla de certificados al item de idioma
                    itemB.appendChild(table);
                    table.style.display = "block";
                }
            } else {
                itemB.classList.remove("itemB");
                if(a === 4){
                    table.style.display = "none";
                }
            }
        });
    });


    // var inicioSolicitud = document.getElementById("inicioSolicitud");
    // inicio
    // var finSolicitud = document.getElementById("finSolicitud");
    // var inicioPrueba = document.getElementById("inicioPrueba");
    // var finPrueba = document.getElementById("finPrueba");
    // var listaProv = document.getElementById("listaProv");
    // var listaDef = document.getElementById("listaDef");

    // function formatoFecha(id) {
    //     var fecha = document.getElementById(id).value;
    //     var fechaFormateada = fecha.split('-').reverse().join('/');
    //     console.log(fechaFormateada); // Muestra la fecha en formato dd/mm/yyyy
    // }

});



            // Cambia el color de fondo dependiendo del estado del checkbox
            // if (this.checked) {
            //     itemB.classList.add("itemB");
            // } else {
            //     itemB.classList.remove("itemB");
            // }
// if (a==4) {
//     itemB.appendChild("<table><thead><tr><th>A1</th><th>A2</th><th>B1</th><th>B2</th><th>C1</th><th>C2</th></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table>");
// }