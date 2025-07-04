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

  <section class="banner">
    <div class="slides">
      <img src="" alt="Banner 1" />
      <img src="" alt="Banner 2" />
      <img src="" alt="Banner 3" />
    </div>
  </section>

  <footer>
    <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
  </footer>

</body>
</html>