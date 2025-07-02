<?php
session_start();
if(isset($_SESSION['user'])){
    header("location: index.php?accion=crearPedido");
    exit();
}
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
    </nav>
  </header>

  <section id="admin">
    <h2>Registrarse como Cliente</h2>
    <p><strong>Registro:</strong></p>
    <form action="index.php?accion=registroCliente" method="post">
      <input type="hidden" name="rol" value="cliente">
      <input type="text" name="nombre" placeholder="Nombre" required>
      <input type="email" name="correo" placeholder="Correo" required>
      <input type="password" name="clave" placeholder="Contraseña" required>
      <?php 
        if(isset($_SESSION['error_login_cliente'])){
          echo "<p style='color:red;font-weight:bold;'>".$_SESSION['error_login_cliente']."</p>";
          unset($_SESSION['error_login']);  
        }
      ?>
      <button type="submit">Registar</button>
    </form>
  </section>

  <footer>
    <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
  </footer>

</body>
</html>
