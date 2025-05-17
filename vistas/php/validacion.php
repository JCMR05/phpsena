<?php
    // 1.Solicitar datos
    $nombre = $_POST("registroNombre");
    $telefono = $_POST("registroTelefono");
    $correo = $_POST("registroEmail");
    $clave = $_POST("registroClave");

    // 2.Creacion de sanitaciones

    $patternNombre = "/^[A-Za-zÁÉÍÓÚáéíóúÑñ]+(?: [A-Za-zÁÉÍÓÚáéíóúÑñ]+)*$/";
    $patternTelefono = "/^\d{10}$/";
    $patternCorreo = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
    $patternClave = "/^(?=.[A-Za-z])(?=.\d)[A-Za-z\d]{8,}$/";

    // 3. Validar con preg_match
        if (!preg_match($patternNombre, $nombre)) {
            // Nombre inválido: detener el flujo y notificar error
            return "errorNombre";
        }

        if (!preg_match($patternTelefono, $telefono)) {
            // Nombre inválido: detener el flujo y notificar error
            return "errorNombre";
        }

        if (!preg_match($patternCorreo, $correo)) {
            // Nombre inválido: detener el flujo y notificar error
            return "errorNombre";
        }

        if (!preg_match($patternClave, $clave)) {
            // Nombre inválido: detener el flujo y notificar error
            return "errorNombre";
        }
        