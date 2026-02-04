<?php
// db.php
$username = "tiger";        //oracle username
$password = "tiger123";    //oracle password
$connection_string = "localhost/XE"; //inside quotes

$conn = oci_connect($username, $password, $connection_string);

if (!$conn) {
    $e = oci_error();
    die("Connection failed: " . $e['message']);
}

?>
