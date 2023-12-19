//Este es el bueno, increíble
HTMLInputElement.prototype.relleno=function () {
    var respuesta = false;
    if (this.value!="") {
        respuesta=true;
    }
    return respuesta;
}

HTMLInputElement.prototype.dni=function () {
    var letras = "TRWAGMYFPDXBNJZSQVHLCKET";
    var respuesta = false;
    if (this.value!="") {
        var partes = (/^(\d{8})([TRWAGMYFPDXBNJZSQVHLCKET])$/i).exec(this.value); //coincidencia completa -> partes[0], por eso hacemos partes[1] y partes[2]
        if (partes) {
            respuesta = letras[partes[1]%23]==partes[2].toUpperCase();
        }
        console.log(partes);
    }
    return respuesta;
}

HTMLInputElement.prototype.edad=function () {
    var respuesta = false;
    if (this.value==parseInt(this.value) && this.value>=0 && this.value<150) {
        var respuesta = true;
    }
    return respuesta;
}

HTMLInputElement.prototype.seleccionado=function () {
    var respuesta = false;
    var name = this.name;
    if (this.form[name].value!="") {
        respuesta = true;
    }
    return respuesta;
}

HTMLFormElement.prototype.valida=function () {
    var elementos = this.querySelectorAll("input[data-valida], select[data-valida]");
    console.log(elementos);
    var respuesta = true;
    let n = elementos.length;
    for (let i = 0; i < n; i++) {
        let tipo = elementos[i].getAttribute("data-valida"); //es lo mismo que elementos[i].data-valida.value
        var aux=elementos[i][tipo]();
        if (aux) {
            elementos[i].classList.add("valido");
            elementos[i].classList.remove("invalido");
        } else{
            elementos[i].classList.add("invalido");
            elementos[i].classList.remove("valido");
        }
        respuesta = respuesta&&aux;
    }

    return respuesta;
}

HTMLSelectElement.prototype.select=function(){
    var respuesta = false;
    var name = this.name;
    if (this.form[name].value!="-1") {
        respuesta = true;
    }
    return respuesta;
}

