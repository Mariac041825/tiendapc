<?php  
    class GestorProductos{
    
        public function verProductos(){
            $conexion = new Conexion();
            $conexion->abrir();
            $sql = "SELECT c.nombre as categoria,p.* FROM productos p JOIN categorias c ON p.id_categoria = c.id";
            $conexion->consultar($sql);
            $result = $conexion->obtenerResultados();
            $productos = [];
            while ($fila = $result->fetch_assoc()){
                $productos[] = $fila;
            }
            $conexion->cerrar();
            return $productos;
        }
    
        public function viewPedidos(){
            $conexion = new Conexion();
            $conexion->abrir();
            $sql = "SELECT u.nombre as user_name , pr.nombre as producto_name , p.* FROM pedidos p JOIN usuarios u ON p.id_usuario = u.id JOIN productos pr ON p.id_producto = pr.id";
            $conexion->consultar($sql);
            $result = $conexion->obtenerResultados();
            $pedidos = [];
            while ($fila = $result->fetch_assoc()){
                $pedidos[] = $fila;
            }
            $conexion->cerrar();
            return $pedidos;
        }

        public function viewProducto($id){
            $conexion = new Conexion();
            $conexion->abrir();
            $sql = "SELECT c.nombre as categoria,p.* FROM productos p JOIN categorias c ON p.id_categoria = c.id WHERE p.id = $id";
            $conexion->consultar($sql);
            $result = $conexion->obtenerResultados();
            $product = $result->fetch_assoc();
            $conexion->cerrar();
            return $product;
        }

        public function viewCategoria($id){
            $conexion = new Conexion();
            $conexion->abrir();
            $sql = "SELECT * FROM categorias WHERE id = $id";
            $conexion->consultar($sql);
            $result = $conexion->obtenerResultados();
            $categoria = $result->fetch_assoc();
            $conexion->cerrar();
            return $categoria;
        }

        public function verCategorias(){
            $conexion = new Conexion();
            $conexion->abrir();
            $sql = "SELECT * FROM categorias";
            $conexion->consultar($sql);
            $result = $conexion->obtenerResultados();
            $categorias = [];
            while ($fila = $result->fetch_assoc()){
                $categorias[] = $fila;
            }
            $conexion->cerrar();
            return $categorias;
        }

        public function newProducto($nombre, $espec, $precio, $imgPrincipal, $cat, $marca, $modelo, $tipo, $imagenes) {
            $conexion = new Conexion();
            $conexion->abrir();
            $sql = "INSERT INTO productos (nombre, precio, imagen, id_categoria, marca, modelo, tipo, especificaciones) 
                    VALUES ('$nombre', '$precio', '$imgPrincipal', '$cat', '$marca', '$modelo', '$tipo', '$espec');";
            $conexion->consultar($sql);
            $idProducto = $conexion->obtenerUltimoId();
            foreach ($imagenes as $img) {
                $sqlImg = "INSERT INTO imagenes_producto (id_producto, url_imagen) VALUES ('$idProducto', '$img');";
                $conexion->consultar($sqlImg);
            }

            $conexion->cerrar();
            return true;
        }

        public function nuevoPedido($idU,$idP,$cant,$fecha,$estado){
            $conexion = new Conexion();
            $conexion->abrir();
            $sql = "INSERT INTO pedidos (id_usuario,id_producto,cantidad,fecha,estado) VALUES ('$idU', '$idP', '$cant', '$fecha', '$estado')";
            $conexion->consultar($sql);
            $conexion->cerrar();
        }

        public function editProducto($id, $nombre, $precio, $imagen, $categoria, $espec, $marca, $modelo, $tipo, $imagenes) {
            $conexion = new Conexion();
            $conexion->abrir();

            $sql = "UPDATE productos SET 
                        nombre = '$nombre',
                        precio = '$precio',
                        imagen = '$imagen',
                        id_categoria = '$categoria',
                        marca = '$marca',
                        modelo = '$modelo',
                        tipo = '$tipo',
                        especificaciones = '$espec'
                    WHERE id = '$id'";
            $conexion->consultar($sql);

            foreach ($imagenes as $img) {
                $sqlImg = "INSERT INTO imagenes_producto (id_producto, url_imagen) VALUES ('$id', '$img')";
                $conexion->consultar($sqlImg);
            }

            $conexion->cerrar();
            return true;
        }

        public function editCategoria($id,$nombre){
            $conexion = new Conexion();
            $conexion->abrir();
            $sql = "UPDATE categorias SET nombre = '$nombre' WHERE id = $id";
            $conexion->consultar($sql);
            $conexion->cerrar();
            return true;
        }

        public function newCategoria($cat){
            $conexion = new Conexion();
            $conexion->abrir();
            $sql = "INSERT INTO categorias (nombre) VALUES ('$cat');";
            $conexion->consultar($sql);
            $conexion->cerrar();
            return true;
        }

        public function deleteCategoria($id){
            $conexion = new Conexion();
            $conexion->abrir();
            $sql = "DELETE FROM categorias WHERE id = $id";
            $conexion->consultar($sql);
            $conexion->cerrar();
            return true;
        }

        public function deleteProducto($id){
            $conexion = new Conexion();
            $conexion->abrir();
            $sql = "DELETE FROM productos WHERE id = $id";
            $conexion->consultar($sql);
            $conexion->cerrar();
            return true;
        }

    }   