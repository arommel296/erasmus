import Recuadro from "./recuadro.js";


window.addEventListener("load", function () {
    var btnCapturar = document.getElementById("capturar");

    btnCapturar.addEventListener("click", capturar);

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
    }

    var player = document.createElement('video');
    player.id = 'player';
    player.style.width = '50%';
    player.style.height = '50%';
    player.style.zIndex = 102;
    player.autoplay = true;

    var captureButton = document.createElement('button');
    captureButton.id = 'capture';
    captureButton.innerText = 'Capturar';
    captureButton.style.zIndex = 102;

    visualizador.appendChild(player);
    visualizador.appendChild(captureButton);

    player.style.position = 'absolute';
    player.style.top = '100px';
    player.style.left = '50px';

    captureButton.style.position = 'absolute';
    captureButton.style.bottom = '5px';
    captureButton.style.right = '5px';

    const canvas = document.createElement('canvas');
    canvas.id = 'canvas';
    canvas.width = "448px"; // Establece el ancho del canvas igual al ancho del video
    canvas.height = "337px"; // Establece el alto del canvas igual al alto del video
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

    captureButton.addEventListener('click', () => {
        // Draw the video frame to the canvas.
        context.drawImage(player, 0, 0, canvas.width, canvas.height);
        // Aquí puedes crear tu objeto Recuadro y usarlo para recortar la imagen.
        var recuadro = new Recuadro(0, 0, canvas.width, canvas.height, canvas);
        var imagenRecortada = recuadro.recortar();

        imagenRecortada.style.position = 'absolute';
        imagenRecortada.style.top = '100px';
        imagenRecortada.style.right = '50px';
        imagenRecortada.style.width = player.style.width - 136;
        imagenRecortada.style.height = player.style.height;
        // imagenRecortada.style.width = 448;
        // imagenRecortada.style.height = 337;
        visualizador.appendChild(imagenRecortada);

        let fotillo = document.getElementById("canv").toDataURL('image/png') ;
        localStorage.setItem('imagen', fotillo);
        let img = document.getElementById('foto');
        img.src = localStorage.getItem('imagen');

    });

}