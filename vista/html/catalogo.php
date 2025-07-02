<?php
session_start();
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

  <section id="catalogo">
    <h2>Catálogo de Productos</h2>
    <div class="productos">
      <?php foreach($productos as $producto): ?>
        <div class="producto">
          <img src="vista/productosIMG/<?php echo $producto['imagen'];?>" alt="">
          <h3><?php echo $producto['nombre'];?></h3>
          <p style="font-weight: bold;">Categoría: <span style="font-weight: normal;"><?php echo $producto['categoria'];?></span></p>
          <p style="font-weight: bold;">Especificaciones: <span style="font-weight: normal;"><?php echo $producto['especificaciones'];?></span></p>
          <p style="font-weight: bold;">Marca: <span style="font-weight: normal;"><?php echo $producto['marca'];?></span></p>
          <p style="font-weight: bold;">Modelo: <span style="font-weight: normal;"><?php echo $producto['modelo'];?></span></p>
          <p style="font-weight: bold;">Tipo: <span style="font-weight: normal;"><?php echo $producto['tipo'];?></span></p>
          <p style="font-weight: bold;">Precio: <span style="font-weight: normal;">$<?php echo $producto['precio'];?></span></p>
          <button><a href="index.php?accion=loginCliente&id=<?php echo $producto['id'];?>&ver=<?php if(isset($_SESSION['user'])){echo "1";}else{echo "0";}?>">Solicitar Compra</a></button>
        </div>  
      <?php endforeach ?>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
  </footer>

  <script src="vista/js/Scrips.js"></script>
</body>
</html>