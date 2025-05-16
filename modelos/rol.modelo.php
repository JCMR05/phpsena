<?php

require_once "conexion.php"; // Asegúrate de tener tu clase de conexión a DB aquí

class ModeloRol {

    static public function mdlRegistrarRol($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare("INSERT INTO 
        {$tabla} (rol_nombre, 
        rol_descripcion, 
        rol_estado, 
        rol_created_at, 
        rol_updated_at)
        VALUES (:rol_nombre, :rol_descripcion, :rol_estado, NOW(), NOW())");

        $stmt->bindParam(":rol_nombre", $datos["rol_nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":rol_descripcion", $datos["rol_descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":rol_estado", $datos["rol_estado"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt = null;
            return "ok";
        } else {
            $stmt = null;
            return "error";
        }
    }
    
        static public function mdlSeleccionarRol($tabla, $item, $valor){


        if ($item === null && $valor === null) {

                // Trae todos los registros, aliasando la PK a 'id'
                $sql = "
                SELECT 
                    pk_id_rol AS id,
                    rol_nombre,
                    rol_descripcion,
                    rol_estado,
                    DATE_FORMAT(rol_created_at, '%d/%m/%Y') AS fecha 
                FROM {$tabla} 
                ORDER BY pk_id_rol DESC
                ";

                $stmt = Conexion::conectar()->prepare($sql);
                $stmt->execute();
                $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();

                return $datos;


        }else{

            $sql = "
                SELECT 
                pk_id_rol AS id, 
                rol_nombre, 
                rol_descripcion, 
                rol_estado,
                DATE_FORMAT(pers_fecha_registro, '%d/%m/%Y') AS fecha 
                FROM {$tabla} 
                WHERE {$item} = :valor 
                ORDER BY pk_id_persona DESC
            ";

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindValue(":valor", $valor, PDO::PARAM_STR);
            $stmt->execute();
            $dato = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return $dato;
        }
    }


     // Método para editar un rol
     static public function mdlEditarRol($tabla, $datos) {
        try {
            $conexion = Conexion::conectar();
            $stmt = $conexion->prepare("UPDATE {$tabla} SET 
                rol_nombre = :rol_nombre,
                rol_descripcion = :rol_descripcion,
                rol_estado = :rol_estado,
                rol_updated_at = NOW()
                WHERE rol_id = :rol_id");
            
            $stmt->bindParam(":rol_nombre", $datos["rol_nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":rol_descripcion", $datos["rol_descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":rol_estado", $datos["rol_estado"], PDO::PARAM_INT);
            $stmt->bindParam(":rol_id", $datos["rol_id"], PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                $stmt = null;
                return "ok";
            }
            return "error";
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        } finally {
            $stmt = null;
            $conexion = null;
        }
    }

    // Método para eliminar un rol
    static public function mdlEliminarRol($tabla, $rol_id) {
        try {
            $conexion = Conexion::conectar();
            $stmt = $conexion->prepare("DELETE FROM {$tabla} WHERE rol_id = :rol_id");
            $stmt->bindParam(":rol_id", $rol_id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                $stmt = null;
                return "ok";
            }
            return "error";
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        } finally {
            $stmt = null;
            $conexion = null;
        }
    }


}