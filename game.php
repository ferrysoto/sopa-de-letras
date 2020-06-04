<?php
  session_start();

  $_SESSION['name'] = $_POST['name'];
  $_SESSION['rows'] = $_POST['rows'];
  $_SESSION['columns'] = $_POST['columns'];
  $_SESSION['words'] = $_POST['words'];

 ?>
