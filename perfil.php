<?php

    error_reporting(0);

    include 'php/conexion_db.php';

    session_start();

    if(!isset($_SESSION['usuario'])) {
        echo '
            <script>
                alert("Por favor debes iniciar sesion");
                window.location = "index.php";
            </script>
        ';

        session_destroy();
        die();
    }

    $perfil_name = $_SESSION['usuario'];

    $id = $_SESSION['id'];

    $quer = "SELECT * FROM usuarios WHERE id = '".$id."' ";
    $consulta = $conexion->query($quer);
    
    
    
    $datos = $consulta->fetch_array();
    $datos_name = $datos['nombre']; 
    $qry1 = "SELECT * FROM perfil WHERE nick = '$datos_name' ";
    $consult1 = $conexion->query($qry1);
    $resulting1 = $consult1->fetch_array();
    $img_perfil = $resulting1['image_perfil'];
 
    if($img_perfil == NULL) {
        $path = 'assets/images/default.webp';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        
        $img_perfil = $data;
    }

    

    if($resulting1['about'] == NULL) {
        $datos_desc = '';
    } else {
        $datos_desc = $resulting1['about'];
    }
    //echo $datos_name;

?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/perfil.css">
    <title><?php echo $datos['nombre'].' || Perfil'; ?> </title>
</head>
<body>
    <div id="container">
    <header id="header">
          <nav class="navbar">
            <a href = "Coffehut.php" class = "item_inicio">Inicio</a>
            <form action="php/search.php" method = "POST">
                <div class="input-wrapper">
                    <input name = "search" type="search" class="input" placeholder="Buscar en Waiycof">
                        <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
            </form>    
                <div class="perfil mostrar">
                    <img class = "image-post"  src="data:image/jpg;base64,<?php echo base64_encode($img_perfil); ?>">
                   
                   <p class = "name"> <?php echo $datos['nombre']; ?> </p>
                    
                    
                    <svg class = "arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M16.939 7.939 12 12.879l-4.939-4.94-2.122 2.122L12 17.121l7.061-7.06z"></path></svg>
                        <div class="submenu">
                        <a href="perfil.php" class = "item">Perfil </a>
                        <a href="#" class = "item">Configuracion</a>
                        <a href="php/cerrar_sesion.php" class = "item">Cerrar sesion</a>
                    </div>
                </div>
            </nav>
        </header>
        <div id="contenedor-perfil">
            <div class="perfil-left">
                <aside>
                    <div>
                    <img src="data:image/jpg;base64,<?php echo base64_encode($img_perfil); ?>">
                            <button class = "edit-perfil" id = "edit-perfil">Editar Perfil</button>
                        </img>
                        <p class = "name"> <?php echo  $datos['nombre']; ?> </p>
                    </div>
                    <p class = "desc_title">Sobre mi</p>
                    <p class = "desc_text"> <?php echo $datos_desc; ?></p>
                </aside>
            </div>
            <div class="perfil-right" id = "content">
            <div class="content-post">
                    <?php 

                        $posteo_query = "SELECT * from posteos";
                        $ejecutar_posteo = $conexion->query($posteo_query);
                        foreach($ejecutar_posteo as $key) {
                            if($datos_name == $key['send']): ?>
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


                        <?php endif; 
                        }
                    ?>                                        
            </div>
         </div>
    </div>
</div>
    <div id="container-edit-perfil">
            <div> 
                <div class="perfil-square">
                    <p>Editar Perfil</p>
                    <form id = "form-edit" action="php/form_edit.php" method = "POST" enctype="multipart/form-data">
                        <label for="edit-name">Nombre: 
                            <input class = "i-form" type="text" name = "edit-name" value = <?php echo $datos['nombre']; ?>>
                        </label>
                        <label for="edit-email">Correo: 
                            <input class = "i-form" type="email" name = "edit-email" value = <?php echo $datos['correo']; ?>>
                        </label>
                        <label for="edit-password">Contraseña: 
                            <input class = "i-form" type="password" name = "edit-password" value = <?php echo $datos['clave'] ?> >
                        </label>
                        <label for="edit-desc">Descripcion: 
                            <input class = "i-form" type="text" name = "edit-desc" value = "<?php echo $datos_desc ?>" >
                        </label>
                        <label for="edit-imagen" class = "edit-imagen">Imagen de perfil
                            

                                <input class = "i-form" id = "file-image" type="file" name = "edit-imagen">
                            
                        </label>
                        <div>
                            <input type = "reset" class = "btn-form" value = "Cancelar">
                            <input class = "input-form" type="submit" value = "Confirmar">
                        </div>
                    </form>
                </div>  
                  
            </div>
    <script src = "assets/js/edit.js"></script>
    <script src="assets/js/perfil.js"></script>
</body>
</html>