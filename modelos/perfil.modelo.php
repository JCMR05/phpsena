<?php

require_once "conexion.php";

class ModeloPerfil {

    /*=============================================
    Registrar usuario
    =============================================*/
    static public function mdlPerfil($tabla, $datos){
        $sql = "INSERT INTO {$tabla} 
                    (perf_nombre) 
                VALUES 
                    (:nombre)";

        $stmt = Conexion::conectar()->prepare($sql);

        #                1 adonde parada el dato.   2 dato obtenido del registro por medio del array.  3 Tipo de dato.
        $stmt->bindParam(":nombre",   $datos["nombre"],   PDO::PARAM_STR);

        $ok = $stmt->execute();
        $stmt->closeCursor(); #Cierra la consulta
        return $ok ? "ok" : "error";
    }
}
