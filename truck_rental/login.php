<?php
// login.php
session_start();
require 'db.php';

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // 1. We select * (all columns), so this includes customer_id
    // Note: Make sure your table is actually named 'customers'
    $sql = "SELECT * FROM customers WHERE username = :username AND password = :password";
    
    $stid = oci_parse($conn, $sql);
    
    oci_bind_by_name($stid, ":username", $user);
    oci_bind_by_name($stid, ":password", $pass);
    
    oci_execute($stid);
    
    // 2. Fetch the result
    if ($row = oci_fetch_assoc($stid)) {
        
        // 3. CAPTURE THE CUSTOMER ID
        // Oracle returns keys in UPPERCASE by default.
        // Ensure your database column is named 'CUSTOMER_ID' (or change this to 'ID')
        $_SESSION['customer_id'] = $row['CUSTOMER_ID']; 
        
        $_SESSION['username'] = $row['USERNAME'];
        $_SESSION['role'] = $row['ROLE'];

        if ($row['ROLE'] == 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error_msg = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck Rental Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="login-container">
    
   <div class="logo-badge">
        <img src="logo.png" alt="Truck Rental Logo">
    </div>

    <h2>Truck Rental Login</h2>

    <?php if (!empty($error_msg)): ?>
        <div class="error-message"><?php echo $error_msg; ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <div class="register-link">
        Don't have an account? <a href="register.php">Sign up here</a>
    </div>
</div>
</body>
</html>