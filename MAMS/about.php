<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/about-img-1.png" alt="">
         <h3>why choose us?</h3>
         <p>Elevate your business with MAMS, offering seamless machine lifecycle management, efficient maintenance, and unparalleled customer support. Trust us for real-time insights, warranty management, and a hassle-free experience. Choose MAMS – the smart choice for sustainable growth.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

      <div class="box">
         <img src="images/about-img-2.png" alt="">
         <h3>what we provide?</h3>
         <p>At MAMS, we provide comprehensive machine lifecycle management, efficient maintenance solutions, and unparalleled customer support. Our services include real-time insights, warranty management, and a seamless user experience. Choose MAMS for excellence in after-sales services and sustainable business growth</p>
         <a href="shop.php" class="btn">our shop</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">clients reivews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/prof.jpeg" alt="">
         <p>Outstanding support! MAMS has transformed our machine management. Quick responses, efficient maintenance, and a user-friendly interface make them our go-to choice.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Gheorghi Guzun</h3>
      </div>

      <div class="box">
         <img src="images/albert.jpg" alt="">
         <p>MAMS is a game-changer for our business. The real-time insights and seamless customer interactions have elevated our after-sales experience. Highly recommended!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Albert Einstein</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>Impressive warranty management! MAMS ensures our machines are always covered. The team's expertise and quick resolutions have exceeded our expectations.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>John Deo</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>Choosing MAMS was a wise decision. The machine lifecycle management is top-notch. Their commitment to customer satisfaction sets them apart. Excellent service!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Jane Dan</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>Efficiency redefined! MAMS delivers on its promise of efficient maintenance and timely support. Our machines perform optimally, thanks to their proactive approach.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Alex Smith</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>MAMS provides a hassle-free experience. Their user-friendly interface simplifies machine management, and the dedicated support team is always ready to assist. Truly satisfied!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Sean Lee</h3>
      </div>

   </div>

</section>



<script src="js/script.js"></script>

</body>
</html>

