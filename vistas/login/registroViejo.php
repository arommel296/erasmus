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

            $repo->insert($usuario);
        }
    }
?>
    <form method="post" action="">
        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario"><br>
        <?= $valida->ImprimirError('usuario') ?>
        <label for="password1">Contraseña:</label><br>
        <input type="password" id="password1" name="password1"><br>
        <?= $valida->ImprimirError('password1') ?>
        <label for="password2">Repetir Contraseña:</label><br>
        <input type="password" id="password2" name="password2"><br>
        <?= $valida->ImprimirError('password2') ?>
        <a href="?menu=login">Ya tengo cuenta</a>
        <input type="submit" name="submit" value="Registrarme">
    </form>
