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
    
        static public function mdlMostrarRoles($tabla) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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