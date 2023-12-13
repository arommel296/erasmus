<!-- <form method="post" action="">
    <label for="usuario">Usuario:</label><br>
    <input type="text" id="usuario" name="usuario"><br>
    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="submit" name="submit" value="Iniciar sesión">
</form>
<p class='text-center'><a href='?menu=registro'>Crear una Cuenta</a></p> -->
<div class="inicioSesion-container">
    <form method="post"class="formInicioSesion" action="">
        <label for="usuario" >Usuario:</label><br>
        <input autocomplete="on" class="input-form" type="text" placeholder="Usuario" id="usuario" name="usuario"><br>
        <label for="password" >Contraseña:</label><br>
        <input class="input-form" type="password"  placeholder="Contraseña" id="password" name="password"><br>
        <a href='?menu=registro'>Crear una Cuenta</a>
        <input type="submit" name="submit" value="Iniciar sesión">
    </form>
</div>
<?php
    session_unset();
    Session::cierraSesion();
    $valida=new Validacion();
    $repo=new UsuarioRepo();
    if(isset($_POST['submit']))
    {
        $nomUsu=$_POST['usuario'];
        $passUsu=$_POST['password'];
        // $valida->Requerido($nomUsu); //puede generar error
        // $valida->Requerido($passUsu); //puede generar error
        echo $nomUsu;
        //Comprobamos validacion
        if($valida->ValidacionPasada())
        {
            // $usuario=null;
            $usuario=$repo->findByNamePass($nomUsu, $passUsu);
            // $repo->u($nomUsu);
            if($usuario!=null)
            {
                //echo $_SESSION['usuario'];
                Login::login($nomUsu);
                echo $nomUsu;
                echo $_SESSION['usuario'];
                $_SESSION['rol']=$usuario->getRol();

                header("location: ?menu=inicio");
                
            } else{
                echo json_encode(['error'=>'No se ha podido iniciar sesión']);
                echo $nomUsu;
            }
        }
    }
?>
