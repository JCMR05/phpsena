
<?php
    // Incluimos las clases necesarias del patrón MVC:
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
    $roles = ControladorRol::ctrListarRoles();

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
            
                            <input type="text" class="form-control" id="nombrePersona" name="registroNombre" minlength="1" maxlength="15" pattern="[a-zA-Z]+" required placeholder="Ingresa tu nombre">
            
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
            
                            <input type="text" class="form-control" id="telefono" name="registroTelefono" minlength="10" maxlength="15" pattern="[0-9]{10,15}" required placeholder="Ingresa tu número de teléfono">
            
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
            
                            <input type="email" class="form-control" id="email" name="registroEmail" minlength="5" maxlength="50" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required placeholder="Ingresa tu correo">
                        
                        </div>
                        
                    </div>

                        <div class="form-group mb-3">
                        <label for="rolSeleccionado">Rol:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user-tag"></i>
                            </span>
                            </div>
                            <select 
                            class="form-control" 
                            id="rolSeleccionado" 
                            name="registroRolId" 
                            required
                            >
                            <option value="" disabled selected>Selecciona un rol</option>
                            <?php foreach ($roles as $rol): ?>
                                <option value="<?= htmlspecialchars($rol['pk_id_rol']) ?>">
                                <?= htmlspecialchars($rol['rol_nombre']) ?>
                                </option>
                            <?php endforeach; ?>
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
            
                            <input type="password" class="form-control" id="pwd" name="registroClave" minlength="8" maxlength="20" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}" required placeholder="Ingresa tu contraseña">
            
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

                
                    <button type="submit" class="btn btn-primary mt-2">Enviar</button>
            
                </form>
            
            </div>

        </div>

    </div>