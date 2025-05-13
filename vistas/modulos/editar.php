
<?php

    session_start();

    if (!isset($_SESSION["validarIngreso"]) || $_SESSION["validarIngreso"] !== "ok") {
        header("Location: index.php?modulo=editar");
        exit;
    }

    // Obtenemos todos los registros de la tabla "registros"
    $registros = ControladorRegistro::ctrSeleccionarRegistro();
    // var_dump($registros);
?>

<?php
    $idSeleccionado = $_GET['id']; // o $_POST['id']
    $telefono = "";

    foreach ($registros as $registro) {
        if ($registro["id"] == $idSeleccionado) {
            $telefono = $registro["pers_telefono"];
            break;
        }
    }
?>

<div class="container-fluid">
		
	<div class="container py-5">
<h1>Actualizar</h1>
        <div class="d-flex justify-content-center text-center py-3">

            <form class="p-5 bg-light" method="post">
            
                <div class="form-group">

                    <label for="nombre">Nombre:</label>
            
                    <div class="input-group">
                            
                            <div class="input-group-prepend">

                                <span class="input-group-text">

                                    <i class="fas fa-user"></i>

                                </span>

                            </div>
            
                        <input type="text" class="form-control" id="nombre" name="actualizarNombre" value="<?php echo $registros[0]["pers_nombre"]?>">
            
                    </div>
                        
                </div>

                <div class="form-group">

                    <label for="telefono">Teléfono:</label>
            
                    <div class="input-group">
                            
                        <div class="input-group-prepend">

                            <span class="input-group-text">

                                <i class="fas fa-phone"></i>

                            </span>

                        </div>
            
                        <input type="text" class="form-control" id="telefono" name="actualizarTelefono" value="<?php echo $registros htmlspecialchars($telefono) ?>">
            
                    </div>
                        
                </div>
            
                <div class="form-group">
            
                    <label for="correo">Correo electrónico:</label>
            
                    <div class="input-group">
                            
                        <div class="input-group-prepend">

                            <span class="input-group-text">

                                <i class="fas fa-envelope"></i>

                            </span>

                        </div>
            
                        <input type="email" class="form-control" id="correo" name="actualizarCorreo" value="<?php echo $registros[0]["pers_correo"]?>">
                        
                    </div>
                        
                </div>
            
                <div class="form-group">

                    <label for="clave">Contraseña:</label>
            
                    <div class="input-group">
                            
                        <div class="input-group-prepend">

                            <span class="input-group-text">

                                <i class="fas fa-lock"></i>

                            </span>

                        </div>
            
                        <input type="password" class="form-control" id="clave" name="actualizarClave" value="<?php echo $registros[0]["pers_clave"]?>">
            
                    </div>
            
                </div>
            
                <?php

                    /*=============================================
                    FORMA EN QUE SE INSTA­NCIA LA CLASE DE UN MÉTODO ESTÁTICO
                    =============================================*/

                    // Método estático para registrar
                    $actualizar = ControladorRegistro::ctrActualizar();

                    if ($actualizar === 'ok') {
                        // Evita reenvío del formulario al refrescar la página
                        //uso de heredoc (<<<HTML):
                        //Facilita la inclusión de HTML y JS con múltiples líneas sin necesidad de múltiples echo y mejora la legibilidad.
                        echo <<<HTML
                            <script>
                                if (window.history.replaceState) {
                                    window.history.replaceState(null, null, window.location.href);
                                }
                            </script>
                            <div class="alert alert-success">El usuario ha sido actualizado</div>
                        HTML;
                    }

                ?>



                <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
            
            </form>
            
        </div>

    </div>

</div>