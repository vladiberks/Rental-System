<?php
// register.php - CONTROLLER (Logic Only)
session_start();
require 'db.php';

$error_msg = "";
$success_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Collect inputs
    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact_number'];
    $ctype   = $_POST['customer_type'];
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // 2. Logic & Validation
    if ($password !== $confirm_password) {
        $error_msg = "Passwords do not match!";
    } else {
        $check_sql = "SELECT username FROM customers WHERE username = :u";
        $check_stid = oci_parse($conn, $check_sql);
        oci_bind_by_name($check_stid, ":u", $username);
        oci_execute($check_stid);

        if (oci_fetch_assoc($check_stid)) {
            $error_msg = "That username is already taken.";
        } else {
            $insert_sql = "INSERT INTO customers 
                (username, password, role, first_name, middle_name, last_name, address, contact_number, customer_type) 
                VALUES 
                (:u, :p, 'customer', :fn, :mn, :ln, :addr, :cont, :ctype)";
            
            $insert_stid = oci_parse($conn, $insert_sql);
            
            oci_bind_by_name($insert_stid, ":u", $username);
            oci_bind_by_name($insert_stid, ":p", $password);
            oci_bind_by_name($insert_stid, ":fn", $fname);
            oci_bind_by_name($insert_stid, ":mn", $mname);
            oci_bind_by_name($insert_stid, ":ln", $lname);
            oci_bind_by_name($insert_stid, ":addr", $address);
            oci_bind_by_name($insert_stid, ":cont", $contact);
            oci_bind_by_name($insert_stid, ":ctype", $ctype);

            if (oci_execute($insert_stid)) {
                $success_msg = "Account created! <a href='login.php'>Login now</a>";
            } else {
                $e = oci_error($insert_stid);
                $error_msg = "Database Error: " . $e['message'];
            }
        }
    }
}

// 3. Load the View
// This line grabs the HTML file and shows it to the user
include 'register_view.php';
?>