// Check if the user is logged in as an user
<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <span>MAMAS</span>
         <h3>Empowering Your Machines, Ensuring Your Success!</h3>
         <p><white><b><i>Beyond Sale, We Manage Excellence!</i></b></white></p>
         <a href="about.php" class="btn">about us</a>
      </div>

   </section>

</div>

<section class="home-category">

   <h1 class="title">How can we help</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/history.png" alt="">
         <h3>purchase history</h3>
         <p>Track your journey with us! View and manage your purchase history</p>
         <a href="orders.php" class="btn">see History</a>
      </div>

      <div class="box">
         <img src="images/service.jpg" alt="">
         <h3>Service Request</h3>
         <p>Need assistance? Our Service Request option is your direct line to expert support.</p>
         <a href="contact.php" class="btn">Request Service</a>
      </div>


   </div>

</section>




<script src="js/script.js"></script>

</body>
</html>
