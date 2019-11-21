<?php
// Include config file
require_once( dirname(__FILE__) . '/../dmap-config.php' );
require_once( dirname(__FILE__) . '/dmap-db.php' );

// Define variables and initialize with empty values
$username = $password = $confirm_password = $instcode = "";
$username_err = $password_err = $confirm_password_err = $instcode_err = "";

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

    // Validate instcode
    if (empty(trim($_POST["instcode"]))) {
        $instcode_err = "Please enter a instcode.";
    } else {
        $instcode = trim($_POST["instcode"]);
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($instcode_err)){

        // Prepare a select statement
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        $sql = "INSERT INTO " . $table_prefix . "users (username, password, instcode) VALUES ('" . $username . "', '" . $hashed_password . "', '" . $instcode . "')";
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
$page_title = "Sign Up";
include(ABSPATH . 'dmap-includes/head.php');
?>
    <div class="container" style="padding-top: 5vh;">
      <div class="row">
        <div class="col-12 col-md-4">
        </div>
        <div class="col-12 col-md-4">
          <h2>Sign Up</h2>
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
              <div class="form-group <?php echo (!empty($instcode_err)) ? 'has-error' : ''; ?>">
                  <label>Institution Code (instcode)</label>
                  <input type="text" name="instcode" class="form-control" value="<?php echo $instcode; ?>">
                  <span class="help-block"><?php echo $instcode_err; ?></span>
              </div>
              <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Submit">
                  <input type="reset" class="btn btn-default" value="Reset">
              </div>
              <p>Already have an account? <a href="dmap-login.php">Login here</a>.</p>
          </form>
        </div>
        <div class="col-12 col-md-4">
        </div>
      </div>
    </div>
<?php
include(ABSPATH . 'dmap-includes/foot.php');
?>
