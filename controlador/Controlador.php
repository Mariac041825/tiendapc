<?php 
    class Controlador{
        public function verPagina($vista){
            require $vista;
        }

        public function login($correo,$rol,$clave){
            session_start();
            $gestion = new GestorLogin();
            $user = $gestion->validar($correo);
            if ($user){
                if($rol == $user['rol'] && $user['rol'] === "admin"){
                    if($clave !== $user['contraseña']){
                        $_SESSION['error_login'] = "Error >> Clave incorrecta";
                        header("location: index.php?accion=login");
                        exit();
                    } else {
                        $_SESSION['user'] = [
                            "id" => $user['id'],
                            "nombre" => $user['nombre'],
                            "correo" => $user['correo'],
                            "rol" => $user['rol'],
                        ];
                        header("location: index.php?accion=admin");
                        unset($_SESSION['error_login']);
                        exit();
                    }
                } elseif($rol == $user['rol'] && $user['rol'] === "cliente"){
                    if($clave !== $user['contraseña']){
                        $_SESSION['error_login'] = "Error >> Clave incorrecta";
                        header("location: index.php?accion=loginCliente");
                        exit();
                    } else {
                        $_SESSION['user'] = [
                            "id" => $user['id'],
                            "nombre" => $user['nombre'],
                            "correo" => $user['correo'],
                            "rol" => $user['rol'],
                        ];
                        $id = $_POST['idprod'];
                        header("location: index.php?accion=loginCliente&ver=1&id=".$id);
                        unset($_SESSION['error_login']);
                        exit();
                    }
                } else{
                    $_SESSION['error_login'] = "Error >> Rol de usuario no reconocido";
                    header("location: index.php?accion=login");
                    exit();
                }
            } else {
                $_SESSION['error_login'] = "Error >> Datos de inicio no validos";
                header("location: index.php?accion=login");
                exit();
            }
        }

        public function unLogin(){
            session_start();
            session_destroy();
            header("location: index.php?accion=index");
            exit();
        }

        public function zonaAdmin(){
            $gestor = new GestorProductos();
            $productos = $gestor->verProductos();
            $categorias = $gestor->verCategorias();
            $pedidos = $gestor->viewPedidos();
            require "vista/html/admin.php";
        }

        public function registro($name,$correo,$rol,$clave){
            $gestor = new GestorLogin();
            $register = $gestor->registrarCliente($name,$correo,$rol,$clave);
            header("location: index.php?accion=catalogo");
        }

        public function catalogo(){
            $gestor = new GestorProductos();
            $productos = $gestor->verProductos();
            $categorias = $gestor->verCategorias();
            require "vista/html/catalogo.php";
        }

        public function verProducto($id){
            $gestor = new GestorProductos();
            $producto = $gestor->viewProducto($id);
            $categorias = $gestor->verCategorias();
            require "vista/html/editarProducto.php";
        }

        public function verCategoria($id){
            $gestor = new GestorProductos();
            $categoria = $gestor->viewCategoria($id);
            require "vista/html/editarCategoria.php";
        }

        public function nuevoProducto($nombre, $espec, $precio, $imgPrincipal, $cat, $marca, $modelo, $tipo, $imagenes) {
            $gestor = new GestorProductos();
            $crear = $gestor->newProducto($nombre, $espec, $precio, $imgPrincipal, $cat, $marca, $modelo, $tipo, $imagenes);
            if ($crear) {
                header("location: index.php?accion=admin&mensaje=creado");
            } else {
                header("location: index.php?accion=admin&mensaje=error");
            }
        }

        public function editarProducto($id, $nombre, $precio, $imagen, $categoria, $espec, $marca, $modelo, $tipo, $imagenes) {
            $gestor = new GestorProductos();
            $editar = $gestor->editProducto($id, $nombre, $precio, $imagen, $categoria, $espec, $marca, $modelo, $tipo, $imagenes);
            if ($editar) {
                header("location: index.php?accion=admin&mensaje=editado");
            } else {
                header("location: index.php?accion=admin&mensaje=error");
            }
        }

        public function editarCategoria($id,$nombre){
            $gestor = new GestorProductos();
            $editar = $gestor->editCategoria($id,$nombre);
            if($editar){
                echo "<script>alert('Categoria Editada')</script>";
                header("location: index.php?accion=admin");
            } else {
                echo "<script>alert('Error al editar al Categoria')</script>";
                header("location: index.php?accion=admin");
            }
        }

        public function eliminarProducto($id){
            $gestor = new GestorProductos();
            $eliminar = $gestor->deleteProducto($id);
            if($eliminar){
                echo "<script>alert('Producto Eliminado')</script>";
                header("location: index.php?accion=admin");
            } else {
                echo "<script>alert('Error al eliminar el producto')</script>";
                header("location: index.php?accion=admin");
            }
        }

        public function nuevaCategoria($cat){
            $gestor = new GestorProductos();
            $crear = $gestor->newCategoria($cat);
            if($crear){
                echo "<script>alert('Categoria Creada')</script>";
                header("location: index.php?accion=admin");
            } else {
                echo "<script>alert('Error al crear la categoria')</script>";
                header("location: index.php?accion=admin");
            }
        }

        public function eliminarCategoria($id){
            $gestor = new GestorProductos();
            $eliminar = $gestor->deleteCategoria($id);
            if($crear){
                echo "<script>alert('Categoria Creada')</script>";
                header("location: index.php?accion=admin");
            } else {
                echo "<script>alert('Error al crear la categoria')</script>";
                header("location: index.php?accion=admin");
            }
        }

        public function crearPedido($id){
            $gestor = new GestorProductos();
            $producto = $gestor->viewProducto($id);
            require "vista/html/crearPedido.php";
        }

        public function registrarPedido($idU,$idP,$cant,$fecha,$estado){
            $gestor = new GestorProductos();
            $gestor->nuevoPedido($idU,$idP,$cant,$fecha,$estado);
            header("location: index.php?accion=index");
        }
    }