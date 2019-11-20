<?php
/* Database credentials */
define('DB_SERVER', 'localhost');
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
define('SITEURL', 'https://venus.cs.qc.cuny.edu/~dmap');

/* Absolute path to the dmap installation directory */
if (!defined('ABSPATH'))
  define('ABSPATH', dirname(__FILE__) . '/');

/* That's it. Happy coding :D */
