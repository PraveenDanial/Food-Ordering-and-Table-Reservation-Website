<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};
// Cancel reservation within 30 minutes
if (isset($_GET['cancel']) && is_numeric($_GET['cancel'])) {
   $cancel_id = $_GET['cancel'];
   $select_table = $conn->prepare("SELECT * FROM table_reservations");
   $select_table->execute();
   $row = $check_time->fetch(PDO::FETCH_ASSOC);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Your Table</title>
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php' ?>

<?php if(!empty($message) && is_array($message)): ?>
   <?php foreach($message as $msg): ?>
      <div class="message">
         <span><?= $msg; ?></span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
   <?php endforeach; ?>
<?php endif; ?>


<div class="heading">
   <h3>Reservation</h3>
   <p><span>Table</span></p>
</div>

<section class="orders">
   <h1 class="title">Your Table</h1>
   <div class="box-container">

   <?php
      $select_table = $conn->prepare("SELECT * FROM `table_reservations`");
      $select_table->execute();
      if($select_table->rowCount() > 0){
         while($fetch_table = $select_table->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>name: <span><?= $fetch_table['name']; ?></span></p>
      <p>Phone Number: <span><?= $fetch_table['Phonenumber']; ?></span></p>
      <p>Table Number: <span><?= $fetch_table['tableNumber']; ?></span></p>
      <p>email: <span><?= $fetch_table['email']; ?></span></p>
      <p>Time: <span><?= $fetch_table['time']; ?></span></p>
      <p>Date: <span><?= $fetch_table['date']; ?></span></p>
    
   </div>
   <?php
         }
      } else {
         echo '<p class="empty">No reservations yet!</p>';
      }
   ?>

   </div>
</section>




<script src="js/script.js"></script>
</body>
</html>
