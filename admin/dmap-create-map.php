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
$username = trim($_SESSION["username"]);
$institute_id = trim($_SESSION["institute_id"]);

// Render Create Map page
$page_title = "Create Map - Admin";
include(ABSPATH . 'dmap-includes/head.php');
?>
    <div class="container" style="padding-top: 5vh;">
      <div class="row">
        <div class="col-12">
          <div class="page-header">
              <h1 class="text-center">Create a Map</h1>
              <p class="text-center">
                These are all the required fields needed from client to create a map in the database.<br>
                Some fields are user inputs and some are provided with the admin account.
              </p>
          </div>
        </div>
      </div>
      <form class="" action="dmap-create-map.php" method="post" id="createMapForm">
        <div class="row">
          <div class="col-12 text-center">
            <label for="map_name">Map Name</label>
            <input id="map_name" type="text" placeholder="Name of the map" /><br>
            <label for="degree">Degree</label>
            <input id="degree" type="text" placeholder="Computer Science" /><br>
          </div>
          <div class="col-6 col-sm-12">
          </div>
          <div class="col-6 col-sm-12">
          </div>
        </div>
      </form>


    </div>
<?php
include(ABSPATH . 'dmap-includes/foot.php');
?>
