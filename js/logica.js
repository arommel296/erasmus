window.addEventListener("load", function () {
    const boton = document.getElementById("submit");
    console.log(boton);
    boton.onclick=function (ev) {
        ev.preventDefault();
        if (this.form.valida()) {
            this.form.classList.add("valido");
            this.form.classList.remove("invalido");
        } else{
            this.form.classList.add("invalido");
            this.form.classList.remove("valido");
        }
    }
})