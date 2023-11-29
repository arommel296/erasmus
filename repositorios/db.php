<?php
//require_once 'autocargar.php';
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

class Db{
    private static $conexion=null;
    private static $host = 'localhost';
    private static $db = 'autoescuela';
    private static $user = 'alvaro';
    private static $pass = 'alvaro';

    // Método getter para la conexión
    public static function getConexion() {
        return self::$conexion;
    }


    public static function conecta(){
        if(self::$conexion==null){
            try {
                self::$conexion = new PDO("mysql:host=".self::$host.";dbname=".self::$db, self::$user, self::$pass);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                //echo "Error: " . $e->getMessage();
            }
        }
        return self::getConexion();
    }

}