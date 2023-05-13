<?php


session_start();

if(isset($_SESSION['usuario'])){
	echo '
	<script>
		window.location = "Coffehut.php";
	</script>  
	';
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="assets/css/login-register.css">
	<title>Formulario</title>
</head>
<body>
	<div id="container">
		<div id="content-two">
			<img src="assets/images/imagen.jpeg">
		</div>
		<div id="content-form">
			<div class="content">
			<p>Coffehut</p>
			<p class="register">¡Regístrate!
			<span>Sin compromiso. Sin cobros ocultos.</span>
			</p>

			<form action = "php/registro_usuario_db.php" method = "POST"  class="formulario">
				<label class="col" for="name">Usuario
					<input type="text" name="name" placeholder = "JuampaVLL" autocomplete="nope" required>
				</label>
				<label class="col" for="email">Email
					<input type="email" name="email" placeholder="ex: firstname@example.com" autocomplete="nope" required>
				</label>
				<label class="col" for="password">Contraseña
					<input class = "show-pass" type="password" name="password" placeholder = "ex: 12345678" autocomplete="nope" required>
					
				</label>
				<div class="extras">
					<label for="recording" class="checkbox">
						<input type="checkbox" class="checkbox" name="recording">Mostrar Contraseña
					</label>
				</div>
				<input type="submit" name="submit" class="submit" value="¡Regístrate!">
				<a href="login.php"><p class="link">¿Ya estás registrado?</p></a>
				<p class="about">Al hacer clic en el botón “¡Regístrate!“, acepto  expresamente los <u>Términos y Condiciones</u> de Coffehut y entiendo que la información de mi cuenta será usada de acuerdo con la <u>Política de Privacidad</u> de Coffehut.</p>
			</form>

		</div>
		</div>
	</div>
<script src = "assets/js/check.js"></script>
</body>
</html>