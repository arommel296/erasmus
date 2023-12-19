<?php
// require_once 'autocargar.php';
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/Autocargar.php";

class Validacion
{
    //Array de errores
    private $errores;

    //Constructor
    public function __construct()
    {
        $this->errores=array();
    }

     // Método para obtener los errores
     public function getErrores() {
        return $this->errores;
    }

    public function borrarErrores() {
        $this->errores = array();
    }

    /**
     * Comprueba si esta vacio
     *
     * @param [type] $campo
     * @return boolean
     */ 
    public function Requerido($campo)
    {
        if(!isset($_POST[$campo]) || empty($_POST[$campo]))
        {
            $this->errores[$campo]="El campo $campo no puede estar vacio";
            return false;
        }
        return true;
    }

    /**
     * Método que comprueba que el campo es un valor entero
     * y de manera opcional un rango de valores
     *
     * @param [String] $campo
     * @param [int] $min
     * @param [int] $max
     * @return boolean
     */
    public function EnteroRango($campo,$min=PHP_INT_MIN,$max=PHP_INT_MAX)
    {
        if(!filter_var($_POST[$campo],FILTER_VALIDATE_INT,
            ["options"=>["min_range"=>$min,"max_range"=>$max]]))
        {
            $this->errores[$campo]="Debe ser entero entre $min y $max";
            return false;
        }
        return true;
    }

    /**
     * Método que comprueba el número de caracteres de la cadena
     * entre un mínimo y un máximo
     *
     * @param [String] $campo
     * @param [integer] $max
     * @param integer $min
     * @return boolean
     */
    public function CadenaRango($campo,$max,$min=0)
    {
        if(!(strlen($_POST[$campo])>$min && strlen($_POST[$campo])<$max))
        {
            $this->errores[$campo]="Debe tener entre $min y $max caracteres";
            return false;
        }
        return true;

    }

    /**
     * Comprueba si el campo es un email válido
     *
     * @param [String] $campo
     * @return boolean
     */
    public function Email($campo)
    {
        if(!filter_var($_POST[$campo],FILTER_VALIDATE_EMAIL))
        {
            $this->errores[$campo]="Debe ser un email válido";
            return false; 
        }
        return true;
    }

    public function Dni($campo)
    {
        $letras="TRWAGMYFPDXBNJZSQVHLCKE";
        $mensaje="";
        if(preg_match("/^[0-9]{8}[a-zA-z]{1}$/",$_POST[$campo])==1)
        {
            $numero=substr($_POST[$campo],0,8);
            $letra=substr($_POST[$campo],8,1);
            if($letras[$numero%23]==strtoupper($letra))
            {
                return TRUE;
            }
            else
            {
                $mensaje="El campo $campo es un Dni con letra no válida";
            }
        }
        else
        {
            $mensaje="El campo $campo no es un Dni válido";
        }
        $this->errores[$campo]=$mensaje;
        return FALSE;
    }

    /**
     * Comprueba si el campo cumple una expresión regular (patrón)
     *
     * @param [string] $campo
     * @param [string] $patron
     * @return boolean
     */
    public function Patron($campo,$patron)
    {
        if(!preg_match($patron,$_POST[$campo]))
        {
            $this->errores[$campo]="No cumple el patrón $patron";
            return false;
        }
        return true;
    }

    /**
     * Ejecuta una función que será la encargada de validar el campo
     *
     * @param [type] $campo
     * @param [type] $funcion
     * @param [type] $mensaje
     * @return boolean
     */
    public function ValidaConFuncion($campo,$funcion,$mensaje)
    {
        if(!call_user_func($funcion))
        {
            $this->errores[$campo]=$mensaje;
            return false;
        }
        return true;
    }

    /**
     * Comprueba si hay errores
     *
     * @return boolean
     */
    public function ValidacionPasada()
    {
        if(count($this->errores)!=0)
        {
            return false;
        }
        return true;
    }

    public function ImprimirError($campo)
    {
        return
        isset($this->errores[$campo])?'<span class="error_mensaje">'.$this->errores[$campo].'</span>':'';
    }

    public function getValor($campo)
    {
        return
        isset($_POST[$campo])?$_POST[$campo]:'';
    }

    public function getSelected($campo,$valor)
    {
        return
        isset($_POST[$campo]) && $_POST[$campo]==$valor?'selected':'';
    }

    public function getChecked($campo,$valor)
    {
        return
        isset($_POST[$campo]) && $_POST[$campo]==$valor?'checked':'';
    }
 
    public function iguales($campo, $par1, $par2){
        //Si los parámetros son del mismo tipo y tienen el mismo valor devuelve TRUE.
        $param1=$_POST[$par1];
        $param2=$_POST[$par2];
        if (gettype($param1) == gettype($param2)){
            if ($param1 == $param2){
                return true;
            } else {
                $this->errores[$campo]="Las contraseñas deben ser iguales";
                return false;
            }
        }
    }

    public function Fecha($campo) {
        $fecha = DateTime::createFromFormat('Y-m-d', $_POST[$campo]);
        if(!$fecha || $fecha->format('Y-m-d') != $_POST[$campo]) {
            $this->errores[$campo] = "El campo $campo debe ser una fecha válida en formato 'Y-m-d'";
            return false;
        }
        return true;
    }
    
    public function FechaAntesQue($campo1, $campo2) {
        $fecha1 = DateTime::createFromFormat('Y-m-d', $_POST[$campo1]);
        $fecha2 = DateTime::createFromFormat('Y-m-d', $_POST[$campo2]);
    
        if(!$fecha1 || $fecha1->format('Y-m-d') != $_POST[$campo1]) {
            $this->errores[$campo1] = "El campo $campo1 debe ser una fecha válida en formato 'Y-m-d'";
            return false;
        }
    
        if(!$fecha2 || $fecha2->format('Y-m-d') != $_POST[$campo2]) {
            $this->errores[$campo2] = "El campo $campo2 debe ser una fecha válida en formato 'Y-m-d'";
            return false;
        }
    
        if($fecha1 > $fecha2) {
            $this->errores[$campo1] = "La fecha en el campo $campo1 no puede ser después de la fecha en el campo $campo2";
            return false;
        }
    
        return true;
    }
    
    
    

    public function validarCampo($campo, $tipos, $min=PHP_INT_MIN, $max=PHP_INT_MAX, $campo2=null) {
        foreach($tipos as $tipo) {
            switch($tipo) {
                case 'requerido':
                    if(!$this->Requerido($campo)) return false;
                    break;
                case 'entero':
                    if(!$this->EnteroRango($campo, $min, $max)) return false;
                    break;
                case 'email':
                    if(!$this->Email($campo)) return false;
                    break;
                case 'cadena':
                    if(!$this->CadenaRango($campo, $min, $max)) return false;
                    break;
                case 'fecha':
                    if(!$this->Fecha($campo)) return false;
                    break;
                case 'fechaAntesQue':
                    if(!$this->FechaAntesQue($campo, $campo2)) return false;
                    break;
                default:
                    $this->errores[$campo] = "Tipo de validación desconocido: $tipo";
                    return false;
            }
        }
        return true;
    }
    


}



