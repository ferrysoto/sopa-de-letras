<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sopa de lletres</title>
  </head>
  <body>
    <h3><?php $_POST['name'] ?></h3>
    <?php
    session_start();

    $name = $_POST['name'];
    $rows = $_POST['rows'];
    $columns = $_POST['columns'];

    function createTable($rows, $columns) {
      $userwords = $_POST['words'];
      $boxes = array();
      $words = getWords($userwords);
      $cant_letters = $rows * $columns;

      print_r($words);
      echo "<table id='table'>\n";

      for ($i = 0; $i < $cant_letters ; $i++) {
        $boxes[$i] = "";
      }

      $cont = 0;
      for ($i = 0; $i < $cant_letters; $i++) {
        $k = rand(0, $cant_letters);
        $l = $k+5;
        $position = rand(0, $cant_letters-1);
          if ($boxes[$position] == "") {
            $j = 0;
              for ($k; $k < $l; $k++) {
                if ($cont < $userwords) {
                  $boxes[$k] = "<button>" . substr($words[$cont], $j, 1) . "</button>";
                  $j++;
                }
              }
          } else {
            $i--;
          }
          $cont++;
      }

        for ($i = 0; $i < $cant_letters; $i++) {
          $position = rand(0, $cant_letters-1);
          $letter = chr(rand(65,90));
          if (strlen($boxes[$i]) == 0) {
            $boxes[$i] = "<button>".$letter."</button>";
          }
        }

        $pos = 0;
        for ($i = 0; $i < $rows; $i++) {
          echo '<tr>';
          for ($j = 0; $j < $columns; $j++) {
            if ($j == 2 || $j == 5) {
              if ($boxes[$pos] == "") {
                echo '<td></td>';
              } else {
                echo '<td>'. $boxes[$pos] .'</td>';
              }
            } else {
              if ($boxes[$pos] == "") {
                echo '<td></td>';
              } else {
                echo '<td>'. $boxes[$pos] .'</td>';
              }
            }
            $pos++;
          }
          echo '</tr>';
        }
        echo '</table>';
    }

    function getWords($usernumber) {
      $filecontents = file_get_contents('words.txt');
      $filewords = preg_split('/[\s]+/', $filecontents, -1, PREG_SPLIT_NO_EMPTY);
      $words = [];

      for ($i=0; $i < $usernumber; $i++) {
        $randnumber = array_rand($filewords, 1);
        array_push($words, $filewords[$randnumber]);
        unset($filewords[$randnumber]);
      }

      return $words;
    }


    createTable($rows, $columns);

    ?>
  </body>
</html>
