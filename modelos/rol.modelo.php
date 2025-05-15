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

}