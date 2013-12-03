<?php 
  $id = $_GET['id'];
  // Connect to db
  $db = new mysqli('127.0.0.1', 'team06', 'blueberry', 'team06');
  if(mysqli_connect_errno()) {
    include "base.php";
    echo 'ERROR: Could not connect to the DB. Aborting...';
    exit;
  }

  $file = $db->query("SELECT * FROM submission WHERE submission.id = $id");

  if ($file_row = $file->fetch_row()) {
    $file_type = $file_row[5];
    $file_length = $file_row[6];
    $file_content = $file_row[7];
    $file_name = $file_row[4];
    header('Content-Length: '.$file_length);
    header('Content-Type: '.$file_type);
    header('Content-Disposition: attachment; filename='.$file_name);
    echo $file_content;
  } else {
    include "base.php";
    echo "That ain't a file, get money get paid elsewhere.";
  }
?>

