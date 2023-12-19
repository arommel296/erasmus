<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/Autocargar.php";
$itemRepo = new ItemBaremableRepo();
$convoRepo = new ConvocatoriaRepo();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['item'])) {


        header('Content-Type: application/json');
        echo json_encode($items);
    }
}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST)) {
        $usuario = $_POST['usuario'];

        
        header('Content-Type: application/json');
        echo json_encode($item);
    }
} elseif($_SERVER["REQUEST_METHOD"] == "PUT"){

} elseif($_SERVER["REQUEST_METHOD"] == "DELETE"){
    if (isset($_GET)) {

        echo '{"respuesta":"200"}';
    } else{
        echo '{"respuesta":"ERROR"}';
    }
}