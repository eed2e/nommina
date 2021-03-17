
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Buscador Ajax</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://kit.fontawesome.com/18e932af55.js"></script>
	<link rel="stylesheet" href="CSS/bootstrap.min.css">
	<link rel="stylesheet" href="CSS/bootstrap-grid.min.css">
	<link rel="stylesheet" href="CSS/estilos.css">
	<script src="JS/jquery-3.4.1.min.js"></script>
	<script src="JS/bootstrap.min.js"></script>
	<script src="JS/buscar.js"></script>
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<a class="navbar-brand text-monospace" href="#">BUSCADOR DE PRODUCTOS <i class="fas fa-search"></i></a>
			<input class="form-control mr-sm-4" type="text" name="termino" id="termino" placeholder="Digite el nombre del producto que desea buscar..." aria-label="Search">
		</nav>	
	</header>
	<section class="content-area">
		<div class="table-area" id="tabla_resultados">
		</div>
	</section>
</body>
</html>
