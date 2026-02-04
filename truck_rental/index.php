<?php
// index.php - CUSTOMER CONTROLLER
session_start();
require 'db.php';

// checks if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// rent button view
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rent_asset'])) {
    
    $asset_id = $_POST['asset_id'];
    
    // sql for database
    $sql = "UPDATE ASSETS 
            SET STATUS = 'rented' 
            WHERE ASSET_ID = :id";
            
    $stid = oci_parse($conn, $sql);
    
    oci_bind_by_name($stid, ":id", $asset_id);
    
    oci_execute($stid, OCI_COMMIT_ON_SUCCESS);
    
    // page refresh
    header("Location: index.php"); 
    exit();
}

// select all trucks for customer view
$sql = "SELECT * FROM ASSETS ORDER BY ASSET_ID DESC";

// We use $assets_stid to match your index_view.php
$assets_stid = oci_parse($conn, $sql);
oci_execute($assets_stid);

// load view
include 'index_view.php';

?>
