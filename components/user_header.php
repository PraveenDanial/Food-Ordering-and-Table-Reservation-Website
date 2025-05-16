<?php

@include '../components/connect.php';  // Adjust the path if needed

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
   

   <section class="flex">


   <a href="home.php" class="homeLogo" ><img src="images/hm.jpeg" alt=""></a>
      <a href="home.php" class="logo">NJ FOOD CENTER</a>

      <nav class="navbar">
         <a href="home.php">HOME</a>
         <a href="about.php">ABOUT</a>
         <a href="menu.php">MENU</a>
         <a href="orders.php">ORDER</a>
         <a href="contact.php">CONTACT</a>
         <a href="table_reserve.php">TABLE BOOKING</a>
         <a href="seeUrTable.php">YOUR RESERVATION</a>
         <a href="admin/admin_login.php" class="admin-login-link">Admin Login</a>

      </nav>

      <div class="icons">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn">profile</a>
            <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         </div>
       
         <?php
            }else{
         ?>
            <p class="account">
            <a href="login.php" class="btn">login</a> 
         </p> 
 
         <?php
          }
         ?>
      </div>

   </section>




</header>