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
$page_title = "Create Map - Admin";
include(ABSPATH . 'dmap-includes/head.php');
?>
    <div class="container" id="main-content">
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
      <div class="row">
        <div class="col-12 col-md-3"></div>
        <div class="col-12 col-md-6">

          <form id="createMapForm">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label class="sr-only" for="map_name">Map Name</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-map-marked-alt"></i></div>
                  </div>
                  <input type="text" id="map_name" placeholder="Map Name" required>
                </div>
              </div>
              <div class="form-group col-md-4">
                <label class="sr-only" for="degree">Major</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-book-open"></i></div>
                  </div>
                  <input type="text" id="degree" placeholder="Major" required>
                </div>
              </div>
              <div class="form-group col-md-4">
                <label class="sr-only" for="start_year">Start Year</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                  </div>
                  <input type="text" id="start_year" placeholder="Start Year" required>
                </div>
                <small class="form-text text-muted">Format: SP YYYY for spring, or FA YYYY for fall.</small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="institute_id">Institute</label>
                <select id = "institute_id">
                  <option selected value disabled>Loading...</option>
                  <option value = "17">Queens College</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="submit_id">Submitter ID</label>
                <input id="submit_id" type="text" value="<?php echo $id ?>" disabled />
              </div>
            </div>

            <!--display for path-->
            <div class="container">
              <div id="add-path-disp" class="table-response-xl">
                <table class="table table-bordered">
                  <thead>
                    <th class="text-center">First Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem1');">
                    </th>
                    <th class="text-center">Second Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem2');">
                    </th>
                  </thead>
                  <tr>
                    <td class="text-center" id ="sem1"></td>
                    <td class="text-center" id ="sem2"></td>
                  </tr>
                  <thead>
                    <th class="text-center">Third Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem3');">
                    </th>
                    <th class="text-center">Fourth Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem4');">
                    </th>
                  </thead>
                  <tr>
                    <td class="text-center" id="sem3"></td>
                    <td class="text-center" id="sem4"></td>
                  </tr>
                  <thead>
                    <th class="text-center">Fifth Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem5');">
                    </th>
                    <th class="text-center">Sixth Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem6');">
                    </th>
                  </thead>
                  <tr>
                    <td class="text-center" id="sem5"></td>
                    <td class="text-center" id="sem6"></td>
                  </tr>
                  <thead>
                    <th class="text-center">Seventh Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem7');">
                    </th>
                    <th class="text-center">Eighth Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem8');">
                    </th>
                  </thead>
                  <tr>
                    <td class="text-center" id="sem7"></td>
                    <td class="text-center" id="sem8"></td>
                  </tr>
                </table>
                <div class="text-center">
                  <input id="submitButton"  type="submit" value="Create Map" />
                  <button type="reset" name="reset">Start Over</button>
                  <a href="<?php echo SITEURL; ?>/admin/dmap-dashboard.php">Cancel</a>
                </div>
              </div>
            </div>

          </form>

        </div>
        <div class="col-12 col-md-3"></div>
      </div>


    </div>
<?php
include(ABSPATH . 'dmap-includes/foot.php');
?>

<?php if (trim($_SESSION["institute_id"]) == 0): ?>
  <script type="text/javascript">
    $(document).ready(function() {
      loadCampuses("institute_id");
    });
  </script>
<?php else: ?>
  <script type="text/javascript">
    $(document).ready(function() {
      loadSpecificCampus("institute_id", <?php echo $institute_id ?>);
    });
  </script>
<?php endif ?>

<script src="<?php echo(SITEURL); ?>/assets/js/admin-create-map.js"></script>
