<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_repair'])){

    $repair_status = $_POST['repair_status'];
    $update_status = $_POST['update_status'];
    $update_status = filter_var($update_status, FILTER_SANITIZE_STRING);
    $update_repairs = $conn->prepare("UPDATE `repair` SET `status` = ? WHERE id = ?");
    $update_repairs->execute([$update_status, $repair_status]);
    $message[] = 'status has been updated!';
 
 };

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_repair = $conn->prepare("DELETE FROM `repair` WHERE id = ?");
   $delete_repair->execute([$delete_id]);
   header('location:admin_repair.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>repair</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">repairs</h1>

   <div class="box-container">

   <?php
      $select_repair = $conn->prepare("SELECT * FROM `repair`");
      $select_repair->execute();
      if($select_repair->rowCount() > 0){
         while($fetch_repair = $select_repair->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_repair['user_id']; ?></span> </p>
      <p> name : <span><?= $fetch_repair['name']; ?></span> </p>
      <p> number : <span><?= $fetch_repair['number']; ?></span> </p>
      <p> email : <span><?= $fetch_repair['email']; ?></span> </p>
      <p> message : <span><?= $fetch_repair['message']; ?></span> </p>
      <form action="" method="POST">
            <input type="hidden" name="repair_status" value="<?= $fetch_repair['status']; ?>">
            <select name="update_status" class="drop-down">
               <option value="" selected disabled><?= $fetch_repair['status']; ?></option>
               <option value="pending">pending</option>
               <option value="fixed">fixed</option>
            </select>
            <div class="flex-btn">
               <input type="submit" name="update_repair" class="option-btn" value="update">
               <a href="admin_repair.php?delete=<?= $fetch_repair['id']; ?>" class="delete-btn" onclick="return confirm('delete this repair?');">delete</a>
            </div>
        </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">you have no repairs!</p>';
      }
   ?>

   </div>

</section>













<script src="js/script.js"></script>

</body>
</html>
