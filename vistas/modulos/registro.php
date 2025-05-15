
<?php
    // Incluimos las clases necesarias del patrón VCM:
    // - Controlador para manejar la lógica de negocio
    require_once "controladores/registro.controlador.php";
    // - Modelo para interactuar con la base de datos
    require_once "modelos/registro.modelo.php";

    // 1) Procesar borrado si el formulario envió la petición
    //    Detectamos un POST con los campos 'delete' e 'idRegistro'
    if ($_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['delete'], $_POST['idRegistro'])
    ) {
        // Convertimos el ID a entero para mayor seguridad
        $id = intval($_POST['idRegistro']);

        // Llamamos al controlador para eliminar el registro
        $res = ControladorRegistro::ctrEliminarRegistro($id);

        // Mostramos un mensaje según el resultado de la operación
        if ($res === 'ok') {
            echo '<div class="alert alert-success">
                    Registro eliminado correctamente.
                </div>';
        } else {
            echo '<div class="alert alert-danger">
                    Ocurrió un error al eliminar el registro.
                </div>';
        }
    }

    // 2) Verificar que el usuario está autenticado
    //    Si no existe la sesión o no es válida, redirigimos al login
    if (!isset($_SESSION["validarIngreso"])
        || $_SESSION["validarIngreso"] !== "ok"
    ) {
        header("Location: index.php?modulo=ingreso");
        exit; // Detenemos la ejecución para evitar que se muestre contenido protegido
    }

    // 3) Obtener el listado actualizado de registros
    //    Después de procesar (o no) el borrado, pedimos al controlador
    //    que nos devuelva todos los registros de la tabla 'personas'
    $registros = ControladorRol::ctrMostrarRoles();
?>

<div class="container-fluid">
		
		<div class="container py-5">

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
            
                            <input type="text" class="form-control" id="nombre" name="registroNombre">
            
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label for="nombre">Teléfono:</label>
            
                        <div class="input-group">
                            
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-phone"></i>
                                </span>
                            </div>
            
                            <input type="text" class="form-control" id="telefono" name="registroTelefono">
            
                        </div>
                        
                    </div>
            
                    <div class="form-group">
            
                        <label for="email">Correo electrónico:</label>
            
                        <div class="input-group">
                            
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
            
                            <input type="email" class="form-control" id="email" name="registroEmail">
                        
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label for="rol">Seleccionar Rol:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                        <i class="fas fa-toggle-on"></i>
                                </span>
                            </div>
                            <select class="form-control" id="rol" name="rol">
                                <option value="">Selecciona un rol</option>
                                <?php
                                    $roles = ControladorRol::ctrMostrarRoles();
                                    foreach ($roles as $rol) {
                                        echo '<option value="'.$rol["pk_id_rol"].'">'.$rol["rol_nombre"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
            
                    <div class="form-group">
                        <label for="pwd">Contraseña:</label>
            
                        <div class="input-group">
                            
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
            
                            <input type="password" class="form-control" id="pwd" name="registroClave">
            
                        </div>
            
                    </div>
            

                    <?php

                            /*=============================================
                            FORMA EN QUE SE INSTA­NCIA LA CLASE DE UN MÉTODO ESTÁTICO
                            =============================================*/

                            $registro = ControladorRegistro::ctrRegistro();

                            if ($registro === 'ok') {
                                // Aquí sí entra cuando el método devuelve "ok"
                                echo '<script>
                                    if (window.history.replaceState) {
                                        window.history.replaceState(null, null, window.location.href);
                                    }
                                </script>';
                                echo '<div class="alert alert-success">El usuario ha sido registrado</div>';
                            }

                    ?>

                
                    <button type="submit" class="btn btn-primary">Enviar</button>
            
                </form>
            
            </div>

        </div>

    </div>