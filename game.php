<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Sopa de lletres</title>
  </head>

  <body>
    <div class="container">
      <?php
      session_start();
      echo "<h3>Está jugando:  " . $_SESSION["name"] . "</h3>";

      $_SESSION["name"] =  $_POST['name'];
      $_SESSION["rows"] =  $_POST['rows'];
      $_SESSION["cols"] =  $_POST['columns'];
      $_SESSION["words"] =  $_POST['words'];
      $_SESSION["hits"] =  0;
      $_SESSION["game"] = createTable($_SESSION["rows"], $_SESSION["cols"], $_SESSION["words"] );


      function createTable($rows, $columns, $userwords) {
            $arrayGame = createArrayFillRandom($rows, $columns);
            $words = getWords($userwords);
            $_SESSION['cant_letters'] = countLetters($words);

            for ($indexWord = 0; $indexWord < count($words); $indexWord++) {
            $vertical = rand(0, 1);
            if ($vertical) {
                $fila = rand(0, $rows - strlen($words[$indexWord])-1);
                $columna = rand(0, $columns-1);
                for ($i = 0; $i < strlen($words[$indexWord]); $i++) {
                    $letra = substr($words[$indexWord], $i, 1);
                    $nextFila = $fila + $i;
                    $arrayGame[$nextFila][$columna] = "<td class><button type='submit' name='cell' value=\"$nextFila-$columna\">" . $letra . "</button></td>";
                }
            } else {
                $fila = rand(0, $rows-1);
                $columna = rand(0, $columns - strlen($words[$indexWord]));
                for ($i = 0; $i < strlen($words[$indexWord]); $i++) {
                    $letra = substr($words[$indexWord], $i, 1);
                    $nextCol = $columna + $i;
                    $arrayGame[$fila][$nextCol] = "<td class><button type='submit' name='cell' value=\"$fila-$nextCol\">" . $letra . "</button></td>";
                }
              }
          }
          return $arrayGame;
        }

        function CountLetters($words) {
          $numLetters = 0;

          foreach ($words as $word) {
            $numLetters += strlen($word);
          }

          return $numLetters;
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

        function createArrayFillRandom($rows, $columns) {
            $array = [];
            for ($i = 0; $i < $rows; $i++) {
                for ($j = 0; $j < $columns; $j++) {
                    $randChar = chr(rand(65, 90));
                    $array[$i][$j] = "<td><button type='submit' name='cell'> $randChar </button></td>";
                }
            }
            return $array;
        }

        function removeButton($htmlString) {
            $htmlString = preg_replace('/<button [^>]*>/',"",$htmlString);
            $htmlString = preg_replace('/<\/button>/',"",$htmlString);      
            return $htmlString;
        }


        ?>
    </div>
    <a class="btn" href="/index.php">Inicio</a>
  </body>
</html>
