<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .form-section { text-align: left; margin-bottom: 10px; }
        .form-section label { font-weight: bold; font-size: 12px; color: #666; display: block; margin-top: 10px; }
        .row { display: flex; gap: 10px; }
        select { width: 100%; padding: 12px; border-radius: 8px; border: 2px solid transparent; background-color: #f0f2f5; margin-top: 5px; }
    </style>
</head>
<body>

    <div class="login-container" style="max-width: 500px;">
        
        <div class="logo-badge">
            <img src="logo.png" alt="Truck Rental Logo">
        </div>

        <h2>Create Account</h2>

        <?php if (!empty($error_msg)): ?>
            <div class="error-message"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <?php if (!empty($success_msg)): ?>
            <div style="color: #28a745; background-color: #d4edda; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?php echo $success_msg; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="register.php"> <div class="form-section">
                <div class="row">
                    <div style="flex:1;">
                        <label>First Name</label>
                        <input type="text" name="first_name" required placeholder="Juan">
                    </div>
                    <div style="flex:1;">
                        <label>Middle</label>
                        <input type="text" name="middle_name" placeholder="D.">
                    </div>
                    <div style="flex:1;">
                        <label>Last Name</label>
                        <input type="text" name="last_name" required placeholder="Dela Cruz">
                    </div>
                </div>

                <label>Complete Address</label>
                <input type="text" name="address" required placeholder="e.g. 123 Rizal St, Naga City">

                <div class="row">
                    <div style="flex:1;">
                        <label>Contact Number</label>
                        <input type="text" name="contact_number" required placeholder="0912..." maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <div style="flex:1;">
                        <label>Customer Type</label>
                        <select name="customer_type" required>
                            <option value="" disabled selected>Select Type</option>
                            <option value="Individual">Individual (Personal)</option>
                            <option value="Business">Business / Company</option>
                            <option value="Government">Government</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr style="border: 0; border-top: 1px solid #eee; margin: 15px 0;">

            <div class="form-section">
                <label>Username</label>
                <input type="text" name="username" placeholder="Choose a Username" required>
                
                <div class="row">
                    <div style="flex:1;">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div style="flex:1;">
                        <label>Confirm</label>
                        <input type="password" name="confirm_password" placeholder="Confirm" required>
                    </div>
                </div>
            </div>
            
            <button type="submit" style="margin-top: 20px;">Sign Up</button>
        </form>

        <div class="register-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>

</body>
</html>