<?php
// index.php - CUSTOMER CONTROLLER
session_start();
require 'db.php';

// 1. Security: Check if user is logged in
// We check for 'username' because that is what we set in login.php
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 2. Handle "Rent" Action
// This runs if the user clicks a "Rent" button in the view
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rent_asset'])) {
    
    $asset_id = $_POST['asset_id'];
    
    // UPDATED SQL: 
    // Since we removed customer_id and dates, we can only update the STATUS.
    // We cannot track WHO rented it or WHEN it returns anymore.
    $sql = "UPDATE ASSETS 
            SET STATUS = 'rented' 
            WHERE ASSET_ID = :id";
            
    $stid = oci_parse($conn, $sql);
    
    oci_bind_by_name($stid, ":id", $asset_id);
    
    oci_execute($stid, OCI_COMMIT_ON_SUCCESS);
    
    // Refresh page to show it as unavailable
    header("Location: index.php"); 
    exit();
}

// 3. Prepare Data for the View
// Select all assets from the new ASSETS table
// You can change this to "WHERE STATUS = 'available'" if you only want to show available ones
$sql = "SELECT * FROM ASSETS ORDER BY ASSET_ID DESC";

// We use $assets_stid to match your index_view.php
$assets_stid = oci_parse($conn, $sql);
oci_execute($assets_stid);

// 4. Load the View
include 'index_view.php';
?>