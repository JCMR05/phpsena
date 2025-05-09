
<?php

    session_start();

    if (!isset($_SESSION["validarIngreso"]) || $_SESSION["validarIngreso"] !== "ok") {
        header("Location: index.php?modulo=ingreso");
        exit;
    }

    // Obtenemos todos los registros de la tabla "registros"
    $registros = ControladorRegistro::ctrSeleccionarRegistro();
    // var_dump($registros);
?>
<section class="container-fluid">
        <div class="container py-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Contraseña</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($registros)): ?>
                    <?php foreach ($registros as $registro): ?>
                        <tr>
                            <td><?= htmlspecialchars($registro['pers_nombre'],   ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($registro['pers_telefono'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($registro['pers_correo'],   ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($registro['pers_clave'],    ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <form method="post" action="procesarRegistro.php">
                                        <!-- Usamos el alias 'id' definido en el modelo -->
                                        <input
                                            type="hidden"
                                            name="idRegistro"
                                            value="<?= htmlspecialchars($registro['id'], ENT_QUOTES, 'UTF-8') ?>"
                                        >
                                        <div class="px-1">
                                            <a href="index.php?modulo=editar&id=<?php echo $registro['id']; ?>" class="btn btn-warning">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        

                                        <button
                                            type="submit"
                                            name="delete"
                                            class="btn btn-danger"
                                            onclick="return confirm('¿Seguro que deseas eliminar este registro?');"
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            No hay registros para mostrar.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>