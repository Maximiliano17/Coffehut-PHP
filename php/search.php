<?php


error_reporting(0);

session_start();

$get_nombre = $_GET["nombre"];

include 'conexion_db.php';

$perfil_name = $_SESSION['usuario'];

$busqueda_verif = $_POST['search'];

if($busqueda_verif) {
    $busqueda = $_POST['search'];
} else {
    $busqueda = $get_nombre;
}



$consulta = "SELECT * FROM usuarios WHERE nombre = '$busqueda'";

$query = mysqli_query($conexion, $consulta);


$result = $query->fetch_array();


if($result) {
    if($busqueda == $perfil_name) {
        echo '
            <script>
                window.location = "../perfil.php";
            </script>
        ';
    }
} else {
    echo '
    <script>
        alert("Usuario no Encontrado!");
        window.location = "../Coffehut.php";
    </script>
';
}

$qry = "SELECT * FROM perfil WHERE nick = '$busqueda' ";
$consult = $conexion->query($qry);
$resulting = $consult->fetch_array();


$img_perfil = $resulting['image_perfil'];

$id = $_SESSION['id'];

$quer = "SELECT * FROM usuarios WHERE id = '".$id."' ";
$consulta = $conexion->query($quer);

$datos = $consulta->fetch_array();

$datos_name = $datos['nombre'];


$query1 = "SELECT * FROM perfil WHERE nick = '$datos_name' ";
$consulta1 = $conexion->query($query1);
$resultado1 = $consulta1->fetch_array();
$img_perfil2 = $resultado1['image_perfil'];

if($img_perfil2 == NULL) {
    $path = '../assets/images/default.webp';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);

    $img_perfil2 = $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/perfil.css">
    <title> perfil de <?php echo $result['nombre'].' || Perfil'; ?> </title>
</head>
<body>
    <div id="container">
    <header id="header">
          <nav class="navbar">
            <a href = "../Coffehut.php" class = "item_inicio">Inicio</a>
            <form action="./search.php" method = "POST">
                <div class="input-wrapper">
                    <input name = "search" type="search" class="input search" placeholder="Buscar en Waiycof">
                        <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
            </form>    
                <div class="perfil mostrar">
                <img class = "image-post"  src="data:image/jpg;base64,<?php echo base64_encode($img_perfil2); ?>">
                   
                   <p class = "name"> <?php echo $perfil_name ?> </p>
                      
                    <svg class = "arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M16.939 7.939 12 12.879l-4.939-4.94-2.122 2.122L12 17.121l7.061-7.06z"></path></svg>
                        <div class="submenu">
                        <a href="../perfil.php" class = "item">Perfil </a>
                        <a href="#" class = "item">Configuracion</a>
                        <a href="./cerrar_sesion.php" class = "item">Cerrar sesion</a>
                    </div>
                </div>
            </nav>
        </header>
        <div id="contenedor-perfil">
            <div class="perfil-left">
                <aside>
                    <div>
                    <img class = "image-post"  src="data:image/jpg;base64,<?php echo base64_encode($img_perfil); ?>">
                        <p class = "name"> <?php echo  $result['nombre'] ?> </p>
                        <form action="./follow.php" method = "POST" disabled>
                            <input class = "follow" type="submit" value = 'Seguir'>
                        </form>
                    </div>
                    <p class = "desc_title">Sobre Mi</p>
                    <p class = "desc_text"> <?php echo $resulting['about']; ?></p>
                </aside>
            </div>
            <div class="perfil-right" id = "content">
            <div class="content-post">
            <?php 

            $posteo_query = "SELECT * from posteos";
            $ejecutar_posteo = $conexion->query($posteo_query);
            $contador = 0;
            foreach($ejecutar_posteo as $key) {
                if($result['nombre'] == $key['send']){ $contador++; ?>
            <div class="posteo">
                <div>
                    <img src="data:image/jpg;base64,<?php echo base64_encode($img_perfil); ?>">
                    <p> 
                    <?php echo $key['texto']; ?>
                    </p>
                </div>
            <?php if($key['imagen']): ?>
 
            <img class = "image-post"  src="data:image/jpg;base64,<?php echo base64_encode($key['imagen']); ?>">
  
            <?php endif; ?>

        </div>


            <?php }  ?>
                   
            <?php } if($contador == 0): ?>
                    
                <p class = "error_post">Esta Cuenta no tiene posteos</p>
                
            <?php endif; ?> 
                </div>
            </div>
        </div>
    </div>       
</div>
    <script src="../assets/js/perfil.js"></script>
    <script src="../assets/js/search.js"></script>
</body>
</html>