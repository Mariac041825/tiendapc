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
        <?php 
            if(!$_SESSION['user']['rol'] === 'cliente'){
                echo "<a href='index.php?accion=admin'>Zona Admin</a>";
            }
            if(isset($_SESSION['user'])){
                echo "<a href='index.php?accion=unlogin'>Cerrar Sesion</a>";
            }
        ?>
        </nav>
    </header>

    <section id="catalogo">
        <h3>Editar Categoria</h3>
        <form action="index.php?accion=editarCategoria&guardar" method="post" class="form-admin" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $categoria['id'];?>">
            <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $categoria['nombre'];?>" required>
            <button type="submit">Guardar Categoria</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
    </footer>

</body>
</html>