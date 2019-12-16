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
$page_title = "Dashboard - Admin";
include(ABSPATH . 'dmap-includes/head.php');
?>
    <div class="container" id="main-content">
      <div class="row">
        <div class="col-12 col-md-3">
        </div>
        <div class="col-12 col-md-6">
          <div class="page-header">
              <h1 class="text-center">Admin Dashboard</h1>
              <p>You have logged in as: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> (Submitter ID: <?php echo htmlspecialchars($_SESSION["id"]); ?>)<br>
                 <span id="DashboardCampus">You are from institute_id: <b><?php echo htmlspecialchars($_SESSION["institute_id"]); ?></b></span><br>
                 Your login expires in<b>
                <?php
                if(!empty(trim($_SESSION["rememberme"]))) {
                  echo "7 days";
                }
                else {
                  echo "24 hours";
                }
                ?></b>.
              </p>
          </div>
          <hr>
          <p>
              <h2>Map Actions:</h2>
              <a href="<?php echo SITEURL; ?>/admin/dmap-create-map.php" class="btn btn-primary">Set up a New Map</a>
              <a href="<?php echo SITEURL; ?>/admin/dmap-dashboard.php#" class="btn btn-secondary">Edit Existing Map</a>
              <a href="<?php echo SITEURL; ?>/admin/dmap-delete-map.php" class="btn btn-danger">Delete a Map</a>
          </p>
          <hr>
          <p>
              <h2>User Management:</h2>
              <a href="<?php echo SITEURL; ?>/admin/dmap-dashboard.php#" class="btn btn-info">Reset Your Password</a>
              <a href="<?php echo SITEURL; ?>/admin/dmap-logout.php" class="btn btn-warning">Sign Out of Your Account</a>
          </p>
          <?php if (trim($_SESSION["institute_id"]) == 0): ?>
            <p>
                <h2>Site Management:</h2>
                <a href="<?php echo SITEURL; ?>/admin/dmap-dashboard.php#" class="btn btn-primary">List of All Map Admins</a>
                <a href="<?php echo SITEURL; ?>/admin/dmap-signup.php" class="btn btn-primary">Create New User</a>
            </p>
          <?php endif ?>
        </div>
        <div class="col-12 col-md-3">
        </div>
      </div>
    </div>
<?php
include(ABSPATH . 'dmap-includes/foot.php');
?>

<?php if (trim($_SESSION["institute_id"]) == 0): ?>
  <script type="text/javascript">
    $(document).ready(function() {
      var DashboardCampusHTML = "You are a site admin and have access to all campuses.";
      $("#DashboardCampus").html(DashboardCampusHTML);
    });
  </script>
<?php else: ?>
  <script type="text/javascript">
    $(document).ready(function() {
      var DashboardCampusHTML = "You are from <b>" + campusNameByInstituteId(<?php echo trim($_SESSION["institute_id"]); ?>) + "</b>" ;
      $("#DashboardCampus").html(DashboardCampusHTML);
    });
  </script>
<?php endif ?>
