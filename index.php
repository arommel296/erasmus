<?php
class Principal
{
    public static function main()
    {
        require_once './helpers/Autocargar.php';
        require_once './helpers/Session.php';
        require_once './vistas/principal/layout.php';
    }
}
Principal::main();
?>