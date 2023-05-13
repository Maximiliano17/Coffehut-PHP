<?php

    session_start();

    include 'conexion_db.php';

    $nombre = $_POST['name'];
    $clave = $_POST['password'];
    $clave = hash('sha256', $clave);

    $query1 = mysqli_query($conexion,"SELECT * FROM usuarios WHERE nombre ='$nombre' AND clave='$clave' ");
    $q2 = $query1->fetch_array();

    if(mysqli_num_rows($query1) > 0) {
       $_SESSION['usuario'] = $nombre;
        $_SESSION['id'] = $q2['id'];
            
            



        
        header("location: ../Coffehut.php");
        exit;

    }  else {
       echo '
            <script>
                alert("Usario no existe, por favor verifique los datos introducidos");
                window.location = "../login.php";
            </script>
       ';

       exit;
    }

?>