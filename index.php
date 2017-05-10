<html>
	<head>
		<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="js/jquery.js"></script>
	</head>
	<body>
		<h1> Bienvenido </h1>
		<p> Iniciar sesion </p>
		<form method="POST" action="CtlSesion.php" id="fmInicioSesion">
			<input type="text" name="usuario" placeholder="Usuario" required> </input> <br>
			<input type="password" name="pass" placeholder="Contraseña" required> </input> <br>
			<input type="submit" value="Iniciar sesion"> </input>
		</form>
		<div id="avisoSes"></div>
		<a href="Registro.php"> Registrarme </a>
	</body>
</html>