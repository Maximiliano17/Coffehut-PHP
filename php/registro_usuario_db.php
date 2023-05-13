<?php

    include 'conexion_db.php';

    $submit = $_POST['submit'];

    $usuario = $_POST['name'];
    
    $password = $_POST['password'];

    $email = $_POST['email'];

   
    if(isset($submit)) {
    if(strpos($usuario, " ")) {
        echo '
            <script>
                alert("No se permiten espacios en el usuario.");
                window.location = "../index.php";
            </script>
        ';
    
        die;

    }

        if($usuario != NULL || $usuario != '' ){
            if(strlen($usuario) < 3) {
                echo '
                    <script>
                        alert("Usuario debe tener minimo 4 Caracteres.");
                        window.location = "../index.php";        
                    </script>
                ';

                die;
            }
        }

if(strpos($password, " ")) {
    echo '
        <script>
            alert("No se permiten espacios en la contrasenia.");
            window.location = "../index.php";
        </script>
        ';
        die;
}
    if($password != NULL || $password != '') {
            if(strlen($password) < 7) {
                echo '
                <script>
                    alert("Contrasenia debe tener minimo 8 Caracteres.");
                    window.location = "../index.php";        
                </script>
                ';
                die;
            } else {
                $password = hash('sha256', $password);
            }

            

        }

     }



    $query = "INSERT INTO usuarios(nombre, correo, clave) 
    VALUES('$usuario', '$email', '$password')";

    // Verificacion
    $verificacion_email = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$email' ");
    $verificacion_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre = '$usuario' ");

    if(mysqli_num_rows($verificacion_usuario) > 0) {
        echo '
            <script>
                alert("Este Nombre ya existe, porfavor intenta con otro diferente.");
                window.location = "../index.php";
            </script>
        ';

        exit();

    }


    if(mysqli_num_rows($verificacion_email) > 0) {
        echo '
            <script>
                alert("Este Correo ya esta registrado, intenta con otro diferente.");
                window.location = "../index.php";
            </script>
        ';

        exit();
        
    }


    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar) {
        echo '
            <script> 
                alert("Te registraste exitosamente!");
                window.location = "../login.php";
            </script>
            ';
        }else {
            echo '
                <script> 
                    alert("Error Intentalo Nuevamente");
                    window.location = "../index.php";
                </script>
            ';
        }

        mysqli_close($conexion);

?>