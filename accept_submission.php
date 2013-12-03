<?php include "base.php" ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Accept Submission
<?php endblock() ?>

<?php
  startblock('content');
  $id = $_GET['id'];
  @$confirm = $_GET['confirm'];
  if (isset($id) && !isset($confirm)) {
    // ask user to confirm
    echo '<div class="fifty alert alert-info">Are you sure you want to accept this submission? Your request will be closed from further submssions.';
    echo '<br><br><center><a href="accept_submission.php?id='.$id.'&confirm=true" class="btn btn-success">Accept</a>';
    echo '<a href="user_page.php" class="big-left-pad btn btn-danger">Cancel</a></center></div>';
  } else if (isset($id) && isset($confirm)) {
    // update record in DB
    // Connect to db
    $db = new mysqli('127.0.0.1', 'team06', 'blueberry', 'team06');
    if(mysqli_connect_errno()) {
      echo 'ERROR: Could not connect to the DB. Aborting...';
      exit;
    }
    // Get request
    $request = $db -> query("UPDATE request SET accepted_submission_id = $id
				WHERE request.id = (SELECT request_id FROM submission
					WHERE submission.id = $id LIMIT 1);");
    if ($request == true) {
      echo '<div class="fifty alert alert-success">You\'ve successfully accepted this submission. Be sure to contact the seller for payment.<br><strong>Give money, get paid.</strong></div>';
    } else {
      echo '<div class="fifty alert alert-danger">Something went wrong updating the record.</div>';
    }
  }
  endblock();
?>
