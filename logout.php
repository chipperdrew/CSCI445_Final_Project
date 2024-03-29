<?php include 'base.php' ?>

<!-- Title block --> 
<?php startblock('title') ?>
	PaidSource Logout
<?php endblock() ?>

<?php startblock('content') ?>
<?php
  if (is_logged_in()) {
    $username = $_SESSION[USERNAME];
    echo "You've successfully logged out, $username. Come back soon so you can <strong>get money $ get paid $</strong>.";
    // log out
    // from http://us3.php.net/session_destroy
    // Unset all of the session variables.
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
      );
    }
    // Finally, destroy the session.
    session_destroy(); 
  } else {
    echo "You're not logged in.";
  }
?>
<?php endblock() ?>

