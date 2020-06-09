
<head>
    <meta charset="UTF-8">
    <title>Game</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
session_start();

  function newGame($rows,$columns,$numWords) {
    $arrayGame = createArrayFilledRandomly($rows,$columns);
    $words = getWords($numWords);
    $_SESSION["maxLetters"] = cntLetters($words);

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

  function createArrayFilledRandomly($rows, $columns) {
    $array = [];
    for ($i = 0; $i < $rows; $i++) {
      for ($j = 0; $j < $columns; $j++) {
        $randChar = chr(rand(65, 90));
        $array[$i][$j] = "<td><button type='submit' name='cell'>$randChar</button></td>";
      }
    }
    return $array;
  }

  function getWords($number) {
     $filecontents = file_get_contents('words.txt');
     $filewords = preg_split('/[\s]+/', $filecontents, -1, PREG_SPLIT_NO_EMPTY);
     $words = [];

     for ($i=0; $i < $number; $i++) {
          $randnumber = array_rand($filewords, 1);
          array_push($words, $filewords[$randnumber]);
          unset($filewords[$randnumber]);
      }

    $_SESSION['palabras'] = $words;
    return $words;
  }

  function cntLetters($arrayWords) {
    $letters = 0;
    foreach ($arrayWords as  $word) {
      $letters += strlen($word);
    }
    return $letters;
  }

  function rmvBtn($htmlString) {
    $htmlString = preg_replace('/<button [^>]*>/', "", $htmlString);
    $htmlString = preg_replace('/<\/button>/', "", $htmlString);
    return $htmlString;
  }

  function ifCorrect($box) {
    $i = explode("-", $box)[0];
    $j = explode("-", $box)[1];

    $aux = preg_replace('/class/',"class='success'", $_SESSION["game"][$i][$j]);
    $aux = rmvBtn($aux);
    $_SESSION["game"][$i][$j] = $aux;
  }

  function render($array) {
    foreach ($array as $rows) {
      echo "<tr>";
        foreach ($rows as $row) {
          echo $row;
        }
        echo "</tr>";
      }
    }

  if (!isset($_SESSION["game"]) or is_null($_SESSION["game"])){

    if (!isset($_POST["username"], $_POST["rows"], $_POST["columns"], $_POST["words"])){
      header('Location:./index.php');
      die();
    }
    $_SESSION["username"] =  $_POST["username"];
    $_SESSION["rows"] =  $_POST["rows"];
    $_SESSION["columns"] =  $_POST["columns"];
    $_SESSION["words"] =  $_POST["words"];
    $_SESSION["tries"] =  0;
    $_SESSION["game"] = newGame($_SESSION["rows"], $_SESSION["columns"], $_SESSION["words"]);

  } else if (isset($_GET["cell"])) {
      ifCorrect($_GET["cell"]);
  }
  $arrayGame = $_SESSION["game"];

  ?>
    <body>
      <div class="container">
        <h3>Está Jugando:  <?php print_r($_SESSION['username']); ?></h3>
        <br>
        Palabras <?php print_r($_SESSION['palabras']); ?>
        <form action="./game.php" method="get">
          <table><?php render($arrayGame) ?></table>
        </form>
        <form action="./index.php" method="get">
          <button class="btn" type="submit">Menu</button>
        </form>
      </div>
    </body>
</html>
