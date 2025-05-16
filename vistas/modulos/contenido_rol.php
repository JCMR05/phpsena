<?php
    // Incluimos las clases necesarias del patrón VCM:
    // - Controlador para manejar la lógica de negocio
    require_once "controladores/rol.controlador.php";
    // - Modelo para interactuar con la base de datos
    require_once "modelos/rol.modelo.php";

    // 1) Procesar borrado si el formulario envió la petición
    //    Detectamos un POST con los campos 'delete' e 'idRegistro'
    if ($_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['delete'], $_POST['idRol'])
    ) {
        // Convertimos el ID a entero para mayor seguridad
        $id = intval($_POST['idRol']);

        // Llamamos al controlador para eliminar el registro
        $res = ControladorRol::ctrEliminarRol($id);

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
        header("Location: ingreso");
        exit; // Detenemos la ejecución para evitar que se muestre contenido protegido
    }

    // 3) Obtener el listado actualizado de registros
    //    Después de procesar (o no) el borrado, pedimos al controlador
    //    que nos devuelva todos los registros de la tabla 'personas'
    $roles = ControladorRol::ctrSeleccionarRol();
?>


<section class="container-fluid">
    <div class="container py-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre Rol</th>
                    <th>Descripcion Rol</th>
                    <th>Estado Rol</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($roles)): ?>
                <?php foreach ($roles as $rol): ?>
                    <tr>
                        <td><?= htmlspecialchars($rol["rol_nombre"],   ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($rol["rol_descripcion"], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($rol["rol_estado"],   ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <form method="post" onsubmit="return confirm('¿Seguro que deseas eliminar este rol?');">
                                    <input type="hidden" name="idRol" value="<?= htmlspecialchars($registro['id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <button type="submit" name="delete" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <a href="index.php?modulo=editar&id=<?= $rol['id'] ?>" class="btn btn-warning">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No hay registros de roles para mostrar.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>