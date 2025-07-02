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
          if (isset($_SESSION['user'])) {
              if ($_SESSION['user']['rol'] !== "cliente") {
                  echo "<a href='index.php?accion=admin'>Zona Admin</a>";
              }
              echo "<a href='index.php?accion=unlogin'>Cerrar Sesión</a>";
          } else {
              echo "<a href='index.php?accion=admin'>Zona Admin</a>";
          }
      ?>
    </nav>
  </header>

  

  <div class="productoPedido">
    <div class="crearPedido">
      <div class="img">
          <img src="vista/productosIMG/<?php echo $producto['imagen'];?>" alt="">
      </div>
      <div class="content">
          <h2>Informarcion Pedido</h2>
          <p>Nombre: <span><?php echo $producto['nombre'];?></span></p>
          <p>Categoría: <span><?php echo $producto['categoria'];?></span></p>
          <p>Especificaciones: <span><?php echo $producto['especificaciones'];?></span></p>
          <p>Marca: <span><?php echo $producto['marca'];?></span></p>
          <p>Modelo: <span><?php echo $producto['modelo'];?></span></p>
          <p>Tipo: <span><?php echo $producto['tipo'];?></span></p>
          <p>Precio: <span>$<?php echo $producto['precio'];?></span></p>
          <form action="index.php?accion=registrarPedido" method="POST">
            <input type="hidden" name="id_user" value="<?php echo $_SESSION['user']['id'];?>">
            <input type="hidden" name="id_prod" value="<?php echo $producto['id'];?>">
            <input type="hidden" name="cant" value="1">
            <input type="hidden" name="fecha" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="estado" value="pendiente">
            <button>Confirmar</button>
          </form>
      </div>
    </div> 
  </div>

  <footer>
    <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
  </footer>

</body>
</html>