<?php
/* Database credentials */
define('DB_SERVER', '149.4.211.180');
define('DB_USERNAME', 'dmap');
define('DB_PASSWORD', 'dmap2019');
define('DB_NAME', 'dmap');

/* dmap Database Table prefix .
 *
 * You can have multiple installations in one database if you give
 * each a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'dmap_';

/* Define the dmap installation root URL. Do not put a slash at the end. */
define('SITEURL', 'https://qmap-web.herokuapp.com');

/* Define the backend installation URL. Do not put a slash at the end. */
define('BACKENDURL', 'https://qmap-platform.herokuapp.com');

/* Absolute path to the dmap installation directory */
if (!defined('ABSPATH'))
  define('ABSPATH', dirname(__FILE__) . '/');

/* That's it. Happy coding :D */

/*
 * The following code block allows frontend js to query frontend or backend
 * URL. The response can be later requested by AJAX.
 * Example: https://venus.cs.qc.cuny.edu/~dmap/dmap-config.php?fetchConfig=frontend
 * Response: https://venus.cs.qc.cuny.edu/~dmap
 */

if (!empty(trim($_GET["fetchConfig"]))) {
  if (trim($_GET["fetchConfig"]) == "frontend") {
    echo SITEURL;
  }
  else if (trim($_GET["fetchConfig"]) == "backend") {
    echo BACKENDURL;
  }
  else header("location: index.php");
}
