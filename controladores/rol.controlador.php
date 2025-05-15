<?php

include "modelos/rol.modelo.php";

class ControladorRol {

    static public function ctrRegistrarRol() {

        if (isset($_POST["rol_nombre"]) && isset($_POST["rol_descripcion"]) && isset($_POST["rol_estado"])) {

            $tabla = "roles";

            $datos = array(
                "rol_nombre" => $_POST["rol_nombre"],
                "rol_descripcion" => $_POST["rol_descripcion"],
                "rol_estado" => $_POST["rol_estado"]
            );

            $respuesta = ModeloRol::mdlRegistrarRol($tabla, $datos);

            return $respuesta;
        }
    }

        static public function ctrMostrarRoles() {
        $tabla = "roles";
        $respuesta = ModeloRol::mdlMostrarRoles($tabla);
        return $respuesta;
    }

}