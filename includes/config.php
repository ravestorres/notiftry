<?php
define('DB_HOST', 'localhost');          // Set database host
define('DB_USER', 'root');              // Set database user
define('DB_PASS', '');                  // Set database password
define('DB_NAME', 'inventory_system');  // Set database name

// Establish database connection
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
