<?php
  session_start();
  session_destroy();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sopa de letras</title>
  </head>
  <body>
    <h1>Sopa de letras</h1>
    <form action="game.php" method="post">
      <label for="name">Nombre del jugador: </label>
      <input type="text" name="name" value="" required>
      <br>
      <label for="rows">Filas: </label>
      <input type="number" name="rows" value="" min="10" max="20" required>
      <br>
      <label for="columns">Columnas: </label>
      <input type="number" name="columns" value="" min="10" max="20" required>
      <br>
      <label for="words">Palabras: </label>
      <input type="number" name="words" value="" min="2" max="10" required>
      <button type="submit" name="button">¡Jugar!</button>
    </form>
  </body>
</html>
