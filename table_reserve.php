<?php
include 'components/connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
   header('location:login.php');
   exit;
}

$user_id = $_SESSION['user_id'];
$message = [];
if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $tableNumber = $_POST['tableNumber'];
   $time = $_POST['time'];
   $date = $_POST['date'];

   // 1. Check if the user has already booked 2 tables
   $check_user_tables = $conn->prepare("SELECT COUNT(*) FROM table_reservations WHERE user_id = ?");
   $check_user_tables->execute([$user_id]);
   $table_count = $check_user_tables->fetchColumn();

   if ($table_count >= 2) {
      $message[] = 'You can only reserve up to 2 tables!';
   } else {
      // 2. Check if the specific table, date and time is already booked
      $check_table = $conn->prepare("SELECT * FROM table_reservations WHERE tableNumber = ? AND date = ? AND time = ?");
      $check_table->execute([$tableNumber, $date, $time]);

      if ($check_table->rowCount() > 0) {
         $message[] = 'This table is already reserved for the selected date and time.';
      } else {
         // 3. Insert reservation
         $insert = $conn->prepare("INSERT INTO table_reservations (user_id, name, email, Phonenumber, tableNumber, time, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
         $insert->execute([$user_id, $name, $email, $phone, $tableNumber, $time, $date]);
         $message = [];
         $message[] = 'Table reserved successfully!';
      }
   }
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include 'components/user_header.php'; ?>


<section class="form-container">


   <form action="" method="post">
      <h3>register now</h3>
          
<div class="imgtable">
            <div class="content">
               <span>order online</span>
               <h3>chezzy hamburger</h3>
               <a href="menu.html" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="images/home-img-2.png" alt="">
            </div>
         </div>
      <input type="text" name="name" required placeholder="Enter your name" class="box">
<input type="email" name="email" required placeholder="Enter your email" class="box">
<input type="tel" name="phone" required placeholder="Enter your phone number" class="box" maxlength="15">

<input type="text" name="tableNumber" required placeholder="Enter your table number Eg:T16" class="box">
<input type="time" name="time" required class="box">
<input type="date" name="date" required class="box">
<input type="submit" value="Reserve Your Table" name="submit" class="btn">

   </form>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>

</body>
</html>
