<?php
    class GestorLogin{
        public function validar($correo){
            $conexion = new Conexion();
            $conexion->abrir();
            $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
            $conexion->consultar($sql);
            $result = $conexion->obtenerResultados();
            $usuario = $result->fetch_assoc();
            $conexion->cerrar();
            return $usuario;
        }

        public function registrarCliente($name,$correo,$rol,$clave){
            $conexion = new Conexion();
            $conexion->abrir();
            $sql = "INSERT INTO usuarios (nombre,correo,contraseña,rol) VALUES ('$name', '$correo', '$clave', '$rol');";
            $conexion->consultar($sql);
            $conexion->cerrar();
            return true;
        }
    }