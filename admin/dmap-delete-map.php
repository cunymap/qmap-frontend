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

// Load admin info
$id = trim($_SESSION["id"]);
$username = trim($_SESSION["username"]);
$institute_id = trim($_SESSION["institute_id"]);

// Render Create Map page
$page_title = "Delete Map - Admin";
include(ABSPATH . 'dmap-includes/head.php');
?>

<div class="container" id="main-content">
  <div class="text-center"
    <form id="deletePathForm">
      <h5>Delete Existing Map</h5><br>
      <label for="map_id"><strong>Search by Map ID #</strong><br><br>
      <input id="map_id" type="text" class="w-100"/><br><br>
      <input id="searchButton" type="button" value="Search">
      <input id = "delete_btn" type = "submit" value = "Delete Path" hidden>
    </form>
    <br><br>
    <p id="output" class="text-danger"></p>

  </div>
</div>

<!--Semester Table Section-->
<div id="add-path-disp" class="table-response-xl">
  <table class="table table-bordered">
    <thead>
      <th>First Semester</th>
      <th>Second Semester</th>
    </thead>
    <tr>
      <td id ="sem1"></td>
      <td id ="sem2"></td>
    </tr>
    <thead>
      <th>Third Semester</th>
      <th>Fourth Semester</th>
    </thead>
    <tr>
      <td id = "sem3"></td>
      <td id = "sem4"></td>
    </tr>
    <thead>
      <th>Fifth Semester</th>
      <th>Sixth Semester</th>
    </thead>
    <tr>
      <td id = "sem5"></td>
      <td id = "sem6"></td>
    </tr>
    <thead>
      <th>Seventh Semester</th>
      <th>Eighth Semester</th>
    </thead>
    <tr>
      <td id = "sem7"></td>
      <td id = "sem8"></td>
    </tr>
  </table>
</div>

<?php
include(ABSPATH . 'dmap-includes/foot.php');
?>

<script src="<?php echo(SITEURL); ?>/assets/js/admin-delete-map.js"></script>
