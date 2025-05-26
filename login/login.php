<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
</head>
<body>
  <h2>Inicio de Sesión</h2>

  <form action="validar_login.php" method="POST">
    <label for="nombre_usuario">Usuario:</label><br>
    <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>

    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Ingresar">
  </form>

  <?php if (isset($_GET['error'])): ?>
    <p style="color:red;">Usuario o contraseña incorrectos.</p>
  <?php endif; ?>
</body>
</html