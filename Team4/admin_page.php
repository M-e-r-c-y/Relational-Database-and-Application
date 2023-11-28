<?php
/*"SJSU CMPE 138 FALL 2023 TEAM4"*/
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>

<?php include 'admin_header.php'; ?> <?php /* link to admin header*/ ?>

<section class="dashboard">
   <h1 class="title">dashboard</h1>

   <div class="box-container">

<?php /* Create link to product page*/ ?>
     <div class="box">
     <?php
        $select_products = $conn->prepare("SELECT * FROM `products`");
        $select_products->execute();
        $number_of_products = $select_products->rowCount();
     ?>
     <h3><i class="fa-regular fa-folder-open"></i></h3>
     <p><b style="color:Tomato;"><?= $number_of_products; ?></b>  Products Added</p>
     <a href="admin_products.php" class="btn">Manage products</a>
     </div>

<?php /* Create link to page where we can sell products*/ ?>
     <div class="box">
     <h3><i class="fa-solid fa-comments-dollar"></i></h3>
     <p><b style="color:Tomato;">Choose </b>Products</p>
     <a href="shop.php" class="btn">Sell Products</a>
     </div>

<?php /* Create link to page where we can access pending sell*/ ?>
     <div class="box">
      <?php
      $select_cart = $conn->prepare("SELECT * FROM `cart`");
      $select_cart->execute();
      $number_of_cart = $select_cart->rowCount();
      ?>
      <h3><i class="fas fa-hourglass"></i></h3>
     <p><b style="color:Tomato;"><?= $number_of_cart; ?></b> Pending Products</p>
      <a href="cart.php" class="btn">Pending Orders</a>
      </div>

<?php /* Create link to page where we can see sales made*/ ?>
      <div class="box">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $number_of_orders = $select_orders->rowCount();
      ?>
      <h3><i class="fas fa-shopping-cart"></i></h3>
      <p><b style="color:Tomato;"><?= $number_of_orders; ?> </b>Total Sales</p>
      <a href="admin_orders.php" class="btn">Sales Record</a>
      </div>

<?php /* link to Service request page*/ ?>
      <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `message`");
         $select_messages->execute();
         $number_of_messages = $select_messages->rowCount();
      ?>
      <h3><i class="fas fa-message"></i></h3>
      <p><b style="color:Tomato;"><?= $number_of_messages; ?></b> Requests</p>
      <a href="admin_contacts.php" class="btn">Service Requests</a>
      </div>

<?php /* link to Account pages*/ ?>
      <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
         $select_admins->execute(['admin']);
         $number_of_admins = $select_admins->rowCount();
      ?>
      <h3><i class="fas fa-lock"></i></h3>
      <p><b style="color:Tomato;"><?= $number_of_admins; ?></b> Admin</p>
      <a href="admin_users.php" class="btn">Admin accounts</a>
      </div>

      <?php /*
           <div class="box">
           <?php
              $select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
              $select_users->execute(['user']);
              $number_of_users = $select_users->rowCount();
           ?>
           <h3><i class="fas fa-user"></i></h3>
           <p><b style="color:Tomato;"><?= $number_of_users; ?></b> Customer</p>
           <a href="admin_users.php" class="btn">customer accounts</a>
           </div>
           */ ?>

<?php /* link to Repair page*/ ?>
      <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `repair`");
         $select_messages->execute();
         $number_of_messages = $select_messages->rowCount();
      ?>
      <h3><i class="fa-regular fa-thumbs-up"></i></h3>
      <p><b style="color:Tomato;">Manage </b>Repairs</p>
      <a href="admin_repair.php" class="btn">Repairs</a>
      </div>
      
<?php /* link to Maintenance page*/ ?>      
      <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `repair`");
         $select_messages->execute();
         $number_of_messages = $select_messages->rowCount();
      ?>
      <h3><i class="fa-regular fa-bell"></i></h3>
      <p><b style="color:Tomato;">Manage </b>Maintenance</p>
      <a href="admin_maintenance.php" class="btn">Maintenance</a>
      </div>
      
      



   </div>
</section>



<script src="js/script.js"></script>

</body>
</html>
