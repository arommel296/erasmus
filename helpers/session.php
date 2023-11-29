<?php
// class sesion con todas las funciones estáticas
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

class Session{
    static function iniciaSesion(){
        session_start();
    }
    
    static function cierraSesion(){
        session_destroy();
    }
    
    static function guardaSesion($clave,$valor){
        $_SESSION[$clave] = $valor;
    }
    
    static function leerSesion($clave){
        if (isset($_SESSION[$clave])) {
            return $_SESSION[$clave];
        } else {
            return null;
        }
    }
    
    static function existeValor($clave){
        $user=null;
        if (isset($_SESSION[$clave])){
            $user=$_SESSION[$clave];
            echo $user;
        }
        echo $user;
        return $user;
    }
}