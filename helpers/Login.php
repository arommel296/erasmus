<?php
// class login con todas las funciones estáticas
class Login {
    static function login($a){
        Session::iniciaSesion();
        echo 'w';
        //echo '<script>console.log('.$a.');</script>';
        $_SESSION['usuario']=$a;
    }
    
    static function guardaUsuario(){
        $_SESSION['usuario']=$_POST['usuario'];
    }

    static function logout(){
        Session::cierraSesion();
    }
    
    static function estaLogeado(){
        return Session::existeValor('user');
    }
}