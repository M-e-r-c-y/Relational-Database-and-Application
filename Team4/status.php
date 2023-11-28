<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>status</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <section class="placed-orders">

        <h1 class="title">Service Request Status</h1>

        <div class="box-container">

            <?php
            $select_status = $conn->prepare("SELECT * FROM `repair` WHERE user_id = ?");
            $select_status->execute([$user_id]);

            if ($select_status->rowCount() > 0) {
                while ($fetch_status = $select_status->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="box">
                        <p>Machine ID: <?= $fetch_status['id']; ?></p>
                        <p>Status: <?= $fetch_status['status']; ?></p>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">No service request found!</p>';
            }
            ?>

        </div>

    </section>


</body>

</html>