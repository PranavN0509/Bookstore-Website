<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="user_orders.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <!-- custom css file link  -->

    <title>User Orders</title>
</head>
<body>

<?php
    include '../config.php';
    include 'user_headersidebar.php';
    $user_id = $_SESSION['user_id'];
?>


<section class="orders">
        <h1>Orders Section</h1>
        <div class="box-container">
           <?php
              $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
              if(mysqli_num_rows($order_query) > 0){
                 while($fetch_orders = mysqli_fetch_assoc($order_query)){
           ?>
           <div class="box">
              <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
              <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
              <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
              <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
              <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
              <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
              <p> your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
              <p> total price : <span>₹<?php echo $fetch_orders['total_price'];?>/-</span> </p>
              <p> order status : <span style = "color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span></p>
           </div>
           <?php
            }
           }else{
              echo '<p class="empty">no orders placed yet!</p>';
           }
           ?>
        </div>
     
     </section>
     
<?php
     include 'user_footer.php';
?>    
</body>
<script src="user_script.js"></script>
</html>