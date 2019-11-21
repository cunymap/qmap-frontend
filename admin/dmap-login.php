<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: dmap-dashboard.php");
    exit;
}

// Include config file
require_once( dirname(__FILE__) . '/../dmap-config.php' );
require_once( dirname(__FILE__) . '/dmap-db.php' );

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM " . $table_prefix . "users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // PHP default session timeout is 24 min.
                            // "Remember Me" will extend session cookie by 7 days.
                            if(!empty(trim($_POST["rememberme"]))) {
                              $params = session_get_cookie_params();
                              setcookie(session_name(), $_COOKIE[session_name()], time() + 60*60*24*7, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
                              $_SESSION["rememberme"] = "yes";
                            }

                            // Redirect user to welcome page
                            header("location: dmap-dashboard.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}

// Render Login page
$page_title = "Login";
include(ABSPATH . 'dmap-includes/head.php');
?>
    <div class="container" style="padding-top: 5vh;">
      <div class="row">
        <div class="col-12 col-md-4">
        </div>
        <div class="col-12 col-md-4">
          <h2 class="text-center" style="padding-bottom: 25px;">Admin Login</h2>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
              <label class="sr-only" for="username">Username</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="Username" required>
                <div class="invalid-feedback"><?php echo $username_err; ?></div>
              </div>
            </div>
            <div class="form-group">
              <label class="sr-only" for="password">Password</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </div>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Password" required>
                <div class="invalid-feedback"><?php echo $username_err; ?></div>
              </div>
            </div>
            <div class="form-group text-center">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="rememberme" name="rememberme" value="yes">
                <label class="custom-control-label" for="rememberme">Remember Me for 7 Days</label>
              </div>
            </div>
            <div class="form-group text-center">
              <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p class="text-center"><a href="#" data-toggle="tooltip" data-placement="bottom" title="Contact the CUNY Service Desk at (646) 664-2311 or service.desk@cuny.edu.">Need Help?</a></p>
            <p>This page is protected by reCAPTCHA (haven't implemented yet), and subject to the <a href="https://www.google.com/policies/privacy/" target="_blank" rel="noopener noreferrer">Privacy Policy</a> and <a href="https://www.google.com/policies/terms/" target="_blank" rel="noopener noreferrer">Terms of service</a>.</p>
          </form>
        </div>
        <div class="col-12 col-md-4">
        </div>
      </div>
    </div>
<?php
include(ABSPATH . 'dmap-includes/foot.php');
?>
