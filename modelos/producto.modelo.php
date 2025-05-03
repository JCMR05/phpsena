<?php

require_once "conexion.php";

class ModeloProducto {

    /*=============================================
    Registrar usuario
    =============================================*/
    static public function mdlProducto($tabla, $datos){
        $sql = "INSERT INTO {$tabla} 
                    (prod_nombre, prod_cantidad, prod_precio) 
                VALUES 
                    (:nombre, :cantidad, :precio)";

        $stmt = Conexion::conectar()->prepare($sql);

        #                1 adonde parada el dato.   2 dato obtenido del registro por medio del array.  3 Tipo de dato.
        $stmt->bindParam(":nombre",   $datos["nombre"],   PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
        $stmt->bindParam(":precio",   $datos["precio"],   PDO::PARAM_STR);

        $ok = $stmt->execute();
        $stmt->closeCursor(); #Cierra la consulta
        return $ok ? "ok" : "error";
    }
}
