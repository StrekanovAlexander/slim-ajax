<?php 
  require 'db.php';
 
  $titles = array();

 
 if (isset($_POST['start']) && is_numeric($_POST['start'])) {
  $start = $_POST['start'];
  $res = mysqli_query($db, "SELECT * FROM titles order by id DESC LIMIT {$start}, 5");
  while ($row = mysqli_fetch_assoc($res)) {
    $titles[] = $row;
  }
 }
 
echo json_encode($titles);