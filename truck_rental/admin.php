<?php
session_start();
require 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_asset'])) {
    
    $brand = $_POST['brand'];   
    $model = $_POST['model'];    
    $type = $_POST['type'];      
    $operator = $_POST['operator']; 

    $sql = "INSERT INTO assets (brand, model, asset_type, operator_name, status) 
            VALUES (:br, :md, :tp, :op, 'available')";
            
    $stid = oci_parse($conn, $sql);
    
    oci_bind_by_name($stid, ":br", $brand);
    oci_bind_by_name($stid, ":md", $model);
    oci_bind_by_name($stid, ":tp", $type);
    oci_bind_by_name($stid, ":op", $operator);
    
    if (oci_execute($stid)) {
        $message = "Asset added successfully!";
    } else {
        $e = oci_error($stid);
        $message = "Error: " . $e['message'];
    }
}


if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $del_sql = "DELETE FROM assets WHERE asset_id = :id";
    $del_stid = oci_parse($conn, $del_sql);
    oci_bind_by_name($del_stid, ":id", $id);
    if (oci_execute($del_stid, OCI_COMMIT_ON_SUCCESS)) {
        header("Location: admin.php"); 
        exit();
    }
}

$sql = "SELECT * FROM assets ORDER BY asset_id DESC";
$trucks_stid = oci_parse($conn, $sql);
oci_execute($trucks_stid);

include 'admin_view.php';
?>