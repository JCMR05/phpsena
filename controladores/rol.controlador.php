<?php

include "modelos/rol.modelo.php";

class ControladorRol {

    static public function ctrRegistrarRol() {

        if (isset($_POST["rol_nombre"]) && isset($_POST["rol_descripcion"]) && isset($_POST["rol_estado"])) {

            $tabla = "rol";

            $datos = array(
                "rol_nombre" => $_POST["rol_nombre"],
                "rol_descripcion" => $_POST["rol_descripcion"],
                "rol_estado" => $_POST["rol_estado"]
            );

            $respuesta = ModeloRol::mdlRegistrarRol($tabla, $datos);

            return $respuesta;
        }
    }

        static public function ctrSeleccionarRol($item = null, $valor = null) {
        $tabla = "rol";
        $respuesta = ModeloRol::mdlSeleccionarRol($tabla, $item, $valor);
        return $respuesta;
    }

     // Método para editar un rol existente
        static public function ctrEditarRol($datos) {
        $tabla = "rol";
        return ModeloRol::mdlEditarRol($tabla, $datos);
    }

    // Método para eliminar un rol
        static public function ctrEliminarRol($rol_id) {
        $tabla = "rol";
        return ModeloRol::mdlEliminarRol($tabla, $rol_id);
    }

}