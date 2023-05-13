<?php
/*
    $servidor = 'sql203.epizy.com';
    $usuario = 'epiz_32183960';
    $contrasena = 'CGkGU39v9aqi';
    $database = 'epiz_32183960_login_register_db';
*/


    $servidor = 'localhost';
    $usuario = 'root';
    $contrasena = '';
    $database = 'login_register_db';


    $conexion = mysqli_connect("$servidor", "$usuario", "$contrasena", "$database");



?>