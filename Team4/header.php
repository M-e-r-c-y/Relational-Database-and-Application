<?php
/*"SJSU CMPE 138 FALL 2023 TEAM4"*/
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo"><i class="fas fa-solid fa-wrench fa-xl fa-shake"></i> MAMS<span>.</span></a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="orders.php">history</a>
         <a href="about.php">about</a>
         <a href="contact.php">service</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user" >
            <a href="user_profile_update.php">
               <?php 
               $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
               $select_profile->execute([$user_id]);
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
               echo $fetch_profile['name']; 
               ?>
            </a>
         </div>

      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="images/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name'];?></p>
         <a href="user_profile_update.php" class="btn">update profile</a>
         <a href="logout.php" class="delete-btn">logout</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div>

   </div>

</header>
