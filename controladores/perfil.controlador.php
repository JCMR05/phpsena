<?php

include "modelos/perfil.modelo.php";

class ControladorPerfil{

    static public function ctrPerfil(){

        if(isset($_POST["nombrePerfil"])){

            # Tabla donde destinara el registro
            $tabla = "perfiles";

            $datos = array(
                #Se obtienen los datos por medio de registro.php que serian desde "name" 
                # y de ahi se hace un post para él agarrar ese dato y llevarlo al registro.modelo.php
                "nombre" => $_POST["nombrePerfil"],
            );

            $respuesta = ModeloPerfil::mdlPerfil($tabla, $datos);

            return $respuesta;

        }

    }

}