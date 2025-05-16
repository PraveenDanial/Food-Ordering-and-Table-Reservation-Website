<?php
include 'components/connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
   header('location:login.php');
   exit;
}

$user_id = $_SESSION['user_id'];
$message = [];

// Cancel reservation within 30 minutes
if (isset($_GET['cancel']) && is_numeric($_GET['cancel'])) {
   $cancel_id = $_GET['cancel'];
   $check_time = $conn->prepare("SELECT created_at FROM table_reservations WHERE id = ? AND user_id = ?");
   $check_time->execute([$cancel_id, $user_id]);
   $row = $check_time->fetch(PDO::FETCH_ASSOC);

   if ($row) {
      $created = strtotime($row['created_at']);
      $now = time();
      $diff = ($now - $created) / 60000;

      if ($diff <= 30) {
         $delete = $conn->prepare("DELETE FROM table_reservations WHERE id = ? AND user_id = ?");
         $delete->execute([$cancel_id, $user_id]);
         $message[] = 'Reservation cancelled successfully.';
      } else {
         $message[] = 'Cancellation period (30 minutes) has expired.';
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Your Table</title>
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php include 'components/user_header.php'; ?>

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
      $select_table = $conn->prepare("SELECT * FROM table_reservations WHERE user_id = ?");
      $select_table->execute([$user_id]);
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

      <a href="#" class="btn cancel-btn" 
         data-id="<?= $fetch_table['id']; ?>" 
         data-created="<?= strtotime($fetch_table['created_at']); ?>">
         Cancel
      </a>
   </div>
   <?php
         }
      } else {
         echo '<p class="empty">No reservations yet!</p>';
      }
   ?>

   </div>
</section>

<?php include 'components/footer.php'; ?>

<script>
document.querySelectorAll('.cancel-btn').forEach(button => {
   button.addEventListener('click', function(e) {
      e.preventDefault();
      const bookingId = this.dataset.id;
      const createdAt = parseInt(this.dataset.created);
      const now = Math.floor(Date.now() / 1000);
      const minutesPassed = (now - createdAt) / 60000;

      if (minutesPassed > 30) {
         Swal.fire({
            icon: 'warning',
            title: 'Time Expired!',
            text: 'You can only cancel within 30 minutes of booking.',
            confirmButtonText: 'OK'
         });
      } else {
         Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to cancel this reservation?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, cancel it!',
            cancelButtonText: 'No, keep it'
         }).then((result) => {
            if (result.isConfirmed) {
               window.location.href = `?cancel=${bookingId}`
               ;
            }
         });
      }
   });
});
</script>
<script src="js/script.js"></script>
</body>
</html>
