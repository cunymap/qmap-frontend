<?php
include '../dmap-config.php';

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
  die("ERROR: Could not connect. " . mysqli_connect_error());
}
else {
  echo "Your " . DB_SERVER . " connection is working.";
}

?>
