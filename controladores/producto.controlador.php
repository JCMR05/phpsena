<?php

include "modelos/producto.modelo.php";

class ControladorProducto{

    static public function ctrProducto(){

        if(isset($_POST["nombreProducto"])){

            # Tabla donde destinara el registro
            $tabla = "productos";

            $datos = array(
                #Se obtienen los datos por medio de registro.php que serian desde "name" 
                # y de ahi se hace un post para él agarrar ese dato y llevarlo al registro.modelo.php
                "nombre" => $_POST["nombreProducto"],
                "cantidad" => $_POST["cantidadProducto"],
                "precio" => $_POST["precioProducto"]
            );

            $respuesta = ModeloProducto::mdlProducto($tabla, $datos);

            return $respuesta;

        }

    }

}