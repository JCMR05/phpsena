<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>PHP</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <? include "modulos/menu.php"; ?>

    <div class="container-fluid">
		<div class="container py-5">

			<?php 

				#ISSET: isset() Determina si una variable está definida y no es NULL

				if(isset($_GET["modulo"])){

					if($_GET["modulo"] == "registro" ||
					   $_GET["modulo"] == "ingreso" ||
					   $_GET["modulo"] == "inicio" ||
                       $_GET["modulo"] == "inventario" ||
					   $_GET["modulo"] == "salir"){

						include "modulos/".$_GET["modulo"].".php";

					}else{

						include "paginas/error404.php";
					}


				}else{

					include "modulos/registro.php";

				}

				

			 ?>

		</div>
    </div>

</body>
</html>