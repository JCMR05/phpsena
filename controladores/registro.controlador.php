<?php

include "modelos/registro.modelo.php";

class ControladorRegistro{

    static public function ctrRegistro(){

        if(isset($_POST["registroNombre"])){

            # Tabla donde destinara el registro
            $tabla = "personas";

            $datos = array(
                #Se obtienen los datos por medio de registro.php que serian desde "name" 
                # y de ahi se hace un post para él agarrar ese dato y llevarlo al registro.modelo.php
                "nombre" => $_POST["registroNombre"],
                "telefono" => $_POST["registroTelefono"],
                "correo" => $_POST["registroEmail"],
                "clave" => $_POST["registroPassword"]            

            );

            $respuesta = ModeloRegistro::mdlRegistro($tabla, $datos);

            return $respuesta;

        }

    }

}