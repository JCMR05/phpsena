
<div class="container-fluid">
    <div class="container py-5">
        <div class="d-flex justify-content-center text-center py-3">
            <form class="p-5 bg-light" method="post">

                <!-- Campo: Nombre del rol -->
                <div class="form-group">
                    <label for="rol_nombre">Nombre del rol:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user-tag"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="rol_nombre" name="rol_nombre" required>
                    </div>
                </div>

                <!-- Campo: Descripción del rol -->
                <div class="form-group">
                    <label for="rol_descripcion">Descripción:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-align-left"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="rol_descripcion" name="rol_descripcion" required>
                    </div>
                </div>

                <!-- Campo: Estado del rol -->
                <div class="form-group">
                    <label for="rol_estado">Estado:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                    <i class="fas fa-toggle-on"></i>
                            </span>
                        </div>
                        <select class="form-control" id="rol_estado" name="rol_estado">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
                
                <div class= "mt-2">
                    <?php

                                /*=============================================
                                FORMA EN QUE SE INSTA­NCIA LA CLASE DE UN MÉTODO ESTÁTICO
                                =============================================*/

                                $rol = ControladorRol::ctrRegistrarRol();

                                if ($rol === 'ok') {
                                    // Aquí sí entra cuando el método devuelve "ok"
                                    echo '<script>
                                        if (window.history.replaceState) {
                                            window.history.replaceState(null, null, window.location.href);
                                        }
                                    </script>';
                                    echo '<div class="alert alert-success">El rol ha sido registrado</div>';
                                }

                    ?>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Registrar rol</button>

            </form>
        </div>
    </div>
</div>