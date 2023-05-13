<?php

include 'conexion_db.php';

    $consultas = "SELECT * from usuarios";
    $ejecutars = mysqli_query($conexion, $consultas);

    $listado = array();

    $sumador = 0;

    foreach($ejecutars as $key) {
        $sumador++;
        array_push($listado, $key['nombre']);
    }

?>