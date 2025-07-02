<?php
    require_once "controlador/Controlador.php";
    require_once "modelo/Conexion.php";
    require_once "modelo/GestorLogin.php";
    require_once "modelo/GestorProductos.php";


    $controlador = new Controlador();
    $accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

    switch ($accion){
        case 'index':
            $controlador->verPagina("vista/html/index.php");
            break;
        case 'catalogo':
            $controlador->catalogo();
            break;
        case 'login':
            if(isset($_POST['correo']) && isset($_POST['clave']) && isset($_POST['rol'])){
                $controlador->login($_POST['correo'],$_POST['rol'],$_POST['clave']);
            }
            $controlador->verPagina("vista/html/login.php");
            break;
        case 'loginCliente':
            if(isset($_GET['ingresar'])){
                if(isset($_POST['correo']) && isset($_POST['clave']) && isset($_POST['rol'])){
                    $controlador->login($_POST['correo'],$_POST['rol'],$_POST['clave']);
                }
            } else {
                if (isset($_GET['ver']) && $_GET['ver'] === "1"){
                    if (isset($_GET['id'])){
                        $controlador->crearPedido($_GET['id']);
                    }
                } else {$controlador->verPagina("vista/html/loginCliente.php");}
            }
            
            break;
        case 'registrarPedido':
            $controlador->registrarPedido($_POST['id_user'],$_POST['id_prod'],$_POST['cant'],$_POST['fecha'],$_POST['estado']);
            break;
        case 'registroCliente':
            if(isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['clave']) && isset($_POST['rol'])){
                $controlador->registro($_POST['nombre'],$_POST['correo'],$_POST['rol'],$_POST['clave']);
            }
            $controlador->verPagina("vista/html/registroCliente.php");
            break;
        case 'unlogin':
            $controlador->unLogin();
            break;
        case 'admin':
            $controlador->zonaAdmin();
            break;
        case 'nuevaCategoria':
            $controlador->nuevaCategoria($_POST['categoria']);
            break;
        case 'eliminarCategoria':
            $controlador->eliminarCategoria($_GET['id']);
            break;
        case 'nuevoProducto':
            if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['espec']) && isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['Tipo']) && isset($_POST['categoria'])) {

                $imgPrincipal = "Sin_Imagen.png";
                $imagenesGuardadas = [];

                if (isset($_FILES['imgs']) && count($_FILES['imgs']['name']) > 0) {
                    $totalImgs = count($_FILES['imgs']['name']);
                    for ($i = 0; $i < $totalImgs; $i++) {
                        $nombreArchivo = $_FILES['imgs']['name'][$i];
                        $tempArchivo = $_FILES['imgs']['tmp_name'][$i];
                        $rutaFinal = "vista/productosIMG/" . basename($nombreArchivo);

                        if (move_uploaded_file($tempArchivo, $rutaFinal)) {
                            $imagenesGuardadas[] = $nombreArchivo;
                        }
                    }

                    if (count($imagenesGuardadas) > 0) {
                        $imgPrincipal = $imagenesGuardadas[0];
                    }
                }

                $controlador->nuevoProducto(
                    $_POST['nombre'],
                    $_POST['espec'],
                    $_POST['precio'],
                    $imgPrincipal,
                    $_POST['categoria'],
                    $_POST['marca'],
                    $_POST['modelo'],
                    $_POST['Tipo'],
                    $imagenesGuardadas
                );
            }
            break;
        case 'eliminarProducto':
            $controlador->eliminarProducto($_GET['id']);
            break;
        case 'editarProducto': 
            if (isset($_GET['guardar'])) {
                $imagenPrincipal = $_POST['imgOriginal'];
                if (isset($_FILES['imgs']) && $_FILES['imgs']['name'] != "") {
                    $img = $_FILES['imgs'];
                    $nameimg = basename($img['name'][0]);
                    $rutaTemp = $img['tmp_name'][0];
                    $rutaFin = "vista/productosIMG/" . $nameimg;
                    if (move_uploaded_file($rutaTemp, $rutaFin)) {
                        $imagenPrincipal = $nameimg;
                    }
                }
                $imagenesAdicionales = [];
                if (isset($_FILES['imgs']) && $_FILES['imgs']['name'][0] != "") {
                    $totalImgs = count($_FILES['imgs']['name']);
                    for ($i = 0; $i < $totalImgs; $i++) {
                        $nombreArchivo = $_FILES['imgs']['name'][$i];
                        $tempArchivo = $_FILES['imgs']['tmp_name'][$i];
                        $rutaFinal = "vista/productosIMG/" . basename($nombreArchivo);
                        if (move_uploaded_file($tempArchivo, $rutaFinal)) {
                            $imagenesAdicionales[] = $nombreArchivo;
                        }
                    }
                }
                $controlador->editarProducto(
                    $_POST['id'],
                    $_POST['nombre'],
                    $_POST['precio'],
                    $imagenPrincipal,
                    $_POST['categoria'],
                    $_POST['espec'],
                    $_POST['marca'],
                    $_POST['modelo'],
                    $_POST['Tipo'],
                    $imagenesAdicionales
                );
            } else {
                $controlador->verProducto($_GET['id']);
            }
            break;
        case 'editarCategoria': 
            if (isset($_GET['guardar'])){
                $controlador->editarCategoria($_POST['id'],$_POST['nombre']);
            } else { $controlador->verCategoria($_GET['id']); }
            break;
    }