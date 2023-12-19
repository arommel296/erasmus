<?php
class Enrutador{
    static function enruta(){
        if (isset($_GET['menu'])) {
            if ($_GET['menu'] == "inicio") {
                require_once './vistas/pagPrincipal.php';
            }
            if ($_GET['menu'] == "loginSolicitud") {
                require_once './vistas/usuario/loginSolicitud.php';
            }
            if ($_GET['menu'] == "cerrarsesion") {
                require_once './vistas/login/cerrarSesion.php';
            }
            if ($_GET['menu'] == "listaConvocatorias") {
                require_once './vistas/usuario/listaConvocatorias.php';
            }
            if ($_GET['menu'] == "loginAdmin") {
                require_once './vistas/admin/loginAdmin.php';
            }
            if ($_GET['menu'] == "solicitud") {
                require_once './vistas/usuario/solicitud.php';
            }
            if ($_GET['menu'] == "crudConvocatoria") {
                require_once './vistas/admin/convocatoria.php';
            }
            if ($_GET['menu'] == "listaSolicitudes") {
                require_once './vistas/admin/listaSolicitudes.php';
            }
        } else{
            header("location: ?menu=inicio");
        }
    }
}
