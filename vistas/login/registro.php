<?php
    $valida=new Validacion();
    $repo=new UsuarioRepo();
    if(isset($_POST['submit']))
    {
        $password2=$_POST['password2'];
        $valida->Requerido('usuario');
        $valida->Requerido('password1');
        $valida->Requerido('password2');
        $valida->Iguales($password2,'password1', 'password2');
        //Comprobamos validacion
        if($valida->ValidacionPasada())
        {
            $usuario = new Usuario();
            $usuario->setNombre($_POST['usuario']);
            $usuario->setPassword($_POST['password1']);
            //var_dump($usuario);
            // echo $usuario->getNombre();
            // var_dump($_POST);
            $repo->insert($usuario);
            //$url=$_GET['returnurl'];
            //header("location:?menu=login");
        }
    }
?>
<div class="inicioSesion-container">
    <form method="post" class="formInicioSesion" action="Inicio.php">
        <label for="usuario" >Usuario:</label><br>
        <input autocomplete="on" class="input-form" type="text" placeholder="Usuario" id="usuario" name="usuario"><br>
        <label for="password" >Contraseña:</label><br>
        <input class="input-form" type="password"  placeholder="Contraseña" id="password" name="password"><br>
        <label for="password" >Repite la contraseña:</label><br>
        <input class="input-form" type="password"  placeholder="Contraseña" id="password" name="password"><br>
        <a href="?menu=login">Ya tengo cuenta</a>
        <input type="submit" name="submit" value="Registrarse">
    </form>
</div>