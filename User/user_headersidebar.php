<?php
   include '../config.php';
   session_start();
   $user_id = $_SESSION['user_id'];
   $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
   $user = mysqli_fetch_assoc($select_user);
   $user_image = $user['image'];

  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>User HeaderSidebar</title>
    <link rel="stylesheet" href="user_headersidebar.css">
</head>
<body>

   <header class="header">
      
      <div class="logo">
         <div id="menu-btn" class="fas fa-bars"></div>
         <img src="../Images/BooksmartLogo.png" alt="" srcset="">
         <div><a href="user_home.php">BookSmart</a></div>
      </div>
      
      <!-- <form action="" method="post" class="search-form"> -->
      <input type="text" id="live_search" name="search_books" placeholder="Search books..." maxlength="100" autocomplete="off">
         <!-- <button id="search-btn" type="submit" name="searchbooks" title="click here to submit"  class="fas fa-search"></button> -->
      <!-- </form> -->

<section id="search-result" class="search-show">
   <?php
   if(isset($_POST['add_to_cart'])){
      
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];
   
      $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
   
      if(mysqli_num_rows($check_cart_numbers) > 0){
         $message[] = 'already added to cart!';
      }else{
         mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
         $message[] = 'product added to cart!';
      }
      
   }
   ?>
</section>


<?php
   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   $cartitemcount = mysqli_num_rows($select_cart);

?>      
      <div class="icons">
         <a id="cart-btn" class="fa-solid fa-cart-shopping" href="user_cart.php">(<?php echo $cartitemcount;?>)</a>
         <div id="user-btn" >
         <img src="./<?=$user_image?>" alt=""><?= $user['name'];?>
         </div>
         <!-- <div id="search-btn" class="fas fa-search"></div> -->
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>


      <div class="profile">
         <img src="./<?=$user_image?>" class="image" alt="">
         <h3 class="name"><?= $user['name'];?></h3>
         <p class="useremail"><?= $user['email'];?></p>
         <a href="../logout.php" class="btn">Log Out</a>
         <!-- <div class="flex-btn">
            <a href="login.html" class="option-btn">login</a>
            <a href="register.html" class="option-btn">register</a>
         </div> -->
      </div>
  
  </header>  
  <?php
  ?> 
  
  <div class="side-bar">
     <div class="profile">
        <img src="./<?= $user_image?>" class="image" alt="">
        <h3 class="name"><?= $user['name'];?></h3>
        <p class="useremail"><?= $user['email'];?></p>
        <a href="user_profile.php" class="btn">view profile</a>
     </div>
  
     <nav class="navbar">
        <a href="user_Home.php"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="user_shop.php"><i class="fa-solid fa-shop"></i><span>Shop</span></a>
        <a href="user_orders.php"><i class="fa-solid fa-book"></i><span>Orders</span></a>
        <!-- <a href="user_cart.php"><i class="fa-solid fa-cart-shopping"></i><span>Cart</span></a> -->
        <!-- <a ><i class="fa-solid fa-circle-info"></i><span>About Us</span></a> -->
        <!-- <a ><i class="fa-solid fa-address-book"></i><span>Contact Us</span></a> -->
     </nav>
  
  </div>
  
   
</body>
<script src="user_script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type = 'text/javascript'>
   $(document).ready(function(){
      $("#live_search").keyup(function(){
         var input = $(this).val();
         // alert(input);
         if(input!=""){
            $.ajax({
               url:"ajax_livesearch.php",
               type: "POST",
               data: {
                  search:input
               },
               dataType: "text",
               success: function(data){
                  $("#search-result").html(data);
                }
            });
         }
      })
   })
</script>
</html>