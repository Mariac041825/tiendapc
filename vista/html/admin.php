<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location: index.php?accion=login");
    exit();
}
if (isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'cliente'){
    header("location: index.php?accion=catalogo");
    exit();
}
$mensaje = $_GET['mensaje'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Tenis</title>
    <link rel="stylesheet" href="vista/css/Styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body data-mensaje="<?= $mensaje ?>">
    <header>
        <h1>Tienda de Tenis</h1>
        <nav>
            <a href="index.php?accion=index">Inicio</a>
            <a href="index.php?accion=catalogo">Catálogo</a>
            <a href="index.php?accion=admin">Zona Admin</a>
            <?php 
                if(isset($_SESSION['user'])){
                    echo "<a href='index.php?accion=unlogin'>Cerrar Sesion</a>";
                }
            ?>
        </nav>
    </header>

    <section id="panel-admin">
    <h2>Panel de Administración</h2>

    <div class="admin-section">
        <h3>Crear Producto</h3>
        <form action="index.php?accion=nuevoProducto" method="post" class="form-admin" enctype="multipart/form-data">
            
            <input type="text" name="nombre" placeholder="Nombre del producto" required>
            <input type="number" placeholder="Precio Ej: 12.000" name="precio" required>
            <input type="text" placeholder="especificaciones" name="espec" required> 
            <input type="text" placeholder="Marca" name="marca" required> 
            <input type="text" placeholder="Modelo" name="modelo" required> 

            <select name="Tipo" required>
                <option value="">Seleccionar Tipo</option>
                <option value="computador"> Computador </option>
                <option value="repuesto"> Repuesto </option>
                
            </select>

            <select name="categoria" required>
                <option value="">Seleccionar categoría</option>
                <?php foreach($categorias as $categoria): ?>
                    <option value="<?php echo $categoria['id'];?>"> <?php echo $categoria['nombre'];?> </option>
                <?php endforeach; ?>
            </select>
            <input multiple type="file" accept="image/*" name="imgs[]" required>
            <button type="submit">Guardar Producto</button>
        </form>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Tipo</th>
                <th>Especificaciones</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $producto): ?>
                    <tr>
                        <td><?php echo $producto['id'];?></td>
                        <td><?php echo $producto['nombre'];?></td>
                        <td>$<?php echo $producto['precio'];?></td>
                        <td><?php echo $producto['categoria'];?></td>
                        <td><?php echo $producto['marca'];?></td>
                        <td><?php echo $producto['modelo'];?></td>
                        <td><?php echo $producto['tipo'];?></td>
                        <td><?php echo $producto['especificaciones'];?></td>
                        <td>
                            <button><a href="index.php?accion=editarProducto&id=<?php echo $producto['id'];?>">Editar</a></button>
                            <button onclick="eliminarProducto(<?php echo $producto['id'];?>)">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>

        <div class="admin-section">
        <h3>Categorías</h3>
        <form action="index.php?accion=nuevaCategoria" method="post" class="form-admin">
            <input type="text" name="categoria" placeholder="Nombre de la categoría" required>
            <button type="submit">Guardar Categoría</button>
        </form>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($categorias as $categoria): ?>
                    <tr>
                        <td><?php echo $categoria['id'];?></td>
                        <td><?php echo $categoria['nombre'];?></td>
                        <td>
                            <button><a href="index.php?accion=editarCategoria&id=<?php echo $categoria['id'];?>">Editar</a></button>
                            <button onclick="eliminarCategoria(<?php echo $categoria['id'];?>)">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>

        <div class="admin-section">
        <h3>Pedidos</h3>
        <table>
            <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            <tbody>
                <?php foreach($pedidos as $pedido): ?>
                    <tr>
                        <td><?php echo $pedido['id'];?></td>
                        <td><?php echo $pedido['user_name'];?></td>
                        <td><?php echo $pedido['producto_name'];?></td>
                        <td><?php echo $pedido['cantidad'];?></td>
                        <td>$<?php echo $pedido['fecha'];?></td>
                        <td><?php echo $pedido['estado'];?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </tbody>
        </table>
        </div>
    </section>
    
    <footer>
        <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
    </footer>

    <script src="vista/js/Scrips.js"></script>
</body>
</html>
