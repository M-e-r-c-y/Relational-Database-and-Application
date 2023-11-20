<?php

include 'config.php';

// Check if the user is logged in as an admin
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location: login.php');
    exit();
}

// Admin page content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/components.css">

    <style>
        /* Add any additional styles for the admin page here */
        /* For example, styling for the navigation menu */
        .admin-nav {
            background-color: #333;
            overflow: hidden;
        }

        .admin-nav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .admin-nav a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body style="background-image: url('images/admin_back.jpg');">

<?php
// Display any messages (e.g., success messages or errors)
if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<!-- Admin Navigation Menu -->
<div class="admin-nav">
    <a href="#maintenanceTasks">Maintenance Tasks</a>
    <a href="#repairs">Repairs</a>
    <a href="#customers">Customers</a>
    <a href="#machines">Machines</a>
    <a href="logout.php" style="float: right;">Logout</a>
</div>

<!-- Content Sections -->
<section id="maintenanceTasks">
    <h2>Maintenance Task Table</h2>
    <?php
    // SQL query to create MaintenanceTask table
    $maintenanceTaskQuery = "
        CREATE TABLE MaintenanceTask (
            TaskID INT PRIMARY KEY,
            MachineID INT,
            TechnicianID INT,
            Description TEXT,
            TaskDate DATE,
            Status VARCHAR(50),
            FOREIGN KEY (MachineID) REFERENCES Machine(MachineID),
            FOREIGN KEY (TechnicianID) REFERENCES Technician(TechnicianID)
        );
    ";
    $conn->exec($maintenanceTaskQuery);
    echo "MaintenanceTask table created successfully.";
    ?>
</section>

<section id="repairs">
    <h2>Repair Table</h2>
    <?php
    // SQL query to create Repair table
    $repairQuery = "
        CREATE TABLE Repair (
            RepairID INT PRIMARY KEY,
            MachineID INT REFERENCES Machine(MachineID),
            IssueDescription TEXT,
            RepairDate DATE,
            Details TEXT
        );
    ";
    $conn->exec($repairQuery);
    echo "Repair table created successfully.";
    ?>
</section>

<section id="customers">
    <h2>Customer Table</h2>
    <?php
    // SQL query to create Customer table
    $customerQuery = "
        CREATE TABLE Customer (
            CustomerID INT PRIMARY KEY,
            ContactInformation TEXT,
            MachinesOwned TEXT,
            PurchaseHistory TEXT,
            WarrantyInformation TEXT,
            PasswordHash VARCHAR(255),
            Salt VARCHAR(50)
        );
    ";
    $conn->exec($customerQuery);
    echo "Customer table created successfully.";
    ?>
</section>

<section id="machines">
    <h2>Machine Table</h2>
    <?php
    // SQL query to create Machine table
    $machineQuery = "
        CREATE TABLE Machine (
            MachineID INT PRIMARY KEY,
            Model VARCHAR(255),
            Specifications TEXT,
            PurchaseDate DATE,
            WarrantyDetails TEXT,
            ServiceHistory TEXT,
            MaintenanceSchedules TEXT
        );
    ";
    $conn->exec($machineQuery);
    echo "Machine table created successfully.";
    ?>
</section>

</body>
</html>
