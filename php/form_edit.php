<?php

    include './conexion_db.php';

    session_start();

    // tabla 
    $id = $_SESSION['id'];
    $quer = "SELECT * FROM usuarios WHERE id = '".$id."' ";
    $consulta = $conexion->query($quer);
    $datos = $consulta->fetch_array();

    // perfil
    $query_perfil = "SELECT * FROM perfil";
    $consulta_perfil = $conexion->query($query_perfil);
    $datos_perfil = $consulta_perfil->fetch_array();

    $nameuser = $datos['nombre'];
    $correo = $datos['correo'];
    $clave = $datos['clave'];
    $claveD = hash('sha256', $clave);

    $name = $_POST['edit-name'];
    $email = $_POST['edit-email'];
    $password = $_POST['edit-password'];
    $desc = $_POST['edit-desc'];
    $picture = addslashes(file_get_contents($_FILES['edit-imagen']['tmp_name']));
    $img_name = $_FILES['edit-imagen']['name'];
    
    // Nombre
    if(strlen($name) > 0 && $name != $nameuser) {
        $verificar_nombre = mysqli_query($conexion,"SELECT * FROM usuarios WHERE nombre ='$name' ");
            if(mysqli_num_rows($verificar_nombre) > 0) {
                echo '
                    <script>
                        alert("Este nombre ya existe!");
                        window.location = "../perfil.php";
                    </script>
                ';
                
            } else {
                $modificar = mysqli_query($conexion, "UPDATE usuarios set nombre = '$name' WHERE nombre = '$nameuser' ");            
                $modificar_send = mysqli_query($conexion, "UPDATE posteos set send = '$name' WHERE send = '$nameuser' ");
                $modificar_send = mysqli_query($conexion, "UPDATE perfil set nick  = '$name' WHERE nick = '$nameuser' ");
                
                echo '
                    <script>
                        alert("Nombre Actualizado Con Exito!");
                        alert("Necesita Volver a logearse");
                        window.location = "../login.php";
                    </script>
                    ';
                session_destroy();
            }
    }

    // Correo
    if(strlen($email) > 0 && $email != $nameuser) {
        $verificar_correo = mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo ='$email' ");
            if(mysqli_num_rows($verificar_correo) > 0) {
                echo '
                    <script>
                        
                       window.location = "../perfil.php";
                    </script>
                ';
                
            } else {
                $modificar = mysqli_query($conexion, "UPDATE usuarios set correo = '$email' WHERE correo = '$correo' ");            
                echo '
                    <script>
                        alert("Correo Actualizado Con Exito!");
                        alert("Necesita Volver a logearse");
                        window.location = "../login.php";
                    </script>
                    ';

                    session_destroy();
            }
    }

    // password

    if(strlen($password) > 0 && $password != $clave) {
        $password_enc = hash('sha256', $password);
        $modificar = mysqli_query($conexion, "UPDATE usuarios set clave = '$password_enc' WHERE clave = '$clave' ");
        echo '
                    <script>
                        alert("Clave Actualizada Con Exito!");
                        alert("Necesita Volver a logearse");
                        window.location = "/login.php";
                    </script>
                    ';
        
        session_destroy();
    
    }

    // Descripcion

    
    if(strlen($desc) > 0) {
    
        $verificar_desc = mysqli_query($conexion,"SELECT * FROM perfil WHERE nick ='$nameuser' ");
        if(mysqli_num_rows($verificar_desc) > 0) {
            $nick = $datos_perfil['nick'];
            $qry = "SELECT * FROM perfil WHERE nick = '".$nameuser."' ";
            $consult = $conexion->query($qry);
            $result = $consult->fetch_array();
            $str = $result['about'];
            $modificar = mysqli_query($conexion, "UPDATE perfil set about = '$desc' WHERE about = '$str' ");

            echo '
            <script>
                alert("Descripcion Actualizada Con Exito!");
            /window.location = "../perfil.php";
            </script>
            ';

    } else {
        $desc_query = "INSERT INTO perfil(about, nick, image_perfil, default_perfil) 
        VALUES('$desc', '$nameuser', '', 'true')";
        $ejecutar = mysqli_query($conexion, $desc_query);
        echo '
        <script>
            alert("Descripcion Agregada Con Exito!");
            window.location = "../perfil.php";
        </script>
        ';
        

    }

   



    }

    // imagenes
    if($picture) {
        $img2_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img2_ex_lc = strtolower($img2_ex);
        $verificar_img = mysqli_query($conexion,"SELECT * FROM perfil WHERE nick ='$nameuser' ");
        
            if($img2_ex_lc == 'jpg' || $img2_ex_lc == 'png' || $img2_ex_lc == 'jpeg') {
    
                if(mysqli_num_rows($verificar_img) > 0) {  
                    echo 'imagen actualizadad con exito!';
                    $qry = "SELECT * FROM perfil WHERE nick = '".$nameuser."' ";
                    $consult = $conexion->query($qry);
                    $result = $consult->fetch_array();
                    $img_actually = $result['nick'];
                    $modificar = mysqli_query($conexion, "UPDATE perfil set image_perfil = '$picture' WHERE nick = '$img_actually' ");
                    echo '
                    <script>
                        alert("Imagen Actualizada Con Exito!");
                        window.location = "../perfil.php";
                    </script>
                    ';
                } else {
                    $img_query = "INSERT INTO perfil(image_perfil, nick, about) 
                    VALUES('$picture', '$nameuser', ' ')";
                    $ejecutar = mysqli_query($conexion, $img_query);
                    echo '
                    <script>
                        alert("Imagen Agregada Con Exito!");
                        window.location = "../perfil.php";
                    </script>
                    ';
                }
                

            } else {
                echo '
                <script>
                    alert("Formato incorrecto!");
                    window.location = "../perfil.php";
                </script>
                ';
            }
    } 
?>