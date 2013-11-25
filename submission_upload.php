<?php include "base.php";
  $id = $_GET['id'];
  
  // Connect to the DB
  $db = new mysqli('127.0.0.1', 'team06', 'blueberry', 'team06');
  if(mysqli_connect_errno()) {
    echo 'ERROR: Could not connect to the DB. Aborting...';
    exit;
  }

  // Validate user
  if (!is_logged_in()) {
    echo "You're not logged in.";
    exit;
  } else {
    $USER_ID = $_SESSION[USER_ID];
  }

  // verify $id exists
  $valid = false;
  $request = $db -> query("SELECT * FROM request WHERE id=$id");
  if ($request_data = $request->fetch_row()) {
    $valid = true;
    $request_title = $request_data[3];
  }
?>
<!-- Title block --> 
<?php startblock('title') ?>
<?php
  if ($valid) {
    echo "$request_title Submission";
  } else {
    echo 'Invalid Submission';
  }
?>
<?php endblock() ?>

<?php startblock('content') ?>
<?php
  // verify a file was uploaded
  if ($valid && isset($_POST['submit']) && $_FILES['file']['error'] == 0) {
    $file_name = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $fp = fopen($tmp_name, 'r');
    $content = addslashes(fread($fp, filesize($tmp_name)));
    fclose($fp);

    if (!get_magic_quotes_gpc()) {
      $file_name = addslashes($file_name);
    }

    $timestamp_now = time();

    $db->query("INSERT INTO submission(request_id, user_id, submission_timestamp, file_name, file_type, file_size, file_content) VALUES($id, $USER_ID, $timestamp_now, '$file_name', '$file_type', $file_size, '$content');");
    $submission_id = $db->insert_id;
    if (isset($submission_id) && $submission_id > 0) {
      echo "<div class='alert alert-success fifty'><strong>Your file upload was successful</strong>, the request author will email you about your submission.</div>";
    } else {
      echo "<div class='alert alert-danger fifty'><strong>Your file upload was not successful.</strong><br>";
      echo $db->error;
      echo '</div>';
    }
  } else {
    echo '<strong>Something went wrong with the file upload, try again.</strong>';
    $valid = false;
  }
?>
<?php endblock() ?>
