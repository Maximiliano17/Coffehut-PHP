<?php
    session_start();

    include 'php/conexion_db.php';

    include 'php/random_users.php';

    $perfil_name = $_SESSION['usuario']; 

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

    $id = $_SESSION['id'];

    $quer = "SELECT * FROM usuarios WHERE id = '".$id."' ";
    $consulta = $conexion->query($quer);
    error_reporting(0);
    $datos = $consulta->fetch_array();
    $datos_name = $datos['nombre'];

    $qry1 = "SELECT * FROM perfil WHERE nick = '$datos_name' ";
    $consult1 = $conexion->query($qry1);
    $resulting1 = $consult1->fetch_array();
    $default_perfil = $resulting1['default_perfil'];
    $img_perfil = $resulting1['image_perfil'];
    $nick_perfil = $resulting1['nick'];

    if($img_perfil == NULL) {
        $path = 'assets/images/default.webp';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        //echo '<img src="' . $path . '" alt="imagen"/>';

      
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
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Coffehut</title>
</head>
<body>
    <div id="container">
        <header id="header">
          <nav class="navbar">
            <a href = "Coffehut.php" class = "item_inicio">Inicio</a>
            <form action="php/search.php" method = "POST">
                <div class="input-wrapper">
                    <input name = "search" type="search" class="input input_search" placeholder="Buscar en Waiycof">
                        <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
            </form>   
            <div class="perfil mostrar">
                <?php if($img_perfil || $default_perfil == 'vacio') { ?>
                    <img class = "profile_picture"  src="data:image/jpg;base64,<?php echo base64_encode($img_perfil); ?>">
                <?php } elseif($img_perfil == false) { 
                    echo '<img src="' . $path . '" alt="imagen"/>';
                 } ?>
                   <p class = "name"> <?php echo  $perfil_name ?> </p>
                  
                    <svg class = "arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M16.939 7.939 12 12.879l-4.939-4.94-2.122 2.122L12 17.121l7.061-7.06z"></path></svg>
                        <div class="submenu">
                        <a href="perfil.php?id=<?php echo $_SESSION['id']; ?>" class = "item">Perfil </a>
                        <a href="#" class = "item">Configuracion</a>
                        <a href="php/cerrar_sesion.php" class = "item">Cerrar sesion</a>
                    </div>
                </div>
            </nav>
        </header>
    <main id="main">
        <aside id="col-left">
            <div>
                <p>c</p>
                <p>o</p>
                <p>f</p>
                <p>f</p>
                <p>e</p>
                <p>h</p>
                <p>u</p>
                <p>t</p>
            </div>
        </aside>
        <div id="content">
            <div class="content-post">
                    <?php
                        $consulta = "SELECT * from posteos";
                        $ejecutar = mysqli_query($conexion, $consulta);
                        foreach($ejecutar as $var):
                        
                        
                        ?>
                <div class="posteo">   
                <div>
                        <?php 

                            $name_temp = $var['send'];

                            $qry3 = "SELECT * FROM perfil WHERE nick = '$name_temp' ";
                            $consult2 = $conexion->query($qry3);
                            if(mysqli_num_rows($consult2) > 0):
                            
                            

                            $qry4 = "SELECT image_perfil FROM perfil WHERE nick = '$name_temp' ";
                            $consult3 = $conexion->query($qry4);
                            $array = $consult3->fetch_array();


                            
                        ?>
                        
                        <script>
                            function LoadError() {
                                //const imgs=Array.from(document.querySelector('#image_perfil_load'));
                                const imgs=Array.from(document.querySelectorAll('#image_perfil_load'));

                                imgs.forEach(i => i.addEventListener('error',event => {
                                    i.src = "assets/images/default.webp";
                                })
                                );
                                
                                
                            }

                        </script>

                        <img onerror = "LoadError()" id = "image_perfil_load" src="data:image/jpg;base64,<?php echo base64_encode($array['image_perfil']); ?>">

                        <? endif; //$img_perfil ?>
                        <p> 
                            <?php 
                                echo $var['texto'];                             
                             ?> 
                        </p>
                    </div> 
                    
                        <!-- Imagen aqui class = "image-post"-->
                     
                    
                            


                            
                        <?php if($var['imagen']): ?>
                         
                        <img class = "image-post"  src="data:image/jpg;base64,<?php echo base64_encode($var['imagen']); ?>">
                        
                        <?php endif; ?>
                        
                        
                       
                      
                            <p class = "username">~ <?php echo $var['send'];  ?> </p>
                            
                        
                    </div>
                
                <?php
                    endforeach;
                ?>

            </div>
            <script>
                'use strict';

                function Scroll() {

                var div = document.querySelector('.content-post');

                var objdiv = document.querySelector('.content-post');

                // ScrollTop ej: Si esta arriba de todo sera de 0
                // ScrollHeight ej: Es el maximo de altura o de scroll que tiene el contenedor en este caso es aproximadamente de 5600px, por lo tanto si decimos que el scrollTop que es la altura en la cual esta en este preciso momento la pagina ahora le decimos que sea igual a la altura maxima que llega el contenedor, nos llevara abajo de todo.
                objdiv.scrollTop = objdiv.scrollHeight;


               
                }
                function Search() {
                    let input_search = document.querySelector('.input_search');
                    input_search.textcontent = "hola";
                }
                Scroll();
            </script>
            <div class="send">
            <form action = "php/posteo.php" method = "POST" enctype = "multipart/form-data">
                <?php if($img_perfil) { ?>
                    <img class = "profile_picture"  src="data:image/jpg;base64,<?php echo base64_encode($img_perfil); ?>">
                <?php } else { 
                    echo '<img src="' . $path . '" alt="imagen"/>';
                 } ?>     
                    <textarea name = "text-post" maxlength = "500" placeholder = "Que esta pasando?"></textarea>
                        <div class = "file-container">
                        <svg  class = "add-image" xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(56, 22, 0, 1);transform: ;msFilter:;"><path d="M4 5h13v7h2V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-2H4V5z"></path><path d="m8 11-3 4h11l-4-6-3 4z"></path><path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z"></path></svg>
                            <input type="file" name = "img-file">
                        </div>
                    
                        <input name = "send" type="submit" value = "Enviar" class = "env-consulta">   
                    </form>
            </div>
        </div>
        <aside id="col-right">
        <script>
            function Perfil(name) {
                window.location = ` php/search.php?nombre=${name}`;
            }
        </script>
            <div class = "random_profiles">
            <?php for($i = 0; $i < $sumador; $i++): ?>
                <?php
                if($datos_name != $listado[$i]):
                       
                $name_temp = $listado[$i];

                $qry3 = "SELECT * FROM perfil WHERE nick = '$name_temp' ";
                $consult2 = $conexion->query($qry3);
                if(mysqli_num_rows($consult2) > 0):

                $qry4 = "SELECT image_perfil FROM perfil WHERE nick = '$name_temp' ";
                $consult3 = $conexion->query($qry4);
                $array = $consult3->fetch_array();
                $arr_img = $array['image_perfil'];

                
                
                ?>

                <div class = "random_content" onclick = Perfil("<?php echo $name_temp; ?>");>
                  
                <img id = "image_perfil_load" onerror = "LoadError()" src="data:image/jpg;base64,<?php echo base64_encode($arr_img); ?>">
                
                        <p> <?php echo $listado[$i]; ?> </p>
        
                    </form>
                </div>
                <?php endif; endif; endfor; ?>
            </div>
            
        </aside>
    </main>  
      
</div>



<script src = "assets/js/posteos.js"></script>
<script src = "assets/js/load_images.js"></script>
<script src="assets/js/scroll.js"></script>
<script src="assets/js/perfil.js"></script>
</body>
</html>