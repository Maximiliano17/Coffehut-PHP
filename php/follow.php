<?php 

session_start();

include './conexion_db.php';

$id = $_SESSION['id'];

$quer = "SELECT * FROM usuarios WHERE id = '".$id."' ";
$consulta = $conexion->query($quer);
$datos = $consulta->fetch_array();



?>