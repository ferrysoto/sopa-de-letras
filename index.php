<?php
        session_start();
        session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Menu</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
  <div class="container">
    <form action="./game.php" method='post'>
      Nombre: <input type="text" name="username" required minlength="2" maxlength="14"><br>
      Filas: <input type="number" name="rows" required min="10" max="20"><br>
      Columnas:<input type="number" name="columns" required min="10" max="20"><br>
      Cantidad de palabras :<input type="number" name="words"  min="2" max="12"><br>
      <input class="btn" type="submit">
    </form>
  </div>
</body>

</html>
