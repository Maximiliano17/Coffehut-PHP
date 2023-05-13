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
			<p>Waiycof</p>
			<p class = "register">Iniciar Sesion
				<span>Sin compromiso. Sin cobros ocultos.</span>
			</p>
				<form class="formulario" action="php/login_usuario_db.php" method="POST">
					<label class="col" for="name">Nombre
						<input type="text" name="name" autocomplete="nope" required>
					</label>
					<label class="col" for="password">Contraseña
						<input type="password" name="password" autocomplete="nope" required>
					</label>
					<div class="extras">
						<label for="recording" class="checkbox">
							<input type="checkbox"  autocomplete="nope" name="recording">Recuerdame
						</label>
						<a class="link" href="/">¿Olvidaste tu Contraseña?</a>	
					</div>
					<input type="submit" name="submit" class="submit" value="Iniciar sesión">
					<a href="index.php"><p class="link">¿Aún no tienes una cuenta?</p></a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>