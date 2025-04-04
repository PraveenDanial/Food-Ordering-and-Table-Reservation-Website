<?php
include '../components/connect.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
   header('location:admin_login.php');
   exit;
}

if (isset($_POST['submit'])) {
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image_tmp = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_promotions/' . $image;

   if (!empty($image)) {
    move_uploaded_file($image_tmp, $image_folder);
 
    $insert = $conn->prepare("INSERT INTO promotions (title, image) VALUES (?, ?)");
    $insert->execute([$title, $image]);
 
    $_SESSION['message'] = 'Promotion added successfully!';
    header("Location: add_promotion.php");
    exit;
 } else {
    $_SESSION['message'] = 'Please select an image.';
    header("Location: add_promotion.php");
    exit;
 }
 
}
if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM `promotions` WHERE id = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);

    if ($fetch_delete_image && file_exists('../uploaded_promotions/'.$fetch_delete_image['image'])) {
        unlink('../uploaded_promotions/'.$fetch_delete_image['image']);
    }

    $delete_product = $conn->prepare("DELETE FROM `promotions` WHERE id = ?");
    $delete_product->execute([$delete_id]); // ✅ You missed this line

    header('location:add_promotion.php');
    exit;
}

 
?>

<!-- Simple HTML form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD Promotion</title>
       <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php include '../components/admin_header.php' ?>

    
<section class="add-products">


<form action="" method="POST" enctype="multipart/form-data">
      <h3>Add Promtion </h3>
      <input type="text" required placeholder="Enter title name" name="title" maxlength="100" class="box">
    
>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" name="submit" value="Add Promotion" class="btn"> 
   </form>

</section>

</section>

<section class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_products = $conn->prepare("SELECT * FROM `promotions`");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="../uploaded_promotions/<?= $fetch_products['image']; ?>" alt="">
 
      <div class="title"><?= $fetch_products['title']; ?></div>
      <div class="flex-btn">

         <a href="add_promotion.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

   </div>

</section>
<script src="../js/admin_script.js"></script>
</body>
</html>

