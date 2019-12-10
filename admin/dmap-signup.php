<?php
// Initialize the session
session_start();

// Check if the user has logged in
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: dmap-login.php");
    exit;
}
// Check if the user is admin
if(!(trim($_SESSION["institute_id"]) == 0)){
    header("location: dmap-dashboard.php");
    exit;
}

// Include config file
require_once( dirname(__FILE__) . '/../dmap-config.php' );
require_once( dirname(__FILE__) . '/dmap-db.php' );

// Define variables and initialize with empty values
$username = $password = $confirm_password = $institute_id = "";
$username_err = $password_err = $confirm_password_err = $institute_id_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    }
    else {
        // Prepare a select statement
        $sql = "SELECT * FROM " . $table_prefix . "users WHERE username = '" . trim($_POST["username"]) . "';";
        // Attempt to execute the prepared statement
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            $username_err = "The username '" . trim($_POST["username"]) . "' is already taken.";
        }
        else {
            $username = trim($_POST["username"]);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate institute_id
    if (is_null(trim($_POST["institute_id"]))) {
        $institute_id_err = "Please enter a valid institute_id.";
    } else {
        $institute_id = trim($_POST["institute_id"]);
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($institute_id_err)){

        // Prepare a select statement
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        $sql = "INSERT INTO " . $table_prefix . "users (username, password, institute_id) VALUES ('" . $username . "', '" . $hashed_password . "', '" . $institute_id . "')";
        // Attempt to execute the prepared statement
        if (mysqli_query($link, $sql)) {
            // Optional: Redirect to login page
            echo "Successfully created user " . $username;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
            echo "<br>Something went wrong. Please try again later.<br>";
        }
    }

    // Close connection
    mysqli_close($link);
}

// Render Login page
$page_title = "Create New Account - Admin";
include(ABSPATH . 'dmap-includes/head.php');
?>
    <div class="container" style="padding-top: 5vh;">
      <div class="row">
        <div class="col-12 col-md-4">
        </div>
        <div class="col-12 col-md-4">
          <h2>Create New Account</h2>
          <p>For site admin use only; Please fill this form to create an account.</p>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                  <span class="help-block"><?php echo $username_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                  <span class="help-block"><?php echo $password_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                  <label>Confirm Password</label>
                  <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                  <span class="help-block"><?php echo $confirm_password_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($institute_id_err)) ? 'has-error' : ''; ?>">
                  <label>Institute (institute_id)</label>
                  <input type="text" name="institute_id" class="form-control" value="<?php echo $institute_id; ?>">
                  <span class="help-block">Fill out value 0 to create another site admin.</span>
                  <span class="help-block"><?php echo $institute_id_err; ?></span>
              </div>
              <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Submit">
                  <input type="reset" class="btn btn-default" value="Reset">
              </div>
          </form>
        </div>
        <div class="col-12 col-md-4">
        </div>
      </div>
    </div>
<?php
include(ABSPATH . 'dmap-includes/foot.php');
?>
