    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img src="<?php echo(SITEURL); ?>/assets/img/cuny-logo.png" height="30" class="d-inline-block align-top" id="cuny-logo" alt="City University of New York">
        Degree Maps
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo(SITEURL); ?>">Home</a>
          </li>
          <li class="nav-item">
            <div class="nav-link">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="darkSwitch">
                <label class="custom-control-label" for="darkSwitch">High Contrast Theme</label>
              </div>
            </div>
          </li>
        </ul>
        <span class="navbar-text">
          <?php
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
              echo "<a href=\"" . SITEURL . "/admin/\">Admin Login</a>";
            }
            else {
              echo "Current Admin: ";
              echo "<a href=\"" . SITEURL . "/admin/\">";
              echo htmlspecialchars($_SESSION["username"]);
              echo "</a> ";
              echo " (<a href=\"" . SITEURL . "/admin/dmap-logout.php\">Logout</a>)";
            }
          ?>
        </span>
      </div>
    </nav>
