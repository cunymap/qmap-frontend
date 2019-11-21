<?php
// Initialize the session
session_start();

// Include config file
require_once( dirname(__FILE__) . '/../dmap-config.php' );

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: dmap-login.php");
    exit;
}

// Render Dashboard page
$page_title = "Dashboard";
include(ABSPATH . 'dmap-includes/head.php');
?>
    <div class="container" style="padding-top: 5vh;">
      <div class="row">
        <div class="col-12 col-md-3">
        </div>
        <div class="col-12 col-md-6">
          <div class="page-header">
              <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Degree Maps admin page.</h1>
              <p>Your login expires in
                <?php
                if(!empty(trim($_SESSION["rememberme"]))) {
                  echo "7 days";
                }
                else {
                  echo "24 minutes";
                }
                ?>.
              </p>
          </div>
          <hr>
          <p>
              <h2>Map Actions:</h2>
              <a href="#" class="btn btn-primary">Set up a New Map</a>
              <a href="#" class="btn btn-secondary">Edit Existing Map</a>
              <a href="#" class="btn btn-danger">Remove a Map</a>
          </p>
          <hr>
          <p>
              <h2>User Management:</h2>
              <a href="#" class="btn btn-info">Reset Your Password</a>
              <a href="dmap-logout.php" class="btn btn-warning">Sign Out of Your Account</a>
          </p>
        </div>
        <div class="col-12 col-md-3">
        </div>
      </div>
    </div>
<?php
include(ABSPATH . 'dmap-includes/foot.php');
?>
