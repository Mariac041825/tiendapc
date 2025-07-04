<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Tenis</title>
    <link rel="stylesheet" href="vista/css/Styles.css">
</head>

<body>
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

    <section id="catalogo">
        <h3>Editar Producto</h3>
        <form action="index.php?accion=editarProducto&guardar" method="post" class="form-admin" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $producto['id'];?>">
            <input type="hidden" name="imgOriginal" value="<?php echo $producto['imagen'];?>">

            <input type="text" name="nombre" value="<?php echo $producto['nombre'];?>" placeholder="Nombre del producto" required>
            <input type="number" value="<?php echo $producto['precio'];?>"  placeholder="Precio Ej: 12.000" name="precio" required>
            <input type="text" value="<?php echo $producto['especificaciones'];?>" placeholder="Especificaciones" name="espec" required> 
            <input type="text" value="<?php echo $producto['marca'];?>" placeholder="Marca" name="marca" required> 
            <input type="text" value="<?php echo $producto['modelo'];?>" placeholder="Modelo" name="modelo" required> 

            <select name="categoria" required>
                <option value="<?php echo $producto['id_categoria'];?>"> |-- <?php echo $producto['categoria'];?> --| </option>
                <?php foreach($categorias as $categoria): ?>
                    <option value="<?php echo $categoria['id'];?>"> <?php echo $categoria['nombre'];?> </option>
                <?php endforeach; ?>
            </select>

            <select name="Tipo" required>
                <option value="<?php echo $producto['tipo'];?>"> |-- <?php echo $producto['tipo'];?> --| </option>
                <option value="computador"> Computador </option>
                <option value="repuesto"> Repuesto </option>
            </select>

            <input multiple type="file" accept="image/*" name="imgs[]">
            <button type="submit">Guardar Producto</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
    </footer>

</body>
</html>