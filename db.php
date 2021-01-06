<?php
  $db_host = "localhost";
  $db_name = "simple_db";
  $db_user = "root";
  $db_pass = "root";
  $db = mysqli_connect ($db_host, $db_user, $db_pass, $db_name) or die ("Connect error...");
  mysqli_query ($db, 'set character_set_results = "utf8"');