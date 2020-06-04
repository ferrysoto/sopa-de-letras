<?php
  session_start();

  $_SESSION['name'] = $_POST['name'];
  $_SESSION['rows'] = $_POST['rows'];
  $_SESSION['columns'] = $_POST['columns'];
  $_SESSION['words'] = $_POST['words'];

  function createTable($rows, $columns) {

    echo "<table id='table'>\n";
    for ($i=0; $i <= ($rows) ; $i++) {
      echo "<tr>\n";
      for ($j=0; $j < $columns; $j++) {
        $letter = chr(rand(65,90));
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $letter . "</td>";
      }
    }
  }


  createTable($_SESSION['rows'], $_SESSION['columns'])



  // explode php -> añadir elemento en lista segun separa

  // al clickar en una letra eliminar el boton
  // preg_replace

 ?>
