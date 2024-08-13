<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User profile</title>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="user_profile.css">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   

</head>
<body>

<?php
   include '../config.php';
   include 'user_headersidebar.php'; 
   $user_id = $_SESSION['user_id'];
?>

<section class="profile">

   <h1 class="heading">profile details</h1>

<div class="details">

<?php
   $user_query = mysqli_query($conn, "SELECT id, name, email, image FROM `users` WHERE id='$user_id'") or die('query failed');
   $users_selected=mysqli_fetch_assoc($user_query);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
   $orders_selected = mysqli_num_rows($order_query);

?>


      <div class="user">
         <img src="./<?=$users_selected['image']; ?>" alt="">
         <h3><?= $users_selected['name']; ?></h3>
         <p><?= $users_selected['email']; ?></p>
         <a href="user_profileupdate.php" class="inline-btn">update profile</a>
      </div>

      <div class="box-container">

         <div class="box">
               <i class="fa-solid fa-cart-shopping"></i>
               <div>
                  <h3><?= $orders_selected ?></h3>
                  <span>Your Orders</span>
               </div>
            <a href="user_orders.php" class="btn">View Orders</a>
         </div>

         <!-- <div class="box">
               <i class="fas fa-heart"></i>
               <div>
                  <h3></h3>
                  <span>Previous Orders</span>
               </div>
            <a href="user_previousorders.php" class="btn">Previous Orders</a>
         </div> -->

         <!-- <div class="box">
            <div class="flex">
               <i class="fas fa-comment"></i>
               <div>
                  <h3><?= $total_comments; ?></h3>
                  <span>video comments</span>
               </div>
            </div>
            <a href="#" class="inline-btn">view comments</a>
         </div> -->

      </div>

   </div>

</section>

<!-- profile section ends -->



<!-- custom js file link  -->

</body>
<script src="user_script.js"></script>
</html>