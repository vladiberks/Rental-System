<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Asset Rental</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style="display: block; height: auto;">

    <nav class="navbar">
        <div style="display: flex; align-items: center; gap: 10px;">
            <h2 style="margin: 0; color: #fff;">Asset Rental System</h2>
        </div>
        <div>
            <span style="color: white; margin-right: 10px;">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
            <a href="logout.php" style="color: #dc3545; text-decoration: none; font-weight: bold;">Logout</a>
        </div>
    </nav>

    <div style="text-align: center; padding: 40px 20px;">
        <h1>Available Assets</h1>
        <p style="color: white;">Browse our fleet of reliable equipment.</p>
    </div>

    <div class="truck-grid">
        <?php
        // Loop through the NEW ASSETS table
        while ($row = oci_fetch_assoc($assets_stid)) {
            
            // Get variables (Handle potential uppercase/lowercase column names)
            $brand = isset($row['BRAND']) ? $row['BRAND'] : 'N/A';
            $model = isset($row['MODEL']) ? $row['MODEL'] : 'N/A';
            $type = isset($row['ASSET_TYPE']) ? $row['ASSET_TYPE'] : 'Generic';
            $operator = isset($row['OPERATOR_NAME']) ? $row['OPERATOR_NAME'] : 'None';
            $status = isset($row['STATUS']) ? $row['STATUS'] : 'available';

            // Status Color Logic
            $statusColor = ($status == 'available') ? '#28a745' : '#dc3545'; // Green or Red
        ?>

        <div class="truck-card" style="padding: 20px; min-height: 200px;">
            <div class="card-body">
                <div class="card-title" style="font-size: 1.5em; font-weight: bold;">
                    <?php echo $brand . " " . $model; ?>
                </div>
                
                <hr style="margin: 15px 0; border: 0; border-top: 1px solid #eee;">

                <div class="card-text"><strong>Type:</strong> <?php echo $type; ?></div>
                <div class="card-text"><strong>Operator:</strong> <?php echo $operator; ?></div>

                <div style="margin-top: 15px; padding: 8px; background-color: <?php echo $statusColor; ?>; color: white; border-radius: 5px; text-align: center; font-weight: bold;">
                    <?php echo strtoupper($status); ?>
                </div>
            </div>
        </div>

        <?php } ?>
    </div>

</body>
</html>