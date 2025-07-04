<?php
    class Conexion{
        private $mySQLI;
        private $sql;
        private $filasAfectadas;
        private $result;
        private $UltimoId;

        public function abrir(){
            $this->mySQLI = new mysqli("b4mobqkdkcydppku2yq2-mysql.services.clever-cloud.com","u8w7qsreibif5fdn","4yFIVqGxfMPTegZImGCo","b4mobqkdkcydppku2yq2","3306");
            if($this->mySQLI->connect_error){
                throw new Exception("Error al conectar con la DB".$this->mySQLI->connect_error);
            }
            return true;
        }

        public function cerrar(){
            if($this->mySQLI){
                $this->mySQLI->close();
            }
        }

        public function consultar($sql){
            $this->sql = $sql;
            $this->result = $this->mySQLI->query($sql);
            $this->filasAfectadas = $this->mySQLI->affected_rows;
            $this->UltimoId = $this->mySQLI->insert_id;
        }

        public function obtenerResultados(){
            return $this->result;
        }

        public function obtenerFilasAfectadas(){
            return $this->filasAfectadas;
        }

        public function obtenerUltimoId(){
            return $this->UltimoId;
        }
    }