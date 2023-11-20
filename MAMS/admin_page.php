<?php
include 'config.php';

// Check if the user is logged in as an admin
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location: login.php');
    exit();
}

// Fetch data from the Machine table
$machineQuery = "SELECT * FROM Machine";
$machineResult = $conn->query($machineQuery);
$machineData = $machineResult->fetchAll(PDO::FETCH_ASSOC);

// Fetch data from the SparePart table
$sparePartQuery = "SELECT * FROM SparePart";
$sparePartResult = $conn->query($sparePartQuery);
$sparePartData = $sparePartResult->fetchAll(PDO::FETCH_ASSOC);

// Fetch data from the Maintenance table
$maintenanceQuery = "SELECT * FROM Maintenance";
$maintenanceResult = $conn->query($maintenanceQuery);
$maintenanceData = $maintenanceResult->fetchAll(PDO::FETCH_ASSOC);

// Fetch data from the Repair table
$repairQuery = "SELECT * FROM Repair";
$repairResult = $conn->query($repairQuery);
$repairData = $repairResult->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Add your CSS links here -->

</head>
<body>

<!-- Add your HTML and PHP code to display data here -->

<h1>Welcome to the Admin Dashboard</h1>

<!-- Display Machine data -->
<section>
    <h2>Machine Table</h2>
    <table border="1">
        <tr>
            <th>MachineID</th>
            <th>Model</th>
            <th>Specifications</th>
            <th>PurchaseDate</th>
            <th>WarrantyDetails</th>
        </tr>
        <?php foreach ($machineData as $machineRow): ?>
            <tr>
                <td><?php echo $machineRow['MachineID']; ?></td>
                <td><?php echo $machineRow['Model']; ?></td>
                <td><?php echo $machineRow['Specifications']; ?></td>
                <td><?php echo $machineRow['PurchaseDate']; ?></td>
                <td><?php echo $machineRow['WarrantyDetails']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<!-- Display SparePart data -->
<section>
    <h2>SparePart Table</h2>
    <table border="1">
        <tr>
            <th>PartNumber</th>
            <th>Description</th>
            <th>QuantityAvailable</th>
            <th>SupplierDetails</th>
            <th>Price</th>
            <th>UsageHistory</th>
        </tr>
        <?php foreach ($sparePartData as $sparePartRow): ?>
            <tr>
                <td><?php echo $sparePartRow['PartNumber']; ?></td>
                <td><?php echo $sparePartRow['Description']; ?></td>
                <td><?php echo $sparePartRow['QuantityAvailable']; ?></td>
                <td><?php echo $sparePartRow['SupplierDetails']; ?></td>
                <td><?php echo $sparePartRow['Price']; ?></td>
                <td><?php echo $sparePartRow['UsageHistory']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<!-- Display Maintenance data -->
<section>
    <h2>Maintenance Table</h2>
    <table border="1">
        <tr>
            <th>MaintenanceID</th>
            <th>MachineID</th>
            <th>MaintenanceType</th>
            <th>MaintenanceDate</th>
            <th>Details</th>
        </tr>
        <?php foreach ($maintenanceData as $maintenanceRow): ?>
            <tr>
                <td><?php echo $maintenanceRow['MaintenanceID']; ?></td>
                <td><?php echo $maintenanceRow['MachineID']; ?></td>
                <td><?php echo $maintenanceRow['MaintenanceType']; ?></td>
                <td><?php echo $maintenanceRow['MaintenanceDate']; ?></td>
                <td><?php echo $maintenanceRow['Details']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<!-- Display Repair data -->
<section>
    <h2>Repair Table</h2>
    <table border="1">
        <tr>
            <th>RepairID</th>
            <th>MachineID</th>
            <th>IssueDescription</th>
            <th>RepairDate</th>
            <th>Details</th>
        </tr>
        <?php foreach ($repairData as $repairRow): ?>
            <tr>
                <td><?php echo $repairRow['RepairID']; ?></td>
                <td><?php echo $repairRow['MachineID']; ?></td>
                <td><?php echo $repairRow['IssueDescription']; ?></td>
                <td><?php echo $repairRow['RepairDate']; ?></td>
                <td><?php echo $repairRow['Details']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

</body>
</html>
