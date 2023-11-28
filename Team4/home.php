
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


<div style="background-image: url('images/s.png'); background-repeat: no-repeat; background-size: cover; background-position: center;">

   <section style="display: flex; align-items: center; min-height: 20vh;">

      <div style="width: 50rem;">
         <span style="color:var(--orange); font-size: 10.0rem;"> M.A.M.S</span>

         <h3
         style="font-size: 3rem; text-transform: uppercase; margin-top: 1.5rem;
         color:var(--black);">Empowering Your Machines, Ensuring Your Success!</h3>

         <p style="font-size: 2.0rem;
         padding:1rem 0;
         line-height: 2;
         color:var(--light-color);"><b><i>Beyond Sale, We Manage Excellence!</i></b></p>

         <a style="display: inline-block;
         width: auto; "href="about.php" class="btn">about us</a>
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
         <a href="check_status.php" class="btn">Check Status</a>
      </div>


   </div>

</section>

<?php include 'footer.php'; ?>


<script src="js/script.js"></script>

</body>
</html>
