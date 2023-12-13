<?php
class Autocargar{
    private static function autocargador($clase){
        $carpeta="";
        if (file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/entidades/".$clase.".php")) {
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/entidades/".$clase.".php";
        } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/vistas/".$clase.".php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/vistas/".$clase.".php";
        } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/".$clase.".php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/".$clase.".php";
        } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/repositorios/".$clase.".php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/repositorios/".$clase.".php";
        } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/interfaces/dbInterface.php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/interfaces/dbInterface.php";
        } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/api/".$clase.".php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/api/".$clase.".php";
        }else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/vistas/login".$clase.".php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/vistas/login".$clase.".php";
        }else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/vistas/principal".$clase.".php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/vistas/principal".$clase.".php";
        }
        //echo $carpeta;
        if ($carpeta != "") {
            require_once $carpeta;
        } else {
            throw new Exception("No se pudo autocargar la clase: " . $clase);
        }
    }

    public static function autocargar(){
        spl_autoload_register([self::class, 'autocargador']);
    }
}

Autocargar::autocargar();


