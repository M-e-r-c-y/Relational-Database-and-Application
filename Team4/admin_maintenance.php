<?php
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

// Update last maintenance date
if (isset($_POST['update_maintenance'])) {
    $new_maintenance_date = $_POST['new_maintenance_date'];
    // Perform necessary validation on $new_maintenance_date

    // Update the last maintenance date in your 'maintenance' table
    $update_last_maintenance = $conn->prepare("UPDATE `maintenance` SET `LastMaintenanceDate` = ? WHERE `id` = ?");
    $update_last_maintenance->execute([$new_maintenance_date, $admin_id]);

    $message[] = 'Maintenance date has been updated!';
}

// Fetch last maintenance date from your 'maintenance' table
$fetch_last_maintenance = $conn->prepare("SELECT `LastMaintenanceDate` FROM `maintenance` WHERE `id` = ?");
$fetch_last_maintenance->execute([$admin_id]);
$last_maintenance_date = $fetch_last_maintenance->fetchColumn();

// Calculate next maintenance date (90 days from last maintenance date)
$next_maintenance_date = date('Y-m-d', strtotime($last_maintenance_date . ' + 90 days'));

// Fetch placed orders
$select_orders = $conn->prepare("SELECT * FROM `orders`");
$select_orders->execute();
$orders = $select_orders->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Maintenance</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="maintenance">

   <h1 class="title">Maintenance</h1>

   <!-- Display last maintenance date and provide an option to update it -->
   <div class="maintenance-date">
      <p>Last Maintenance Date: <?= $last_maintenance_date; ?></p>
      <form action="" method="POST">
         <label for="new_maintenance_date">Update Last Maintenance Date:</label>
         <input type="date" name="new_maintenance_date" id="new_maintenance_date" required>
         <input type="submit" name="update_maintenance" value="Update">
      </form>
   </div>

   <!-- Display next maintenance date (90 days from last maintenance date) -->
   <div class="next-maintenance-date">
      <p>Next Maintenance Date: <?= $next_maintenance_date; ?></p>
   </div>

   <!-- Display placed orders -->
   <div class="box-container">
      <?php
         foreach ($orders as $fetch_orders) {
      ?>
         <div class="box">
            <!-- Display order details -->
            <p> User ID : <span><?= $fetch_orders['user_id']; ?></span> </p>
            <p> Placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
            <!-- ... (other order details) ... -->
         </div>
      <?php
         }
         if (empty($orders)) {
            echo '<p class="empty">No orders placed yet!</p>';
         }
      ?>
   </div>

</section>

<script src="js/script.js"></script>

</body>
</html>
