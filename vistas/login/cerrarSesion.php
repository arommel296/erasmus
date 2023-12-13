<?php
Session::iniciaSesion();
setcookie('recuerdame',Session::leerSesion('login'),time()-10);
Session::cierraSesion();
header("location:?menu=inicio");
?>