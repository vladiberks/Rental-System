<?php
// db.php
$username = "tiger";         // Make sure this is your user
$password = "tiger123";    // Make sure this is your password
$connection_string = "localhost/XE"; // Ensure this is inside quotes!

$conn = oci_connect($username, $password, $connection_string);

if (!$conn) {
    $e = oci_error();
    die("Connection failed: " . $e['message']);
}
?>