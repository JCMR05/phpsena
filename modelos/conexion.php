<?php

    class Conexion{

        static public function conectar(){

            $link = new PDO("mysql:host=localhost:3307;dbname=phpsena_bd","root","root");
            return $link;

        }

    }