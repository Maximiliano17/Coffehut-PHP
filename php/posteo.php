<?php
session_start();
include 'conexion_db.php';

$send = $_POST['send'];
$text = $_POST['text-post'];
$img_name = $_FILES['img-file']['name'];
$imagenes = addslashes(file_get_contents($_FILES['img-file']['tmp_name']));

$from = $_SESSION['usuario'];

if(isset($send)) {

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);

    if($text != '') { 
        if($imagenes == NULL) {
            
            $query4 = "INSERT INTO posteos(texto, imagen, send) 
            VALUES('$text', '$imagenes', '$from')";

            $enviar = mysqli_query($conexion, $query4);

            
            echo '
                <script>
                    window.location = "../Coffehut.php";
                </script>
            ';            
        } else if($img_ex_lc == 'jpg' || $img_ex_lc == 'png' || $img_ex_lc == 'jpeg') {

            $query4 = "INSERT INTO posteos(texto, imagen, send) 
            VALUES('$text', '$imagenes', '$from')";

            $enviar = mysqli_query($conexion, $query4);

            echo '
                <script>
                    window.location = "../Coffehut.php";
                </script>
                ';            
        } else {
            echo '
            <script>
                alert("Formato no Permitido");
                window.location = "../Coffehut.php";
            </script>
            ';
            exit;
        }


    } else if($text == '' && $imagenes == false) {
        echo '
            <script>
                alert("Texto Vacio!");
                window.location = "../Coffehut.php";
            </script>  
        ';
        exit;
    } else {
        $query4 = "INSERT INTO posteos(texto, imagen, send) 
            VALUES('$text', '$imagenes', '$from')";

            $enviar = mysqli_query($conexion, $query4);
        echo '
                <script>
                    window.location = "../Coffehut.php";
                </script>
                ';      
    }

}


?>