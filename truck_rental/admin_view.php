<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="admin-container">
        <div class="admin-header">
            <h2>Admin Dashboard - Asset Management</h2>
            <a href="logout.php"><button class="logout-btn">Logout</button></a>
        </div>

        <?php if (!empty($message)): ?>
            <p style="color: green; font-weight: bold;"><?php echo $message; ?></p>
        <?php endif; ?>

        <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h3>+ Add New Asset</h3>
            <form method="post" action="admin.php" style="display: flex; gap: 10px; flex-wrap: wrap;">
                
                <input type="text" name="brand" placeholder="Brand (e.g. Caterpillar)" required style="flex: 2;">

                <input type="text" name="model" placeholder="Model (e.g. 320 GC)" required style="flex: 2;">
                
                <input type="text" name="type" placeholder="Type (e.g. Excavator)" required style="flex: 1;">
                
                <input type="text" name="operator" placeholder="Operator Name" required style="flex: 1;">

                <button type="submit" name="add_asset" style="width: auto; margin: 0;">Add Asset</button>
            </form>
        </div>

        <h3>Current Fleet</h3>
        <table>
            <thead>
                <tr>
                    <th>Brand</th> <th>Model</th>
                    <th>Type</th>
                    <th>Operator</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = oci_fetch_assoc($trucks_stid)) {
                    $id = $row['ASSET_ID'];
                    
            
                    $brand = isset($row['BRAND']) ? $row['BRAND'] : 'N/A';
                    
                    $model = isset($row['MODEL']) ? $row['MODEL'] : 'N/A';
                    $type = isset($row['ASSET_TYPE']) ? $row['ASSET_TYPE'] : 'N/A';
                    $operator = isset($row['OPERATOR_NAME']) ? $row['OPERATOR_NAME'] : 'None';
                    $status = isset($row['STATUS']) ? $row['STATUS'] : 'available';
                    
                    $statusColor = ($status == 'available') ? 'green' : 'red';
                ?>
                    <tr>
                        <td><?php echo $brand; ?></td>
                        <td><?php echo $model; ?></td>
                        <td><?php echo $type; ?></td>
                        <td><?php echo $operator; ?></td>
                        
                        <td style="color: <?php echo $statusColor; ?>; font-weight: bold;">
                            <?php echo strtoupper($status); ?>
                        </td>
                        
                        <td>
                            <a href="admin.php?delete_id=<?php echo $id; ?>" 
                               class="action-btn delete-btn"
                               style="color: red; text-decoration: none;"
                               onclick="return confirm('Are you sure you want to delete this asset?');">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>